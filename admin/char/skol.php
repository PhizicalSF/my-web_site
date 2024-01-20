<?php
require "../../path.php";
include "../../app/database/database.php";
//________________
error_reporting(E_ALL & ~E_NOTICE);


//chart1
$sql = "SELECT YEAR(order_date) AS year, MONTH(order_date) AS month, SUM(price) AS summ
FROM orders
JOIN category ON orders.category_id = category.category_id
GROUP BY YEAR(order_date), MONTH(order_date)
ORDER BY year, month;
";

global $pdo;
$stmt = $pdo->prepare($sql);
$stmt->execute();
$orders = $stmt->fetchAll();
$arrN1 = array();
foreach ($orders as $key => $value) {
    $str = '["' . $value['month'] . '",' . $value['summ'] . '],';
    array_push($arrN1, $str);
}
$str = implode("", $arrN1);
//chart2
$sql2 = "SELECT MONTH(order_date) as month, COUNT(*) as total_orders
FROM orders
GROUP BY MONTH(order_date);
";

global $pdo;
$stmt = $pdo->prepare($sql2);
$stmt->execute();
$orders2 = $stmt->fetchAll();
$arrN2 = array();


foreach ($orders2 as $key => $value) {
    $str2 = '["' . $value['month'] . '",' . $value['total_orders'] . '],';
    array_push($arrN2, $str2);
}
$str2 = implode("", $arrN2);
//chart3
$sql3 = "SELECT 
CAST(order_date AS DATE) AS order_day,
SUM(price) AS revenue
FROM 
Orders
JOIN 
category ON Orders.category_id = category.category_id
WHERE 
MONTH(order_date) = 1 or MONTH(order_date) = 2 or  MONTH(order_date) =3 or  MONTH(order_date) = 4 AND 
YEAR(order_date) = 2023
GROUP BY 
CAST(order_date AS DATE)
ORDER BY 
order_day DESC;
";

global $pdo;
$stmt = $pdo->prepare($sql3);
$stmt->execute();
$orders3 = $stmt->fetchAll();
$arrN3 = array();


foreach ($orders3 as $key => $value) {
    $str3 = '["' . $value['order_day'] . '",' . $value['revenue'] . '],';
    array_push($arrN3, $str3);
}
$str3 = implode("", $arrN3);
$sum1 = 0;
$sum2 = 0;

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

    <title>CHART</title>

   
</head>

