<?php
include "config.php";
    $id=$_GET['id'];
    $stmt=$pdo->prepare("SELECT * FROM incomes WHERE id=?");
    $stmt->execute([$id]);
    $income = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!$incomes){
        echo"revenu introuvable";
        exit;
    }
    else{
        return $income;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modifier un revenu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-pink-50 p-8">

<h2 class="text-2xl font-bold mb-4">Modifier le revenu</h2>

<form action="updateIncome.php" method="POST" class="space-y-4 bg-white p-6 rounded shadow w-96">

    <input type="hidden" name="id" value="<?= $income['id'] ?>">

    <div>
        <label>Date :</label>
        <input type="date" name="date_income" 
               value="<?= $income['date_income'] ?>" 
               class="border p-2 w-full rounded">
    </div>

    <div>
        <label>Description :</label>
        <input type="text" name="desp" 
               value="<?= $income['desp'] ?>" 
               class="border p-2 w-full rounded">
    </div>

    <div>
        <label>Montant :</label>
        <input type="number" name="amount"
               value="<?= $income['amount'] ?>" 
               class="border p-2 w-full rounded">
    </div>

    <button class="bg-yellow-500 text-white px-4 py-2 rounded">Sauvegarder</button>
</form>

</body>