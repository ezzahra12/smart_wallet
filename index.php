<?php
require "incomeController.php";
require "config.php";
addIncome($pdo);

$chartRevenu = $pdo->query("SELECT amount FROM incomes");
$valuesIN = $chartRevenu->fetchAll(PDO::FETCH_COLUMN);

$chartexpense=$pdo->query("SELECT amount FROM expenses");
$valuesEX=$chartexpense->fetchALL(PDO::FETCH_COLUMN);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartWallet</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- MOBILE HEADER -->
    <div class="lg:hidden flex justify-between items-center p-4 bg-gray-800 text-white">
        <div class="text-xl font-bold">SmartWallet</div>
        <button id="menuBtn" class="bg-white text-gray-800 px-3 py-1 rounded">Menu</button>
    </div>

    <div class="flex h-screen">

        <!-- SIDEBAR -->
        <div id="sidebar" class="w-64 bg-gray-800 text-white shadow-lg hidden lg:block absolute lg:relative h-full z-20">
            <div class="p-6 text-2xl font-bold">SmartWallet</div>

            <!-- CHART Income -->
            <div class="w-full flex justify-center mt-6">
                <div class="bg-white border border-gray-300 rounded-xl shadow-md p-3"
                    style="width: 220px; height: 220px;">
                    <h2 class="text-center text-gray-700 font-bold text-sm mb-2">Revenus</h2>

                    <div class="w-full h-[170px]">
                        <canvas id="myChartI"></canvas>
                    </div>
                </div>
            </div>

            <!-- CHART Expense -->
            <div class="w-full flex justify-center mt-6">
                <div class="bg-white border border-gray-300 rounded-xl shadow-md p-3"
                    style="width: 220px; height: 220px;">
                    <h2 class="text-center text-gray-700 font-bold text-sm mb-2">Dépenses</h2>

                    <div class="w-full h-[170px]">
                        <canvas id="myChartE"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="flex-1 p-4 lg:p-6 overflow-auto">

            <!-- HEADER -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
                <div class="text-gray-600 hidden lg:block">Welcome 👋</div>
            </div>

            <!-- CARDS -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">

                <div class="bg-white p-6 rounded-xl shadow border border-gray-300">
                    <h2 class="text-gray-600 text-sm">Total Revenus</h2>
                    <p class="text-3xl font-bold text-gray-900">
                        <?php
                            $stmt=$pdo->query("SELECT SUM(amount) as total from incomes");
                            $total_incomes=$stmt->fetch();
                            echo  $total_incomes['total'];
                        ?>
                    </p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow border border-gray-300">
                    <h2 class="text-gray-600 text-sm">Total Dépenses</h2>
                    <p class="text-3xl font-bold text-gray-900">
                        <?php
                            $stmt=$pdo->query("SELECT SUM(amount) as total from expenses");
                            $total_depenses=$stmt->fetch();
                            echo  $total_depenses['total'];
                        ?>
                    </p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow border border-gray-300">
                    <h2 class="text-gray-600 text-sm">Solde</h2>
                    <p class="text-3xl font-bold text-gray-900">
                        <?php 
                            $stmt=$pdo->query("SELECT SUM(amount) as total from expenses");
                            $total_depenses=$stmt->fetch();
                            $depenses=$total_depenses['total'];

                            $stmt=$pdo->query("SELECT SUM(amount) as total from incomes");
                            $total_incomes=$stmt->fetch();
                            $incomes=$total_incomes['total'];

                            echo $incomes - $depenses;
                        ?>
                    </p>
                </div>

            </div>

            <!-- TABLES -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- TABLE INCOMES -->
                <div class="bg-white p-4 rounded-xl shadow border border-gray-300 overflow-auto">
                    <h2 class="text-xl font-bold mb-4 text-gray-800">Revenus</h2>

                    <table class="min-w-full text-sm">
                        <tr class="bg-gray-200">
                            <th class="text-left px-4 py-2">Date</th>
                            <th class="text-left px-4 py-2">Description</th>
                            <th class="text-left px-4 py-2">Montant</th>
                            <th class="text-left px-4 py-2">Actions</th>
                        </tr>

                        <?php 
                        $stmt=$pdo->query("select * from incomes");
                        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                            echo "
                            <tr>
                                <td class='px-4 py-2'>{$row['date_income']}</td>
                                <td class='px-4 py-2'>{$row['desp']}</td>
                                <td class='px-4 py-2'>{$row['amount']}</td>
                                <td class='px-4 py-2 flex gap-2'>
                                    <form action='delete.php' method='GET'>
                                        <input name='id' type='text' class='hidden' value='{$row['id']}'/>
                                        <button name='delete_income' type='submit' class='bg-red-600 text-white px-2 py-1 rounded'>Supprimer</button>
                                    </form>
                                    <a href='editIncome.php?id={$row['id']}' class='bg-yellow-500 text-white px-2 py-1 rounded'>Modifier</a>
                                </td>
                            </tr>
                            ";
                        }
                        ?>

                    </table>
                </div>

                <!-- TABLE EXPENSES -->
                <div class="bg-white p-4 rounded-xl shadow border border-gray-300 overflow-auto">
                    <h2 class="text-xl font-bold mb-4 text-gray-800">Dépenses</h2>

                    <table class="min-w-full text-sm">
                        <tr class="bg-gray-200">
                            <th class="text-left px-4 py-2">Date</th>
                            <th class="text-left px-4 py-2">Description</th>
                            <th class="text-left px-4 py-2">Montant</th>
                            <th class="text-left px-4 py-2">Actions</th>
                        </tr>

                        <?php 
                        $stmt=$pdo->query("select * from expenses");
                        while($row=$stmt->fetch(PDO:: FETCH_ASSOC)){
                            echo "
                            <tr>
                                <td class='px-4 py-2'>{$row['date_expense']}</td>
                                <td class='px-4 py-2'>{$row['desp']}</td>
                                <td class='px-4 py-2'>{$row['amount']}</td>
                                <td class='px-4 py-2 flex gap-2'>
                                    <form method='GET' action='delete.php'>
                                        <input name='id' type='text' class='hidden' value='{$row['id']}'/>
                                        <button name='delete_depense' class='bg-red-600 text-white px-2 py-1 rounded'>Supprimer</button>
                                    </form>
                                    <button type='submit' class='bg-yellow-500 text-white px-2 py-1 rounded'>Modifier</button>
                                </td>
                            </tr>
                            ";
                        }
                        ?>
                    </table>
                </div>
            </div>

            <!-- ADD INCOME -->
            <div class="bg-white p-6 rounded-xl shadow border border-gray-300 mt-8">
                <h2 class="text-2xl font-bold mb-4 text-gray-900">Ajouter un Revenu</h2>

                <form class="grid grid-cols-1 sm:grid-cols-3 gap-4" method='POST'>
                    <input type="date" name="date" class="border border-gray-400 p-2 rounded bg-gray-100">
                    <input type="text" name="description" class="border border-gray-400 p-2 rounded bg-gray-100" placeholder="Description">
                    <input type="number" name="montant" class="border border-gray-400 p-2 rounded bg-gray-100" placeholder="Montant">

                    <button name="add_income" class="sm:col-span-3 bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                        Ajouter
                    </button>
                </form>
            </div>

            <!-- ADD EXPENSE -->
            <div class="bg-white p-6 rounded-xl shadow border border-gray-300 mt-8 mb-10">
                <h2 class="text-2xl font-bold mb-4 text-gray-900">Ajouter une Dépense</h2>

                <form class="grid grid-cols-1 sm:grid-cols-3 gap-4" method='POST'>
                    <input type="date" name="dateEx" class="border border-gray-400 p-2 rounded bg-gray-100">
                    <input type="text" name="descriptionEx" class="border border-gray-400 p-2 rounded bg-gray-100" placeholder="Description">
                    <input type="number" name="montantEx" class="border border-gray-400 p-2 rounded bg-gray-100" placeholder="Montant">

                    <button name="add_expense" class="sm:col-span-3 bg-red-600 text-white py-2 rounded hover:bg-red-700">
                        Ajouter
                    </button>
                </form>
            </div>

        </div>
    </div>

    <script>
        document.getElementById("menuBtn").onclick = () => {
            const sidebar = document.getElementById("sidebar");
            sidebar.classList.toggle("hidden");
        };
    </script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const valuesIN = <?php echo json_encode($valuesIN); ?>;
const valuesEX = <?php echo json_encode($valuesEX); ?>;

new Chart(document.getElementById('myChartE'), {
    type: 'bar',
    data: {
        labels: valuesEX.map((v, i) => "N°" + (i+1)),
        datasets: [{
            data: valuesEX,
            borderWidth: 1
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        responsive: true,
        maintainAspectRatio: false
    }
});

new Chart(document.getElementById('myChartI'), {
    type: 'bar',
    data: {
        labels: valuesIN.map((v, i) => "N°" + (i+1)),
        datasets: [{
            data: valuesIN,
            borderWidth: 1
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        responsive: true,
        maintainAspectRatio: false
    }
});
</script>

</body>
</html>
