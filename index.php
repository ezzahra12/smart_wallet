<?php
require "incomeController.php";
require "config.php";
addIncome($pdo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartWallet - Girly</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-pink-50">

    <!-- MOBILE HEADER -->
    <div class="lg:hidden flex justify-between items-center p-4 bg-pink-300 text-white">
        <div class="text-xl font-bold">💖 SmartWallet</div>
        <button id="menuBtn" class="bg-white text-pink-500 px-3 py-1 rounded">Menu</button>
    </div>

    <div class="flex h-screen">
        <!-- SIDEBAR -->
        <div id="sidebar" class="w-64 bg-pink-300 text-white shadow-lg hidden lg:block absolute lg:relative h-full z-20">
            <div class="p-6 text-2xl font-bold">💖 SmartWallet</div>
            <nav class="mt-6 space-y-2">
                <a href="#" class="block py-2.5 px-6 hover:bg-pink-400 rounded">Dashboard</a>
                <a href="#" class="block py-2.5 px-6 hover:bg-pink-400 rounded">Incomes</a>
                <a href="#" class="block py-2.5 px-6 hover:bg-pink-400 rounded">Expenses</a>
                <a href="#" class="block py-2.5 px-6 hover:bg-pink-400 rounded">Categories</a>
            </nav>
        </div>

        <!-- MAIN CONTENT -->
        <div class="flex-1 p-4 lg:p-6 overflow-auto">

            <!-- HEADER -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-pink-700">Dashboard</h1>
                <div class="text-pink-600 hidden lg:block">Hello, Princess 👑</div>
            </div>

            <!-- CARDS -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">

                <div class="bg-white p-6 rounded-xl shadow border border-pink-200">
                    <h2 class="text-pink-500 text-sm">Total Revenus</h2>
                    <p class="text-3xl font-bold text-pink-700"><?php
                    $stmt=$pdo->query("SELECT SUM(amount) as total from incomes");
                    $total_incomes=$stmt->fetch();
                    echo  $total_incomes['total'];
                    ?></p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow border border-pink-200">
                    <h2 class="text-pink-500 text-sm">Total Dépenses</h2>
                    <p class="text-3xl font-bold text-pink-700"><?php
                    $stmt=$pdo->query("SELECT SUM(amount) as total from expenses");
                    $total_depenses=$stmt->fetch();
                
                    echo  $total_depenses['total'];
                    ?></p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow border border-pink-200">
                    <h2 class="text-pink-500 text-sm">Solde</h2>
                    <p class="text-3xl font-bold text-pink-700"><?php 
                    $stmt=$pdo->query("SELECT SUM(amount) as total from expenses");
                    $total_depenses=$stmt->fetch();
                    $depenses=$total_depenses['total'];
                     $stmt=$pdo->query("SELECT SUM(amount) as total from incomes");
                    $total_incomes=$stmt->fetch();
                    $incomes=$total_incomes['total'];

                    $solde= $incomes- $depenses;
                    echo $solde;
                    ?></p>
                </div>

            </div>


            <!-- TABLES -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- TABLE INCOMES -->
                <div class="bg-white p-4 rounded-xl shadow border border-pink-200 overflow-auto">
                    <h2 class="text-xl font-bold mb-4 text-pink-600">Revenus</h2>

                    <table class="min-w-full text-sm">
                        <tr class="bg-pink-100">
                            <th class="text-left px-4 py-2">Date</th>
                            <th class="text-left px-4 py-2">Description</th>
                            <th class="text-left px-4 py-2">Montant</th>
                            <th class="text-left px-4 py-2">Actions</th>
                        </tr>
        <?php 
        $stmt=$pdo->query("select * from incomes");
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
             echo " <tr>
                            <td class=\"px-4 py-2\">{$row['date_income']}</td>
                            <td class=\"px-4 py-2\">{$row['desp']}</td>
                            <td class=\"px-4 py-2\">{$row['amount']}</td>
                            <td class=\"px-4 py-2 flex gap-2\">
                            <form action=\"delete.php\" method=\"GET\">
                              <input name=\"id\" type=\"text\" class=\"hidden\" value=\"{$row['id']}\"/>

                                <button  name=\"delete_income\" type=\"submit\" class=\"supprimer  bg-rose-500 text-white px-2 py-1 rounded\">Supprimer</button>
                                </form>
                                <button  type=\"submit\"  class=\"modifier  bg-yellow-400 text-white px-2 py-1 rounded\" >Modifier</button>
                            </td>
                   </tr> ";
                 }
        ?>
        
       
                    </table>
                </div>

                <!-- TABLE EXPENSES -->
                <div class="bg-white p-4 rounded-xl shadow border border-pink-200 overflow-auto">
                    <h2 class="text-xl font-bold mb-4 text-pink-600">Dépenses</h2>

                    <table class="min-w-full text-sm">
                        <tr class="bg-pink-100">
                            <th class="text-left px-4 py-2">Date</th>
                            <th class="text-left px-4 py-2">Description</th>
                            <th class="text-left px-4 py-2">Montant</th>
                            <th class="text-left px-4 py-2">Actions</th>
                        </tr>
 <?php 

