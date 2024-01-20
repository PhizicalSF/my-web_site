<?php include("path.php");
include "app/database/database.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search-term'])) {
    $db_search = searchTitleAndContent($_POST['search-term'], 'poems', 'users');
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['theme'])) {
    $db_search = searchTheme($_GET['theme'], 'poems', 'users');
  
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button_search'])) {


    $db_search = searchDate($_POST['date_one'],$_POST['date_two'], 'poems', 'users');

  
}
?>

<!doctype html>
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


    <title>Результаты поиска</title>

</head>

<body>

    <!--include-->
    <?php include('app/include/header.php') ?>
    <!--include-->

    <!--Блок main-->
    <div class="container">
        <div class="content row">
            <!--Основной контент-->
            <div class="main-content col-md-9 col-12">
            <form action="search.php" method="POST">
                <div class="poisk">
                    <h2>Расширенный поиск</h2>
                    <div class="data_row">
                        <label for="start">По дате:</label>
                        <input type="date" id="start" name="date_one">
                        <a>-</a>

                        <input type="date" id="start" name="date_two">
                    </div>
                    
                    <div class="button_search">

                        <button name="button_search" type="sybmit" class="btn btn-light">Найти</button>

                    </div>
                </div>
            </form>
                <h2>Результаты поиска.</h2>

                <?php
                foreach ($db_search as $key => $value) :
                ?>

                    <div class="post_row">
                        <?php if (empty($value['img'])) {
                            $value['img'] = "image-placeholder.jpg";
                        } ?>
                        <div class="img col-12 col-md-4">
                            <img src="<?= "assets/images/posts/" . $value['img'] ?>" alt="" class="img-thumbnail">
                        </div>

                        <div class="post_text col-12 col-md-8">
                            <h3>
                                <a href="single.php?poemsid=<?= $value['poemsid'] ?>"><?= $value['name'] ?></a>
                            </h3>

                            <i class="far fa-user"><?= $value['author'] ?></i>
                            <i class="far fa-calendar"><?= $value['date'] ?></i>
                            <p class="preview-text">
                                <?= nl2br($value['text']) ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
            <!--Блок sidebar-->
            <div class="sidebar col-md-3 col-12">
                <div class="section search">
                    <h3>Поиск</h3>
                    <form action="search.php" method="post">
                        <input type="text" name="search-term" class="text-input" placeholder="Введите искомое слово...">
                    </form>
                </div>
                <div class="section theme">

                    <h3>Популярные темы</h3>
                    <ul>
                        <?php foreach ($poem_db_index_theme as $key => $value) : ?>
                            <li><a href="search.php?theme=<?= $value['theme']; ?>"><?= $value['theme']; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <!--Блок sidebar-->
        </div>
    </div>
    <!--Блок main-->
    <!--Блок footer-->
    <?php include('app/include/footer.php') ?>
    <!--Блок footer-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>