<?php

include "../../app/controllers/profile.php";
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


    <title>Панель администратора</title>

</head>

<body>

    <!--include-->
    <?php include("C:/Ampps/www/my-web_site/app/include/header_admin.php"); ?>
    <!--include-->
    <div class="container-xxl">

        <?php $sum = 0; ?>
        <?php $topicsAUT = selectone('users', ['email' => $_SESSION['email']]); ?>


        <div class='content row'>
        <?php include("../../app/include/sidebar_admin.php"); ?>
            <div class="main-content col-9">
                <?php
                $sql = "select *,MONTH(order_date) from orders ";
         
                $sdate = $_POST['sdate'];
                $edate = $_POST['edate'];
                if ($sdate && $edate) {
                    $sql .= " Where order_date > '" . $sdate . "' and order_date < '" . $edate . "'";
              
                }
                if ($sdate && !$edate) {
                    $sql .= " Where order_date > '" . $sdate . "'";
      
                }
                if (!$sdate && $edate) {
                    $sql .= " Where order_date < '" . $edate . "'";
        
                }
           
                global $pdo;
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $orders = $stmt->fetchAll();

           

                $sum1 = 0;
                $sum2 = 0;
                $sum3 = 0;
                $sum4 = 0;
                $sum5 = 0;
                $sum6 = 0;
                $sum7 = 0;
                $sum8 = 0;
                $sum9 = 0;
                $sum10 = 0;
                $sum11 = 0;
                $sum12 = 0;
            
                foreach ($orders as $key => $value) {
                    $price=selectOne('category',['category_id'=>$value['category_id']]);
                    if ($value['MONTH(order_date)'] == 1) {
                        $sum1 += $price['price'];
                    }
                    if ($value['MONTH(order_date)'] == 2) {
                        $sum2 += $price['price'];
                    }
                    if ($value['MONTH(order_date)'] == 3) {
                        $sum3 += $price['price'];
                    }
                    if ($value['MONTH(order_date)'] == 4) {
                        $sum4 += $price['price'];
                    }
                    if ($value['MONTH(order_date)'] == 5) {
                        $sum5 += $price['price'];
                    }
                    if ($value['MONTH(order_date)'] == 6) {
                        $sum6 += $price['price'];
                    }
                    if ($value['MONTH(order_date)'] == 7) {
                        $sum7 += $price['price'];
                    }
                    if ($value['MONTH(order_date)'] == 8) {
                        $sum8 += $price['price'];
                    }
                    if ($value['MONTH(order_date)'] == 9) {
                        $sum9 += $price['price'];
                    }
                    if ($value['MONTH(order_date)'] == 10) {
                        $sum10 += $price['price'];
                    }
                    if ($value['MONTH(order_date)'] == 11) {
                        $sum11 += $price['price'];
                    }
                    if ($value['MONTH(order_date)'] == 12) {
                        $sum12 += $price['price'];
                    }
                }
              
                ?>
                <div class="main-contentpdf">
                    <div class="row title-table">
                        <div class="id col-6">Месяц</div>
                        <div class="name col-6">Выручка</div>
                    </div>
                    <div class="row add-post">
                        <?php
                        if ($sum1 != 0) {
                            echo '<div class="id col-6">Январь</div>';
                            echo '<div class="name col-6">' . $sum1 . '</div>';
                        }
                        if ($sum2 != 0) {
                            echo '<div class="id col-6">Февраль</div>';
                            echo '<div class="name col-6">' . $sum2 . '</div>';
                        }
                        if ($sum3 != 0) {
                            echo '<div class="id col-6">Март</div>';
                            echo '<div class="name col-6">' . $sum3 . '</div>';
                        }
                        if ($sum4 != 0) {
                            echo '<div class="id col-6">Апрель</div>';
                            echo '<div class="name col-6">' . $sum4 . '</div>';
                        }
                        if ($sum5 != 0) {
                            echo '<div class="id col-6">Май</div>';
                            echo '<div class="name col-6">' . $sum5 . '</div>';
                        }
                        if ($sum6 != 0) {
                            echo '<div class="id col-6">Июнь</div>';
                            echo '<div class="name col-6">' . $sum6 . '</div>';
                        }
                        if ($sum7 != 0) {
                            echo '<div class="id col-6">Июль</div>';
                            echo '<div class="name col-6">' . $sum7 . '</div>';
                        }
                        if ($sum8 != 0) {
                            echo '<div class="id col-6">Август</div>';
                            echo '<div class="name col-6">' . $sum8 . '</div>';
                        }
                        if ($sum9 != 0) {
                            echo '<div class="id col-6">Сентябрь</div>';
                            echo '<div class="name col-6">' . $sum9 . '</div>';
                        }
                        if ($sum10 != 0) {
                            echo '<div class="id col-6">Октябрь</div>';
                            echo '<div class="name col-6">' . $sum10 . '</div>';
                        }
                        if ($sum11 != 0) {
                            echo '<div class="id col-6">Ноябрь</div>';
                            echo '<div class="name col-6">' . $sum11 . '</div>';
                        }
                        if ($sum12 != 0) {
                            echo '<div class="id col-6">Декабрь</div>';
                            echo '<div class="name col-6">' . $sum12 . '</div>';
                        }
                        ?>
                        <div class="id col-6">Суммарная выручка</div>
                        <div class="name col-6"><?= $sum1+$sum2+$sum3+$sum4+$sum5+$sum6+$sum7+$sum8+$sum9+$sum10+$sum11+$sum12 ?></div>
                    </div>
                </div>
                <form action="pdftree.php" method="post">
                    <input type="hidden" name="sdate" value="<?= $_POST['sdate'] ?>">
                    <input type="hidden" name="edate" value="<?= $_POST['edate'] ?>">
                    <button name="pdftree1" class="btn btn-primary" type="submit">Скачать PDF</button>
            </div>
            </form>
        </div>
    </div>
    </div>

    <!--Блок footer-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>