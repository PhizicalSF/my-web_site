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

    <title>PDF</title>

</head>

<body>

    <!--include-->
    <?php include("C:/Ampps/www/my-web_site/app/include/header_user.php"); ?>
    <!--include-->
    <div class="container-xxl">

        <?php $sum = 0; ?>
        <?php $topicsAUT = selectone('users', ['email' => $_SESSION['email']]); ?>


        <div class='content row'>
            <?php include("../../app/include/sidebar_user.php"); ?>

            <div class="main-content col-9">
                <?php 
                $id=selectOne('users', ['email'=>$_SESSION['email']]);
                $orders = selectAll('orders', ['user_id' => $id['usersid']]);
                $sum = 0; ?>
                   
                <!---->
                <div class="posts col-10">
                    <div class="row phone">
                        <div class="row title-table">
                            <h2>Отчет по заказам</h2>
                            <div class="id col-1">ID</div>
                            <div class="name col-4">Название</div>
                            <div class="description col-4">Описание</div>
                            <div class="price col-2">Цена</div>

                        </div>

                        <?php foreach ($orders as $key => $value) : ?>
                            <div class="row post">
                                <?php 
                                $price=selectOne('category',['category_id'=>$value['category_id']])
                                ?>
                           
                                <div class="name col-4"><?= $value['theme']; ?></div>
                                <div class="description col-4"><?= $value['comment']; ?></div>
                                <div class="price col-2"><?= $price['price'];
                                                            $sum += $price['price']; ?></div>
                            </div>
                        <?php endforeach; ?>
                   
                            <div class="price col-9">Сумма </div>
                            <div class="price col-2"><?= $sum; ?></div>
                        </div>
                        <form action="pdfone.php" method="post">
                    <button name="pdfone" class="btn btn-primary" type="submit">Скачать PDF</button>
           
            </form>
                    </div>
                   
                </div>
                <!---->
          
        </div>
    </div>
    </div>

    <!--Блок footer-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>