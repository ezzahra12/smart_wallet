<?php
session_start();
require "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

   
    if ($user && $password==$user['password']) {

        $_SESSION['user'] = [
            'id' => $user['id'],
            'email' => $user['email'],
            'name' => $user['username'] ?? "User"
        ];

        header("Location: index.php");
        exit;

    } else {
        $_SESSION['error'] = "Email ou mot de passe incorrect";
        header("Location: login.php");
        exit;
    }
}
