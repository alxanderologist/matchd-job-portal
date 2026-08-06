<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="../output.css">
    <title>Matchd | Employer Portal</title>
</head>
<body class="bg-blue-50/50 text-slate-800 font-sans min-h-screen flex">

    <!-- menu LEFT SIDE-->
    <aside class="w-64 bg-slate-900 text-white min-h-screen p-5 flex flex-col justify-between border-r border-slate-800">
        <div class="space-y-8">

            <div class="px-2 pt-2 flex items-center gap-3">
                <img src="../images/matchd-logo.png" alt="Matchd Logo" class="h-8 w-auto">
                <span class="text-[10px] bg-slate-800 text-slate-400 px-2 py-0.5 rounded-full font-medium ml-auto">Employer</span>
            </div>

            <!--  list of menu -->
            <nav class="space-y-1.5">
                <a href="e-dashboard.php" class="flex items-center gap-3 bg-[#1f48ff] text-white font-semibold px-3 py-2 rounded-xl transition text-sm shadow-lg shadow-[#1f48ff]/20">
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                    Dashboard
                </a>
                <a href="e-jobs.php" class="flex items-center gap-3 text-slate-400 hover:text-white hover:bg-slate-800/60 font-medium px-3 py-2 rounded-xl transition text-sm">
                    <i data-lucide="plus-circle" class="w-4 h-4"></i>
                    Create a Job
                </a>
                <a href="e-applications.php" class="flex items-center gap-3 text-slate-400 hover:text-white hover:bg-slate-800/60 font-medium px-3 py-2 rounded-xl transition text-sm">
                    <i data-lucide="users" class="w-3 h-4"></i>
                    Approve Applicants
                    <span class="ml-auto bg-white/20 text-white text-xs px-2 py-0.5 rounded-full font-bold">4</span>
                </a>
                <a href="e-interview.php" class="flex items-center gap-3 text-slate-400 hover:text-white hover:bg-slate-800/60 font-medium px-3 py-2 rounded-xl transition text-sm">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                    Set Interview
                </a>
            </nav>
        </div>

        <!-- profile below menu -->
        <div class="p-3 bg-slate-800/50 rounded-2xl border border-slate-800/80 flex items-center gap-3">
            <div class="w-10 h-8 rounded-full bg-[#1f48ff] text-white flex items-center justify-center font-bold text-xs">M</div>
            <div class="overflow-hidden">
                <p class="text-xs font-semibold text-slate-200 truncate">MCorp HR</p>
                <p class="text-[11px] text-slate-400 truncate">hr@mcorp.io</p>
            </div>
            <div>
                <a class="inline-block bg-red-600 text-white font-medium px-4 py-2 rounded-lg text-xs" href="../sessionPHP/logout.php">Logout</a>
            </div>
        </div>
    </aside>

    <!-- Main Workspace -->
    <main class="flex-1 flex flex-col min-w-0 overflow-y-auto">
        
        <!-- header-->
        <header class="h-16 border-b border-slate-200/80 bg-white/80 backdrop-blur-md px-8 flex items-center justify-between sticky top-0 z-10">
            <!-- search  -->
            <div class="relative w-72">
                <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" placeholder="Search jobs, applicants, or tags..." class="w-full pl-9 pr-4 py-1.5 text-xs bg-slate-100/80 border border-transparent rounded-lg focus:outline-none focus:border-[#1f48ff] focus:bg-white transition">
            </div>

            <!-- create n notif -->
            <div class="flex items-center gap-4">
                <button class="relative p-2 text-slate-500 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition">
                    <i data-lucide="bell" class="w-4 h-4"></i>
                    <span class="w-2 h-2 bg-[#1f48ff] rounded-full absolute top-1.5 right-1.5 border-2 border-white"></span>
                </button>
                <button class="bg-[#1f48ff] hover:bg-[#1a3ed6] text-white font-semibold text-xs px-4 py-2 rounded-xl transition shadow-sm flex items-center gap-2">
                    <i data-lucide="plus" class="w-4 h-4"></i> Create a Job
                </button>
            </div>
        </header>

        <!--  Content -->
        <div class="p-8 space-y-6 max-w-7xl w-full mx-auto">

            <!-- title -->
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Dashboard Overview</h1>
                    <p class="text-sm text-slate-500 mt-0.5">Welcome back! Here is a summary of your active job listings and candidate pipelines.</p>
                </div>
            </div>

            <!-- box box part -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- box 1 -->
                <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center gap-4">
                    <div class="p-3 bg-[#1f48ff]/10 rounded-xl text-[#1f48ff]">
                        <i data-lucide="briefcase" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-500">Active Job Posts</p>
                        <p class="text-2xl font-bold text-slate-900">5</p>
                    </div>
                </div>

                <!-- box 2 -->
                <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center gap-4">
                    <div class="p-3 bg-[#1f48ff]/10 rounded-xl text-[#1f48ff]">
                        <i data-lucide="users" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-500">Total Applicants</p>
                        <p class="text-2xl font-bold text-slate-900">48</p>
                    </div>
                </div>

                <!-- box 3 -->
                <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center gap-4">
                    <div class="p-3 bg-amber-50 rounded-xl text-amber-600">
                        <i data-lucide="clock" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-500">Pending Review</p>
                        <p class="text-2xl font-bold text-slate-900">12</p>
                    </div>
                </div>

                <!-- box 4 -->
                <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs flex items-center gap-4">
                    <div class="p-3 bg-[#457a00]/10 rounded-xl text-[#457a00]">
                        <i data-lucide="calendar-check" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-slate-500">Interviews Set</p>
                        <p class="text-2xl font-bold text-slate-900">6</p>
                    </div>
                </div>
            </div>

            <!-- Two Column Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Left Column: Active Job Posts Table (2 Cols) -->
                <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden flex flex-col justify-between">
                    <div>
                        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                            <h3 class="font-bold text-slate-900 text-sm">Active Job Listings</h3>
                            <a href="#" class="text-xs text-[#1f48ff] font-semibold hover:underline">View All Jobs &rarr;</a>
                        </div>

                        <div class="divide-y divide-slate-100">
                            <!-- Job 1 -->
                            <div class="p-5 flex items-center justify-between hover:bg-slate-50/50 transition">
                                <div class="space-y-1">
                                    <div class="flex items-center gap-2">
                                        <h4 class="font-bold text-slate-900 text-sm">Frontend Engineer</h4>
                                        <span class="bg-[#457a00]/10 text-[#457a00] border border-[#457a00]/20 text-[10px] font-bold px-2 py-0.5 rounded-full">Active</span>
                                    </div>
                                    <p class="text-xs text-slate-400">Posted 3 days ago • 18 Applicants</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button class="text-xs text-slate-600 hover:text-slate-900 font-medium bg-slate-100 px-3 py-1.5 rounded-lg transition">Manage</button>
                                </div>
                            </div>

                            <!-- Job 2 -->
                            <div class="p-5 flex items-center justify-between hover:bg-slate-50/50 transition">
                                <div class="space-y-1">
                                    <div class="flex items-center gap-2">
                                        <h4 class="font-bold text-slate-900 text-sm">Cyber Security Analyst</h4>
                                        <span class="bg-[#457a00]/10 text-[#457a00] border border-[#457a00]/20 text-[10px] font-bold px-2 py-0.5 rounded-full">Active</span>
                                    </div>
                                    <p class="text-xs text-slate-400">Posted 1 week ago • 22 Applicants</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button class="text-xs text-slate-600 hover:text-slate-900 font-medium bg-slate-100 px-3 py-1.5 rounded-lg transition">Manage</button>
                                </div>
                            </div>

                            <!-- Job 3 -->
                            <div class="p-5 flex items-center justify-between hover:bg-slate-50/50 transition">
                                <div class="space-y-1">
                                    <div class="flex items-center gap-2">
                                        <h4 class="font-bold text-slate-900 text-sm">UI/UX Designer</h4>
                                        <span class="bg-[#457a00]/10 text-[#457a00] border border-[#457a00]/20 text-[10px] font-bold px-2 py-0.5 rounded-full">Active</span>
                                    </div>
                                    <p class="text-xs text-slate-400">Posted 2 weeks ago • 8 Applicants</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button class="text-xs text-slate-600 hover:text-slate-900 font-medium bg-slate-100 px-3 py-1.5 rounded-lg transition">Manage</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Recent Activity Feed (1 Col) -->
                <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs p-6 space-y-4">
                    <h3 class="font-bold text-slate-900 text-sm border-b border-slate-100 pb-3">Recent Application</h3>
                    
                    <div class="space-y-4">
                        <!-- Activity Item 1 -->
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-700 font-bold flex items-center justify-center text-xs shrink-0 mt-0.5">JD</div>
                            <div class="text-xs">
                                <p class="text-slate-800"><span class="font-bold text-slate-900">John Doe</span> applied for <span class="font-semibold text-[#1f48ff]">Frontend Engineer</span></p>
                                <p class="text-slate-400 mt-0.5">10 minutes ago</p>
                            </div>
                        </div>

                        <!-- Activity Item 3 -->
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-700 font-bold flex items-center justify-center text-xs shrink-0 mt-0.5">MK</div>
                            <div class="text-xs">
                                <p class="text-slate-800"><span class="font-bold text-slate-900">Michael Khan</span> applied for <span class="font-semibold text-[#1f48ff]">UI/UX Designer</span></p>
                                <p class="text-slate-400 mt-0.5">5 hours ago</p>
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
</body>
</html>