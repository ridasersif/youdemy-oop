<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 min-h-screen flex items-center justify-center p-4">
  
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-8 space-y-6">
        <div class="flex justify-start p-4">
            <a href="../../../index.php" 
            class="text-white bg-red-500 hover:bg-red-600 px-4 py-2 rounded-full text-lg font-bold border border-red-500 hover:border-red-600 transition-all duration-300 flex items-center justify-center">
                <i class="fas fa-arrow-left"></i> 
            </a>
        </div>
        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-900">Connexion</h2>
            <p class="mt-2 text-sm text-gray-600">
                Connectez-vous à votre compte
            </p>
        </div>
        <?php if (isset($_SESSION['error_message'])): ?>
                <div style="color: red; font-weight: bold;">
                    <?= $_SESSION['error_message']; ?>
                </div>
                <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>

        <form class="space-y-6" method="POST" action="../../Controllers/AuthController.php" onsubmit="return validateForm()">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">
                    Adresse email
                </label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="bouanaya@exemple.com"
                
                >
                <span id="emailError" class="text-red-500 text-sm hidden">Veuillez entrer une adresse email valide.</span>
            </div>

            <div>
                <label for="motDePasse" class="block text-sm font-medium text-gray-700">
                    Mot de passe
                </label>
                <div class="mt-1 relative">
                    <input 
                        type="password" 
                        id="motDePasse" 
                        name="motDePasse" 
                        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="••••••••"
                  
                    >
                    <i class="fas fa-eye absolute right-3 top-3 text-gray-500 cursor-pointer" onclick="togglePassword()"></i>
                </div>
                <span id="passwordError" class="text-red-500 text-sm hidden">Le mot de passe est requis.</span>
            </div>

            <div class="flex items-center justify-between mt-2">
                <div class="flex items-center">
                    <input 
                        id="remember" 
                        name="remember" 
                        type="checkbox"
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                    >
                    <label for="remember" class="ml-2 block text-sm text-gray-700">
                        Se souvenir de moi
                    </label>
                </div>
                <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                    Mot de passe oublié ?
                </a>
            </div>

            <button 
                name="login" 
                type="submit"
                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
            >
                Se connecter
            </button>
        </form>

        <div class="relative">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-gray-500">
                    Ou continuer avec
                </span>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-3">
            <button class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-red-500 text-sm font-medium text-white hover:bg-gray-50">
                <span class="sr-only">Se connecter avec Google</span>
                Google
            </button>
            <button class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-blue-400 text-sm font-medium text-white">
                <span class="sr-only">Se connecter avec Facebook</span>
                Facebook
            </button>
        </div>

        <div class="text-center text-sm">
            <p class="text-gray-600">
                Pas encore de compte ?
                <a href="register.php" class="font-medium text-blue-600 hover:text-blue-500">
                    S'inscrire
                </a>
            </p>
        </div>
    </div>
    <script>
    function validateForm() {
        let email = document.getElementById("email");
        let password = document.getElementById("motDePasse");
        let emailError = document.getElementById("emailError");
        let passwordError = document.getElementById("passwordError");

        emailError.classList.add("hidden");
        passwordError.classList.add("hidden");
        email.classList.remove("border-red-500");
        password.classList.remove("border-red-500");

        let isValid = true;

        if (!email.value.includes("@") || !email.value.includes(".")) {
            emailError.classList.remove("hidden");
            email.classList.add("border-red-500");
            isValid = false;
        }

        if (password.value.trim() === "") {
            passwordError.classList.remove("hidden");
            password.classList.add("border-red-500");
            isValid = false;
        }

        return isValid;
    }

    function togglePassword() {
        const passwordField = document.getElementById("motDePasse");
        const icon = event.target;
        if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            passwordField.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
    document.getElementById("email").addEventListener("input", function () {
        this.classList.remove("border-red-500");
        document.getElementById("emailError").classList.add("hidden");
    });

    document.getElementById("motDePasse").addEventListener("input", function () {
        this.classList.remove("border-red-500");
        document.getElementById("passwordError").classList.add("hidden");
    });
</script>

  
</body>
</html>
