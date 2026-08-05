<?php

session_start();

require __DIR__ . '/../db/config.php';

// dapat naka login ka as applicant
if (!isset($_SESSION['user-id']) || $_SESSION['user-role'] !== 'applicant') {
    header("Location: ../sessionPHP/login-page.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../applicant/a-profile.php");
    exit;
}

$userId = $_SESSION['user-id'];

$fullName  = trim($_POST['full_name'] ?? '');
$headline  = trim($_POST['headline'] ?? '');
$phone     = trim($_POST['phone_number'] ?? '');
$bio       = trim($_POST['bio'] ?? '');
$education = trim($_POST['education'] ?? '');
$github    = trim($_POST['github_url'] ?? '');
$portfolio = trim($_POST['portfolio_url'] ?? '');
$rawTags   = trim($_POST['submitted-tags'] ?? '');

if (empty($fullName)) {
    header("Location: ../applicant/a-profile.php?error=name_required");
    exit;
}

// Empty optional fields should be stored as NULL, not empty strings
$headline  = $headline !== '' ? $headline : null;
$phone     = $phone !== '' ? $phone : null;
$bio       = $bio !== '' ? $bio : null;
$education = $education !== '' ? $education : null;
$github    = $github !== '' ? $github : null;
$portfolio = $portfolio !== '' ? $portfolio : null;

$newResumePath = null;

if (isset($_FILES['resume']) && $_FILES['resume']['error'] !== UPLOAD_ERR_NO_FILE) {

    $file = $_FILES['resume'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        header("Location: ../applicant/a-profile.php?error=upload_failed");
        exit;
    }

    $allowedExt = ['pdf', 'doc', 'docx'];
    $maxBytes   = 5 * 1024 * 1024; // 5MB

    $originalName = $file['name'];
    $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

    if (!in_array($ext, $allowedExt)) {
        header("Location: ../applicant/a-profile.php?error=bad_filetype");
        exit;
    }

    if ($file['size'] > $maxBytes) {
        header("Location: ../applicant/a-profile.php?error=file_too_large");
        exit;
    }

    $uploadDir = __DIR__ . '/../uploads/resumes/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Unique filename so uploads never collide or overwrite another user's file
    $safeFileName = 'resume_' . $userId . '_' . time() . '.' . $ext;
    $destination  = $uploadDir . $safeFileName;

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        header("Location: ../applicant/a-profile.php?error=upload_failed");
        exit;
    }

    // Path stored relative to project root, used for links/display later
    $newResumePath = 'uploads/resumes/' . $safeFileName;
}

$connection->begin_transaction();

try {
    // Update users table (full_name is in users, not in applicant_profiles)
    $updateUser = $connection->prepare("UPDATE users SET full_name = ? WHERE id = ?");
    $updateUser->bind_param("si", $fullName, $userId);
    $updateUser->execute();
    $updateUser->close();

    // Update applicant_profiles
    if ($newResumePath !== null) {
        $updateProfile = $connection->prepare(
            "UPDATE applicant_profiles
             SET headline = ?, phone_number = ?, bio = ?, education = ?, github_url = ?, portfolio_url = ?, resume_path = ?
             WHERE user_id = ?"
        );
        $updateProfile->bind_param(
            "sssssssi",
            $headline, $phone, $bio, $education, $github, $portfolio, $newResumePath, $userId
        );
    } else {
        $updateProfile = $connection->prepare(
            "UPDATE applicant_profiles
             SET headline = ?, phone_number = ?, bio = ?, education = ?, github_url = ?, portfolio_url = ?
             WHERE user_id = ?"
        );
        $updateProfile->bind_param(
            "ssssssi",
            $headline, $phone, $bio, $education, $github, $portfolio, $userId
        );
    }
    $updateProfile->execute();
    $updateProfile->close();

    // Get this applicant's profile id (applicant_tags links to applicant_profiles.id, not users.id) 
    $profileIdStmt = $connection->prepare("SELECT id FROM applicant_profiles WHERE user_id = ?");
    $profileIdStmt->bind_param("i", $userId);
    $profileIdStmt->execute();
    $profileRow = $profileIdStmt->get_result()->fetch_assoc();
    $profileIdStmt->close();
    $applicantProfileId = $profileRow['id'] ?? null;

    // Sync skill tags (same add-if-missing pattern as create-job.php) 
    if ($applicantProfileId !== null) {

        // Clear old tag links first, then re-insert whatever was submitted.
        // Simplest correct way to also handle tags the user removed.
        $clearTags = $connection->prepare("DELETE FROM applicant_tags WHERE applicant_id = ?");
        $clearTags->bind_param("i", $applicantProfileId);
        $clearTags->execute();
        $clearTags->close();

        if (!empty($rawTags)) {
            $tagArray = array_unique(explode(',', $rawTags));

            $checkTag  = $connection->prepare("SELECT id FROM tags WHERE name = ?");
            $insertTag = $connection->prepare("INSERT INTO tags (name) VALUES (?)");
            $linkTag   = $connection->prepare("INSERT INTO applicant_tags (applicant_id, tag_id) VALUES (?, ?)");

            foreach ($tagArray as $tagName) {
                $cleanTag = strtolower(trim($tagName));

                if (empty($cleanTag)) continue;

                $checkTag->bind_param('s', $cleanTag);
                $checkTag->execute();
                $checkResult = $checkTag->get_result();

                if ($row = $checkResult->fetch_assoc()) {
                    $tagID = $row['id'];
                } else {
                    $insertTag->bind_param('s', $cleanTag);
                    $insertTag->execute();
                    $tagID = $connection->insert_id;
                }

                $linkTag->bind_param("ii", $applicantProfileId, $tagID);
                $linkTag->execute();
            }

            $checkTag->close();
            $insertTag->close();
            $linkTag->close();
        }
    }

    $connection->commit();

    // Keep the session's display name in sync
    $_SESSION['user-name'] = $fullName;

    header("Location: ../applicant/a-profile.php?success=1");
    exit;

} catch (Exception $e) {
    $connection->rollback();
    header("Location: ../applicant/a-profile.php?error=save_failed");
    exit;
}