<?php

include "C:/Ampps/www/my-web_site/app/controllers/spam.php";
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
                <a href="<?php echo BASE_URL . "admin/rass/crearas.php"; ?>" class="col-2 btn btn-success">Добавить</a>
                <a href="<?php echo BASE_URL . "admin/rass/del.php"; ?>" class="col-2 btn btn-success">Удалить</a>
                <a href="<?php echo BASE_URL . "admin/rass/stat.php"; ?>" class="col-2 btn btn-success">Статистика</a>

            </div>
            <div class="row phone">
              
                <div class="row add-post">
                    <form action="index.php" method="post">
                       
                        <div class="row title-table">
                            <h2>Рассылка сообщений</h2>
                        </div>
                    
                        <div class="row add-post">
                            <form action="spam.php" method="post" enctype="multipart/form-data">
                                <div class="col-12">
                                    <label for="name" class="form-label">Название темы</label>
                                    <input type="text" name="title" class="form-control" placeholder="Название темы.." aria-label="First name">
                                </div>
                                <div class="col-12">
                                    <label for="content" class="form-label">Текст письма</label>
                                    <textarea name="content" class="form-control" id="content" rows="6"></textarea>
                                </div>
                                <div class="col-5">
                                    <label for="content" class="form-label">Рассылка</label>
                                    <select name="mailing" class="form-select" aria-label="Default select example">
                                        <?php foreach ($db_rasl as $key => $value) : ?>
                                            <option value="<?= $key ?>"><?= $value['rname'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <button name="spaming" class="btn btn-primary" type="submit">Выполнить рассылку</button>
                                </div>
                            </form>
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