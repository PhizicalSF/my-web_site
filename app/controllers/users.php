<?php
include "C:/Ampps/www/my-web_site/app/database/database.php";




function userAuto($user)
{
    $_SESSION['login'] = $user['login'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['admin_status'] = $user['admin_status'];
    if ($_SESSION['admin_status']) {
        header('location: ' . BASE_URL . 'admin/posts/index.php');
    } else {
        header('location: ' . BASE_URL);
    }
}

$errMsg = [];
$regStatus = '';
//Код для входа
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-reg'])) {
    $admin_status = 0;
    $name = trim($_POST['user_name']);
    $email = trim($_POST['user_mail']);
    $login = trim($_POST['user_login']);
    $passf = trim($_POST['user_first_password']);
    $passs = trim($_POST['user_second_password']);
    //$pass= password_hash($_POST['user_second_password'],PASSWORD_DEFAULT);
    if ($name === '' || $email === '' || $login === '' || $passf === '') {
        array_push($errMsg, "Не все поля заполнены!");
        
    } elseif ((mb_strlen($name, 'UTF8') < 2) || (mb_strlen($login, 'UTF8') < 2)) {
        array_push($errMsg, "Имя и Логин должны быть более 1 символа");
       
    } elseif ($passf !== $passs) {
        array_push($errMsg, "Пароли должны совпадать.");
     
    } else {
        $existence = selectOne('users', ['email' => $email]);
        if ($existence) {
            if ($existence['email'] === $email) {
                array_push($errMsg, "Пользователь с данной почтой уже зарегистрирован.");
          
            }
            if ($existence['login'] === $login) {
                array_push($errMsg, "Пользователь с таким логином уже зарегистрирован.");
              
            }
        } else {

            $pass = password_hash($passf, PASSWORD_DEFAULT);
            $post = [
                'admin_status' => $admin_status,
                'name' => $name,
                'email' => $email,
                'login' => $login,
                'password' => $pass

            ];
            insert_db('users', $post);
            // $user = selectOne('users',['usersid'=>$id]);
            // $user2 = selectOne('login_password',['usersid'=>$id2]);
            userAuto($post);
            // $regStatus = "Пользователь $login успешно зарегистрирован.";
        }
    }
} else {
    $name = '';
    $email = '';
    $login = '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-log'])) {
    $login = trim($_POST['user_login']);
    $pass = trim($_POST['user_password']);
    if ($login === '' || $pass === '') {
        array_push($errMsg, "Не все поля заполнены!");
       
    } else {
        $existence3 = selectOne('users', ['login' => $login]);
        if ($existence3) {

            if (password_verify($pass, $existence3['password'])) {
                userAuto($existence3);
                
            }
            else {
            
                array_push($errMsg, "Неверный логин или пароль.");
            }

        } 
    }
} else {
    $login = '';
}
