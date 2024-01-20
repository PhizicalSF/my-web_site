<?php
include "app/controllers/messa.php";
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


    <title>О нас</title>

  </head>
  <body>
<!--include-->
<?php include('app/include/header.php') ?> 
<!--include-->
<!--Блок карусели-->

<div class="container">
    <div class="row">
        <h2>Сайт в трех словах</h2>
    </div>
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
       
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="assets/images/Твори2.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5><a>Твори</a></h5>
             
            </div>
          </div>
          <div class="carousel-item">
            <img src="assets/images/Читай2.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5><a>Люби</a></h5>
            </div>
          </div>
          <div class="carousel-item">
            <img src="assets/images/Мечтай.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5><a>Мечтай</a></h5>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>

<!--Блок карусели-->


<!--Блок main-->
<div class="container">
  <div class="content row">
    <!--Основной контент-->
    <div class="main-content col-md-9 col-12">
        <h2>Немного о нас</h2>
        <div class="fullpost">
        <div class="single_post row">
            <div class="img col-12 col-md-4">
                <img src="assets/images/мотивация1.jpg" alt="" class="img-thumbnail">
            </div>
            <div class="post_text_info col-12 col-md-8">
                <h3>
                    <a>
                        Доброго времени суток дорогие читатели и поэты. 
                        Хочу рассказать немного о том ресурсе, где вы сейчас находитесь. 
                        Раз вы сюда попали, вероятно вы склонный к творчеству человек с горящими глазами и, если это так, чувствуйте себя как дома!
                    </a>
                </h3>
            
            </div>
        </div>
        <div class="single_post row">
            
            <div class="post_text_info col-12 col-md-8">
                <h3>
                    <a>
                        Тут можно побыть наедине со своими мыслями и чувствами… 
                        Но также можно пообщаться с классными и творческими людьми, возможно даже найти себе “братьев по разуму”!
                    </a>
                </h3>
            
            </div>
            <div class="img col-12 col-md-4">
                <img src="assets/images/мотивация2.jpg" alt="" class="img-thumbnail">
            </div>
        </div>
        <div class="single_post row">
            <div class="img col-12 col-md-4">
                <img src="assets/images/мотивация3.jpg" alt="" class="img-thumbnail">
            </div>
            <div class="post_text_info col-12 col-md-8">
                <h3>
                    <a>
                        Мы рады всем желающим проявить себя с творческой стороны. И не забывайте нам писать, общение – истинная добродетель!
                    </a>
                </h3>
            
            </div>
           
        </div>
    </div>
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
<?php include('app/include/footer.php')?>
<!--Блок footer-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>