$stmt=$pdo->query("select * from expenses");
while($row=$stmt->fetch(PDO:: FETCH_ASSOC)){
    echo"<tr>
                            <td class=\"px-4 py-2\">{$row['date_expense']}</td>
                            <td class=\"px-4 py-2\">{$row['desp']}</td>
                            <td class=\"px-4 py-2\">{$row['amount']}</td>
                            <td class=\"px-4 py-2 flex gap-2\">
                            <form method=\"GET\" action=\"delete.php\">
                              <input name=\"id\" type=\"text\" class=\"hidden\" value=\" {$row['id']} \"/>
                                <button name=\"delete_depense\"  class=\"supprimer  bg-rose-500 text-white px-2 py-1 rounded\">Supprimer</button>
                                 </form>
                                 <button  type=\"submit\"  class=\"modifier  bg-yellow-400 text-white px-2 py-1 rounded\" >Modifier</button>
                            </td>
                   </tr> ";
    
}

 ?>
                       
                    </table>
                </div>

            </div>

            <!-- ADD INCOME -->
            <div class="bg-white p-6 rounded-xl shadow border border-pink-200 mt-8">
                <h2 class="text-2xl font-bold mb-4 text-pink-700">Ajouter un Revenu</h2>

                <form class="grid grid-cols-1 sm:grid-cols-3 gap-4" method= 'POST' >
                    <input type="date" name="date" class="border border-pink-300 p-2 rounded bg-pink-50">
                    <input type="text" name="description" class="border border-pink-300 p-2 rounded bg-pink-50" placeholder="Description">
                    <input type="number" name="montant" class="border border-pink-300 p-2 rounded bg-pink-50" placeholder="Montant">

                    <button name="add_income" class="sm:col-span-3 bg-pink-500 text-white py-2 rounded hover:bg-pink-600">
                        Ajouter 💕
                    </button>
                </form>
            </div>

            <!-- ADD EXPENSE -->
            <div class="bg-white p-6 rounded-xl shadow border border-pink-200 mt-8 mb-10">
                <h2 class="text-2xl font-bold mb-4 text-rose-600">Ajouter une Dépense</h2>

                <form class="grid grid-cols-1 sm:grid-cols-3 gap-4" method= 'POST'>
                    <input type="date" name="dateEx" class="border border-rose-300 p-2 rounded bg-rose-50">
                    <input type="text" name="descriptionEx" class="border border-rose-300 p-2 rounded bg-rose-50" placeholder="Description">
                    <input type="number" name="montantEx" class="border border-rose-300 p-2 rounded bg-rose-50" placeholder="Montant">

                    <button name="add_expense" class="sm:col-span-3 bg-rose-500 text-white py-2 rounded hover:bg-rose-600">
                        Ajouter 🌸
                    </button>
                </form>
            </div>

        </div>
    </div>

    <script>
        // Toggle Sidebar in mobile
        document.getElementById("menuBtn").onclick = () => {
            const sidebar = document.getElementById("sidebar");
            sidebar.classList.toggle("hidden");
        };
    </script>

</body>
</html>
