<?php

include "C:/Ampps/www/my-web_site/app/controllers/topics.php";
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
                <a href="<?php echo BASE_URL . "admin/topics/created.php"; ?>" class="col-2 btn btn-success">Добавить</a>
                <a href="<?php echo BASE_URL . "admin/topics/index.php"; ?>" class="col-2  btn btn-warning">Управление</a>

            </div>
            <div class="row phone">
                <div class="row title-table">
                    <h2>Добавление отзыва</h2>

                </div>
                <div class="row add-post">
                    <form action="created.php" method="post">
                    <div class="mb-3 col-12 col-md-4 err">
                           <?php include("../../app/helps/errorinfo.php"); ?>
                        </div>
                        <div class="col">
                            <label for="customRange3" class="form-label">ID стиха</label>
                            <input name="id_poem"value= "<?= $id_poem;?>" type="text" class="form-control" placeholder="ID стиха" aria-label="">
                        </div>

                        <label for="customRange3" class="form-label">Оценка стиха</label>
                        <input name="star" type="range" class="form-range" min="1" max="5" step="1" id="customRange3">
                        <div class="col">
                            <label for="content" class="form-label">Текст отзыва</label>
                            <textarea name="reviews" class="form-control" id="content" rows="3"> <?= $reviews;?></textarea>
                        </div>
                        <div class="col">
                            <label for="customRange3" class="form-label">ID автора</label>
                            <input name="id_author" value= "<?= $id_author;?>" type="text" class="form-control" placeholder="ID Автора" aria-label="">
                        </div>


                        <div class="col">
                            <button name="topic-name" class="btn btn-primary" type="submit">Сохранить отзыв</button>
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