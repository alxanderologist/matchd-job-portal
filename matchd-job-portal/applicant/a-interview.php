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

    <!-- Sidebar Navigation -->
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
                <a href="#" class="flex items-center gap-3 bg-[#1f48ff] text-white font-semibold px-3 py-2 rounded-xl transition text-sm shadow-lg shadow-[#1f48ff]/20">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                    Interviews
                    <span class="ml-auto bg-[#457a00] text-white text-[10px] px-2 py-0.5 rounded-full font-bold">1 New</span>
                </a>
                <a href="a-profile.php" class="flex items-center gap-3 text-slate-400 hover:text-white hover:bg-slate-800/60 font-medium px-3 py-2 rounded-xl transition text-sm">
                    <i data-lucide="user" class="w-4 h-4"></i>
                    My Profile & Skills
                </a>
            </nav>
        </div>

        
        <div class="p-3 bg-slate-800/50 rounded-2xl border border-slate-800/80 flex items-center gap-3">
            <div class="w-10 h-8 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold text-xs">M</div>
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
        <header class="h-16 border-b border-slate-200/80 bg-white/80 backdrop-blur-md px-8 flex items-center justify-between sticky top-0 z-10">
            <div class="relative w-80">
                <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" placeholder="Search scheduled interviews..." class="w-full pl-9 pr-4 py-1.5 text-xs bg-slate-100/80 border border-transparent rounded-lg focus:outline-none focus:border-[#1f48ff] focus:bg-white transition">
            </div>

            <div class="flex items-center gap-4">
                <button class="relative p-2 text-slate-500 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition">
                    <i data-lucide="bell" class="w-4 h-4"></i>
                    <span class="w-2 h-2 bg-[#1f48ff] rounded-full absolute top-1.5 right-1.5 border-2 border-white"></span>
                </button>
            </div>
        </header>

        <div class="p-8 space-y-6 max-w-6xl w-full mx-auto">
            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Interview Schedule</h1>
                    <p class="text-sm text-slate-500 mt-0.5">Manage video meeting links, interviewer notes, and schedule requests.</p>
                </div>

                <div class="flex items-center gap-1 bg-slate-200/60 p-1 rounded-xl text-xs font-medium text-slate-600 shrink-0">
                    <button id="tab-upcoming" class="px-3 py-1.5 bg-white text-slate-900 rounded-lg font-bold shadow-xs transition-all">Upcoming (2)</button>
                    <button id="tab-completed" class="px-3 py-1.5 hover:text-slate-900 hover:bg-slate-300/50 rounded-lg transition-all text-slate-500">Completed</button>
                </div>
            </div>

            <!-- UPCOMING VIEW CONTAINER -->
            <div id="upcoming-view" class="space-y-6">
                <!-- Urgent / Today's Featured Interview Banner -->
                <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-[#457a00]/90 p-6 rounded-2xl text-white shadow-md border border-slate-800 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="space-y-3 max-w-xl">
                        <div class="flex items-center gap-2">
                            <span class="bg-[#457a00] text-white text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase tracking-wider flex items-center gap-1">
                                <span class="w-1.5 h-1.5 bg-white rounded-full animate-ping"></span> Starting Today
                            </span>
                            <span class="text-xs text-slate-300">2:00 PM - 2:45 PM (PST)</span>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold">Cyber Security Analyst Interview</h2>
                            <p class="text-xs text-slate-300 mt-0.5">SecureTech Corp • Initial HR Screening</p>
                        </div>
                        <div class="flex items-center gap-4 text-xs text-slate-300 pt-1">
                            <span class="flex items-center gap-1.5"><i data-lucide="user" class="w-3.5 h-3.5 text-[#1f48ff]"></i> Interviewer: Sarah Jenkins</span>
                            <span class="flex items-center gap-1.5"><i data-lucide="clock" class="w-3.5 h-3.5 text-[#457a00]"></i> 45 minutes</span>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row md:flex-col gap-2 shrink-0">
                        <a href="https://meet.google.com" target="_blank" class="bg-[#457a00] hover:bg-[#386400] text-white font-semibold text-xs px-5 py-3 rounded-xl transition shadow-lg flex items-center justify-center gap-2">
                            <i data-lucide="video" class="w-4 h-4"></i> Join Google Meet Room
                        </a>
                    </div>
                </div>

                <!-- List of All Scheduled Meetings -->
                <div class="space-y-4">
                    <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                        <i data-lucide="calendar-days" class="w-4 h-4 text-[#1f48ff]"></i>
                        Upcoming Meetings
                    </h3>

                    <!-- Interview Card 1: Today -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-4">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-slate-900 text-white flex items-center justify-center font-bold text-sm">ST</div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h4 class="font-bold text-slate-900 text-base">Cyber Security Analyst</h4>
                                        <span class="bg-[#457a00]/10 text-[#457a00] border border-[#457a00]/20 text-[11px] font-bold px-2.5 py-0.5 rounded-full">
                                            HR Screening
                                        </span>
                                    </div>
                                    <p class="text-xs text-slate-500 mt-0.5">SecureTech Corp • Scheduled for Today, Aug 2, 2026</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                <a href="https://meet.google.com" target="_blank" class="bg-[#457a00] hover:bg-[#386400] text-white font-semibold text-xs px-4 py-2 rounded-xl transition flex items-center gap-1.5">
                                    <i data-lucide="video" class="w-3.5 h-3.5"></i> Join Call
                                </a>
                            </div>
                        </div>

                        <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-100 text-xs text-slate-600 space-y-1">
                            <p class="font-semibold text-slate-800">Recruiter Instruction:</p>
                            <p>Please ensure your microphone and camera are tested prior to joining. Be ready to present your past security audit projects.</p>
                        </div>
                    </div>

                    <!-- Interview Card 2: Future Date -->
                    <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-4">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-xl bg-blue-50 text-[#1f48ff] border border-blue-100 flex items-center justify-center font-bold text-sm">MC</div>
                                <div>
                                    <div class="flex items-center gap-2">
                                        <h4 class="font-bold text-slate-900 text-base">Senior Frontend Engineer</h4>
                                        <span class="bg-blue-50 text-[#1f48ff] border border-blue-100 text-[11px] font-bold px-2.5 py-0.5 rounded-full">
                                            Technical Assessment
                                        </span>
                                    </div>
                                    <!-- ADDED ID HERE -->
                                    <p id="interview-date-text" class="text-xs text-slate-500 mt-0.5">MCorp Tech Solutions • Scheduled for Aug 8, 2026 @ 10:00 AM</p>
                                </div>
                            </div>

                            
                            <div class="flex flex-col items-end gap-1.5 shrink-0">
                                
                                <div class="relative flex justify-end w-full">
                                    <button id="reschedule-btn" class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs px-4 py-2 rounded-xl transition flex items-center gap-1.5 shrink-0">
                                        <i data-lucide="clock" class="w-3.5 h-3.5"></i> Reschedule
                                    </button>
                                    <input type="datetime-local" id="reschedule-input" style="opacity: 0; width: 0; height: 0; position: absolute; pointer-events: none;">
                                </div>
                                
                                <p id="attempts-text" class="text-[10px] text-slate-400 font-medium transition-colors text-right">
                                    3 attempts remaining
                                </p>
                                
                            </div>
                        </div>

                        <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-100 text-xs text-slate-600 space-y-1">
                            <p class="font-semibold text-slate-800">Recruiter Instruction:</p>
                            <p>This session will include a 30-minute live paired coding assessment on React and component state design.</p>
                        </div>
                    </div>

                </div>
            </div> <!-- End of Upcoming View -->

            <!-- COMPLETED VIEW CONTAINER -->
            <div id="completed-view" class="space-y-6 hidden">
                <h3 class="text-base font-bold text-slate-900 flex items-center gap-2">
                    <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600"></i>
                    Past Meetings
                </h3>

                <!-- Completed Interview Card -->
                <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200/80 shadow-xs space-y-4 opacity-80">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-xl bg-slate-200 text-slate-500 flex items-center justify-center font-bold text-sm">NX</div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <h4 class="font-bold text-slate-700 text-base">UI/UX Web Developer</h4>
                                    <span class="bg-slate-200 text-slate-600 border border-slate-300 text-[11px] font-bold px-2.5 py-0.5 rounded-full">
                                        Initial Interview
                                    </span>
                                </div>
                                <p class="text-xs text-slate-500 mt-0.5">Nexus Labs • Completed on Jul 15, 2026</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <span class="bg-emerald-50 text-emerald-700 font-semibold text-xs px-4 py-2 rounded-xl border border-emerald-200 flex items-center gap-1.5">
                                <i data-lucide="check" class="w-3.5 h-3.5"></i> Awaiting Feedback
                            </span>
                        </div>
                    </div>
                </div>
            </div> <!-- End of Completed View -->

        </div>
    </main>
   
    <script>
        lucide.createIcons();
    </script>
    <script src="../applicantJS/search.js"></script>
    <script src="../applicantJS/interview.js"></script>
</body>
</html>