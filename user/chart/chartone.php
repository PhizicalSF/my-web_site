<?php
include "../../app/controllers/profile.php";

global $pdo;
$stmt = $pdo->prepare("SELECT poems.name,poems.theme, reviews.reviewsid, reviews.stars from reviews, poems where reviews.poemsid= poems.poemsid and poems.theme = '$_POST[category]'");
$stmt->execute();
$orders = $stmt->fetchAll();
$arr1 = array();
$arr2 = array();
foreach ($orders as $key => $value) {
    $str = '"' . $value['name'] . '",';
    array_push($arr1, $str);
    $str = $value['stars'] . ',';
    array_push($arr2, $str);
}
$str = "['Тема'," . implode("", $arr1) . "],";
$str2 = "['Стихи'," . implode("", $arr2) . "],";
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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
            // Some raw data (not necessarily accurate)
            var data = google.visualization.arrayToDataTable([
                <?php echo $str . $str2 ?>
            ]);

            var options = {
                title: 'Оценки выбранной категории ',
                vAxis: {
                    title: 'Оценка'
                },
                seriesType: 'bars',
                series: {
                    5: {
                        type: 'line'
                    }
                }
            };

            var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
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
        
  
    </div>
    </div>

    <!--Блок footer-->
    <?php include("C:/Ampps/www/my-web_site/app/include/footer.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>