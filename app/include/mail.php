<?php 
$errMsg = [];
include "C:/Ampps/www/my-web_site/path.php";
include "C:/Ampps/www/my-web_site/app/database/database.php";
require_once('phpmailer/PHPMailerAutoload.php');
$mail = new PHPMailer;
$mail->CharSet = 'utf-8';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mess'])) {
   $us= selectOne('users', ['login' => $_SESSION['login']]);
    $email = $_POST['email'];
    $text1 = $_POST['message'];
    if (mb_strlen($text1)<1 || mb_strlen($email)<2)
    {
        array_push($errMsg, "Не правильно заполнена форма.");
    } else {
    $mail = new PHPMailer;
    $mail->CharSet = 'utf-8';

    //$mail->SMTPDebug = 3; // Enable verbose debug output
    
    $mail->isSMTP(); // Set mailer to use SMTP
    $mail->Host = 'smtp.mail.ru'; // Specify main and backup SMTP servers
    $mail->SMTPAuth = true; // Enable SMTP authentication
    $mail->Username = 'sportatip@mail.ru'; // Ваш логин от почты с которой будут отправляться письма
    $mail->Password = 'mrkZmA0vWSue3C82wc6W'; // Ваш пароль от почты с которой будут отправляться письма
    $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465; // TCP port to connect to / этот порт может отличаться у других провайдеров
    
    $mail->setFrom('sportatip@mail.ru'); // от кого будет уходить письмо?
    $mail->addAddress('sportatip@mail.ru'); // Кому будет уходить письмо
    //$mail->addAddress('ellen@example.com'); // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');
    //$mail->addAttachment('/var/tmp/file.tar.gz'); // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg'); // Optional name
    $mail->isHTML(true); // Set email format to HTML
    
    $mail->Subject =$_POST['email'] .' задал вопрос на сайте Поэтика';
    $text = $text1;
    $mail->Body = $text;
    $mail->AltBody = '';
    $post1 = [
        'userid' => $us['usersid'],
        'text'=> $text
    ];   
    insert_db('feedback', $post1);

    header('location: ' . BASE_URL . '/index.php');
    if(!$mail->send()) {
        array_push($errMsg, "Запрос не отправлен.");
    } else {
        array_push($errMsg, "Запрос отправлен");
          
    }
    }
    }
?>