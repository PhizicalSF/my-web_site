<?php
include "C:/Ampps/www/my-web_site/app/database/database.php";
include "../../path.php";
$errMsg = [];
$id_poem = '';
$star = '';
$reviews = '';
$id_author = '';
$idme = selectOne('users', ['email' => $_SESSION['email']]);
$topics = selectall('reviews', ['usersid' => $idme['usersid']]);
//EDIT

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['reviewsid'])) {
    $reviewsid = $_GET['reviewsid'];
    $topic = selectOne('reviews', ['reviewsid' => $_GET['reviewsid']]);
    $id_poem = $topic['poemsid'];
    $star = $topic['stars'];
    $reviews = $topic['review'];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['review-edit'])) {
    $star = trim($_POST['star']);
    $reviews = trim($_POST['reviews']);
 
    $post = [
        'stars' => $star,
        'review' => $reviews,
    ];
    $id = $_POST['reid'];
    update('reviews', $id, $post);

    array_push($errMsg, "Данные обновлены");

    header('location: ' . BASE_URL . 'user/review/profile.php');
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_rew_id'])) {
    $reviewsid = $_GET['del_rew_id'];
    delete('reviews', $reviewsid);
    header('location: ' . BASE_URL . 'user/review/profile.php');
}
