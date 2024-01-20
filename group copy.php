<?php
header('Content-Type: text/html; charset=utf-8');
include "manag.php";
?>
<!DOCTYPE html>

<html lang="ru">

<head>
    <title>Чат</title>
</head>


<body>


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

</body>

</html>