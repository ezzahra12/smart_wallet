
<?php
include "config.php";
if($_SERVER['REQUEST_METHOD']==='GET'){
    if (isset($_GET['delete_income'])){
     $ID = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM incomes WHERE id = ?");
     $stmt->execute([$ID]);
    }
    if(isset($_GET['delete_depense'])){
        $ID=$_GET['id'];
        $stmt=$pdo->prepare("DELETE FROM expenses WHERE id = ?");
         $stmt->execute([$ID]);
    }
     header("Location: index.php");
        exit;
}