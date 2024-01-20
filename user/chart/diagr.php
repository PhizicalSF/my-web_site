<?php
include "C:/Ampps/www/my-web_site/app/controllers/zak.php";

$sql = "SELECT poems.theme from poems
GROUP BY theme;
";
global $pdo;
$stmt = $pdo->prepare($sql);
$stmt->execute();
$graf1 = $stmt->fetchAll();

$categor = selectall('poems');





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


    <title>Панель</title>

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
            <h3 style="text-align:center;">Использование Google Charts</h3>
            <div class="ssilki">
                <h3>1. Гистограмма, отражающая отзывы на выбранную тему</h3>
                <div style=" margin: 30px 0;">
                    <form action="chartone.php" method="post">
                        <select name="category" class="form-select" aria-label="Default select example">
                            <option selected>Выберите подкатегорию..</option>
                            <?php foreach ($graf1 as $key => $value) : ?>
                                <option value=<?= $value['theme'] ?>><?= $value['theme'] ?></option>
                            <?php endforeach; ?>


                        </select>
                        <input name="chartone" class="btn btn-primary" type="submit" value="Создать диаграмму">
                    </form>
                </div>
                <div style=" margin: 30px 0;">
                    <h3>2. Круговая диаграмма, отражающая процентное соотношение затрат пользователя на его заказы по категориям товаров.</h3>
                    <a href="charttwo.php">Создать диаграмму</a>
                </div>

            </div>
        </div>

    </div>

    <!--Блок footer-->
    <?php include("C:/Ampps/www/my-web_site/app/include/footer.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>