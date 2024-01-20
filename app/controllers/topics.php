<?php
include "C:/Ampps/www/my-web_site/app/database/database.php";
include "../../path.php";
$errMsg = [];
$id_poem = '';
$star = '';
$reviews = '';
$id_author = '';
$topics = selectall('reviews');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-name'])) {


    $id_poem = trim($_POST['id_poem']);
    $star = trim($_POST['star']);
    $reviews = trim($_POST['reviews']);
    $id_author = trim($_POST['id_author']);
    $existence1 = selectOne('users', ['usersid' => $id_author]);
    $existence2 = selectOne('poems', ['poemsid' => $id_poem]);
    if ($existence1 && $existence2) {

        if ($id_poem === '' || $star === '' || $reviews === '' ||  $id_author === '') {
            array_push($errMsg, "Не все поля заполнены!");
  
        } else {
            $existence = selectOne('reviews', ['usersid' => $id_author, 'poemsid' => $id_poem]);
            if ($existence) {
                if (($existence['usersid'] === $id_author) && ($existence['poemsid'] === $id_poem)) {
                    array_push($errMsg, "Этот пользователь уже оставлял на это стихотворение отзыв.");
                 
                }
            } else {

                $post = [
                    'usersid' => $id_author,
                    'poemsid' => $id_poem,
                    'stars' => $star,
                    'review' => $reviews,
                ];
                insert_db('reviews', $post);
       
                array_push($errMsg, "Отзыв сохранен.");
            }
        }
    } else {
        if ($existence1) {
        } else {
            array_push($errMsg, "Пользователя с таким ID не существует.");
   
        }
        if ($existence2) {
        } else {
            array_push($errMsg, "Стихотворения с таким ID не существует");
      
        }
    }
} else {
    $id_poem = '';
    $reviews = '';
    $id_author = '';
}

//EDIT

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['reviewsid'])) {
    $reviewsid = $_GET['reviewsid'];
    $topic = selectOne('reviews', ['reviewsid' => $_GET['reviewsid']]);
    $id_poem = $topic['poemsid'];
    $star = $topic['stars'];
    $reviews = $topic['review'];
    $id_author = $topic['usersid'];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-edit'])) {

    $id_poem = trim($_POST['id_poem']);
    $star = trim($_POST['star']);
    $reviews = trim($_POST['reviews']);
    $id_author = trim($_POST['id_author']);
    $existence1 = selectOne('users', ['usersid' => $id_author]);
    $existence2 = selectOne('poems', ['poemsid' => $id_poem]);
    if ($existence1 && $existence2) {

        if ($id_poem === '' || $star === '' || $reviews === '' ||  $id_author === '') {
            array_push($errMsg, "Не все поля заполнены!");
          
        } else {
        
                $post = [
                    'usersid' => $id_author,
                    'poemsid' => $id_poem,
                    'stars' => $star,
                    'review' => $reviews,
                ];
                $id = $_POST['reid'];
                update('reviews', $id, $post);
          
                array_push($errMsg, "Данные обновлены");
           
            header('location: ' . BASE_URL . 'admin/topics/index.php');
        }
    } else {
        if ($existence1) {
        } else {
            array_push($errMsg, "Пользователя с таким ID не существует.");
   
        }
        if ($existence2) {
        } else {
            array_push($errMsg, "Стихотворения с таким ID не существует");
      
        }
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
    $reviewsid = $_GET['del_id'];
    delete('reviews', $reviewsid);
    header('location: ' . BASE_URL . 'admin/topics/index.php');
}
