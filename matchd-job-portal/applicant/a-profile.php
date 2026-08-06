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
                <img src="../images/matchd-logo.png" alt="Matchd Logo" class="h-8 w-auto"">
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
                <a href="#" class="flex items-center gap-3 bg-[#1f48ff] text-white font-semibold px-3 py-2 rounded-xl transition text-sm shadow-lg shadow-[#1f48ff]/20">
                    <i data-lucide="user" class="w-4 h-4"></i>
                    My Profile & Skills
                </a>
            </nav>
        </div>
        
        <div class="p-3 bg-slate-800/50 rounded-2xl border border-slate-800/80 flex items-center gap-3">
            <div class="w-10 h-8 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold text-xs">MP</div>
            <div class="overflow-hidden">
                <p class="text-xs font-semibold text-slate-200 truncate">Mazeah P</p>
                <p class="text-[11px] text-slate-400 truncate">mgp@email.com</p>
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
                    <button id="save-profile-btn" class="bg-[#1f48ff] hover:bg-[#1a3ed6] text-white font-semibold text-xs px-5 py-2.5 rounded-xl transition shadow-md shadow-[#1f48ff]/20 flex items-center gap-2">
                        <i data-lucide="check" class="w-4 h-4"></i> Save Profile Changes
                    </button>
                </div>
            </div>

            <div class="flex-1 gap-6">

                <!-- Left Column: Form & Profile Details (2 Cols) -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Personal Info -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-6">
                        <div class="flex items-center gap-4 border-b border-slate-100 pb-5">
                            <div class="relative">
                                <div class="w-20 h-20 rounded-2xl bg-emerald-600 text-white flex items-center justify-center font-bold text-2xl shadow-sm">
                                    JD
                                </div>
                                <button class="absolute -bottom-1 -right-1 bg-white p-1.5 rounded-lg border border-slate-200 text-slate-600 hover:text-[#1f48ff] shadow-xs transition">
                                    <i data-lucide="camera" class="w-3.5 h-3.5"></i>
                                </button>
                            </div>
                            <div class="space-y-1">
                                <h2 class="text-lg font-bold text-slate-900">John Doe</h2>
                                <p class="text-xs text-slate-500">Senior Frontend & UI Engineer • Manila, Philippines</p>
                                <span class="inline-block text-[10px] bg-emerald-50 text-emerald-700 font-bold px-2 py-0.5 rounded-full border border-emerald-200/60">
                                    Open to Opportunities
                                </span>
                            </div>
                        </div>

                        <!-- Info Inputs -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Full Name</label>
                                <input type="text" value="John Doe" class="w-full px-3.5 py-2 text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#1f48ff] focus:bg-white transition text-slate-700">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Headline / Role Title</label>
                                <input type="text" value="Senior Frontend Engineer" class="w-full px-3.5 py-2 text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#1f48ff] focus:bg-white transition text-slate-700">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Email Address</label>
                                <input type="email" value="john.doe@email.com" class="w-full px-3.5 py-2 text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#1f48ff] focus:bg-white transition text-slate-700">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Phone Number</label>
                                <input type="tel" value="+63 917 123 4567" class="w-full px-3.5 py-2 text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#1f48ff] focus:bg-white transition text-slate-700">
                            </div>
                        </div>

                        <!-- Bio -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Professional Bio</label>
                            <textarea rows="3" class="w-full p-3.5 text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#1f48ff] focus:bg-white transition resize-none text-slate-700">Passionate Frontend Engineer with 4+ years of experience building modern, responsive UI web applications using React, Tailwind CSS, and TypeScript.</textarea>
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
                                <input id="profile-tag-input" type="text" placeholder="Type a skill tag (e.g. #nextjs) and press enter..." class="flex-1 px-3.5 py-2 text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#1f48ff] focus:bg-white transition">
                                <button id="profile-tag-button" type="button" class="bg-[#1f48ff] hover:bg-[#1a3ed6] text-white font-semibold text-xs px-4 py-2 rounded-xl transition flex items-center gap-1">
                                    <i data-lucide="plus" class="w-4 h-4"></i> Add Tag
                                </button>
                            </div>

                
                            <div id="profile-tag-container" class="flex flex-wrap gap-2 pt-2">
                                <span class="bg-[#1f48ff]/10 text-[#1f48ff] border border-[#1f48ff]/20 text-xs font-semibold px-3 py-1 rounded-xl flex items-center gap-1.5">
                                    React.js <button class="hover:text-red-500"><i data-lucide="x" class="w-3 h-3"></i></button>
                                </span>
                                <span class="bg-[#1f48ff]/10 text-[#1f48ff] border border-[#1f48ff]/20 text-xs font-semibold px-3 py-1 rounded-xl flex items-center gap-1.5">
                                    Tailwind CSS <button class="hover:text-red-500"><i data-lucide="x" class="w-3 h-3"></i></button>
                                </span>
                                <span class="bg-[#1f48ff]/10 text-[#1f48ff] border border-[#1f48ff]/20 text-xs font-semibold px-3 py-1 rounded-xl flex items-center gap-1.5">
                                    TypeScript <button class="hover:text-red-500"><i data-lucide="x" class="w-3 h-3"></i></button>
                                </span>
                                <span class="bg-[#1f48ff]/10 text-[#1f48ff] border border-[#1f48ff]/20 text-xs font-semibold px-3 py-1 rounded-xl flex items-center gap-1.5">
                                    JavaScript (ES6+) <button class="hover:text-red-500"><i data-lucide="x" class="w-3 h-3"></i></button>
                                </span>
                                <span class="bg-[#1f48ff]/10 text-[#1f48ff] border border-[#1f48ff]/20 text-xs font-semibold px-3 py-1 rounded-xl flex items-center gap-1.5">
                                    Figma to Code <button class="hover:text-red-500"><i data-lucide="x" class="w-3 h-3"></i></button>
                                </span>
                                <span class="bg-[#1f48ff]/10 text-[#1f48ff] border border-[#1f48ff]/20 text-xs font-semibold px-3 py-1 rounded-xl flex items-center gap-1.5">
                                    REST APIs <button class="hover:text-red-500"><i data-lucide="x" class="w-3 h-3"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Resume Upload & Portfolio Card -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-4">
                        <h2 class="text-base font-bold text-slate-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                            <i data-lucide="file-text" class="w-4 h-4 text-[#1f48ff]"></i>
                            Resume & Online Portfolios
                        </h2>

                        <!-- Resume Upload Drag and Drop -->
                        <div id="resume-drop-zone" class="border-2 border-dashed border-slate-200 rounded-2xl p-5 text-center bg-slate-50/50 hover:border-[#1f48ff]/50 transition cursor-pointer space-y-2">
                            
                            <input type="file" id="resume-file-input" class="hidden" accept=".pdf,.doc,.docx">

                            <div class="w-10 h-10 bg-blue-50 text-[#1f48ff] rounded-xl mx-auto flex items-center justify-center">
                                <i data-lucide="upload-cloud" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-800">Upload Updated Resume / CV</p>
                                <p class="text-[11px] text-slate-400">PDF or DOCX (Max size: 5MB)</p>
                            </div>
                            
                            <div id="current-file-name" class="inline-block bg-white text-slate-700 border border-slate-200 text-[11px] font-semibold px-3 py-1 rounded-lg">
                                Current File: John_Doe_Resume_2026.pdf
                            </div>
                        </div>

                        <!-- Portfolio URLs -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">GitHub Profile</label>
                                <input type="url" value="https://github.com/johndoe" class="w-full px-3.5 py-2 text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#1f48ff] focus:bg-white transition text-slate-700">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-700 mb-1">Portfolio / Website</label>
                                <input type="url" value="https://johndoe.dev" class="w-full px-3.5 py-2 text-sm bg-slate-50/50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#1f48ff] focus:bg-white transition text-slate-700">
                            </div>
                        </div>
                    </div>

                </div>

                </div>

            </div>

        </div>
    </main>
   
    <script>
        lucide.createIcons();
    </script>
    <script src="../applicantJS/search.js"></script>
    <script src="../applicantJS/profile.js"></script>
</body>
</html>