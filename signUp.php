<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Signup</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white p-8 rounded-xl shadow-md w-full max-w-sm">
    <h2 class="text-xl font-semibold text-center mb-6">Créer un compte</h2>

    <form method="POST" class="space-y-4">
        <input type="text" name="username" placeholder="Nom d'utilisateur" required
               class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-gray-400">
        <input type="email" name="email" placeholder="Email" required
               class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-gray-400">
        <input type="password" name="password" placeholder="Mot de passe" required
               class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-gray-400">
        <input type="password" name="confirm_password" placeholder="Confirmer le mot de passe" required
               class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-1 focus:ring-gray-400">
        <button type="submit" 
                class="w-full bg-gray-800 text-white p-3 rounded hover:bg-gray-900 transition">
            S'inscrire
        </button>
    </form>

    <p class="text-center mt-5 text-gray-600 text-sm">
        Déjà un compte ? <a href="login.php" class="text-gray-800 font-medium hover:underline">Se connecter</a>
    </p>
</div>

</body>
</html>
