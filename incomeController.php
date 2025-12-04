<?php

function addIncome(PDO $pdo) {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset($_POST['add_income'])) {

            $date = $_POST['date'];
            $description = $_POST['description'];
            $montant = $_POST['montant'];
            $stmt = $pdo->prepare("INSERT INTO incomes (date_income, desp, amount)  VALUES (?, ?, ?)
            ");

            $stmt->execute([$date, $description, $montant]);
        }

        
        if (isset($_POST['add_expense'])) {

            $date = $_POST['dateEx'];
            $description = $_POST['descriptionEx'];
            $montant = $_POST['montantEx'];

            $stmt = $pdo->prepare("INSERT INTO expenses (date_expense, desp, amount)  VALUES (?, ?, ?)
            ");

            $stmt->execute([$date, $description, $montant]);
        }
    }
};

