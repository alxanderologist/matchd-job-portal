<?php

session_start();

require __DIR__ . '/../db/config.php';




if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $employerID = $_SESSION["user-id"];
    $jobTitle = $_POST["job-title"];
    $employmentType = $_POST["employment-type"];
    $workSetup = $_POST["work-setup"];
    $location = $_POST["location"];
    $minSalary = $minSalary = !empty($_POST["min-salary"]) ? $_POST["min-salary"] : null;
    $maxSalary = $maxSalary = !empty($_POST["max-salary"]) ? $_POST["max-salary"] : null;
    $rawTags = $_POST["submitted-tags"];
    $description = $_POST["description"];
    $requirements = $_POST["requirements"];

    $connection->begin_transaction();

    try {

        $query = $connection->prepare("INSERT INTO jobs (employer_id, job_title, employment_type, work_setup, location, salary_min, salary_max, description, requirements) VALUES (?,?,?,?,?,?,?,?,?)");
        $query->bind_param("issssssss", $employerID, $jobTitle, $employmentType, $workSetup, $location, $minSalary, $maxSalary, $description, $requirements);
        $query->execute();

        $newJobID = $connection->insert_id;

        if (!empty(trim($rawTags))) {

            $tagArray = array_unique(explode(',', $rawTags));

            $checkTag = $connection->prepare("SELECT id from tags where name=?");
            $insertTag = $connection->prepare("INSERT INTO tags (name) VALUES (?)");
            $linkTag = $connection->prepare("INSERT INTO job_tags (job_id, tag_id) VALUES (?,?)");

            foreach ($tagArray as $tagName) {
                $cleanTag = strtolower(trim($tagName));

                if (empty($cleanTag)) continue;

                $checkTag->bind_param('s', $cleanTag);
                $checkTag->execute();
                $checkResult = $checkTag->get_result();

                $tagID = null;

                if ($row = $checkResult->fetch_assoc()) {
                    $tagID = $row['id'];
                } else {
                    $insertTag->bind_param('s', $cleanTag);
                    $insertTag->execute();
                    $tagID = $connection->insert_id;
                }

                $linkTag->bind_param("ii", $newJobID, $tagID);
                $linkTag->execute();
            }

            $checkTag->close();
            $insertTag->close();
            $linkTag->close();
        }

        $connection->commit();
        $query->close();

        header("Location: ../employer/e-dashboard.php");
    } catch (Exception $e) {
        $connection->rollback();
        die("Error creating job: "  . $e->getMessage());
    }
}
