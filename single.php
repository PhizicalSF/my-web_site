<?php
include "app/controllers/reviews.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $one_post = selectSinglePost(['poemsid' => $_GET['poemsid']]);
} else {
    $one_post = selectSinglePost(['poemsid' => $_POST['poemid']]);
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


    <title><?= $one_post['name'] ?></title>

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
                <h2><?= $one_post['name'] ?> </h2>
                <?php if (empty($one_post['img'])) {
                    $value['img'] = "image-placeholder.jpg";
                } ?>

                <div class="post_row">
                    <?php if (empty($one_post['img'])) {
                        $one_post['img'] = "image-placeholder.jpg";
                    } ?>

                    <div class="img col-12 col-md-4">
                        <img src="<?= "assets/images/posts/" . $one_post['img'] ?>" alt="" class="img-thumbnail">
                    </div>
                    <div class="post_text col-12 col-md-8">
                        <h3>
                            <a href="single.php?poemsid=<?= $one_post['poemsid'] ?>"><?= $one_post['name'] ?></a>
                            <?php $st = selectSinglePostStar($one_post['poemsid']); ?>

                            <i class="fa fa-star-o"><?= $st['avg(stars)'] ?></i>
                        </h3>

                        <i class="far fa-user"><?= $one_post['author'] ?></i>
                        <i class="far fa-calendar"><?= $one_post['date'] ?></i>
                        <p class="preview-text-single">
                            <?= nl2br($one_post['text']) ?>
                        </p>

                    </div>
                </div>
                <h2>Отзывы:</h2>
                <div class="mb-3 col-12 err">
                   
                    <?php include("app/helps/errorinfo.php"); ?>
                 
                   
                </div>
                <?php $db_reviws = selectall('reviews', ['poemsid' => $one_post['poemsid']]); ?>


                <?php foreach ($db_reviws as $key => $value) : ?>
                    <?php $db_reviws_user = selectOne('users', ['usersid' => $value['usersid']]); ?>
                    <div class="reviews_row">

                        <div class="post_text col-12 col-md-8">
                            <h3>
                                <a href=""><?= $db_reviws_user['name'] ?></a>
                            </h3>

                            <i class="fa fa-star-o"><?= $value['stars'] ?></i>
                            <i class="far fa-calendar"><?= $value['date_review'] ?></i>
                            <p class="preview-text-single">
                                <?= nl2br($value['review']) ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>

                <form action="single.php" method="POST">
                    <div class="form-floating">
                        <textarea name="rev_text" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                        <label for="floatingTextarea2">Ваш отзыв</label>
                    </div>

                    <div class="star_rev">
                        <label for="customRange3" class="form-label">Оценка</label>
                        <input name="star" type="range" class="form-range" min="1" max="5" step="1" id="customRange3">
                    </div>
                    <input name="poemid" value="<?= $one_post['poemsid']; ?>" type="hidden">
                    <div class="reviews_button">

                        <button name="button_reviews" type="sybmit" class="btn btn-light">Оставить отзыв</button>

                    </div>

                </form>
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