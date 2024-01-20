<?php
include "C:/Ampps/www/my-web_site/app/controllers/zak.php";
$categor = selectall('category');
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

        <div class="posts col-9">

            <div class="row phone">
                <div class="row title-table">
                    <h2>Заказ</h2>

                </div>
                <div class="row add-post">
                    <form action="profile.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3 col-12 col-md-4 err">
                            <?php include("../../app/helps/errorinfo.php"); ?>
                        </div>

                        <div class="col">
                            <label for="customRange3" class="form-label">Тема</label>
                            <input name="theme" value="" type="text" class="form-control" placeholder="Тема" aria-label="">
                        </div>
                        <div class="col">
                            <label for="content" class="form-label">Комментарии</label>
                            <textarea name="comm" class="form-control" id="content" rows="3"></textarea>
                        </div>

                        <label for="content" class="form-label">Категория</label>
                        <select name="category" class="form-select" aria-label="Default select example">
                            <?php foreach ($categor as $key => $value) : ?>
                                <option value=<?= $value['category_id'] ?>><?= $value['name'] ?>(<?=$value['price']?>)</option>
                            <?php endforeach; ?>

                        </select>


                        <div class="col">
                            <button name="zak2_button" class="btn btn-primary" type="submit">Заказать</button>
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