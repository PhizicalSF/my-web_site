<?php
include("path.php");
include "app/database/database.php";
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


    <title>Помощь</title>

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
        <h2>Помощь</h2>
        <div class="fullpost">
        <div class="single_post row">
            
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