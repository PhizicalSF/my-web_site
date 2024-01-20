<?php
// include "../../app/controllers/me.php";
include "../../path.php";
include "C:/Ampps/www/my-web_site/app/database/database.php";
include "trandsfunction.php";
?>
<html lang="en">
<!doctype html>

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


    <title>Ваш Аккаунт</title>

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
            color:white;
        }

        th {
            background-color: white;
            font-weight: bold;
        }

        td:first-child,
        th:first-child {
            text-align: left;
        }
    </style>

</head>

<body>

    <!--include-->
    <?php include("C:/Ampps/www/my-web_site/app/include/header_admin.php"); ?>


    <div class="container-xxl " style=" color:white; ">

        <div class='content row'>
            <?php include("../../app/include/sidebar_admin.php"); ?>
            <div class="main-content col-9" style="margin: 15px 0 0 5px;">
                <?php
                $list = $_SERVER['REQUEST_URI'];
                if (strpos($list, '?a=1')) {
                    $sql = "SELECT YEAR(order_date) AS year, MONTH(order_date) AS month, SUM(price) AS summ
                    FROM orders
                    JOIN category ON orders.category_id = category.category_id
                    GROUP BY YEAR(order_date), MONTH(order_date)
                    ORDER BY year, month;
                    ";

                    global $pdo;
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    echo "<h2>График динамики суммы заказов по месяцам</h2>";
                    $str1 = "График динамики суммы заказов по месяцам";
                }


                if (strpos($list, '?a=2')) {
       
                    $sql2 = "SELECT MONTH(order_date) as month, COUNT(*) as summ
                    FROM orders
                    GROUP BY MONTH(order_date);
                    ";
                    
                    global $pdo;
                    $stmt = $pdo->prepare($sql2);
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    echo "<h2>График динамики количества заказов по месяцам</h2>";
                    $str1 = "График динамики количества заказов по месяцам";
                }
                if (strpos($list, '?a=3')) {
                    $sql3 = "SELECT MONTH(date_review) AS 'month', COUNT(*) AS summ
                    FROM reviews
                    GROUP BY MONTH(date_review);
                    
                    ";
                    
                    global $pdo;
                    $stmt = $pdo->prepare($sql3);
                    $stmt->execute();
                    $result = $stmt->fetchAll();
                    echo "<h2>График динамики количества отзывов по месяцам</h2>";
                    $str1 = "График динамики количества отзывов по месяцам";
                }
                $y = array();
                $yt = array();
                foreach ($result as $key => $value) {
                    array_push($y, $value['month']);
                    array_push($yt, $value['summ']);
                }
             
                //tt($y);
                echo "<h3>Задание 1</h3>";
                HipoTreng($yt);
                echo "<h3>Задание 2</h3>";

                $var = zadanie8_2($yt);
                //var_dump($var['data']);
                echo $var['table'];
                echo "Уравнение линейной модели: " . $var['expr1'] . "</br>";
                echo "Уравнение параболической модели: " . $var['expr2'] . "</br>";
                echo "Уравнение показательной модели: " . $var['expr3'] . "</br>";
                ?>
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['corechart']
                    });

                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            <?php echo $var['data'] ?>
                        ]);

                        var options = {
                            title: 'Модели',
                            curveType: 'function',
                            legend: {
                                position: 'bottom'
                            },
                        };

                        var chart = new google.visualization.LineChart(document.getElementById('curve_chart82'));
                        chart.draw(data, options);
                    }
                </script>
                <div id="curve_chart82" style="width: 900px; height: 500px; margin:0 0 20px 0;"></div>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>