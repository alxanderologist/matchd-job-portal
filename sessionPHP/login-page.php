<?php

session_start();

require __DIR__ . '/../db/config.php';


$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if (!empty($email) && !empty($password)) {

        $query = $connection->prepare("SELECT * FROM users WHERE email = ?");
        $query->bind_param("s", $email);
        $query->execute();
        $result = $query->get_result();

        if ($user = $result->fetch_assoc()) {
            if ($password === $user['password_hash']) {
                // Set Session Variables
                $_SESSION['user-id'] = $user['id'];
                $_SESSION['user-name'] = $user['full_name'];
                $_SESSION['user-email'] = $user['email'];
                $_SESSION['user-role'] = $user['role'];
                $_SESSION['user-company-name'] = $user['company_name'];

                if ($user['role'] === 'employer') {
                    header("Location: ../employer/e-dashboard.php");
                    exit;
                } else {
                    header("Location:  ../applicant/a-jobs.php");
                    exit;
                }
            } else {
                $error_message = "Incorrect Password";
            }
        } else {
            $error_message = "No user found with that email address.";
        }
    } else {
        $error_message = "Input Email and Password";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matchd - Sign In</title>
    <!-- Tailwind CSS CDN -->
    <link rel="stylesheet" href="../output.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#F8FAFC] min-h-screen flex text-slate-800">

    <!-- Left Branding Section (Matching Dark Theme from UI Sidebar) -->
    <div class="hidden lg:flex lg:w-5/12 bg-[#0F172A] flex-col justify-between p-12 text-white relative overflow-hidden">
        <!-- Logo Branding -->
        <div class="flex items-center space-x-3 z-10">
            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center font-bold text-xl text-white">
                M
            </div>
            <span class="text-2xl font-bold tracking-tight">Matchd</span>
        </div>

        <!-- Left Column Content -->
        <div class="z-10 my-auto max-w-md">
            <span class="px-3 py-1 bg-blue-500/20 text-blue-400 rounded-full text-xs font-semibold uppercase tracking-wider">
                Recruitment Platform
            </span>
            <h1 class="text-4xl font-bold mt-4 leading-tight">
                Connect talent with opportunity seamlessly.
            </h1>
            <p class="text-slate-400 mt-4 text-sm leading-relaxed">
                Log in to access candidate pipelines, post dynamic job opportunities, and schedule interviews with top talent.
            </p>
        </div>

        <!-- Decorative Subtle Background Circles -->
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-indigo-600/10 rounded-full blur-3xl"></div>

        <!-- Footer Notice -->
        <div class="z-10 text-xs text-slate-500">
            &copy; <?php echo date("Y"); ?> Matchd Inc. All rights reserved.
        </div>
    </div>

    <!-- Right Form Section -->
    <div class="w-full lg:w-7/12 flex items-center justify-center p-6 sm:p-12">
        <div class="w-full max-w-md space-y-8 bg-white p-8 sm:p-10 rounded-2xl shadow-sm border border-slate-100">
            
            <!-- Mobile Logo Header -->
            <div class="lg:hidden flex items-center space-x-3 mb-4">
                <div class="w-9 h-9 bg-blue-600 rounded-lg flex items-center justify-center font-bold text-white">
                    M
                </div>
                <span class="text-xl font-bold text-slate-900">Matchd</span>
            </div>

            <!-- Header Title -->
            <div>
                <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Welcome back</h2>
                <p class="text-slate-500 text-sm mt-1">Please enter your credentials to access your account</p>
            </div>

            <!-- Display Error Alert if Login Fails -->
            <?php if (!empty($error_message)): ?>
                <div class="p-4 bg-red-50 border-l-4 border-red-500 rounded-r-md text-red-700 text-sm flex items-center space-x-2">
                    <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span><?php echo htmlspecialchars($error_message); ?></span>
                </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form action="login-page.php" method="POST" class="space-y-5">
                <!-- Email Input -->
                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">
                        Email Address
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        required 
                        placeholder="e.g. hr@mcorp.io or john.doe@example.com"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition text-sm bg-slate-50/50"
                    >
                </div>

                <!-- Password Input -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-xs font-semibold text-slate-600 uppercase tracking-wider">
                            Password
                        </label>
                    </div>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        required 
                        placeholder="••••••••"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition text-sm bg-slate-50/50"
                    >
                </div>

                <!-- Remember Me Checkbox -->
                <div class="flex items-center">
                    <input 
                        type="checkbox" 
                        id="remember" 
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded cursor-pointer"
                    >
                    <label for="remember" class="ml-2 block text-xs text-slate-600 cursor-pointer">
                        Remember me on this device
                    </label>
                </div>

                <!-- Submit Button matching the primary UI buttons -->
                <button 
                    type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-xl transition duration-200 shadow-sm text-sm flex items-center justify-center space-x-2"
                >
                    <span>Sign In to Dashboard</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </button>
            </form>

            <!-- Bottom Redirect Link -->
            <div class="pt-4 border-t border-slate-100 text-center text-xs text-slate-500">
                Don't have an account yet? 
                <a href="./signup-page.php" class="font-semibold text-blue-600 hover:underline">Create an account</a>
            </div>

        </div>
    </div>

</body>
</html>