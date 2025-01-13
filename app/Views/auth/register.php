<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'inscription</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 space-y-6">
   
        <div class="flex justify-start p-4">
            <a href="../../../index.php" 
            class="text-white bg-red-500 hover:bg-red-600 px-4 py-2 rounded-full text-lg font-bold border border-red-500 hover:border-red-600 transition-all duration-300 flex items-center justify-center">
                <i class="fas fa-arrow-left"></i> 
            </a>
        </div>

        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-900">Créer un compte</h2>
            <p class="mt-2 text-sm text-gray-600">Remplissez le formulaire ci-dessous</p>
        </div>

        <form class="space-y-4" method="POST" action="../../Controllers/AuthController.php" onsubmit="return validateForm()">
            <!-- Nom -->
            <div>
                <label for="FullName" class="block text-sm font-medium text-gray-700">Nom</label>
                <input 
                    type="text" 
                    id="FullName" 
                    name="nom" 
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Entrez votre nom"
                    required
                >
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">
                    Adresse email
                </label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="sersif@exemple.com"
                    required
                >
            </div>
           <!-- Rôle -->
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">
                    Rôle
                </label>
                <select id="role" name="role" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="" selected disabled class="text-gray-400">Choisissez le rôle que vous souhaitez</option>
                    <option value="1">Administrateur</option>
                    <option value="2">Enseignant</option>
                    <option value="3">Étudiant</option>
                </select>
            </div>

            <!-- Mot de passe -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">
                    Mot de passe
                </label>
                <div class="relative">
                    <input 
                        type="password" 
                        id="password" 
                        name="motDePasse" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="••••••••"
                        required
                        minlength="8"
                    >
                    <button 
                        type="button" 
                        id="togglePassword" 
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500"
                    >
                        <i class="fas fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>

            <!-- Confirmer le mot de passe -->
            <div>
                <label for="passwordConfirm" class="block text-sm font-medium text-gray-700">
                    Confirmer le mot de passe
                </label>
                <div class="relative">
                    <input 
                        type="password" 
                        id="passwordConfirm" 
                        name="passwordConfirm" 
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="••••••••"
                        required
                    >
                    <button 
                        type="button" 
                        id="togglePasswordConfirm" 
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500"
                    >
                        <i class="fas fa-eye" id="eyeIconConfirm"></i>
                    </button>
                </div>
            </div>

            <!-- Bouton de soumission -->
            <button  name="submit" type="submit"  class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" >
                S'inscrire
            </button>
        </form>
    </div>

    <script>
    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });

    document.getElementById('togglePasswordConfirm').addEventListener('click', function () {
        const confirmPasswordField = document.getElementById('passwordConfirm');
        confirmPasswordField.type = confirmPasswordField.type === 'password' ? 'text' : 'password';
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });

    function validateForm() {
    const nameField = document.getElementById('FullName');
    const emailField = document.getElementById('email');
    const passwordField = document.getElementById('password');
    const confirmPasswordField = document.getElementById('passwordConfirm');

    let isValid = true;

    // Reset previous error styles
    resetError(nameField);
    resetError(emailField);
    resetError(passwordField);
    resetError(confirmPasswordField);

    // Validate name
    const nameRegex = /^[a-zA-Z\s]+$/;
    if (!nameRegex.test(nameField.value)) {
        showError(nameField, 'Le nom ne doit pas contenir de chiffres ou de caractères spéciaux.');
        isValid = false;
    }

    // Validate email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(emailField.value)) {
        showError(emailField, 'Veuillez entrer une adresse email valide.');
        isValid = false;
    }

    // Validate password match
    if (passwordField.value !== confirmPasswordField.value) {
        showError(passwordField, 'Les mots de passe ne correspondent pas.');
        showError(confirmPasswordField, 'Les mots de passe ne correspondent pas.');
        isValid = false;
    }

    return isValid;
}

// Function to show error
function showError(field, message) {
    field.style.borderColor = 'red'; // Add red border
    field.classList.add('error'); // Add error class for real-time validation
    alert(message); // Show alert message
}

// Function to reset error styles
function resetError(field) {
    field.style.borderColor = ''; // Reset border color
    field.classList.remove('error'); // Remove error class
}

// Real-time validation function
function setupRealTimeValidation() {
    const nameField = document.getElementById('FullName');
    const emailField = document.getElementById('email');
    const passwordField = document.getElementById('password');
    const confirmPasswordField = document.getElementById('passwordConfirm');

    // Attach event listeners for real-time validation
    nameField.addEventListener('input', () => {
        const nameRegex = /^[a-zA-Z\s]+$/;
        if (nameRegex.test(nameField.value)) {
            resetError(nameField);
        }
    });

    emailField.addEventListener('input', () => {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (emailRegex.test(emailField.value)) {
            resetError(emailField);
        }
    });

    passwordField.addEventListener('input', () => {
        if (passwordField.value === confirmPasswordField.value) {
            resetError(passwordField);
            resetError(confirmPasswordField);
        }
    });

    confirmPasswordField.addEventListener('input', () => {
        if (passwordField.value === confirmPasswordField.value) {
            resetError(passwordField);
            resetError(confirmPasswordField);
        }
    });
}

// Call the real-time validation setup function when the page loads
window.onload = setupRealTimeValidation;
    </script>
</body>
</html>
