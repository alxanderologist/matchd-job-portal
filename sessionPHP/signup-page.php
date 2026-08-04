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
    <title>Matchd - Sign Up</title>
    <link rel="stylesheet" href="../output.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-[#F8FAFC] min-h-screen flex text-slate-800">

    <!-- Left Branding Section (Matching Dark Theme) -->
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
                Join the Platform
            </span>
            <h1 class="text-4xl font-bold mt-4 leading-tight">
                Start your journey with Matchd today.
            </h1>
            <p class="text-slate-400 mt-4 text-sm leading-relaxed">
                Create an account to post job opportunities, discover top talent, or find your next career breakthrough.
            </p>
        </div>

        <!-- Decorative Subtle Background Circles -->
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-indigo-600/10 rounded-full blur-3xl"></div>

        <!-- Footer Notice -->
        <div class="z-10 text-xs text-slate-500">
            &copy; 2026 Matchd Inc. All rights reserved.
        </div>
    </div>

    <!-- Right Form Section -->
    <div class="w-full lg:w-7/12 flex items-center justify-center p-6 sm:p-12 overflow-y-auto">
        <div class="w-full max-w-md space-y-8 bg-white p-8 sm:p-10 rounded-2xl shadow-sm border border-slate-100 my-auto">

            <!-- Mobile Logo Header -->
            <div class="lg:hidden flex items-center space-x-3 mb-4">
                <div class="w-9 h-9 bg-blue-600 rounded-lg flex items-center justify-center font-bold text-white">
                    M
                </div>
                <span class="text-xl font-bold text-slate-900">Matchd</span>
            </div>

            <!-- Header Title -->
            <div>
                <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Create your account</h2>
                <p class="text-slate-500 text-sm mt-1">Get started by filling out your details below</p>
            </div>

            <!-- Signup Form -->
            <form action="signup-page.php" method="POST" class="space-y-5">

                <!-- Account Type Dropdown (Select Input) -->
                <div>
                    <label for="role" class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">
                        I am an
                    </label>
                    <select
                        id="role"
                        name="role"
                        required
                        onchange="toggleCompanyField(this.value)"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition text-sm bg-slate-50/50 cursor-pointer">
                        <option value="applicant" selected>Applicant</option>
                        <option value="employer">Employer</option>
                    </select>
                </div>

                <!-- Full Name Input -->
                <div>
                    <label for="full_name" class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">
                        Full Name
                    </label>
                    <input
                        type="text"
                        id="full_name"
                        name="full_name"
                        required
                        placeholder="John Doe"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition text-sm bg-slate-50/50">
                </div>

                <!-- Company Name Input (Dynamically shown when 'employer' is selected) -->
                <div id="company-field" class="hidden">
                    <label for="company_name" class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">
                        Company Name
                    </label>
                    <input
                        type="text"
                        id="company_name"
                        name="company_name"
                        placeholder="e.g. Acme Corp"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition text-sm bg-slate-50/50">
                </div>

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
                        placeholder="john.doe@example.com"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition text-sm bg-slate-50/50">
                </div>

                <!-- Password Input -->
                <div>
                    <label for="password" class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">
                        Password
                    </label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        placeholder="At least 8 characters"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition text-sm bg-slate-50/50">
                </div>

                <!-- Confirm Password Input -->
                <div>
                    <label for="confirm_password" class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">
                        Confirm Password
                    </label>
                    <input
                        type="password"
                        id="confirm_password"
                        name="confirm_password"
                        required
                        placeholder="••••••••"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-transparent transition text-sm bg-slate-50/50">
                </div>

                <!-- Terms and Conditions Checkbox -->
                <div class="flex items-start">
                    <input
                        type="checkbox"
                        id="terms"
                        required
                        class="mt-0.5 h-4 w-4 text-blue-600 focus:ring-blue-500 border-slate-300 rounded cursor-pointer">
                    <label for="terms" class="ml-2 block text-xs text-slate-600 cursor-pointer leading-tight">
                        I agree to the <a href="#" class="text-blue-600 hover:underline">Terms of Service</a> and <a href="#" class="text-blue-600 hover:underline">Privacy Policy</a>
                    </label>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-xl transition duration-200 shadow-sm text-sm flex items-center justify-center space-x-2">
                    <span>Create Account</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </button>
            </form>

            <!-- Bottom Redirect Link -->
            <div class="pt-4 border-t border-slate-100 text-center text-xs text-slate-500">
                Already have an account?
                <a href="login-page.php" class="font-semibold text-blue-600 hover:underline">Sign in instead</a>
            </div>

        </div>
    </div>

    <!-- Script to handle select toggles -->
    <script>
        function toggleCompanyField(role) {
            const companyField = document.getElementById('company-field');
            const companyInput = document.getElementById('company_name');

            if (role === 'employer') {
                companyField.classList.remove('hidden');
                companyInput.required = true;
            } else {
                companyField.classList.add('hidden');
                companyInput.required = false;
            }
        }
    </script>

</body>

</html>