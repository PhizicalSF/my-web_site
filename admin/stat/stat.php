<?php
include "C:/Ampps/www/my-web_site/app/database/database.php";
include "../../path.php";
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--Bootstrap CSS and Font awesome and styling-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/0b0da13991.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bellota+Text:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


    <title>Панель администратора</title>

</head>
<style>
    table {
        border-collapse: collapse;
        width: 80%;
        color: white;
        padding: 50px;
    }

    .dunamic {
        padding: 50px;

    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }

    th {

        font-weight: bold;
    }

    td:first-child,
    th:first-child {
        text-align: left;
    }
</style>


<body>

    <!--include-->
    <?php include("C:/Ampps/www/my-web_site/app/include/header_admin.php"); ?>
    <!--include-->
    <div class="container">
        <?php include("../../app/include/sidebar_admin.php"); ?>


        <div class="dunamic col-10">
            <?php
            global $pdo;
            $sql = "select orders.order_id, category.name, orders.comment, users.name, category.price, orders.order_date, month(orders.order_date) mont from orders, category, users where category.category_id = orders.category_id and users.usersid=orders.user_id ORDER BY order_date ASC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            //  tt($orders);
            $monthly_totals = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $month = date('Y-m', strtotime($row['order_date']));
                if (isset($monthly_totals[$month])) {
                    $monthly_totals[$month] += $row['price'];
                } else {
                    $monthly_totals[$month] = $row['price'];
                }
            }
            // Создаем массив с месяцами
            $months = array_keys($monthly_totals);

            // Создаем таблицу
            echo '<table>';
            echo '<thead><tr>';
            echo '<th class="month col-2">Месяц</th>';
            echo '<th>Выручка</th>';
            echo '<th>Цепной абс. прирост</th>';
            echo '<th>Базисный абс. прирост</th>';
            echo '<th>Цепной темп роста, %</th>';
            echo '<th>Базисный темп роста, %</th>';
            echo '<th>Цепной темп прироста, %</th>';
            echo '<th>Базисный темп прироста, %</th>';
            echo '</tr></thead>';
            echo '<tbody>';

            // Инициализируем переменные для расчета показателей
            $prev_month_total = null;
            $entry_level = reset($monthly_totals);

            // Проходимся по месяцам и вычисляем показатели
            foreach ($months as $month) {
                // Вычисляем выручку
                $total = $monthly_totals[$month];



                // Вычисляем цепной абсолютный прирост
                $chain_abs_growth = $prev_month_total !== null ? $total - $prev_month_total : null;

                // Вычисляем базисный абсолютный прирост
                $base_abs_growth = $entry_level !== null ? $total - $entry_level : null;

                // Вычисляем цепной темп роста
                $chain_growth_rate = $prev_month_total !== null ? ($total / $prev_month_total) * 100 : null;

                // Вычисляем базисный темп роста
                $base_growth_rate = $entry_level !== null ? ($total / $entry_level) * 100 : null;

                // Вычисляем цепной темп прироста
                $chain_growth_rate_abs = $prev_month_total !== null ? $chain_growth_rate - 100 : null;

                // Вычисляем базисный темп прироста
                $base_growth_rate_abs = $entry_level !== null ? $base_growth_rate - 100 : null;

                // Выводим строку таблицы
                echo '<tr>';
                echo "<td>$month</td>";
                echo "<td>$total</td>";
                echo "<td>" . number_format($chain_abs_growth, 2, '.', '') . "</td>";
                echo "<td>" . number_format($base_abs_growth, 2, '.', '') . "</td>";
                echo "<td>" . number_format($chain_growth_rate, 2, '.', '') . "</td>";
                echo "<td>" . number_format($base_growth_rate, 2, '.', '') . "</td>";
                echo "<td>" . number_format($chain_growth_rate_abs, 2, '.', '') . "</td>";
                echo "<td>" . number_format($base_growth_rate_abs, 2, '.', '') . "</td>";
                echo '</tr>';

                // Сохраняем значение выручки для следующей итерации
                $prev_month_total = $total;
                // Сохраняем значение выручки для базисного абсолютного прироста

            }

            // tt($monthly_totals);
            ?>
        </div>
        <!--Блок Динамики - 3 графика -->
        <?php
        global $pdo;
        $sql = "SELECT MONTH(order_date) AS month, COUNT(*) AS count FROM orders GROUP BY MONTH(order_date)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
      

        // Формирование данных для диаграммы
        $data = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $month = date("F", mktime(0, 0, 0, $row['month'], 1));
            $data[$month] = $row['count'];
        }

        // Использование библиотеки для построения диаграммы
        // Например, можно использовать библиотеку Chart.js

        // Формирование данных для вывода на экран
        $chart_data = json_encode(array(
            'labels' => array_keys($data),
            'datasets' => array(
                array(
                    'label' => 'Количество заказов в месяц',
                    'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                    'borderColor' => 'rgba(255,99,132,1)',
                    'borderWidth' => 1,
                    'data' => array_values($data),
                )
            )
        ));

        // Вывод диаграммы на экран
        echo "<canvas id='chart1'></canvas>";

        echo "<script>
            ";
        echo "var ctx = document.getElementById('chart1');";
        echo "var myChart = new Chart(ctx, {";
        echo "type: 'bar',";
        echo "data: $chart_data,";
        echo "options: {";
        echo "scales: {";
        echo "yAxes: [{";
        echo "ticks: {";
        echo "beginAtZero:true";
        echo "}";
        echo "}]";
        echo "}";
        echo "}";
        echo "});";
        echo "
        </script>";





        ?>
        <!--Блок Динамики - 3 графика -->
</body>


</html>