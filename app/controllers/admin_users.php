<?php
include "C:/Ampps/www/my-web_site/app/database/database.php";
include "../../path.php";
$errMsg = [];
$name = '';
$login = '';
$email = '';
$password = '';
$admin_status = '';
$db_users = selectall('users');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['users_button'])) {

    $user_name = trim($_POST['user_name']);
    $user_login = trim($_POST['user_login']);
    $user_mail = trim($_POST['user_mail']);
    $user_password = trim($_POST['user_password']);
    $admin_status = trim($_POST['admin_status']);
  
     if ($user_mail === '' || $user_password === '') {
        array_push($errMsg, "Отсутствует пароль или почта.");
       
    } elseif ((mb_strlen($user_name, 'UTF8') < 2) || (mb_strlen($user_login, 'UTF8') < 2)) {
        array_push($errMsg, "Имя и Логин должны быть более 1 символа");
      
    } else {
        $existence = selectOne('users', ['email' => $user_mail]);
        if ($existence) {
            if ($existence['email'] === $user_mail) {
                array_push($errMsg, "Пользователь с данной почтой уже зарегистрирован.");
          
            }
            if ($existence['login'] === $user_login) {
                array_push($errMsg, "Пользователь с таким логином уже зарегистрирован.");
      
            }
        } else {

            $pass = password_hash($user_password, PASSWORD_DEFAULT);
            $post = [
                'admin_status' => $admin_status,
                'name' => $user_name,
                'email' => $user_mail,
                'login' => $user_login,
                'password' => $pass

            ];
            insert_db('users', $post);
           
        }
    }
} else {
    $user_name = '';
    $user_mail = '';
    $user_login = '';
}

//EDIT

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['usersid'])) {
    $usersid = $_GET['usersid'];
    $topic = selectOne('users', ['usersid' => $_GET['usersid']]);

    $user_name = $topic['name'];
    $user_mail = $topic['email'];
    $user_city = $topic['city'];
    $user_status = $topic['status'];
    $user_login = $topic['login'];
    $user_password = $topic['password'];
    $admin_status = $topic['admin_status'];
   
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['users-edit'])) {


    $usersid = trim($_POST['usid']);
    $user_name = trim($_POST['user_name']);
    $user_login = trim($_POST['user_login']);
    $user_mail = trim($_POST['user_mail']);
    $user_password = trim($_POST['user_password']);
    $admin_status = trim($_POST['admin_status']);
    $user_city = trim($_POST['user_city']);
    $user_status = trim($_POST['user_status']);

   if ((mb_strlen($user_name, 'UTF8') < 2) || (mb_strlen($user_login, 'UTF8') < 2)) {
        array_push($errMsg, "Имя и Логин должны быть более 1 символа");

    } else {
        $existence = selectOne('users', ['email' => $user_mail]);
     
            $pass = password_hash($user_password, PASSWORD_DEFAULT);
            $post = [
                'admin_status' => $admin_status,
                'name' => $user_name,
                'email' => $user_mail,
                'login' => $user_login,
                'password' => $pass,
                'city'=>$user_city,
                'status'=> $user_status

            ];
            update('users',$usersid ,$post);
            header('location: ' . BASE_URL . 'admin/users/index.php');
    }   
} 

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_users_id'])) {
    $id = $_GET['del_users_id'];
    delete('users', $id);
    header('location: ' . BASE_URL . 'admin/users/index.php');
}
