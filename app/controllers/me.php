<?php
include "C:/Ampps/www/my-web_site/app/database/database.php";
include "../../path.php";
$errMsg = [];
$name = '';
$email = '';
$city = '';
$status = '';

//EDIT
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upd-prof'])) {
    $usersid= trim($_POST['userid']);
    $prof = selectOne('users', ['usersid'=>$usersid]);
  
  
    $user_name = trim($_POST['user_name']); 
    $user_city = trim($_POST['user_city']);
    $user_status = trim($_POST['user_status']);

    if( trim($_POST['user_login'])===$prof['login']){
        $user_login = trim($_POST['user_login']);
        if(trim($_POST['user_mail'])===$prof['email']){
            $user_mail = trim($_POST['user_mail']);

            if ($user_mail === '' || $user_password === '') {
                array_push($errMsg, "Отсутствует пароль или почта.");
              
            } elseif ((mb_strlen($user_name, 'UTF8') < 2) || (mb_strlen($user_login, 'UTF8') < 2)) {
                array_push($errMsg, "Имя и Логин должны быть более 1 символа");
        
            } else {
                $existence = selectOne('users', ['email' => $user_mail]);
             
             
                    $post = [           
                        'name' => $user_name,
                        'email' => $user_mail,
                        'login' => $user_login,
                        'status' => $user_status,
                        'city'=>$user_city
                    ];
                    update('users',$usersid ,$post);
                    header('location: ' . BASE_URL . 'user/me/profile.php');
            } 
        }
        else{ array_push($errMsg, "Данная почта уже занята");}
    }else{
        array_push($errMsg, "Данный логин уже занят");
    }

   
    
    
    }
