<?php

require __DIR__ . '/../db/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["full_name"];
    $role = $_POST["role"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $companyName = !empty($_POST["company_name"]) ? $_POST["company_name"] : null;

    // Package all variables into an array
    $signupData = [
        'name'             => $name,
        'role'             => $role,
        'email'            => $email,
        'password'         => $password,
        'confirm_password' => $confirm_password,
        'companyName'      => $companyName
    ];

    // Safe inline script deployment to the browser developer console
    echo "<script>console.log('PHP Signup Data:', " . json_encode($signupData, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) . ");</script>";


    if ($password === $confirm_password) {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $createUser = $connection->prepare("INSERT INTO users (full_name, email, password_hash, role, company_name) VALUES (?,?,?,?,?)");
        $createUser->bind_param("sssss", $name, $email, $hashedPassword, $role, $companyName);
        $createUser->execute();

        $newUserID = $connection->insert_id;

        if ($role == "applicant") {
            $createApplicant = $connection->prepare("INSERT INTO applicant_profiles (user_id) VALUES (?)");
            $createApplicant->bind_param("i", $newUserID);
            $createApplicant->execute();
            $createApplicant->close();
        }

        $createUser->close();
        header("Location: login-page.php");
    } else {
        echo "<script>
        alert('Passwords do not match!');
        window.location.href = 'signup-page.php';
    </script>";
        exit();
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../output.css">
    <title>Matchd: Create Account</title>
</head>
<body class="bg-slate-50 antialiased text-slate-800">

    <div class="relative min-h-screen w-full flex flex-col justify-between px-4 sm:px-8 md:px-16 py-6 sm:py-8">

        <img src="../images/main-bg.png" 
             alt="matchd-background" 
             class="absolute inset-0 w-full h-full object-cover -z-10">

        <header class="flex justify-between items-center w-full z-10">
            <img src="../images/matchd-logo-black.png" 
                 alt="matchd-logo-black" 
                 class="h-6 sm:h-7 w-auto object-contain">
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
                    <a href="./login-page.php" class="w-full sm:w-auto bg-white/80 hover:bg-white text-slate-800 font-semibold px-8 sm:px-12 py-3.5 sm:py-4 rounded-full border border-slate-300 backdrop-blur-sm shadow-sm transition-all text-center cursor-pointer">
                        Log in
                    </a>
                </div>

            </div>

            <div class="w-full flex items-center justify-center">
                <div class="w-full max-w-md space-y-6 bg-white/90 backdrop-blur-md p-8 sm:p-10 rounded-3xl shadow-xl border border-slate-100 my-auto">
                    
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Create your account</h2>
                        <p class="text-slate-500 text-sm mt-1">Get started by filling out your details below</p>
                    </div>

                  
                    <form action="signup-page.php" method="POST" class="space-y-4">

                        <!-- Account Type Dropdown -->
                        <div>
                            <label for="role" class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1.5">
                                I am an
                            </label>
                            <select
                                id="role"
                                name="role"
                                required
                                onchange="toggleCompanyField(this.value)"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-800 focus:outline-none focus:ring-2 focus:ring-lime-600 focus:border-transparent transition text-sm bg-slate-50/50 cursor-pointer">
                                <option value="applicant" selected>Applicant</option>
                                <option value="employer">Employer</option>
                            </select>
                        </div>

                        <!-- Full Name Input -->
                        <div>
                            <label for="full_name" class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1.5">
                                Full Name
                            </label>
                            <input
                                type="text"
                                id="full_name"
                                name="full_name"
                                required
                                placeholder="John Doe"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-lime-600 focus:border-transparent transition text-sm bg-slate-50/50">
                        </div>

                        <!-- Company Name Input (Dynamically shown when 'employer' is selected) -->
                        <div id="company-field" class="hidden">
                            <label for="company_name" class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1.5">
                                Company Name
                            </label>
                            <input
                                type="text"
                                id="company_name"
                                name="company_name"
                                placeholder="e.g. Acme Corp"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-lime-600 focus:border-transparent transition text-sm bg-slate-50/50">
                        </div>

                        <!-- Email Input -->
                        <div>
                            <label for="email" class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1.5">
                                Email Address
                            </label>
                            <input
                                type="email"
                                id="email"
                                name="email"
                                required
                                placeholder="john.doe@example.com"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-lime-600 focus:border-transparent transition text-sm bg-slate-50/50">
                        </div>

                        <!-- Password Input -->
                        <div>
                            <label for="password" class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1.5">
                                Password
                            </label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                required
                                placeholder="At least 8 characters"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-lime-600 focus:border-transparent transition text-sm bg-slate-50/50">
                        </div>

                        <!-- Confirm Password Input -->
                        <div>
                            <label for="confirm_password" class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1.5">
                                Confirm Password
                            </label>
                            <input
                                type="password"
                                id="confirm_password"
                                name="confirm_password"
                                required
                                placeholder="••••••••"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-lime-600 focus:border-transparent transition text-sm bg-slate-50/50">
                        </div>

                        <!-- Terms and Conditions Checkbox -->
                        <div class="flex items-start pt-1">
                            <input
                                type="checkbox"
                                id="terms"
                                required
                                class="mt-0.5 h-4 w-4 text-lime-600 focus:ring-lime-500 border-slate-300 rounded cursor-pointer">
                            <label for="terms" class="ml-2 block text-xs text-slate-600 cursor-pointer leading-tight">
                                I agree to the <a href="#" class="text-lime-700 font-medium hover:underline">Terms of Service</a> and <a href="#" class="text-lime-700 font-medium hover:underline">Privacy Policy</a>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button
                            type="submit"
                            class="w-full bg-lime-600 hover:bg-lime-700 text-white font-semibold py-3.5 rounded-full transition duration-200 shadow-md text-sm flex items-center justify-center space-x-2 cursor-pointer mt-2">
                            <span>Create Account</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </button>
                    </form>

                    <!-- Bottom Redirect Link -->
                    <div class="pt-4 border-t border-slate-100 text-center text-xs text-slate-500">
                        Already have an account? 
                        <a href="login-page.php" class="font-semibold text-lime-700 hover:underline">Sign in instead</a>
                    </div>

                </div>
            </div>

        </main>
    </div>

    <!-- Script to toggle Company Name field based on role selection -->
    <script>
        function toggleCompanyField(role) {
            const companyField = document.getElementById('company-field');
            const companyInput = document.getElementById('company_name');
            
            if (role === 'employer') {
                companyField.classList.remove('hidden');
                companyInput.setAttribute('required', 'required');
            } else {
                companyField.classList.add('hidden');
                companyInput.removeAttribute('required');
            }
        }
    </script>

</body>
</html>