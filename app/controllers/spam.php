<?php
include "../../path.php";
include "C:/Ampps/www/my-web_site/app/database/database.php";
require_once('phpmailer/PHPMailerAutoload.php');

$errMsg = '';

$db_rasl = selectall('rassl');


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['spaming'])) {

    $title = $_POST['title'];
    $content = $_POST['content'];
    $mailing = $_POST['mailing'] + 1;




    if ($title === '' || $content === '' || $mailing === '') {
        $errMsg = "Не все поля заполнены!";
    } elseif (mb_strlen($title, 'UTF8') < 2) {
        $errMsg = "В названии должно быть более 2-х символов";
    } elseif (mb_strlen($content, 'UTF8') < 2) {
        $errMsg = "В тексте сообзения должно быть более 2-х символов";
    } elseif (!isset($mailing)) {
        $errMsg = "Выберите тему рассылки";
    } else {
     

        $iii = 0;

        $mail = new PHPMailer;
        $mail->CharSet = 'utf-8';

        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.mail.ru';                                                                                              // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'goyda_makar@mail.ru'; // Ваш логин от почты с которой будут отправляться письма
        $mail->Password = '8Grd7Yyhd8FMXsjsmvZs'; // Ваш пароль от почты с которой будут отправляться письма
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465; // TCP port to connect to / этот порт может отличаться у других провайдеров

        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = $title;
        $mail->Body    = $content;
        $mail->AltBody = '';
        $db_svaz = selectall('svaz', ['raslsid' => $mailing]);
        $users = selectAll('users');

        $mail->setFrom('goyda_makar@mail.ru'); // от кого будет уходить письмо?
        foreach ($users as $key => $value) {
           
            $numbers = explode(",", $value['rasid'], PHP_INT_MAX);
            $db_svaz = selectall('svaz', ['usersid'=>$value['usersid']]);

            if(!empty($db_svaz)){
                foreach($db_svaz as $key2 => $value2){
             
                    $int_array = array_map('intval', $value2);
                    if (in_array($mailing, $int_array)) {
                        $mail->AddCC($value['email'], $value['name']);
                        $iii++;
                    }
                }
            }
           
        }
        $mail->send();
        $mails = [
            'mailid' => $mailing,
            'title' => $title,
            'content' => $content,
            'numuser' => $iii
        ];
        $id = insert_db('mailing_history', $mails);
        header('location: ' . BASE_URL . 'admin/rass/index.php');
    }
} else {
    $title = '';
    $content = '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rasl_but'])) {

    $title = $_POST['title'];

    $mails = [
        'rname' => $title
    ];
 
    insert_db('rassl', $mails);
    header('location: ' . BASE_URL . 'admin/rass/index.php');
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rasl_but_del'])) {

    $title = $_POST['mailing'];


    delete('rassl', $title);
    header('location: ' . BASE_URL . 'admin/rass/index.php');
}