<?php

include "C:/Ampps/www/my-web_site/app/controllers/me_review.php";
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
    <?php include("C:/Ampps/www/my-web_site/app/include/header_user.php"); ?>
    <!--include-->
    <div class="container">
        <?php include("../../app/include/sidebar_user.php"); ?>

        <div class="posts col-10">
            <div class="button row">
                <a href="<?php echo BASE_URL . "user/review/profile.php"; ?>" class="col-2  btn btn-warning">Управление</a>

            </div>
            <div class="row phone">
                <div class="row title-table">
                    <h2>Управление отзывами</h2>
                    <div class="title col-2">Название стиха</div>
                    <div class="text col-3">Текст</div>
                    <div class="star col-1">Оценка</div>
                    <div class="revw col-3">Ваш отзыв</div>
                    <div class="red col-3">Управление</div>

                </div>

                <?php foreach ($topics as $key => $value) : ?>
                <?php $text=selectOne('poems_text',['poemsid'=>$value['poemsid']]);?>
                <?php $text2=selectOne('poems',['poemsid'=>$value['poemsid']]);?>
                    <div class="row post">
                        <div class="title col-2"><?= $text2['name']; ?></div>
                        <div class="text col-3"><?= $text['poem']; ?></div>
                    
                        <div class="star col-1"><?= $value['stars']; ?></div>   
                        <div class="revw col-3"><?= $value['review']; ?></div>          
                        <div class="red col-2"><a href="edit.php?reviewsid=<?= $value['reviewsid'] ?>">Изменить</a></div>
                        <div class="del col-1"><a href="edit.php?del_rew_id=<?= $value['reviewsid'] ?>">Удалить</a></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    </div>





    <?php include("C:/Ampps/www/my-web_site/app/include/footer.php"); ?>
    <!--Блок footer-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>