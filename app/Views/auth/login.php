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

   
        <form class="space-y-6" method="post" action="../../src/Controller/SignIn.php">
        
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
                    required
                >
            </div>

        
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">
                    Mot de passe
                </label>
                <div class="mt-1 relative">
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="••••••••"
                        required
                    >
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
            </div>

         
            <button 
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

        <!-- Boutons de connexion sociale -->
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

        <!-- Lien d'inscription -->
        <div class="text-center text-sm">
            <p class="text-gray-600">
                Pas encore de compte ?
                <a href="register.php" class="font-medium text-blue-600 hover:text-blue-500">
                    S'inscrire
                </a>
            </p>
        </div>
    </div>

</body>
</html>