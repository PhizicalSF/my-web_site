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
                



                <h2>Прайс лист на выбранную категорию </h2>
                
                <div class="posts col-10">
                    <div class="row phone">

                        <div class="name col-3">Название</div>
             
                        <div class="vendor col-2">Цена</div>


                        <?php 
                        $list=selectall('category',['category_id'=>$_POST['category']]);
                         ?>

                              
                            <?php foreach ($list as $key => $value) : ?>
                                <div class="row post">
                                <div class="name col-3"> <?=$value['name']?></div>
                
                                <div class="price col-2"><?=$value['price']?></div>
                            </div>      
                        <?php endforeach; ?>
                      
                        <form action="pdftwo.php" method="post">
                            <input type="hidden" name="category" value="<?= $_POST['category'] ?>">
                            <button name="pdftwo1" class="btn btn-primary" type="submit">Скачать PDF</button>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!--Блок footer-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>