<?php
include "../../app/controllers/profile.php";
include "fun.php";
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
    <title>Адекватность</title>
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

        h3 {
            font-size: 18px;
        }
    </style>

</head>

<body>

    <!--include-->
    <?php include("C:/Ampps/www/my-web_site/app/include/header_admin.php"); ?>


    <div class="">

        <?php $sum = 0; ?>
        <?php $topicsAUT = selectone('users', ['login' => $_SESSION['login']]); ?>



        <div class='content row'>
            <?php include("../../app/include/sidebar_admin.php"); ?>

            <div class="main-content col-9">
                <form action="lr9.php?a=1" method="post">
                    <label for='model' style="margin-top: 10px; color:wheat">Выберите модель<br />
                        <select name="model">
                            <option value="line">Линейная</option>
                            <option value="pokaz">Показательная</option>
                            <option value="parab">Параболическая</option>
                        </select>
                    </label>
                    <button class="def" style="margin-top: 10px; margin-left: 10px">График 1</button>
                </form>
                <form action="lr9.php?a=2" method="post">
                    <label for='model' style="margin-top: 10px; color:wheat">Выберите модель<br />
                        <select name="model">
                            <option value="line">Линейная</option>
                            <option value="pokaz">Показательная</option>
                            <option value="parab">Параболическая</option>
                        </select>
                    </label>
                    <button class="def" style="margin-top: 10px; margin-left: 10px">График 2</button>
                </form>
                <form action="lr9.php?a=3" method="post">
                    <label for='model' style="margin-top: 10px; color:wheat">Выберите модель<br />
                        <select name="model">
                            <option value="line">Линейная</option>
                            <option value="pokaz">Показательная</option>
                            <option value="parab">Параболическая</option>
                        </select>
                    </label>
                    <button class="def" style="margin-top: 10px; margin-left: 10px">График 3</button>
                </form>
                <form action="lr9.php?a=test" method="post">
                    <label for='model' style="margin-top: 10px; color:wheat">Выберите модель<br />
                        <select name="model">
                            <option value="line">Линейная</option>
                            <option value="pokaz">Показательная</option>
                            <option value="parab">Параболическая</option>
                        </select>
                    </label>
                    <button class="def" style="margin-top: 10px; margin-left: 10px">Тест</button>
                </form>
                <?php
                $list = $_SERVER['REQUEST_URI'];
                if (strpos($list, '?a')) {
                    $model = $_POST['model'];

                    if (strpos($list, '?a=test')) {
                        $sql = "SELECT Numbers.num AS Number,
                        CASE WHEN Numbers.num = 1 THEN 14717 
                             WHEN Numbers.num = 2 THEN 16642 
                             WHEN Numbers.num = 3 THEN 18504 
                             WHEN Numbers.num = 4 THEN 20376 
                             WHEN Numbers.num = 5 THEN 21321 
                             WHEN Numbers.num = 6 THEN 23342 
                             WHEN Numbers.num = 7 THEN 28317 
                             WHEN Numbers.num = 8 THEN 30624 
                             WHEN Numbers.num = 9 THEN 33408 
                             WHEN Numbers.num = 10 THEN 36505 
                             WHEN Numbers.num = 11 THEN 40524 
                             WHEN Numbers.num = 12 THEN 45416 
                             WHEN Numbers.num = 13 THEN 50857 
                             WHEN Numbers.num = 14 THEN 56024 
                             WHEN Numbers.num = 15 THEN 59381 
                             ELSE NULL END AS summ
                    FROM
                        (SELECT 1 AS num UNION
                         SELECT 2 UNION
                         SELECT 3 UNION
                         SELECT 4 UNION
                         SELECT 5 UNION
                         SELECT 6 UNION
                         SELECT 7 UNION
                         SELECT 8 UNION
                         SELECT 9 UNION
                         SELECT 10 UNION
                         SELECT 11 UNION
                         SELECT 12 UNION
                         SELECT 13 UNION
                         SELECT 14 UNION
                         SELECT 15) AS Numbers;";

                        global $pdo;
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->fetchAll();



                        $sql = "SELECT Numbers.num AS Number,
                        CASE WHEN Numbers.num = 1 THEN 14717 
                             WHEN Numbers.num = 2 THEN 16642 
                             WHEN Numbers.num = 3 THEN 18504 
                             WHEN Numbers.num = 4 THEN 20376 
                             WHEN Numbers.num = 5 THEN 21321 
                             WHEN Numbers.num = 6 THEN 23342 
                             WHEN Numbers.num = 7 THEN 28317 
                             WHEN Numbers.num = 8 THEN 30624 
                             WHEN Numbers.num = 9 THEN 33408 
                             WHEN Numbers.num = 10 THEN 36505 
                             WHEN Numbers.num = 11 THEN 40524 
                             WHEN Numbers.num = 12 THEN 45416 
                             WHEN Numbers.num = 13 THEN 50857 
                             WHEN Numbers.num = 14 THEN 56024 
                             WHEN Numbers.num = 15 THEN 59381 
                             ELSE NULL END AS summ
                    FROM
                        (SELECT 1 AS num UNION
                         SELECT 2 UNION
                         SELECT 3 UNION
                         SELECT 4 UNION
                         SELECT 5 UNION
                         SELECT 6 UNION
                         SELECT 7 UNION
                         SELECT 8 UNION
                         SELECT 9 UNION
                         SELECT 10 UNION
                         SELECT 11 UNION
                         SELECT 12 UNION
                         SELECT 13 UNION
                         SELECT 14 UNION
                         SELECT 15) AS Numbers;";

                        global $pdo;
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        $result1 = $stmt->fetchAll();
                    }

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
                        $result1 = $stmt->fetchAll();
                    }
                    if (strpos($list, '?a=2')) {
                        $sql = "SELECT MONTH(order_date) as month, COUNT(*) as summ
                        FROM orders
                        GROUP BY MONTH(order_date);
                        ";

                        global $pdo;
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        $result1 = $stmt->fetchAll();
                    }

                    if (strpos($list, '?a=3')) {
                        $sql = "SELECT MONTH(date_review) AS 'month', COUNT(*) AS summ
                        FROM reviews
                        GROUP BY MONTH(date_review);
                        ";

                        global $pdo;
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->fetchAll();
                        $result1 = $stmt->fetchAll();
                    }

                    if ($model == "line") {
                        echo "<div><h3 style='color:white'>Проверка линейной модели</h3></div>";
                    }
                    if ($model == "pokaz") {
                        echo "<div><h3 style='color:white'>Проверка показательной модели</h3></div>";
                    }
                    if ($model == "parab") {
                        echo "<div><h3 style='color:white'>Проверка параболической модели</h3></div>";
                    }
                    echo "<div><h3 style='color:white'>Задание 1</h3></div>";

                    $y = array();

                    foreach ($result as $key => $value) {
                        $str = $value['summ'];
                        array_push($y, $str);
                    }

                    $i = 0;
                    $t = -1 * ((count($y) - 1) / 2);

                    $sum_yt = 0;
                    $sum_ytt = 0;
                    $sum_tt = 0;
                    $sum_yt2 = 0;
                    $sum_t4 = 0;
                    $sum_lnyt = 0;
                    $sum_lnytt = 0;

                    while ($i < count($y)) {
                        $number = $i + 1;
                        if ($t != 0)
                            $col4 = $y[$i] * $t;
                        else
                            $col4 = 0;
                        $col5 = $t * $t;
                        $col6 = $y[$i] * $col5;
                        $col7 = $col5 * $col5;
                        $col8 = log($y[$i]);
                        if ($t != 0 && $col8 != 0)
                            $col9 = $col8 * $t;
                        else
                            $col9 = 0;

                        $sum_yt =  $sum_yt + $y[$i];
                        $sum_ytt =  $sum_ytt + $col4;
                        $sum_tt =  $sum_tt + $col5;
                        $sum_yt2 =  $sum_yt2 + $col6;
                        $sum_t4 =  $sum_t4 + $col7;
                        $sum_lnyt =  $sum_lnyt + $col8;
                        $sum_lnytt =  $sum_lnytt + $col9;

                        $i = $i + 1;
                        $t = $t + 1;
                    }

                    $a0_l = $sum_yt / count($y);
                    $a1_l = $sum_ytt / $sum_tt;

                    $a0_pok = exp(($sum_lnyt / count($y)));
                    $a1_pok = exp(($sum_lnytt / $sum_tt));

                    $a2_p = ((count($y) * $sum_yt2) - ($sum_tt * $sum_yt)) / ((count($y) * $sum_t4) - ($sum_tt * $sum_tt));
                    $a0_p = $a0_l - ($sum_tt / count($y)) * $a2_p;


                    $i = 0;
                    $line_model_ostatki = array();
                    $line_model_ostatki_base = array();
                    $t = -1 * ((count($y) - 1) / 2);

                    while ($i < count($y)) {
                        if ($model == "line") {
                            $line_model = $a0_l + $a1_l * $t;
                        }
                        if ($model == "pokaz") {
                            $line_model = $a0_pok * pow($a1_pok, $t);
                        }
                        if ($model == "parab") {
                            $line_model = $a0_p + $a1_l * $t + $a2_p * ($t * $t);
                        }
                        $ost = $y[$i] - $line_model;
                        array_push($line_model_ostatki,   round($ost, 2));
                        array_push($line_model_ostatki_base,   round($ost, 2));
                        $t = $t + 1;
                        $i = $i + 1;
                    }
                    sort($line_model_ostatki);
                    echo "<div><h3 style='color:white'>Ряд остатков</h3></div>
                    <table>
                    <tr>";
                    $i = 0;
                    while ($i < count($y)) {
                        $number = $i + 1;
                        echo "<th>$number</th>";
                        $i = $i + 1;
                    }
                    echo " </tr>
                        <tr> ";
                    $i = 0;
                    while ($i < count($y)) {
                        $t = $line_model_ostatki[$i];
                        echo "<th>$t</th>";
                        $i = $i + 1;
                    }

                    echo "  </tr>
                    </table>";
                    if (count($line_model_ostatki) % 2 == 0) {
                        $Me = ($line_model_ostatki[(count($line_model_ostatki) / 2) - 1] + $line_model_ostatki[(count($line_model_ostatki) / 2)]) / 2;
                    } else {
                        $Me = $line_model_ostatki[(count($line_model_ostatki) / 2)];
                    }

                    echo "<div><h3 style='color:white'>Медиана = $Me </h3></div>

            <div><h3 style='color:white'>Таблица для расчета показателей</h3></div>
           <table>


           <tr><th>et</th><th>Серии</th></tr> 

           
           ";

                    $series_len = 0;
                    $max_s = 0;
                    $total_s = 0;
                    $series = -2;

                    $i = 0;
                    while ($i < count($line_model_ostatki_base)) {
                        if ($line_model_ostatki_base[$i] > $Me) {

                            $ch = "+";

                            if ($series > 0) {
                                $series_len =  $series_len + 1;
                            } else {
                                if ($series_len > $max_s) {
                                    $max_s = $series_len;
                                }
                                $series_len = 1;

                                $total_s = $total_s + 1;
                            }
                            $series = 1;
                        }

                        if ($line_model_ostatki_base[$i] < $Me) {
                            $ch = "-";

                            if ($series < 0) {
                                $series_len =  $series_len + 1;
                            } else {
                                if ($series_len > $max_s) {
                                    $max_s = $series_len;
                                }
                                $series_len = 1;

                                $total_s = $total_s + 1;
                            }
                            $series = -1;
                        }

                        if ($line_model_ostatki_base[$i] == $Me) {
                            $ch = "";

                            if ($series == 0) {
                                $series_len =  $series_len + 1;
                            } else {
                                if ($series_len > $max_s) {
                                    $max_s = $series_len;
                                }
                                $series_len = 1;

                                $total_s = $total_s + 1;
                            }
                            $series = 0;
                        }
                        echo "
                <tr><th>$line_model_ostatki_base[$i]</th><th>$ch</th></tr>
                ";
                        $i = $i + 1;
                    }

                    if ($series_len > 1) {
                        if ($series_len > $max_s) {
                            $max_s = $series_len;
                        }
                        $total_s = $total_s + 1;
                    }
                    echo "</table>";
                    echo "<div><h3 style='color:white'>Количество серий = $total_s </h3></div>";
                    echo "<div><h3 style='color:white'>Длина самой длинной серии = $max_s </h3></div>";
                    echo "<div><h3 style='color:white'>Результат: </h3></div>";
                    $test_one = floor(0.5 * ((count($line_model_ostatki_base) + 1 - (1.96 * sqrt(count($line_model_ostatki_base) - 1)))));
                    $test_two = floor(3.3 * (log(count($line_model_ostatki_base)) + 1));
                    if (($total_s > $test_one) && ($max_s < $test_two)) {
                        echo "<div><h3 style='color:white'>Трендовая модель является адекватной, так как $total_s > $test_one и $max_s < $test_two</h3></div>";
                    } else {
                        echo "<div><h3 style='color:white'>Трендовая модель является неадекватной, так как не выполняется $total_s > $test_one или $max_s < $test_two</h3></div>";
                    }

                    //Задание 2
                    echo "<div><h3 style='color:white'>Задание 2</h3></div>";
                    $i = 0;
                    $Sum_e4 = 0;
                    $Sum_e3 = 0;
                    $Sum_e2 = 0;
                    while ($i < count($line_model_ostatki_base)) {
                        $Sum_e4 = $Sum_e4 + pow($line_model_ostatki_base[$i], 4);
                        $Sum_e3 = $Sum_e3 + ($line_model_ostatki_base[$i] * $line_model_ostatki_base[$i] * $line_model_ostatki_base[$i]);
                        $Sum_e2 = $Sum_e2 + ($line_model_ostatki_base[$i] * $line_model_ostatki_base[$i]);
                        $i = $i + 1;
                    }
                    $A =  round(($Sum_e3 / count($line_model_ostatki_base)) / (sqrt(pow($Sum_e2 / count($line_model_ostatki_base), 3))), 2);
                    $Excess = round((($Sum_e4 / count($line_model_ostatki_base)) / (sqrt(pow($Sum_e2 / count($line_model_ostatki_base), 3)))) - 3, 2);

                    $n = count($line_model_ostatki_base);
                    $test_one = round(1.5 * sqrt((6 * ($n - 2)) / (($n + 1) * ($n + 3))), 2);
                    $test_two = round(1.5 * sqrt(((24 * $n * ($n - 2) * ($n - 3)) / (pow(($n + 1), 2) * ($n + 3) * ($n + 5)))), 2);
                    echo "<div><h3 style='color:white'>Асимметрия = $A </h3></div>";
                    echo "<div><h3 style='color:white'>Эксцесс =  $Excess </h3></div>";
                    $number = (6 / ($n + 1));
                    if ((abs($A) < $test_one) && (abs($Excess + (6 / ($n + 1))) < $test_two)) {
                        echo "<div><h3 style='color:white'>Гипотеза о нормальном характере распределения случайной компоненты принимается, так как |A| < $test_one и |Э + (6/(n+1))| < $test_two </h3></div>";
                    } else {
                        echo "<div><h3 style='color:white'>Гипотеза о нормальном характере распределения случайной компоненты отвергается, так как |A| > $test_one или |Э +  $number)| > $test_two </h3></div>";
                    }

                    //Задание 3
                    echo "<div><h3 style='color:white'>Задание 3</h3></div>";
                    echo "<div><h3 style='color:white'>Вспомогательная таблица для теста Дарбина-Уотсона</h3></div>";
                    echo "
            <table>
            <tr><th>№</th> <th>y(t)</th> <th>t</th> <th>y^(t)</th> <th>e(t)</th> <th>(e(t))^2</th> <th>(e(t)-e(t-1))^2</th> </tr> 
            ";
                    $i = 0;
                    $t = -1 * ((count($y) - 1) / 2);
                    $sum_et2 = 0;
                    $sum_et2_et1_2 = 0;
                    $y_sp = array();

                    while ($i < count($y)) {
                        $number = $i + 1;
                        $col4 = round($y[$i] - $line_model_ostatki_base[$i], 2);
                        $col6 = round($line_model_ostatki_base[$i] * $line_model_ostatki_base[$i], 2);
                        $sum_et2 =  $sum_et2 + $col6;
                        if ($i > 0) {
                            $col7 = round(pow($line_model_ostatki_base[$i] - $line_model_ostatki_base[$i - 1], 2), 2);
                            $sum_et2_et1_2 = $sum_et2_et1_2 + $col7;
                        } else {
                            $col7 = "-";
                        }
                        echo "
                <tr><th>$number</th><th>$y[$i]</th><th>$t</th><th>$col4</th><th>$line_model_ostatki_base[$i]</th><th>$col6</th><th>$col7</th></tr>
                ";
                        $i = $i + 1;
                        $t = $t + 1;
                    }
                    echo "
            <tr><th>Sum</th><th> </th><th> </th><th> </th><th> </th><th>$sum_et2</th><th>$sum_et2_et1_2</th></tr>
            </table>
            ";
                    switch ($model) {
                        case "line":
                            $dl = 0.93;
                            $du = 1.32;
                            break;

                        case "pokaz":
                            $dl = 0.66;
                            $du = 1.6;
                            break;

                        case "parab":
                            $dl = 0.93;
                            $du = 1.32;
                            break;
                    }

                    $d = round($sum_et2_et1_2 / $sum_et2, 2);
                    echo "<div><h3 style='color:white'>d = $d</h3></div>";
                    echo "<div><h3 style='color:white'>dl = $dl</h3></div>";
                    echo "<div><h3 style='color:white'>du = $du</h3></div>";

                    if (($d >= $dl) && ($d <= $du)) {
                        echo "<div><h3 style='color:white'>Значение d попало в область неопределенности</h3></div>";
                    } else {
                        if ($d < $dl) {
                            echo "<div><h3 style='color:white'>Гипотеза об отсутствии автокорреляции отвергается, принимается гипотеза о положительной автокорреляции</h3></div>";
                        }
                        if ($d > $du) {
                            echo "<div><h3 style='color:white'>Гипотеза об отсутствии автокорреляции принимается, гипотеза о положительной автокорреляции отвергается</h3></div>";
                        }
                    }

                    //Задание 4
                    echo "<div><h3 style='color:white'>Задание 4</h3></div>";
                    $line_test = array();
                    $parab_test = array();
                    $pokaz_test = array();
                    $i = 0;
                    $t = -1 * ((count($y) - 1) / 2);
                    while ($i < count($y)) {
                        $arg_l = $a0_l + $a1_l * $t;
                        array_push($line_test,   round($arg_l, 2));
                        $arg_pok = $a0_pok * pow($a1_pok, $t);
                        array_push($pokaz_test,   round($arg_pok, 2));
                        $arg_p = $a0_p + $a1_l * $t + $a2_p * ($t * $t);
                        array_push($parab_test,   round($arg_p, 2));
                        $t = $t + 1;
                        $i = $i + 1;
                    }


                    //Линейная
                    echo "<div><h3 style='color:white'>Линейная модель</h3></div>";
                    $i = 0;
                    $sum_mape = 0;
                    while ($i < count($y)) {
                        $sum_mape = $sum_mape + abs(($line_test[$i] - $y[$i]) / $y[$i]);
                        $i = $i + 1;
                    }
                    $MAPE = round(100 * ($sum_mape / count($y)), 2);
                    echo "<div><h3 style='color:white'>MAPE = $MAPE</h3></div>";
                    if ($MAPE < 10) {
                        echo "<div><h3 style='color:white'>Так как $MAPE < 10%, модель имеет высокую точность</h3></div>";
                    }
                    if ($MAPE >= 10 && $MAPE <= 20) {
                        echo "<div><h3 style='color:white'>Так как 10% <= $MAPE <= 20%, модель можно считать хорошей</h3></div>";
                    }
                    if ($MAPE > 20 && $MAPE < 50) {
                        echo "<div><h3 style='color:white'>Так как 20% < $MAPE < 50%, модель можно считать удовлетворительной</h3></div>";
                    }
                    if ($MAPE >= 50) {
                        echo "<div><h3 style='color:white'>Так как $MAPE > 50%, модель можно считать плохой</h3></div>";
                    }
                    $MAPE_l = $MAPE;

                    $i = 0;
                    $sum_mape = 0;
                    while ($i < count($y)) {
                        $sum_mape = $sum_mape + pow(($line_test[$i] - $y[$i]), 2);
                        $i = $i + 1;
                    }
                    $S = round(sqrt(($sum_mape / count($y))), 2);
                    $SSE = round($sum_mape, 2);
                    $MSE =  round($SSE / (count($y) - 2), 2);
                    echo "<div><h3 style='color:white'>S = $S</h3></div>";
                    echo "<div><h3 style='color:white'>SSE = $SSE</h3></div>";
                    echo "<div><h3 style='color:white'>MSE = $MSE</h3></div>";


                    //Показательная
                    echo "<div><h3 style='color:white'>Показательная модель</h3></div>";
                    $i = 0;
                    $sum_mape = 0;
                    while ($i < count($y)) {
                        $sum_mape = $sum_mape + abs(($pokaz_test[$i] - $y[$i]) / $y[$i]);
                        $i = $i + 1;
                    }
                    $MAPE = round(100 * ($sum_mape / count($y)), 2);
                    echo "<div><h3 style='color:white'>MAPE = $MAPE</h3></div>";
                    if ($MAPE < 10) {
                        echo "<div><h3 style='color:white'>Так как $MAPE < 10%, модель имеет высокую точность</h3></div>";
                    }
                    if ($MAPE >= 10 && $MAPE <= 20) {
                        echo "<div><h3 style='color:white'>Так как 10% <= $MAPE <= 20%, модель можно считать хорошей</h3></div>";
                    }
                    if ($MAPE > 20 && $MAPE < 50) {
                        echo "<div><h3 style='color:white'>Так как 20% < $MAPE < 50%, модель можно считать удовлетворительной</h3></div>";
                    }
                    if ($MAPE >= 50) {
                        echo "<div><h3 style='color:white'>Так как $MAPE > 50%, модель можно считать плохой</h3></div>";
                    }
                    $MAPE_pokaz = $MAPE;

                    $i = 0;
                    $sum_mape = 0;
                    while ($i < count($y)) {
                        $sum_mape = $sum_mape + pow(($pokaz_test[$i] - $y[$i]), 2);
                        $i = $i + 1;
                    }
                    $S = round(sqrt(($sum_mape / count($y))), 2);
                    $SSE = round($sum_mape, 2);
                    $MSE =  round($SSE / (count($y) - 2), 2);
                    echo "<div><h3 style='color:white'>S = $S</h3></div>";
                    echo "<div><h3 style='color:white'>SSE = $SSE</h3></div>";
                    echo "<div><h3 style='color:white'>MSE = $MSE</h3></div>";

                    //Параболическая
                    echo "<div><h3 style='color:white'>Параболическая модель</h3></div>";
                    $i = 0;
                    $sum_mape = 0;
                    while ($i < count($y)) {
                        $sum_mape = $sum_mape + abs(($parab_test[$i] - $y[$i]) / $y[$i]);
                        $i = $i + 1;
                    }
                    $MAPE = round(100 * ($sum_mape / count($y)), 2);
                    echo "<div><h3 style='color:white'>MAPE = $MAPE</h3></div>";
                    if ($MAPE < 10) {
                        echo "<div><h3 style='color:white'>Так как $MAPE < 10%, модель имеет высокую точность</h3></div>";
                    }
                    if ($MAPE >= 10 && $MAPE <= 20) {
                        echo "<div><h3 style='color:white'>Так как 10% <= $MAPE <= 20%, модель можно считать хорошей</h3></div>";
                    }
                    if ($MAPE > 20 && $MAPE < 50) {
                        echo "<div><h3 style='color:white'>Так как 20% < $MAPE < 50%, модель можно считать удовлетворительной</h3></div>";
                    }
                    if ($MAPE >= 50) {
                        echo "<div><h3 style='color:white'>Так как $MAPE > 50%, модель можно считать плохой</h3></div>";
                    }
                    $MAPE_parab = $MAPE;

                    $i = 0;
                    $sum_mape = 0;
                    while ($i < count($y)) {
                        $sum_mape = $sum_mape + pow(($parab_test[$i] - $y[$i]), 2);
                        $i = $i + 1;
                    }
                    $S = round(sqrt(($sum_mape / count($y))), 2);
                    $SSE = round($sum_mape, 2);
                    $MSE =  round($SSE / (count($y) - 2), 2);
                    echo "<div><h3 style='color:white'>S = $S</h3></div>";
                    echo "<div><h3 style='color:white'>SSE = $SSE</h3></div>";
                    echo "<div><h3 style='color:white'>MSE = $MSE</h3></div>";
                    echo "<div><h3 style='color:white'>Результат: </h3></div>";
                    if ($MAPE_l < $MAPE_parab) {
                        if ($MAPE_l < $MAPE_pokaz) {
                            echo "<div><h3 style='color:white'>Линейная модель является самой точной</h3></div>";
                        } else {
                            echo "<div><h3 style='color:white'>Показательная модель является самой точной</h3></div>";
                        }
                    } else {
                        if ($MAPE_parab < $MAPE_pokaz) {
                            echo "<div><h3 style='color:white'>Параболическая модель является самой точной</h3></div>";
                        } else {
                            echo "<div><h3 style='color:white'>Показательная модель является самой точной</h3></div>";
                        }
                    }
                }
                ?>
            </div>
        </div>

        <!--Блок footer-->
        <?php include("C:/Ampps/www/my-web_site/app/include/footer.php"); ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>