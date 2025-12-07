<?php
session_start();
require "config.php";
if($_SERVER["REQUEST_METHOD"]==="POST"){
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $confirmedPassword=$_POST['confirm_password'];
    $stmt=$pdo->prepare("SELECT *  FROM users where email=?");
    $stmt->execute([$email]);
    $sameEmail=$stmt->fetch(PDO :: FETCH_ASSOC);


    if ( $password !== $confirmedPassword   ){
       $_SESSION['error'] = "Les mots de passe ne correspondent pas";
        header('location: signUp.php');
        exit;
    }
    elseif($sameEmail){
        $_SESSION['error'] = "Cet email est déjà utilisé";
         header('location: signUp.php');
    }
    else{
 $passwordhashed=password_hash($password,PASSWORD_DEFAULT);
    $stmt=$pdo->prepare("INSERT INTO users (email,username,password) values (?,?,?)");
    $stmt->execute([$email,$username,$passwordhashed]);
    header("location: login.php");
    exit;
    
    }
   

}