<?php
include "config.php";
    $id=$_GET['id'];
    $stmt=$pdo->prepare("SELECT * FROM expenses WHERE id=?");
    $stmt->execute([$id]);
    $income = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!$income){
        echo"revenu introuvable";
        exit;
    }
    
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modifier un expense</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-pink-50 p-8">

<h2 class="text-2xl font-bold mb-4">Modifier le revenu</h2>

<form action="" method="POST" class="space-y-4 bg-white p-6 rounded shadow w-96">

    <input type="hidden" name="id" value="<?= $income['id'] ?>">

    <div>
        <label>Date :</label>
        <input type="date" name="date_expense" 
               value="<?= $income['date'] ?>" 
               class="border p-2 w-full rounded">
    </div>

    <div>
        <label>Description :</label>
        <input type="text" name="desp" 
               value="<?= $income['description'] ?>" 
               class="border p-2 w-full rounded">
    </div>

    <div>
        <label>Montant :</label>
        <input type="number" name="amount"
               value="<?= $income['amount'] ?>" 
               class="border p-2 w-full rounded">
    </div>

    <button name="modifier" class="bg-yellow-500 text-white px-4 py-2 rounded">Sauvegarder</button>
</form>

</body>
<?php 
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(isset($_POST['modifier'])){
        $date=$_POST['date_expense'];
        $desc=$_POST['desp'];
        $amount=$_POST['amount'];
        $stmt=$pdo->prepare("UPDATE expenses set date= ?, description= ?, amount= ? WHERE id= ?");
        $stmt->execute([$date,$desc,$amount,$id]);
    }
    header("location: index.php");
}










     ?>