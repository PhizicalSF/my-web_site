<?php
include "../../app/controllers/profile.php";
  $topicsAUT = selectone('users', ['email' => $_SESSION['email']]);
global $pdo;
$stmt = $pdo->prepare("SELECT o.user_id, c.name,o.category_id, SUM(c.price) AS summa
FROM orders o
JOIN category c ON o.category_id = c.category_id where o.user_id=".$topicsAUT['usersid'] ."
GROUP BY o.user_id, c.name, o.category_id
ORDER BY o.user_id, c.name");
$stmt->execute();
$orders = $stmt->fetchAll();
$arr = array();
foreach ($orders as $key => $value) {
    $stmt = $pdo->prepare("SELECT category.category_id,category.name 'name' from category where category.category_id = " . $value['category_id']);
    $stmt->execute();
    $orders321 = $stmt->fetch();
    $res = $value['summa'];
    $str = '["' . $orders321['name'] . '",' . $res . '],';
    array_push($arr, $str);
}
$str = implode("", $arr);
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


    <title>Панель</title>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        // Load the Visualization API and the corechart package.
        google.charts.load('current', {
            'packages': ['corechart']
        });

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawChart() {

            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Type TestDrive');
            data.addColumn('number', 'Percent hours');
            <?php
            echo "
        data.addRows([$str]);
        "
            ?>


            // Set chart options
            var options = {
                'title': 'Круговая диаграмма, отражающая процентное соотношение затрат пользователя на его заказы по категориям услуг',
                'width': 800,
                'height': 700
            };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>


</head>

<body>
 <!--include-->
 <?php include("C:/Ampps/www/my-web_site/app/include/header_user.php"); ?>
    <!--include-->
    <div class="container">
        <?php include("../../app/include/sidebar_user.php"); ?>

        <?php $sum = 0; ?>
        <?php $topicsAUT = selectone('users', ['email' => $_SESSION['email']]); ?>


           
            <div class="main-content col-9">
                <div id="chart_div" style="width: 900px; height: 500px; margin-top: 16px; border-radius: 6px;" ></div>
            </div>
            </form>
  
    </div>
    </div>

    <!--Блок footer-->
    <?php include("C:/Ampps/www/my-web_site/app/include/footer.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>