<body>

     <!--include-->
     <?php include("C:/Ampps/www/my-web_site/app/include/header_admin.php"); ?>
    <div class="container-xxl">
    <?php include("../../app/include/sidebar_admin.php"); ?>


        <?php $sum = 0; ?>
        <?php $topicsAUT = selectone('users', ['login' => $_SESSION['login']]); ?>


 
            
            <div class="main-content MR col-9"">
                <?php
                $list = $_SERVER['REQUEST_URI'];
                if (strpos($list, '?a')) {
                ?>
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                        google.charts.load('current', {
                            'packages': ['corechart']
                        });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable(
                                [
                                ['Месяц', 'Максимальная вероятность', 'l = 3', 'l = 7', 'l = 5'],
                                <?php echo $str ?>
                            ]);

                            var options = {
                                title: 'График скользящих средних по месяцам',
                                curveType: 'function',
                                legend: {
                                    position: 'bottom'
                                }
                            };

                            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

                            chart.draw(data, options);
                        }
                    </script>
                    <table>
                        <tr>
                            <th>t, месяц</th>
                            <th>y(t)</th>
                            <th>l = 3</th>
                            <th>l = 7</th>
                            <th>l = 5</th>
                        </tr>
                        <?php
                        if (strpos($list, '?a=1')) {
                            $sql = "select month(orders.order_date) 'month', sum(price) 'price' from orders join category on orders.category_id = category.category_id where year(orders.order_date) = 2022 group by month(orders.order_date) order by month(orders.order_date) asc";
                            global $pdo;
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                      
                        }
                        if (strpos($list, '?a=2')) {

                             $sql = "SELECT month(order_date) 'month', count(*) 'price' from orders where year(order_date) = 2022 group by month(order_date) order by month(order_date) asc";
                            global $pdo;
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                          
                        }
                        if (strpos($list, '?a=3')) {
                            $sql = "SELECT MONTH(date_review) AS 'month', COUNT(*) AS price
                            FROM reviews
                            GROUP BY MONTH(date_review);";
                            global $pdo;
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute();
                            $result = $stmt->fetchAll();
                        }

                        $arr1 = array();
                        $arr2 = array();
                        $arr1_f = array();
                        $y = array();
                        $yt = array();
                       

                        foreach ($result as $key => $value) {
                            array_push($y, $value['month']);
                            array_push($yt, $value['price']);
                        }
                       

                        $l_s_arr = array();
                        $l_ss_arr = array();
                        $l_sss_arr = array();

                        $i = 0;
                        while ($i < count($y)) {
                            if ($i != 0 && $i != 11) {
                                if (strpos($list, '?a=1')){                               
                                        $l_s_w = round(($yt[$i - 1] + $yt[$i] + $yt[$i + 1]) / 3, 2);                                  
                                }
                                 
                                else{
                                    $l_s_w = floor(($yt[$i - 1] + $yt[$i] + $yt[$i + 1]) / 3);
                                }
                                $l_s_point = $l_s_w;
                            } else {
                                $l_s_w = '-';
                                $l_s_point = null;
                            }
                         
                            if ($i != 0 && $i != 1 && $i != 2 && $i != 10 && $i != 11 && $i != 9) {
                                
                                if (strpos($list, '?a=1')){
                                    if($yt[9]){
                                        
                                    }
                       
                                 $l_ss_w = round(($yt[$i - 3] + $yt[$i - 2] + $yt[$i - 1] + $yt[$i] + $yt[$i + 1] + $yt[$i + 2] + $yt[$i + 3]) / 7, 2);

                                }
                        
                                else
                                    $l_ss_w = floor(($yt[$i - 3] + $yt[$i - 2] + $yt[$i - 1] + $yt[$i] + $yt[$i + 1] + $yt[$i + 2] + $yt[$i + 3]) / 7);
                                $l_ss_point = $l_ss_w;
                            } else {
                                $l_ss_w = '-';
                                $l_ss_point = null;
                            }


                            if ($i != 0 && $i != 1 && $i != 11 && $i != 10) {
                                if (strpos($list, '?a=1'))
                                    $l_sss_w = round((-3 * $yt[$i - 2] + 12 * $yt[$i - 1] + 17 * $yt[$i] + 12 * $yt[$i + 1] - 3 * $yt[$i + 2]) / 35, 2);
                                else
                                    $l_sss_w = floor((-3 * $yt[$i - 2] + 12 * $yt[$i - 1] + 17 * $yt[$i] + 12 * $yt[$i + 1] - 3 * $yt[$i + 2]) / 35);
                                $l_sss_point = $l_sss_w;
                            } else {
                                $l_sss_w = '-';
                                $l_sss_point = 0;
                            }

                            echo "
                         <tr><th>$y[$i]</th><th>$yt[$i]</th><th>$l_s_w</th><th>$l_ss_w</th><th>$l_sss_w</th></tr>
                        ";
                            $str_f = '["' . $y[$i] . '",' . $yt[$i] . ',' . $l_s_point . ',' . $l_ss_point . ',' . $l_sss_point . '],';
                            array_push($arr1_f, $str_f);
                            $i = $i + 1;
                        }
                        $str_f = implode("", $arr1_f);

                        $i = 0;
                        while ($i < count($y)) {
                            if (array_key_exists($i + 2, $yt)) {
                                array_push($l_s_arr, round(($yt[$i] + $yt[$i + 1] + $yt[$i + 2]) / 3, 2));
                            }


                            if (array_key_exists($i + 6, $yt)) {
                                array_push($l_ss_arr, round(($yt[$i] + $yt[$i + 1] + $yt[$i + 2] + $yt[$i + 3] + $yt[$i + 4] + $yt[$i + 5] + $yt[$i + 6]) / 7, 2));
                            }


                            if (array_key_exists($i + 4, $yt))
                                array_push($l_sss_arr, round((-3 * $yt[$i] + 12 * $yt[$i + 1] + 17 * $yt[$i + 2] + 12 * $yt[$i + 3] - 3 * $yt[$i + 4]) / 35, 2));

                            $i = $i + 1;
                        }
                     
                        ?>
                    </table>
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                        google.charts.load('current', {
                            'packages': ['corechart']
                        });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            <?php if (strpos($list, '?a=1')) { ?>
                                var data = google.visualization.arrayToDataTable([
                                    ['Месяц', 'Максимальная вероятность', 'l = 3', 'l = 7', 'l = 5'],
                                    <?php echo $str_f ?>
                                ]);


                                var options = {
                                    title: 'График скользящих средних',
                                    curveType: 'function',
                                    legend: {
                                        position: 'bottom'
                                    }
                                };
                            <? } ?>

                            <?php if (strpos($list, '?a=2')) { ?>
                                var data = google.visualization.arrayToDataTable([
                                    ['Месяц', 'Кол-во Анализов', 'l = 3', 'l = 7', 'l = 5'],
                                    <?php echo $str_f ?>
                                ]);


                                var options = {
                                    title: 'График скользящих средних',
                                    curveType: 'function',
                                    legend: {
                                        position: 'bottom'
                                    }
                                };
                            <? } ?>

                            <?php if (strpos($list, '?a=3')) { ?>
                                var data = google.visualization.arrayToDataTable([
                                    ['Месяц', 'Кол-во отзывов', 'l = 3', 'l = 7', 'l = 5'],
                                    <?php echo $str_f ?>
                                ]);


                                var options = {
                                    title: 'График скользящих средних',
                                    curveType: 'function',
                                    legend: {
                                        position: 'bottom'
                                    }
                                };
                            <? } ?>

                            var chart = new google.visualization.LineChart(document.getElementById('curve_chart1'));

                            chart.draw(data, options);
                        }
                    </script>
                    <div id="curve_chart1" style="width: 900px; height: 500px"></div>
                    <div>
                        <h1>Таблица после восстановления краевых значений</h1>
                    </div>
                    <table>

                        <thead>
                            <tr>
                                <th>t, месяц</th>
                                <th>y(t)</th>
                                <th>l = 3</th>
                                <th>l = 7</th>
                                <th>l = 5</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;

                            $i_s_temp = 0;
                            while ($i < count($y)) {
                                if ($i != 0 && $i != 10) {
                                    if (strpos($list, '?a=1'))
                                        $l_s = round(($yt[$i - 1] + $yt[$i] + $yt[$i + 1]) / 3, 2);
                                    else
                                        $l_s = floor(($yt[$i - 1] + $yt[$i] + $yt[$i + 1]) / 3);
                                } else {
                                    if (strpos($list, '?a=1')) {
                                        if ($i_s_temp == 0)
                                            $l_s = round((5 * $yt[0] + 2 * $yt[1] - $yt[2]) / 6, 2);
                                        else
                                            $l_s = round((-1 * $yt[8] + 2 * $yt[9] + 5 * $yt[10]) / 6, 2);
                                        $i_s_temp = 1;
                                    } else {
                                        if ($i_s_temp == 0)
                                            $l_s = floor((5 * $yt[0] + 2 * $yt[1] - $yt[2]) / 6);
                                        else
                                            $l_s = floor((-1 * $yt[8] + 2 * $yt[9] + 5 * $yt[10]) / 6);
                                        $i_s_temp = 1;
                                    }
                                }

                                if ($i != 0 && $i != 1 && $i != 2 && $i != 10 && $i != 9 && $i != 8) {
                                    if (strpos($list, '?a=1'))
                                        $l_ss = round(($yt[$i - 3] + $yt[$i - 2] + $yt[$i - 1] + $yt[$i] + $yt[$i + 1] + $yt[$i + 2] + $yt[$i + 3]) / 7, 2);
                                    else
                                        $l_ss = floor(($yt[$i - 3] + $yt[$i - 2] + $yt[$i - 1] + $yt[$i] + $yt[$i + 1] + $yt[$i + 2] + $yt[$i + 3]) / 7);
                                } else {
                                    if (strpos($list, '?a=1')) {
                                        if ($i == 0)
                                            $l_ss = round((39 * $yt[0] + 8 * $yt[1] - 4 * $yt[2] - 4 * $yt[3] + 1 * $yt[4] + 4 * $yt[5] - 2 * $yt[6]) / 42, 2);
                                        if ($i == 1)
                                            $l_ss = round((8 * $yt[0] + 19 * $yt[1] + 16 * $yt[2] + 6 * $yt[3] - 4 * $yt[4] - 7 * $yt[5] +  4 * $yt[6]) / 42, 2);
                                        if ($i == 2)
                                            $l_ss = round((-4 * $yt[0] + 16 * $yt[1] + 19 * $yt[2] + 12 * $yt[3] + 2 * $yt[4] - 4 * $yt[5] + $yt[6]) / 42, 2);
                                        if ($i == 10)
                                            $l_ss = round((2 * $yt[4] + 4 * $yt[5] + $yt[6] - 4 * $yt[7] - 4 * $yt[8] + 4 * $yt[9] + 39 * $yt[10]) / 42, 2);
                                        if ($i == 9)
                                            $l_ss = round((4 * $yt[4] - 7 * $yt[5] - 4 * $yt[6] + 6 * $yt[7] + 16 * $yt[8] + 19 * $yt[9] + 8 * $yt[10]) / 42, 2);
                                        if ($i == 8)
                                            $l_ss = round(($yt[4] - 4 * $yt[5] + 2 * $yt[6] + 12 * $yt[7] + 19 * $yt[8] + 16 * $yt[9] - 4 * $yt[10]) / 42, 2);
                                    } else {
                                        if ($i == 0)
                                            $l_ss = floor((39 * $yt[0] + 8 * $yt[1] - 4 * $yt[2] - 4 * $yt[3] + 1 * $yt[4] + 4 * $yt[5] - 2 * $yt[6]) / 42);
                                        if ($i == 1)
                                            $l_ss = floor((8 * $yt[0] + 19 * $yt[1] + 16 * $yt[2] + 6 * $yt[3] - 4 * $yt[4] - 7 * $yt[5] +  4 * $yt[6]) / 42);
                                        if ($i == 2)
                                            $l_ss = floor((-4 * $yt[0] + 16 * $yt[1] + 19 * $yt[2] + 12 * $yt[3] + 2 * $yt[4] - 4 * $yt[5] + $yt[6]) / 42);
                                        if ($i == 10)
                                            $l_ss = floor((2 * $yt[4] + 4 * $yt[5] + $yt[6] - 4 * $yt[7] - 4 * $yt[8] + 4 * $yt[9] + 39 * $yt[10]) / 42);
                                        if ($i == 9)
                                            $l_ss = floor((4 * $yt[4] - 7 * $yt[5] - 4 * $yt[6] + 6 * $yt[7] + 16 * $yt[8] + 19 * $yt[9] + 8 * $yt[10]) / 42);
                                        if ($i == 8)
                                            $l_ss = floor(($yt[4] - 4 * $yt[5] + 2 * $yt[6] + 12 * $yt[7] + 19 * $yt[8] + 16 * $yt[9] - 4 * $yt[10]) / 42);
                                    }
                                }


                                if ($i != 0 && $i != 1 && $i != 10 && $i != 9) {
                                    if (strpos($list, '?a=1'))
                                        $l_sss = round((-3 * $yt[$i - 2] + 12 * $yt[$i - 1] + 17 * $yt[$i] + 12 * $yt[$i + 1] - 3 * $yt[$i + 2]) / 35, 2);
                                    else
                                        $l_sss = floor((-3 * $yt[$i - 2] + 12 * $yt[$i - 1] + 17 * $yt[$i] + 12 * $yt[$i + 1] - 3 * $yt[$i + 2]) / 35);
                                } else {
                                    if (strpos($list, '?a=1')) {
                                        if ($i == 0)
                                            $l_sss = round((31 * $yt[0] + 9 * $yt[1] - 3 * $yt[2] - 5 * $yt[3] + 3 * $yt[4]) / 35, 2);
                                        if ($i == 1)
                                            $l_sss = round((9 * $yt[0] + 13 * $yt[1] + 12 * $yt[2] + 6 * $yt[3] + -5 * $yt[4]) / 35, 2);
                                        if ($i == 9)
                                            $l_sss = round((-5 * $yt[6] + 6 * $yt[7] + 12 * $yt[8] + 13 * $yt[9] - 9 * $yt[10]) / 35, 2);
                                        if ($i == 10)
                                            $l_sss = round((3 * $yt[6] - 5 * $yt[7] - 3 * $yt[8] + 9 * $yt[9] + 31 * $yt[10]) / 35, 2);
                                    } else {
                                        if ($i == 0)
                                            $l_sss = floor((31 * $yt[0] + 9 * $yt[1] - 3 * $yt[2] - 5 * $yt[3] + 3 * $yt[4]) / 35);
                                        if ($i == 1)
                                            $l_sss = floor((9 * $yt[0] + 13 * $yt[1] + 12 * $yt[2] + 6 * $yt[3] + -5 * $yt[4]) / 35);
                                        if ($i == 9)
                                            $l_sss = floor((-5 * $yt[6] + 6 * $yt[7] + 12 * $yt[8] + 13 * $yt[9] - 9 * $yt[10]) / 35);
                                        if ($i == 10)
                                            $l_sss = floor((3 * $yt[6] - 5 * $yt[7] - 3 * $yt[8] + 9 * $yt[9] + 31 * $yt[10]) / 35);
                                    }
                                    if ($l_sss < 0)
                                        $l_sss = 0;
                                }

                                echo "
                         <tr><th>$y[$i]</th><th>$yt[$i]</th><th>$l_s</th><th>$l_ss</th><th>$l_sss</th></tr>
                        ";
                                $str = '["' . $y[$i] . '",' . $yt[$i] . ',' . $l_s . ',' . $l_ss . ',' . $l_sss . '],';
                                array_push($arr1, $str);
                                $i = $i + 1;
                            }
                            $str = implode("", $arr1);
                            ?>
                    </table>
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript">
                        google.charts.load('current', {
                            'packages': ['corechart']
                        });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Месяц', 'Максимальная вероятность', 'l = 3', 'l = 7', 'l = 5'],
                                <?php echo $str ?>
                            ]);

                            var options = {
                                title: 'График скользящих средних',
                                curveType: 'function',
                                legend: {
                                    position: 'bottom'
                                }
                            };

                            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

                            chart.draw(data, options);
                        }
                    </script>

                    <script type="text/javascript">
                        google.charts.load('current', {
                            'packages': ['corechart']
                        });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            <?php if (strpos($list, '?a=1')) { ?>
                                var data = google.visualization.arrayToDataTable([
                                    ['Месяц', 'Сумма заказов', 'l = 3', 'l = 7', 'l = 5'],
                                    <?php echo $str ?>
                                ]);


                                var options = {
                                    title: 'График скользящих средних',
                                    curveType: 'function',
                                    legend: {
                                        position: 'bottom'
                                    }
                                };
                            <? } ?>

                            <?php if (strpos($list, '?a=2')) { ?>
                                var data = google.visualization.arrayToDataTable([
                                    ['Месяц', 'Кол-во заказов', 'l = 3', 'l = 7', 'l = 5'],
                                    <?php echo $str ?>
                                ]);


                                var options = {
                                    title: 'График скользящих средних',
                                    curveType: 'function',
                                    legend: {
                                        position: 'bottom'
                                    }
                                };
                            <? } ?>

                            <?php if (strpos($list, '?a=3')) { ?>
                                var data = google.visualization.arrayToDataTable([
                                    ['Месяц', 'Кол-во отзывов', 'l = 3', 'l = 7', 'l = 5'],
                                    <?php echo $str ?>
                                ]);


                                var options = {
                                    title: 'График скользящих средних',
                                    curveType: 'function',
                                    legend: {
                                        position: 'bottom'
                                    }
                                };
                            <? } ?>

                            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

                            chart.draw(data, options);
                        }
                    </script>
                    <div id="curve_chart" style="width: 900px; height: 500px"></div>
                    <div style="margin: 0 0 20px 0;">
                        <div>
                            <h1>Таблица прогнозных значений для трех рядов скользящих средних при l=3, l=5, l=7</h1>
                        </div>
                        <table>
                            <tr>
                                <th>l = 3</th>
                                <th>l = 7</th>
                                <th>l = 5</th>
                            </tr>
                            <?php
                            if (strpos($list, '?a=1')) {
                            
                                $prognoz_l3 = round($l_s_arr[8] + (($yt[10] - $yt[9]) / 3), 2);
                            } else {
                                $prognoz_l3 = floor($l_s_arr[8] + (($yt[10] - $yt[9]) / 3));
                            }

                            if (strpos($list, '?a=1')) {
                                $l_ss = round((4 * $yt[4] - 7 * $yt[5] - 4 * $yt[6] + 6 * $yt[7] + 16 * $yt[8] + 19 * $yt[9] + 8 * $yt[10]) / 42, 2);
                                $prognoz_l7 = round($l_ss + (($yt[10] - $yt[9]) / 7), 2);
                            } else {
                                $l_ss = round((4 * $yt[4] - 7 * $yt[5] - 4 * $yt[6] + 6 * $yt[7] + 16 * $yt[8] + 19 * $yt[9] + 8 * $yt[10]) / 42, 2);
                                $prognoz_l7 = floor($l_ss + (($yt[10] - $yt[9]) / 7));
                            }
                            if (strpos($list, '?a=1')) {
                                $l_sss = round((-5 * $yt[6] + 6 * $yt[7] + 12 * $yt[8] + 13 * $yt[9] - 9 * $yt[10]) / 35, 2);
                                $prognoz_l5 = round($l_sss + (($yt[10] - $yt[9]) / 5), 2);
                            } else {
                                $l_sss = round((-5 * $yt[6] + 6 * $yt[7] + 12 * $yt[8] + 13 * $yt[9] - 9 * $yt[10]) / 35, 2);
                                $prognoz_l5 = floor($l_sss + (($yt[10] - $yt[9]) / 5));
                            }

                            echo "<tr><th>$prognoz_l3</th><th>$prognoz_l7</th><th>$prognoz_l5</th></tr>";
                            ?>
                            <table>
                    </div>
            </div>
    
    </div>

    <!--Блок footer-->
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
<?php
                }
?>
</body>

</html>

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
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        td:first-child,
        th:first-child {
            text-align: left;
        }
    </style>
