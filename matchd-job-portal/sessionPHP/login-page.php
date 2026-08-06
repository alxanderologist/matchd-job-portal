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
            if (password_verify($password, $user['password_hash'])) {
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
    <link rel="stylesheet" href="../output.css">
    <title>Matchd: Log In</title>
</head>
<body class="bg-slate-50 antialiased text-slate-800">

    <div class="relative min-h-screen w-full flex flex-col justify-between px-4 sm:px-8 md:px-16 py-6 sm:py-8">

        <img src="../images/main-bg.png" 
             alt="matchd-background" 
             class="absolute inset-0 w-full h-full object-cover -z-10">

        <header class="flex justify-between items-center w-full z-10">
            <a href="./index.php">
                <img src="../images/matchd-logo-black.png" 
                     alt="matchd-logo-black" 
                     class="h-6 sm:h-7 w-auto object-contain">
            </a>
        </header>

        <main class="w-full max-w-7xl mx-auto my-auto grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center py-8 z-10">

            <div class="flex flex-col items-center lg:items-start text-center lg:text-left space-y-6">

                <div class="w-full max-w-md sm:max-w-xl">
                    <img src="../images/match-a-job-today.png" 
                         alt="match a job today?" 
                         class="w-full h-auto object-contain">
                </div>

                <p id="desc" class="text-base sm:text-lg max-w-lg text-slate-600">
                </p>

    
                <div class="flex flex-col sm:flex-row items-center gap-4 w-full sm:w-auto pt-2">
                    <a href="./signup-page.php" class="w-full sm:w-auto bg-lime-600 hover:bg-lime-700 text-white font-semibold px-8 sm:px-12 py-3.5 sm:py-4 rounded-full shadow-md transition-all text-center cursor-pointer">
                        Sign Up
                    </a>
                </div>

            </div>

            <div class="w-full flex items-center justify-center">
                <div class="w-full max-w-md space-y-6 bg-white/90 backdrop-blur-md p-8 sm:p-10 rounded-3xl shadow-xl border border-slate-100">
                    
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Welcome back</h2>
                        <p class="text-slate-500 text-sm mt-1">Please enter your credentials to access your account</p>
                    </div>

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
                        
                        <!-- Email Field -->
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
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-lime-600 focus:border-transparent transition text-sm bg-slate-50/50"
                            >
                        </div>

                        <!-- Password Field -->
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
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-lime-600 focus:border-transparent transition text-sm bg-slate-50/50"
                            >
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center">
                            <input 
                                type="checkbox" 
                                id="remember" 
                                name="remember"
                                class="h-4 w-4 text-lime-600 focus:ring-lime-500 border-slate-300 rounded cursor-pointer"
                            >
                            <label for="remember" class="ml-2 block text-xs text-slate-600 cursor-pointer">
                                Remember me on this device
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button 
                            type="submit" 
                            class="w-full bg-lime-600 hover:bg-lime-700 text-white font-semibold py-3.5 rounded-full transition duration-200 shadow-md text-sm flex items-center justify-center space-x-2 cursor-pointer"
                        >
                            <span>Sign In to Dashboard</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </button>
                    </form>

                    <!-- Bottom Link to Sign Up -->
                    <div class="pt-4 border-t border-slate-100 text-center text-xs text-slate-500">
                        Don't have an account yet? 
                        <a href="./signup-page.php" class="font-semibold text-lime-700 hover:underline">Create an account</a>
                    </div>

                </div>
            </div>

        </main>
    </div>

</body>
</html>