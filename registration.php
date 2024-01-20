<?php
include "path.php";
include "C:/Ampps/www/my-web_site/app/controllers/users.php";
?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!--Bootstrap CSS and Font awesome and styling-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/0b0da13991.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bellota+Text:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />


  <title>Регистрация</title>

</head>

<body>
  <?php include('app/include/header.php') ?>
  <!--End Header-->
  <!--Form-->
  <div class="container reg_form">
    <form class="row justify-content-md-left" method="post" action="registration.php">
      <h2>Регистрация</h2>
      <div class="mb-3 col-12 col-md-4 err">
        <?php include("app/helps/errorinfo.php") ?>
      </div>
      <div class="stat">
        <p><?= $regStatus ?></p>
      </div>
      <div class="w-100"></div>
      <div class="mb-3 col-12 col-md-4">
        <label for="formGroupExampleInput" class="form-label">Имя</label>
        <input name="user_name" value="<? $name ?>" type="text" class="form-control" id="formGroupExampleInput" placeholder="Введите имя">
      </div>
      <div class="w-100"></div>
      <div class="mb-3 col-12 col-md-4">
        <label for="formGroupExampleInput" class="form-label">Логин</label>
        <input name="user_login" value="<? $login ?>" type="text" class="form-control" id="formGroupExampleInput" placeholder="Введите логин">
      </div>
      <div class="w-100"></div>
      <div class="mb-3 col-12 col-md-4">
        <label for="exampleInputEmail1" class="form-label">Почта</label>
        <input name="user_mail" value="<? $email ?>" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">Email или gmail</div>
      </div>
      <div class="w-100"></div>
      <div class="mb-3 col-12 col-md-4">
        <label for="exampleInputPassword1" class="form-label">Пароль</label>
        <input name="user_first_password" type="password" class="form-control" id="exampleInputPassword1">
      </div>
      <div class="w-100"></div>
      <div class="mb-3 col-12 col-md-4">
        <label for="exampleInputPassword2" class="form-label">Подтвердите пароль</label>
        <input name="user_second_password" type="password" class="form-control" id="exampleInputPassword2">
      </div>
      <div class="w-100"></div>
      <div class="mb-3 col-12 col-md-4">
        <button type="submit" class="btn btn-secondary" name="button-reg">Зарегистрироваться</button>
        <a href="login.php">Авторизация</a>
      </div>
    </form>
  </div>

  <!--Блок footer-->
  <?php include('app/include/footer.php') ?>
  <!--Блок footer-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>