<?php
header('Content-Type: text/html; charset=utf-8');
include "manag.php";
?>
<!DOCTYPE html>

<html lang="ru">

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


    <title>Чат</title>

</head>


<body>
    
    <?php include("C:/Ampps/www/my-web_site/app/include/header.php"); ?>
    <!-- Блок MAIN -->
    <div class="container">
        <div class="chat_title">
            <h2>Групповой чат</h2>
        </div>
        <div class="chat">
            <?php echo
            getMessages();
            ?>
        </div>
        <div class="new_message col-md-12">
            <?php if (isset($_SESSION['login'])) : ?>
                <h2>Оставить новое сообщение</h2>
                <p><?= $errMsg  ?></p>
                <form method="POST" action="group.php">
                    <textarea name="text" rows="4"></textarea>
                    <input type="hidden" name="parent_id" value="null">
                    <div class="w-100"></div>
                    <button btn-success type="submit" name="mess" class="btn btn-success" style="margin: 5px 0 20px 0;">Отправить</button>
                </form>
            <?php endif; ?>
        </div>
        
    </div>






    <!--Блок footer-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>