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


    <title>Google Charts</title>

</head>

<body>

    <!--include-->
    <?php include("C:/Ampps/www/my-web_site/app/include/header_admin.php"); ?>


    <div class="container-xxl">

        <div class='content row'>
            <?php include("../../app/include/sidebar_admin.php"); ?>
            <div class="main-content col-9">
                <h3 style="text-align:center;">Использование Google Charts</h3>
                <div class="ssilki">
                    <h3>Построение диаграмм специального вида</h3>
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <h1>Задание 1. Диаграмма областей</h1>
                    <h2>Сглаживание временных рядов с помощью скользящих средних. Ряд динамики заказов</h2>
                    <?php
                    $sql = "SELECT YEAR(order_date) AS year, MONTH(order_date) AS month, SUM(price) AS summ
 FROM orders
 JOIN category ON orders.category_id = category.category_id
 GROUP BY YEAR(order_date), MONTH(order_date)
 ORDER BY year, month;
 ";

                    global $pdo;
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    $graf1 = $stmt->fetchAll();

                    $arr1 = array();
                    foreach ($graf1 as $key => $value) {
                        $str = $value['summ'];
                        array_push($arr1, $str);
                    }

                    $arr2 = array();
                    $str1 = '[' . (1) . ',' . $arr1[0] . ',';
                    $str1 .= round((5 * $arr1[0] + 2 * $arr1[1] - $arr1[2]) / 6, 2) . ',';
                    $str1 .= round((39 * $arr1[0] + 8 * $arr1[1] - 4 * $arr1[2] - 4 * $arr1[3] + 1 * $arr1[4] + 4 * $arr1[5] - 2 * $arr1[6]) / 42, 2) . ',';
                    $str1 .= round((31 * $arr1[0] + 9 * $arr1[1] - 3 * $arr1[2] - 5 * $arr1[3] + 3 * $arr1[4]) / 35, 2) . '],';
                    //echo count($arr1);
                    array_push($arr2, $str1);
                    for ($j = 1; $j < count($arr1); $j++) {
                        $str1 = '[' . ($j + 1) . ',' . $arr1[$j] . ',';
                        if (($j > 0) and ($j < count($arr1) - 1)) {
                            $str1 .= round(($arr1[$j - 1] + $arr1[$j] + $arr1[$j + 1]) / 3, 2) . ',';
                        } else if ($j == count($arr1) - 1) {
                            $str1 .= round((-$arr1[$j - 2] + 2 * $arr1[$j - 1] + 5 * $arr1[$j]) / 6, 2) . ',';
                        } else {
                            $str1 .= 'undefined,';
                        }
                        if (($j > 2) and ($j < count($arr1) - 3)) {
                            $str1 .= round(($arr1[$j - 3] + $arr1[$j - 2] + $arr1[$j - 1] + $arr1[$j] + $arr1[$j + 1] + $arr1[$j + 2] + $arr1[$j + 3]) / 7, 2) . ',';
                        } else if ($j == count($arr1) - 3) {
                            $str1 .=            round((1 * $arr1[$j - 4] - 4 * $arr1[$j - 3] + 2 * $arr1[$j - 2] + 12 * $arr1[$j - 1] + 19 * $arr1[$j] + 16 * $arr1[$j + 1] - 4 * $arr1[$j + 2]) / 42, 2) . ',';
                        } else if ($j == count($arr1) - 2) {
                            $str1 .=            round((4 * $arr1[$j - 5] - 7 * $arr1[$j - 4] - 4 * $arr1[$j - 3] + 6 * $arr1[$j - 2] + 16 * $arr1[$j - 1] + 19 * $arr1[$j] + 9 * $arr1[$j + 1]) / 42, 2) . ',';
                        } else if ($j == count($arr1) - 1) {
                            $str1 .=            round((2 * $arr1[$j - 6] + 4 * $arr1[$j - 5] + 1 * $arr1[$j - 4] - 4 * $arr1[$j - 3] - 4 * $arr1[$j - 2] + 4 * $arr1[$j - 1] + 39 * $arr1[$j]) / 42, 2) . ',';
                        } else if ($j == 1) {
                            $str1 .=            round((8 * $arr1[0] + 19 * $arr1[1] + 16 * $arr1[2] + 6 * $arr1[3] - 4 * $arr1[4] - 7 * $arr1[5] + 4 * $arr1[6])  / 42, 2) . ',';
                        } else if ($j == 2) {
                            $str1 .=            round((-4 * $arr1[0] + 16 * $arr1[1] + 19 * $arr1[2] + 12 * $arr1[3] + 2 * $arr1[4] - 4 * $arr1[5] + 1 * $arr1[6]) / 42, 2) . ',';
                        } else {
                            $str1 .= 'undefined,';
                        }
                        if (($j > 1) and ($j < count($arr1) - 2)) {
                            $str1 .=            round((-3 * $arr1[$j - 2] + 12 * $arr1[$j - 1] + 17 * $arr1[$j] + 12 * $arr1[$j + 1] - 3 * $arr1[$j + 2]) / 35, 2) . '],';
                        } else if ($j == count($arr1) - 2) {
                            $str1 .=            round((-5 * $arr1[$j - 3] + 6 * $arr1[$j - 2] + 12 * $arr1[$j - 1] + 13 * $arr1[$j - 1] - 9 * $arr1[$j + 1]) / 35, 2) . '],';
                        } else if ($j == count($arr1) - 1) {
                            $str1 .=            round((3 * $arr1[$j - 4] - 5 * $arr1[$j - 3] - 3 * $arr1[$j - 2] + 9 * $arr1[$j - 1] + 31 * $arr1[$j]) / 35, 2) . '],';
                        } elseif ($j ==  1) {
                            $str1 .=              round((9 * $arr1[0] + 13 * $arr1[1] + 12 * $arr1[2] + 6 * $arr1[3] - 5 * $arr1[4]) / 35, 2) . '],';
                        } else {
                            $str1 .= 'undefined],';
                        }
                        array_push($arr2, $str1);
                    }
                    //tt(count($arr1));

                    array_push($arr2, $str1);
                    $str1 = implode("", $arr2);

                    ?>
                    <script type="text/javascript">
                        google.charts.load('current', {
                            'packages': ['corechart']
                        });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Год', 'Фактические значения', 'l3', 'l7', 'l5'],
                                <?php echo $str1 ?>
                            ]);
                            var options = {
                                title: 'Востановление краевых значений и прогноз',
                                curveType: 'function',
                                legend: {
                                    position: 'bottom'
                                },
                            };
                            var chart = new google.visualization.AreaChart(document.getElementById('curve_chart1'));
                            chart.draw(data, options);
                        }
                    </script>
                    <div id="curve_chart1" style="width: 900px; height: 500px"></div>

                    <h1>Задание 2. Пузырьковая диаграмма</h1>
                    <h2>Соотношение средней оценки и количества отзывов на заказ</h2>
                    (ось X – Количество отзвов, ось Y – Оценка, цвет – Тема, размер пузырька – средняя оценка)
                    <?php
                    $sql = "Select poems.name name, count(reviews.reviewsid) kolvo, poems.theme th, avg(reviews.stars) sred, avg(reviews.stars) us from poems,reviews WHERE poems.poemsid = reviews.poemsid GROUP BY poems.poemsid      ";

                    global $pdo;
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    $graf1 = $stmt->fetchAll();

                    $arr1 = array();
                    foreach ($graf1 as $key => $value) {
                        $str = "['$value[name]',$value[kolvo],$value[sred],'$value[th]',$value[us]],";
                        array_push($arr1, $str);
                    }
                    $str1 = implode("", $arr1);

                    ?>
                    <script type="text/javascript">
                        google.charts.load('current', {
                            'packages': ['corechart']
                        });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {

                            var data = google.visualization.arrayToDataTable([
                                ['Название', 'Кол-во Отзывов', 'Средняя оценка', 'Тема', 'Оценка'],
                                <?php echo $str1 ?>

                            ]);

                            var options = {
                                title: 'Рейтинг заказов по типам',
                                curveType: 'function',
                                vAxis: {
                                    format: '0'
                                },
                                hAxis: {
                                    format: '0'
                                },
                                legend: {
                                    position: 'bottom'
                                },
                                bubble: {
                                    textStyle: {
                                        fontSize: 5
                                    }
                                }
                            };

                            var chart = new google.visualization.BubbleChart(document.getElementById('curve_chart2'));
                            chart.draw(data, options);
                        }
                    </script>
                    <div id="curve_chart2" style="width:1100px; height: 700px"></div>

                    <h1>Задание 3. Календарь</h1>
                    <h2>Количество завершенных заказов</h2>
                    <?php

                    $sql = "SELECT  CONCAT('new Date(',year(order_date), ',',month(order_date),',',day(order_date),')' ) dat, COUNT(*) as total_orders
                    FROM orders
                    GROUP BY order_date;";
                    global $pdo;
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    $graf1 = $stmt->fetchAll();

                    $arr1 = array();
                    foreach ($graf1 as $key => $value) {
                        $str = "[$value[dat],$value[total_orders]],";
                        array_push($arr1, $str);
                    }
                    $str1 = implode("", $arr1);
                    ?>
                    <script type="text/javascript">
                        google.charts.load('current', {
                            'packages': ['calendar']
                        });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ['Дата', 'Количество заказов'],
                                <?php echo $str1 ?>
                            ]);
                            var options = {
                                title: 'Статистика заказов',
                                noDataPattern: {
                                    backgroundColor: '#76a7fa',
                                    color: '#a0c3ff'
                                },
                                legend: {
                                    position: 'bottom'
                                },
                            };
                            var chart = new google.visualization.Calendar(document.getElementById('curve_chart3'));
                            chart.draw(data, options);
                        }
                    </script>
                    <div id="curve_chart3" style="width: 1400px; height: 400px"></div>
                    <h1>Задание 4. Организационная диаграмма</h1>
                    <h2>Соотношение категорий и подкатегорий услуг</h2>
                    <?php

                    $sql0 = "select category.category_id catid, category.name ne from category";
                    global $pdo;
                    $stmt = $pdo->prepare($sql0);
                    $stmt->execute();
                    $graf1 = $stmt->fetchAll();

                    $i = 0;
                    foreach ($graf1 as $key => $value) {

                        $arr1 = array();
                        $sql = "select subcategory.name sname, category.name cname from subcategory,category where subcategory.category_id = category.category_id and category.category_id=$value[catid]";
                        global $pdo;
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        $graf2 = $stmt->fetchAll();

                        $str = "['$value[ne]','',''],";
                        array_push($arr1, $str);
                        foreach ($graf2 as $key => $value) {
                            $str = "['$value[sname]','$value[cname]',''],";
                            array_push($arr1, $str);
                        }

                        $str1 = implode("", $arr1);

                    ?>
                        <script type="text/javascript">
                            google.charts.load('current', {
                                'packages': ['orgchart']
                            });
                            google.charts.setOnLoadCallback(drawChart);

                            function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                    ['Категория', 'Подкатегория', ''],
                                    <?php echo $str1 ?>
                                ]);
                                var options = {
                                    title: 'Соотношение категорий и подкатегорий аккаунтов',
                                    noDataPattern: {
                                        backgroundColor: '#76a7fa',
                                        color: '#a0c3ff'
                                    },
                                    legend: {
                                        position: 'bottom'
                                    },
                                    compactRows: true,
                                    size: 'small',
                                };
                                var chart = new google.visualization.OrgChart(document.getElementById('curve_chart4<?php echo $i; ?>'));
                                data.setRowProperty(0, 'style', 'border: 3px solid green');
                                data.setRowProperty(0, 'selectedStyle', 'background-color:#0000FF');
                                chart.draw(data, options);
                            }
                        </script>

                        <div id="curve_chart4<?php echo $i; ?>" style="width: 100%; height: 100px"></div>
                    <?php
                        $i++;
                    }
                    ?>
                    <h1>Задание 5. Карты</h1>
                    <h2>Карта пользователей</h2>
                    <script src="https://api-maps.yandex.ru/2.1/?apikey=ваш_api_key&lang=ru_RU" type="text/javascript"></script>
                    <div id="map" style="width: 600px; height: 400px"></div>
                    <script type="text/javascript">
                        ymaps.ready(init);

                        function init() {
                            var myMap = new ymaps.Map("map", {
                                center: [55.76, 37.64], // координаты центра карты
                                zoom: 4 // масштаб карты
                            });
                            var cities = [{
                                    name: "Москва",
                                    coords: [55.755814, 37.617635]
                                },
                                {
                                    name: "Санкт-Петербург",
                                    coords: [59.939095, 30.315868]
                                },
                                {
                                    name: "Новосибирск",
                                    coords: [55.008352, 82.935732]
                                },
                                {
                                    name: "Екатеринбург",
                                    coords: [56.838011, 60.597465]
                                },
                                {
                                    name: "Нижний Новгород",
                                    coords: [56.324209, 44.005395]
                                },
                                {
                                    name: "Казань",
                                    coords: [55.796127, 49.106405]
                                },
                                {
                                    name: "Самара",
                                    coords: [53.195873, 50.100193]
                                },
                                {
                                    name: "Омск",
                                    coords: [54.984813, 73.367463]
                                },
                                {
                                    name: "Челябинск",
                                    coords: [55.160825, 61.402829]
                                },
                                {
                                    name: "Ростов-на-Дону",
                                    coords: [47.235713, 39.701505]
                                },
                                {
                                    name: "Уфа",
                                    coords: [54.738762, 55.972055]
                                },
                                {
                                    name: "Волгоград",
                                    coords: [48.707103, 44.516939]
                                },
                                {
                                    name: "Красноярск",
                                    coords: [56.010563, 92.852572]
                                },
                                {
                                    name: "Пермь",
                                    coords: [58.010321, 56.234226]
                                },
                                {
                                    name: "Воронеж",
                                    coords: [51.660781, 39.200269]
                                },
                                {
                                    name: "Саратов",
                                    coords: [51.531427, 46.034262]
                                },
                                {
                                    name: "Краснодар",
                                    coords: [45.035470, 38.975313]
                                },
                                {
                                    name: "Тольятти",
                                    coords: [53.520447, 49.389204]
                                },
                                {
                                    name: "Барнаул",
                                    coords: [53.347350, 83.779900]
                                },
                                {
                                    name: "Ижевск",
                                    coords: [56.851891, 53.204488]
                                },
                                {
                                    name: "Ульяновск",
                                    coords: [54.308067, 48.374796]
                                },
                                {
                                    name: "Томск",
                                    coords: [56.484684, 84.948177]
                                },
                                {
                                    name: "Кемерово",
                                    coords: [55.391898, 86.046508]
                                },
                                {
                                    name: "Магнитогорск",
                                    coords: [53.407562, 58.980499]
                                },
                                {
                                    name: "Киров",
                                    coords: [58.603592, 49.666798]
                                },
                                {
                                    name: "Набережные Челны",
                                    coords: [55.743501, 52.406384]
                                }
                            ];
                            for (var i = 0; i < cities.length; i++) {
                                var city = cities[i];
                                var name = city.name;
                                var coords = city.coords;
                                var placemark = new ymaps.Placemark(coords, {
                                    hintContent: name,
                                    balloonContent: name
                                });
                                myMap.geoObjects.add(placemark);
                            }
                        }
                    </script>

                    <h1>Задание 6. Диаграмма Санки</h1>
                    <h3>Сумма выполненных заказов пользователей по категориям</h3>

                    <script type="text/javascript">
                        google.charts.load('current', {
                            'packages': ['sankey']
                        });
                        google.charts.setOnLoadCallback(drawChart5);

                        function drawChart5() {
                            var data = new google.visualization.DataTable();

                            data.addColumn('string', 'From');
                            data.addColumn('string', 'To');
                            data.addColumn('number', 'Количество');
                            data.addRows([
                                <?php


                                $sql0 = "SELECT users.name uname,category.name cname, SUM(price) AS summ
FROM orders
JOIN category ON orders.category_id = category.category_id
JOIN users on orders.user_id = users.usersid
GROUP BY users.name, category.category_id
";
                                global $pdo;
                                $stmt = $pdo->prepare($sql0);
                                $stmt->execute();
                                $graf1 = $stmt->fetchAll();


                                foreach ($graf1 as $key => $value) {
                                    echo "['$value[uname]', '$value[cname]', $value[summ]],";
                                }
                                ?>


                            ]);

                            // Sets chart options.
                            var options = {
                                width: 600,
                            };

                            // Instantiates and draws our chart, passing in some options.
                            var chart = new google.visualization.Sankey(document.getElementById('sankey_basic'));
                            chart.draw(data, options);
                        }
                    </script>
                    <div id="sankey_basic" style="width: 900px; height: 300px;"></div>

                    <h1>Задание 7. Хронология</h1>
                    <h2>Хронология рассылок</h2>
                    <?php
                    $firstDate = null;
                    $lastDate = null;

                    $sql = "SELECT  CONCAT('new Date(',year(mailing_history.rasl_date), ',',month(mailing_history.rasl_date),',',day(mailing_history.rasl_date),')' ) dat, rassl.rname rn
                      FROM mailing_history, rassl where mailing_history.mailid = rassl.raslid order by mailing_history.rasl_date";
                    global $pdo;
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                    $graf1 = $stmt->fetchAll();

                    $arr1 = array();
                    $previousRname = null;
                    $firstDate = null;

                    $datesByRname = array();

                    foreach ($graf1 as $key => $value) {
                        $rname = $value['rn'];
                        $date = $value['dat'];

                        if (!isset($datesByRname[$rname])) {
                            // Если значение rname встречается впервые, сохраняем первую дату
                            $datesByRname[$rname] = array(
                                'firstDate' => $date,
                                'dates' => array($date)
                            );
                        } else {
                            // Если значение rname уже было встречено ранее, добавляем текущую дату
                            $datesByRname[$rname]['dates'][] = $date;
                        }
                    }
                    $arr1 = array();

                    foreach ($datesByRname as $rname => $dates) {
                        $firstDate = $dates['firstDate'];
                        $datesStr = implode(',', $dates['dates']);

                        $str = "['$rname', new Date($firstDate), " . "new Date(" . end($dates['dates']) . ")],";
                        array_push($arr1, $str);
                    }

                    $str1 = implode('', $arr1);

                
                    ?>

                    <script type="text/javascript">
                        google.charts.load('current', {
                            'packages': ['timeline']
                        });
                        google.charts.setOnLoadCallback(drawChart);

                        function drawChart() {
                            var container = document.getElementById('timeline');
                            var chart = new google.visualization.Timeline(container);
                            var dataTable = new google.visualization.DataTable();

                            dataTable.addColumn({
                                type: 'string',
                                id: 'President'
                            });
                            dataTable.addColumn({
                                type: 'date',
                                id: 'Start'
                            });
                            dataTable.addColumn({
                                type: 'date',
                                id: 'End'
                            });
                            dataTable.addRows([
                                <?php echo $str1; ?>
                            ]);

                            chart.draw(dataTable);
                        }
                    </script>

                    <div id="timeline" style="height: 180px;"></div>
                </div>
            </div>
        </div>
    </div>

    <!--Блок footer-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>