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
    <div class="container">
        <?php include("../../app/include/sidebar_admin.php"); ?>

        <div class="posts col-9">
            <div class="button row">
                <a href="<?php echo BASE_URL . "admin/users/created.php"; ?>" class="col-2 btn btn-success">Добавить</a>
                <a href="<?php echo BASE_URL . "admin/users/index.php"; ?>" class="col-2  btn btn-warning">Управление</a>

            </div>
            <div class="row phone">
                <div class="row title-table">
                    <h2>Редактирование пользователя</h2>
                </div>
                <div class="row add-post">
                    <form action="edit.php" method="post">
                        <div class="col">
                        <div class="mb-3 col-12 col-md-4 err">
                           <?php include("../../app/helps/errorinfo.php"); ?>
                        </div>
                            <input name="usid" value="<?= $usersid; ?>" type="hidden">
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput" class="form-label">Имя</label>
                            <input name="user_name" value="<?= $user_name ?>" type="text" class="form-control" id="formGroupExampleInput" placeholder="Введите имя">
                        </div>

                        <div class="col">
                            <label for="formGroupExampleInput" class="form-label">Город</label>
                            <input name="user_city" value="<?= $user_city ?>" type="text" class="form-control" id="formGroupExampleInput" placeholder="Введите город">
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput" class="form-label">Статус</label>
                            <input name="user_status" value="<?= $user_status ?>" type="text" class="form-control" id="formGroupExampleInput" placeholder="Введите статус">
                        </div>

                        <div class="w-100"></div>
                        <div class="col">
                            <label for="exampleInputEmail1" class="form-label">Почта</label>
                            <input name="user_mail" value="<?= $user_mail ?>" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">

                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput" class="form-label">Логин</label>
                            <input name="user_login" value="<?= $user_login ?>" type="text" class="form-control" id="formGroupExampleInput" placeholder="Введите логин">
                        </div>
                        <div class="col">
                            <label for="formGroupExampleInput" class="form-label">Пароль</label>
                            <input name="user_password" value="<?= $user_password ?>" type="text" class="form-control" id="formGroupExampleInput" placeholder="Введите пароль">
                        </div>
                        <div class="w-100"></div>

                        <select name="admin_status" value="<? $admin_status ?>" class="form-select" aria-label="Default select example">

                            <option value="0">User</option>
                            <option value="1">Admin</option>

                        </select>
                        <div class="col">
                            <button name="users-edit" class="btn btn-primary" type="submit">Сохранить</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    </div>





    <?php include("C:/Ampps/www/my-web_site/app/include/footer.php"); ?>
    <!--Блок footer-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>