<?php

function addIncome(PDO $pdo) {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset($_POST['add_income'])) {

            $date = $_POST['date'];
            $description = $_POST['description'];
            $montant = $_POST['montant'];
            $user_id=$_SESSION['user_id'];
            $stmt = $pdo->prepare("INSERT INTO incomes (date, description, amount,user_id)  VALUES (?, ?, ?,?)
            ");

            $stmt->execute([$date, $description, $montant,$user_id]);
        }

        
        if (isset($_POST['add_expense'])) {

            $date = $_POST['dateEx'];
            $description = $_POST['descriptionEx'];
            $montant = $_POST['montantEx'];
            $user_id=$_SESSION['user_id'];
            $stmt = $pdo->prepare("INSERT INTO expenses (date, description, amount,user_id)  VALUES (?, ?, ?,?)
            ");

            $stmt->execute([$date, $description, $montant,$user_id]);
        }
    }
};

