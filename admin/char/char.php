<?php
include "../../app/controllers/profile.php";

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
$arr1 = array();
$arr2 = array();
foreach ($orders as $key => $value) {
    $str = '["' . $value['month'] . '",' . $value['summ'] . '],';
    array_push($arr1, $str);
}
$str = implode("", $arr1);
//chart2
$sql2 = "SELECT MONTH(order_date) as month, COUNT(*) as total_orders
FROM orders
GROUP BY MONTH(order_date);
";

global $pdo;
$stmt = $pdo->prepare($sql2);
$stmt->execute();
$orders2 = $stmt->fetchAll();
$arr12 = array();
$arr22 = array();

foreach ($orders2 as $key => $value) {
    $str2 = '["' . $value['month'] . '",' . $value['total_orders'] . '],';
    array_push($arr12, $str2);
}
$str2 = implode("", $arr12);
//chart3
$sql3 = "SELECT MONTH(date_review) AS 'month', COUNT(*) AS review_count
FROM reviews
GROUP BY MONTH(date_review);

";

global $pdo;
$stmt = $pdo->prepare($sql3);
$stmt->execute();
$orders3 = $stmt->fetchAll();
$arr123 = array();
$arr223 = array();

foreach ($orders3 as $key => $value) {
    $str3 = '["' . $value['month'] . '",' . $value['review_count'] . '],';
    array_push($arr123, $str3);
}
$str3 = implode("", $arr123);
?>
<html lang="en">
<!doctype html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--Bootstrap CSS and Font awesome and styling-->
    <!--Bootstrap CSS and Font awesome and styling-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/0b0da13991.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../assets/css/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bellota+Text:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <title>CHART</title>
    <!---->
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Месяц', 'Выручка'],
                <?php echo $str ?>
            ]);

            var options = {
                title: 'График выручки организации по месяцам',
                curveType: 'none',
                legend: {
                    position: 'bottom'
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
        }
    </script>

    <!---->
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Месяц', 'Количество заказов'],
                <?php echo $str2 ?>
            ]);

            var options = {
                title: 'График количества заказов организации по месяцам',
                curveType: 'none',
                legend: {
                    position: 'bottom'
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart2'));

            chart.draw(data, options);
        }
    </script>
    <!---->
   <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['месяц', 'кол-во отзывов'],
                <?php echo $str3 ?>
            ]);

            var options = {
                title: 'График отзывов по месяцам',
                curveType: 'none',
                legend: {
                    position: 'bottom'
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart3'));

            chart.draw(data, options);
        }
    </script>
<!---->

</head>

<body>

    <!--include-->
    <!--include-->
    <?php include("C:/Ampps/www/my-web_site/app/include/header_admin.php"); ?>
    <!--include-->
    <div class="container">
        <?php include("../../app/include/sidebar_admin.php"); ?>



        <div class="main-content col-9">
            <div id="curve_chart" style="width: 900px; height: 500px; margin-top: 16px; border-radius: 6px;"></div>
            <div style="color:white;">На графике видно что прибыль организации заметно возрастает перед зимними праздниками и падает когда они проходят. Так же можно сказать что после определенных месяцов замечены резкие снижения прибыли</div>
            <div id="curve_chart2" style="width: 900px; height: 500px; margin-top: 16px; border-radius: 6px;"></div>
            <div style="color:white;">На графике видно количество заказов заметно возрастает перед зимними праздниками и падает когда они проходят. </div>
            <div id="curve_chart3" style="width: 900px; height: 500px; margin-top: 16px; border-radius: 6px;"></div>
            <div style="color:white;">На графике замечено что в последние месяцы количество отзывов падает, возможно это связано с тем что выходит меньше стихотворений из за большого количества заказов в зимний период.</div>
        </div>

     

   

    </div>

    <!--Блок footer-->
    <?php include("C:/Ampps/www/my-web_site/app/include/footer.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>


