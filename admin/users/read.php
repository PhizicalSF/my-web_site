<?php

include "C:/Ampps/www/my-web_site/app/controllers/admin_users.php";
?>
<html lang="en">
<!doctype html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--Bootstrap CSS and Font awesome and styling-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/0b0da13991.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href= "../../assets/css/admin.css">
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
    <div class="container">
    <?php include("../../app/include/sidebar_admin.php"); ?>
           
            <div class="posts col-10">
                <div class="button row">
                    <a href="<?php echo BASE_URL . "admin/users/created.php";?>" class="col-2 btn btn-success">Добавить</a>
                    <a href="<?php echo BASE_URL . "admin/users/index.php";?>" class="col-2  btn btn-warning">Управление</a>
                    
                </div>
                <div class="row phone">
                    <div class="row title-table">
                        <h2>Управление</h2>
                        <div class="id col-1">ID</div>
                        <div class="c col-1">Город</div>
                        <div class="s col-5">Статус</div>
                        <div class="l col-2">Логин</div>
                  
                        <div class="red col-3">Управление</div>

                    </div>
                    <?php foreach ($db_users as $key => $value) : ?>
                    <div class="row post">
                        <div class="id col-1"><?= $value['usersid']; ?></div>
                        <div class="c col-1"><?= $value['city']; ?></div>
                        <div class="s col-5"><?= $value['status']; ?></div>
                        <div class="l col-2"><?= $value['login']; ?></div>   
                    
                        <div class="read col-1"><a href="read.php?usersid=<?= $value['usersid'] ?>">Читать</a></div>
                        <div class="red col-1"><a href="edit.php?usersid=<?= $value['usersid'] ?>">Изменить</a></div>
                        <div class="del col-1"><a href="edit.php?del_users_id=<?= $value['usersid'] ?>">Удалить</a></div>
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