<?php
include "C:/Ampps/www/my-web_site/app/database/database.php";
include "C:/Ampps/www/my-web_site/path.php";
$errMsg = [];
$id_poem = '';
$star = '';
$reviews = '';
$id_author = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button_reviews'])) {
  

    if(empty($_SESSION)){
        header('location: ' . BASE_URL . 'login.php');
    } else {
        $id_us = selectOne('users', ['email' => $_SESSION['email']]);
        $star = trim($_POST['star']);
        $rev = trim($_POST['rev_text']);
        $id_poem = trim($_POST['poemid']);
            $existence = selectOne('reviews', ['usersid' => $id_us['usersid'], 'poemsid' => $id_poem]);
            if ($existence) {
                if (($existence['usersid'] === $id_us['usersid']) && ($existence['poemsid'] === $id_poem)) {
                    array_push($errMsg, "Вы уже оставляли отзыв на это стихотворение.");

                }
            } else {
                $post = [
                    'usersid' => $id_us['usersid'],
                    'poemsid' => $id_poem,
                    'stars' => $star,
                    'review' => $rev,
                ];
  
                insert_db('reviews', $post);
            }
        
    }
}


