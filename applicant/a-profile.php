<?php

session_start();

require __DIR__ . '/../db/config.php';

// --- Auth guard: must be logged in as an applicant ---
if (!isset($_SESSION['user-id']) || $_SESSION['user-role'] !== 'applicant') {
    header("Location: ../sessionPHP/login-page.php");
    exit;
}

$userId = $_SESSION['user-id'];

$stmt = $connection->prepare(
    "SELECT u.full_name, u.email, p.id AS profile_id, p.headline, p.phone_number, p.bio, p.education,
            p.resume_path, p.gi`thub_url, p.portfolio_url, p.availability_status
     FROM users u
     LEFT JOIN applicant_profiles p ON p.user_id = u.id
     WHERE u.id = ?"
);
$stmt->bind_param("i", $userId);
$stmt->execute();
$profile = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Pull this applicant's current skill tags
$skillTags = [];
if (!empty($profile['profile_id'])) {
    $tagStmt = $connection->prepare(
        "SELECT t.name FROM applicant_tags at
         JOIN tags t ON t.id = at.tag_id
         WHERE at.applicant_id = ?
         ORDER BY t.name"
    );
    $tagStmt->bind_param("i", $profile['profile_id']);
    $tagStmt->execute();
    $tagResult = $tagStmt->get_result();
    while ($row = $tagResult->fetch_assoc()) {
        $skillTags[] = $row['name'];
    }
    $tagStmt->close();
}

// Fallback in case a profile row doesn't exist yet for some reason
$fullName    = $profile['full_name'] ?? '';
$email       = $profile['email'] ?? '';
$headline    = $profile['headline'] ?? '';
$phone       = $profile['phone_number'] ?? '';
$bio         = $profile['bio'] ?? '';
$education   = $profile['education'] ?? '';
$resumePath  = $profile['resume_path'] ?? '';
$github      = $profile['github_url'] ?? '';
$portfolio   = $profile['portfolio_url'] ?? '';

$initials = '';
foreach (explode(' ', trim($fullName)) as $part) {
    if ($part !== '') $initials .= strtoupper($part[0]);
}
$initials = substr($initials, 0, 2) ?: '??';

$successMessage = null;
$errorMessage = null;

if (isset($_GET['success'])) {
    $successMessage = "Profile Changed Successfully.";
}

if (isset($_GET['error'])) {
    $errorMap = [
        'name_required'  => 'Full name cannot be empty.',
        'bad_filetype'   => 'Resume must be a PDF, DOC, or DOCX file.',
        'file_too_large' => 'Resume file must be 5MB or smaller.',
        'upload_failed'  => 'Something went wrong uploading your resume. Please try again.',
        'save_failed'    => 'Something went wrong saving your profile. Please try again.',
    ];
    $errorMessage = $errorMap[$_GET['error']] ?? 'Something went wrong. Please try again.';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="../output.css">
    <title>Matchd | Applicant Dashboard</title>
</head>
<body class="bg-blue-50/50 text-slate-800 font-sans min-h-screen flex antialiased">


    <aside class="w-64 bg-slate-900 text-white min-h-screen p-5 flex flex-col justify-between border-r border-slate-800 shrink-0">
        <div class="space-y-8">

            <div class="px-2 pt-2 flex items-center gap-3">
                <img src="../images/matchd-logo.png" alt="Matchd Logo" class="h-8 w-auto">
                <span class="text-[10px] bg-[#1f48ff]/20 text-[#1f48ff] border border-[#1f48ff]/30 px-2 py-0.5 rounded-full font-semibold ml-auto">Applicant</span>
            </div>

            <!-- List of Menu Items -->
            <nav class="space-y-1.5">

                <a href="a-jobs.php" class="flex items-center gap-3 text-slate-400 hover:text-white hover:bg-slate-800/60 font-medium px-3 py-2 rounded-xl transition text-sm">
                    <i data-lucide="compass" class="w-4 h-4"></i>
                    Explore Jobs
                </a>
                <a href="a-applications.php" class="flex items-center gap-3 text-slate-400 hover:text-white hover:bg-slate-800/60 font-medium px-3 py-2 rounded-xl transition text-sm">
                    <i data-lucide="briefcase" class="w-4 h-4"></i>
                    My Applications
                    <span class="ml-auto bg-slate-800 text-slate-300 text-xs px-2 py-0.5 rounded-full font-bold">3</span>
                </a>
                <a href="a-interview.php" class="flex items-center gap-3 text-slate-400 hover:text-white hover:bg-slate-800/60 font-medium px-3 py-2 rounded-xl transition text-sm">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                    Interviews
                    <span class="ml-auto bg-[#457a00] text-white text-[10px] px-2 py-0.5 rounded-full font-bold">1 New</span>
                </a>
                <a href="a-profile.php" class="flex items-center gap-3 bg-[#1f48ff] text-white font-semibold px-3 py-2 rounded-xl transition text-sm shadow-lg shadow-[#1f48ff]/20">
                    <i data-lucide="user" class="w-4 h-4"></i>
                    My Profile & Skills
                </a>
            </nav>
        </div>

        <div class="p-3 bg-slate-800/50 rounded-2xl border border-slate-800/80 flex items-center gap-3">
            <div class="w-10 h-8 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold text-xs"><?php echo htmlspecialchars($initials); ?></div>
            <div class="overflow-hidden">
                <p class="text-xs font-semibold text-slate-200 truncate"><?php echo htmlspecialchars($fullName); ?></p>
                <p class="text-[11px] text-slate-400 truncate"><?php echo htmlspecialchars($email); ?></p>
            </div>
            <div>
                <a class="inline-block bg-red-600 text-white font-medium px-4 py-2 rounded-lg text-xs" href="../sessionPHP/logout.php">Logout</a>
            </div>
        </div>
    </aside>

    <!-- Main  -->
    <main class="flex-1 flex flex-col min-w-0 overflow-y-auto">

        <!-- Top Navbar -->
        <header class="h-16 border-b border-slate-200/80 bg-white/80 backdrop-blur-md px-8 flex items-center justify-between sticky top-0 z-10">
            <div class="relative w-80">
                <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" placeholder="Search settings or skills..." class="w-full pl-9 pr-4 py-1.5 text-xs bg-slate-100/80 border border-transparent rounded-lg focus:outline-none focus:border-[#1f48ff] focus:bg-white transition">
            </div>

            <div class="flex items-center gap-4">
                <button class="relative p-2 text-slate-500 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition">
                    <i data-lucide="bell" class="w-4 h-4"></i>
                    <span class="w-2 h-2 bg-[#1f48ff] rounded-full absolute top-1.5 right-1.5 border-2 border-white"></span>
                </button>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="p-8 space-y-6 max-w-7xl w-full mx-auto">

            <!-- Page Title -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Profile & Skill Tags</h1>
                    <p class="text-sm text-slate-500 mt-0.5">Keep your credentials updated so our matching algorithm pairs you with the right opportunities.</p>
                </div>

                <div class="flex items-center gap-3">
                    <button type="submit" form="profile-form" class="bg-[#1f48ff] hover:bg-[#1a3ed6] text-white font-semibold text-xs px-5 py-2.5 rounded-xl transition shadow-md shadow-[#1f48ff]/20 flex items-center gap-2">
                        <i data-lucide="check" class="w-4 h-4"></i> Save Profile Changes
                    </button>
                </div>
            </div>

            <?php if ($successMessage): ?>
                <div class="p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-r-md text-emerald-700 text-sm">
                    <?php echo htmlspecialchars($successMessage); ?>
                </div>
            <?php endif; ?>

            <?php if ($errorMessage): ?>
                <div class="p-4 bg-red-50 border-l-4 border-red-500 rounded-r-md text-red-700 text-sm">
                    <?php echo htmlspecialchars($errorMessage); ?>
                </div>
            <?php endif; ?>

            <form id="profile-form" action="../applicant/a-updateprofile.php" method="POST" enctype="multipart/form-data" class="flex-1 gap-6">

                <!-- Left Column: Form & Profile Details (2 Cols) -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Personal Info -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-6">
                        <div class="flex items-center gap-4 border-b border-slate-100 pb-5">
                            <div class="relative">
                                <div class="w-20 h-20 rounded-2xl bg-emerald-600 text-white flex items-center justify-center font-bold text-2xl shadow-sm">
                                    <?php echo htmlspecialchars($initials); ?>
                                </div>
                                <button type="button" class="absolute -bottom-1 -right-1 bg-white p-1.5 rounded-lg border border-slate-200 text-slate-600 hover:text-[#1f48ff] shadow-xs transition">
                                    <i data-lucide="camera" class="w-3.5 h-3.5"></i>
                                </button>
                            </div>
                            <div class="space-y-1">
                                <h2 class="text-lg font-bold text-slate-900"><?php echo htmlspecialchars($fullName); ?></h2>
                                <p class="text-xs text-slate-500"><?php echo htmlspecialchars($headline ?: 'Add a headline below'); ?></p>
                                <span class="inline-block text-[10px] bg-emerald-50 text-emerald-700 font-bold px-2 py-0.5 rounded-full border border-emerald-200/60">
                                    <?php echo htmlspecialchars(ucwords(str_replace('_', ' ', $profile['availability_status'] ?? 'open'))); ?>
                                </span>
                            </div>
                        </div>

                        <!-- Info Inputs -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Full Name</label>
                                <input type="text" name="full_name" required value="<?php echo htmlspecialchars($fullName); ?>" class="w-full px-3.5 py-2 text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#1f48ff] focus:bg-white transition text-slate-700">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Headline / Role Title</label>
                                <input type="text" name="headline" value="<?php echo htmlspecialchars($headline); ?>" class="w-full px-3.5 py-2 text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#1f48ff] focus:bg-white transition text-slate-700">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Email Address</label>
                                <input type="email" value="<?php echo htmlspecialchars($email); ?>" disabled class="w-full px-3.5 py-2 text-sm bg-slate-100 border border-slate-200 rounded-xl text-slate-500 cursor-not-allowed">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Phone Number</label>
                                <input type="tel" name="phone_number" value="<?php echo htmlspecialchars($phone); ?>" class="w-full px-3.5 py-2 text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#1f48ff] focus:bg-white transition text-slate-700">
                            </div>
                        </div>

                        <!-- Education -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Education</label>
                            <textarea name="education" rows="2" placeholder="e.g. BS Information Technology, Central Luzon State University" class="w-full p-3.5 text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#1f48ff] focus:bg-white transition resize-none text-slate-700"><?php echo htmlspecialchars($education); ?></textarea>
                        </div>

                        <!-- Bio -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Professional Bio</label>
                            <textarea name="bio" rows="3" class="w-full p-3.5 text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#1f48ff] focus:bg-white transition resize-none text-slate-700"><?php echo htmlspecialchars($bio); ?></textarea>
                        </div>
                    </div>

                    <!-- Skills & Expertise  -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                            <h2 class="text-base font-bold text-slate-900 flex items-center gap-2">
                                <i data-lucide="sparkles" class="w-4 h-4 text-[#1f48ff]"></i>
                                Primary Skills & Technical Tags
                            </h2>
                            <span class="text-xs text-slate-400">Used for Matchd AI scoring</span>
                        </div>

                        <!-- Skill Tags Input Box -->
                        <div class="space-y-3">
                            <div class="flex gap-2">
                                <input type="text" id="tag-input-field" placeholder="Type a skill tag (e.g. nextjs) and press enter..." class="flex-1 px-3.5 py-2 text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#1f48ff] focus:bg-white transition">
                                <button type="button" id="tag-button" class="bg-[#1f48ff] hover:bg-[#1a3ed6] text-white font-semibold text-xs px-4 py-2 rounded-xl transition flex items-center gap-1">
                                    <i data-lucide="plus" class="w-4 h-4"></i> Add Tag
                                </button>
                            </div>

                            <div id="tag-container" class="flex flex-wrap gap-2 pt-2">
                                <?php foreach ($skillTags as $tag): ?>
                                    <span class="bg-[#1f48ff]/10 text-[#1f48ff] border border-[#1f48ff]/20 text-xs font-semibold px-3 py-1 rounded-xl inline-flex items-center gap-1.5">
                                        <?php echo htmlspecialchars($tag); ?>
                                        <button type="button" class="hover:text-red-500"><i data-lucide="x" class="w-3 h-3"></i></button>
                                    </span>
                                <?php endforeach; ?>
                            </div>

                            <!-- This hidden field is what actually gets sent to the server on submit -->
                            <input type="hidden" id="submitted-tags-container" name="submitted-tags" value="">
                        </div>
                    </div>

                    <!-- Resume Upload & Portfolio Card -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-4">
                        <h2 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                            <i data-lucide="file-text" class="w-4 h-4 text-[#1f48ff]"></i>
                            Resume & Online Portfolios
                        </h2>

                        <!-- Resume Upload -->
                        <label for="resume-input" class="block border-2 border-dashed border-slate-200 rounded-2xl p-5 text-center bg-slate-50/50 hover:border-[#1f48ff]/50 transition cursor-pointer space-y-2">
                            <div class="w-10 h-10 bg-blue-50 text-[#1f48ff] rounded-xl mx-auto flex items-center justify-center">
                                <i data-lucide="upload-cloud" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-800">Upload Updated Resume / CV</p>
                                <p class="text-[11px] text-slate-400">PDF, DOC, or DOCX (Max size: 5MB)</p>
                            </div>
                            <div class="inline-block bg-white text-slate-700 border border-slate-200 text-[11px] font-semibold px-3 py-1 rounded-lg">
                                <?php if ($resumePath): ?>
                                    Current File: <?php echo htmlspecialchars(basename($resumePath)); ?>
                                <?php else: ?>
                                    No resume uploaded yet
                                <?php endif; ?>
                            </div>
                            <input id="resume-input" type="file" name="resume" accept=".pdf,.doc,.docx" class="hidden">
                        </label>

                        <!-- Portfolio URLs -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">GitHub Profile</label>
                                <input type="url" name="github_url" value="<?php echo htmlspecialchars($github); ?>" class="w-full px-3.5 py-2 text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#1f48ff] focus:bg-white transition text-slate-700">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Portfolio / Website</label>
                                <input type="url" name="portfolio_url" value="<?php echo htmlspecialchars($portfolio); ?>" class="w-full px-3.5 py-2 text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#1f48ff] focus:bg-white transition text-slate-700">
                            </div>
                        </div>
                    </div>

                </div>

            </form>

        </div>
    </main>

    <script>
        lucide.createIcons();

        // Show the chosen filename right away so users get feedback before saving
        const resumeInput = document.getElementById('resume-input');
        resumeInput.addEventListener('change', () => {
            if (resumeInput.files.length > 0) {
                const label = resumeInput.closest('label').querySelector('.inline-block');
                label.textContent = 'Selected: ' + resumeInput.files[0].name;
            }
        });

        // --- Skill tag add / remove (client-side only until Save is clicked) ---
        const tagContainer = document.getElementById('tag-container');
        const tagInput = document.getElementById('tag-input-field');
        const tagButton = document.getElementById('tag-button');

        function addTag() {
            const inputTag = tagInput.value.trim();
            if (inputTag === "") return;

            const newTag = document.createElement('span');
            newTag.className = "bg-[#1f48ff]/10 text-[#1f48ff] border border-[#1f48ff]/20 text-xs font-semibold px-3 py-1 rounded-xl inline-flex items-center gap-1.5";

            const tagText = document.createTextNode(inputTag);

            const xButton = document.createElement('button');
            xButton.setAttribute('type', 'button');
            xButton.className = "hover:text-red-500";
            xButton.innerHTML = '<i data-lucide="x" class="w-3 h-3"></i>';

            newTag.appendChild(tagText);
            newTag.appendChild(xButton);
            tagContainer.appendChild(newTag);
            lucide.createIcons();

            tagInput.value = "";
        }

        tagButton.addEventListener("click", addTag);
        tagInput.addEventListener("keydown", (event) => {
            if (event.key === 'Enter') {
                event.preventDefault();
                addTag();
            }
        });

        tagContainer.addEventListener("click", (event) => {
            const btn = event.target.closest('button');
            if (btn) {
                btn.closest('span').remove();
            }
        });

        // --- Serialize tags into the hidden field right before the form submits ---
        const profileForm = document.getElementById('profile-form');
        const submittedTagsField = document.getElementById('submitted-tags-container');

        profileForm.addEventListener('submit', () => {
            const tagSpans = tagContainer.querySelectorAll('span');
            const tagsArray = Array.from(tagSpans).map(span => span.firstChild.textContent.trim());
            submittedTagsField.value = tagsArray.join(',');
        });

        <?php if ($successMessage): ?>
        alert("<?php echo addslashes($successMessage); ?>");
        <?php endif; ?>
    </script>
</body>
</html>