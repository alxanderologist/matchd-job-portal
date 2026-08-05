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
                <img src="../images/matchd-logo.png" alt="Matchd Logo" class="h-8 w-auto"">
                <span class="text-[10px] bg-[#1f48ff]/20 text-[#1f48ff] border border-[#1f48ff]/30 px-2 py-0.5 rounded-full font-semibold ml-auto">Applicant</span>
            </div>

            <!-- List of Menu Items -->
            <nav class="space-y-1.5">
            
                <a href="#" class="flex items-center gap-3 bg-[#1f48ff] text-white font-semibold px-3 py-2 rounded-xl transition text-sm shadow-lg shadow-[#1f48ff]/20">
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
                <a href="a-profile.php" class="flex items-center gap-3 text-slate-400 hover:text-white hover:bg-slate-800/60 font-medium px-3 py-2 rounded-xl transition text-sm">
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
            <!-- Search Bar -->
            <div class="relative w-80">
                <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" placeholder="Search roles, skill tags, or companies..." class="w-full pl-9 pr-4 py-1.5 text-xs bg-slate-100/80 border border-transparent rounded-lg focus:outline-none focus:border-[#1f48ff] focus:bg-white transition">
            </div>

            <!-- Header Notifications & Status -->
            <div class="flex items-center gap-4">

                <button class="relative p-2 text-slate-500 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition">
                    <i data-lucide="bell" class="w-4 h-4"></i>
                    <span class="w-2 h-2 bg-[#1f48ff] rounded-full absolute top-1.5 right-1.5 border-2 border-white"></span>
                </button>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="p-8 space-y-6 max-w-7xl w-full mx-auto">

            <!-- Banner / Header -->
            <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-[#1f48ff]/90 p-6 rounded-2xl text-white flex items-center justify-between shadow-sm">
                <div class="space-y-1">
                    <h1 class="text-xl font-bold tracking-tight">Welcome back, Zeah! 👋</h1>
                    <p class="text-xs text-slate-300">We found <span class="font-bold text-white">12 new job matches</span> based on your React & Frontend skills.</p>
                </div>
                <button class="bg-white text-slate-900 hover:bg-slate-100 text-xs font-bold px-4 py-2 rounded-xl transition shadow-sm">
                    Update Profile Skills
                </button>
            </div>

            <!-- Main Grid Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Left Column: Job Feed (2 Cols) -->
                <div class="lg:col-span-2 space-y-4">
                    
                    <div class="flex items-center justify-between">
                        <h2 class="text-base font-bold text-slate-900 flex items-center gap-2">
                            <i data-lucide="sparkles" class="w-4 h-4 text-[#1f48ff]"></i>
                            Recommended for You
                        </h2>
                        <span class="text-xs text-slate-500">Sorted by match score</span>
                    </div>

                    <!-- Job Card 1 -->
                    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs hover:border-[#1f48ff]/40 transition space-y-3">
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex gap-3">
                                <div class="w-10 h-10 rounded-xl bg-blue-50 text-[#1f48ff] border border-blue-100 flex items-center justify-center font-bold text-sm shrink-0">
                                    MC
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-900 text-sm hover:text-[#1f48ff] transition cursor-pointer">Senior Frontend Engineer</h3>
                                    <p class="text-xs text-slate-500">MCorp Tech Solutions • Manila, PH (Remote)</p>
                                </div>
                            </div>
                            <span class="bg-emerald-50 text-emerald-700 border border-emerald-200/80 text-[11px] font-bold px-2.5 py-0.5 rounded-full shrink-0">
                                98% Match
                            </span>
                        </div>

                        <p class="text-xs text-slate-600 line-clamp-2">
                            Looking for a strong React developer with experience in Tailwind CSS and TypeScript to lead our design system team...
                        </p>

                        <!-- Skill Tags -->
                        <div class="flex flex-wrap gap-1.5 pt-1">
                            <span class="bg-slate-100 text-slate-600 text-[11px] font-medium px-2.5 py-0.5 rounded-lg">#reactjs</span>
                            <span class="bg-slate-100 text-slate-600 text-[11px] font-medium px-2.5 py-0.5 rounded-lg">#tailwindcss</span>
                            <span class="bg-slate-100 text-slate-600 text-[11px] font-medium px-2.5 py-0.5 rounded-lg">#typescript</span>
                        </div>

                        <!-- Card Footer -->
                        <div class="flex items-center justify-between pt-2 border-t border-slate-100 text-xs">
                            <span class="font-semibold text-slate-700">$3,500 - $4,500 <span class="text-[10px] text-slate-400 font-normal">/ month</span></span>
                            <button class="bg-[#1f48ff] hover:bg-[#1a3ed6] text-white font-semibold px-4 py-1.5 rounded-xl transition shadow-xs flex items-center gap-1.5 text-xs">
                                Apply Now <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Job Card 2 -->
                    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-xs hover:border-[#1f48ff]/40 transition space-y-3">
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex gap-3">
                                <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 border border-purple-100 flex items-center justify-center font-bold text-sm shrink-0">
                                    NX
                                </div>
                                <div>
                                    <h3 class="font-bold text-slate-900 text-sm hover:text-[#1f48ff] transition cursor-pointer">UI/UX Web Developer</h3>
                                    <p class="text-xs text-slate-500">Nexus Labs • Hybrid</p>
                                </div>
                            </div>
                            <span class="bg-emerald-50 text-emerald-700 border border-emerald-200/80 text-[11px] font-bold px-2.5 py-0.5 rounded-full shrink-0">
                                89% Match
                            </span>
                        </div>

                        <p class="text-xs text-slate-600 line-clamp-2">
                            Build intuitive UI components and maintain high-fidelity user workflows for enterprise cloud applications...
                        </p>

                        <!-- Skill Tags -->
                        <div class="flex flex-wrap gap-1.5 pt-1">
                            <span class="bg-slate-100 text-slate-600 text-[11px] font-medium px-2.5 py-0.5 rounded-lg">#figma</span>
                            <span class="bg-slate-100 text-slate-600 text-[11px] font-medium px-2.5 py-0.5 rounded-lg">#frontend</span>
                            <span class="bg-slate-100 text-slate-600 text-[11px] font-medium px-2.5 py-0.5 rounded-lg">#css</span>
                        </div>

                        <!-- Card Footer -->
                        <div class="flex items-center justify-between pt-2 border-t border-slate-100 text-xs">
                            <span class="font-semibold text-slate-700">$2,800 - $3,600 <span class="text-[10px] text-slate-400 font-normal">/ month</span></span>
                            <button class="bg-[#1f48ff] hover:bg-[#1a3ed6] text-white font-semibold px-4 py-1.5 rounded-xl transition shadow-xs flex items-center gap-1.5 text-xs">
                                Apply Now <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </button>
                        </div>
                    </div>

                </div>

                <!-- Right -->
                <div class="space-y-6">
                    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs p-5 space-y-4">
                        <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                            <h3 class="font-bold text-slate-900 text-sm">Active Applications</h3>
                            <a href="#" class="text-xs font-semibold text-[#1f48ff] hover:underline">View All</a>
                        </div>

                        <div class="space-y-3">
                           
                            <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100 space-y-2">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold text-slate-900">Cyber Security Analyst</span>
                                    <span class="text-[10px] bg-[#457a00]/10 text-[#457a00] font-bold px-2 py-0.5 rounded-full">Interview Set</span>
                                </div>
                                <p class="text-xs text-slate-500">SecureTech Corp</p>
                                <div class="text-[11px] text-slate-400 pt-1 border-t border-slate-200/60 flex items-center gap-1">
                                    <i data-lucide="calendar" class="w-3 h-3 text-[#1f48ff]"></i> Scheduled for Today @ 2:00 PM
                                </div>
                            </div>

                           
                            <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-100 space-y-2">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold text-slate-900">Full Stack Engineer</span>
                                    <span class="text-[10px] bg-amber-100 text-amber-700 font-bold px-2 py-0.5 rounded-full">Under Review</span>
                                </div>
                                <p class="text-xs text-slate-500">Acme Innovations</p>
                                <div class="text-[11px] text-slate-400 pt-1 border-t border-slate-200/60">
                                    Applied 2 days ago
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
</body>
</html>