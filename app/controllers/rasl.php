<?php
include "../../path.php";
include "C:/Ampps/www/my-web_site/app/database/database.php";
require_once('phpmailer/PHPMailerAutoload.php');
$errMsg = [];
$id_poem = '';
$star = '';
$reviews = '';
$id_author = '';
$img = '';
$mail = new PHPMailer;
$mail->CharSet = 'utf-8';
$db_rasl = selectall('rassl');
$s = selectOne('users', ['email' => $_SESSION['email']]);
$db_svaz = selectall('svaz', ['usersid' => $s['usersid']]);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['zak_button'])) {
    $theme = $_POST['theme'];
    $comm = $_POST['comm'];
    $cena = $_POST['cena'];
    $text1 = 'Тема стихотворения: ' . $theme . ' Коментарии к заказу: ' . $comm . ' Цена заказа: ' . $cena;
    $email = $_SESSION['email'];
    if (mb_strlen($text1) < 1 || mb_strlen($email) < 2) {
        array_push($errMsg, "Не правильно заполнена форма.");
    } else {
        $mail = new PHPMailer;
        $mail->CharSet = 'utf-8';

        //$mail->SMTPDebug = 3; // Enable verbose debug output

        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = 'smtp.mail.ru'; // Specify main and backup SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'sportatip@mail.ru'; // Ваш логин от почты с которой будут отправляться письма
        $mail->Password = 'vVVmypzby47EyanFmveV'; // Ваш пароль от почты с которой будут отправляться письма
        $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465; // TCP port to connect to / этот порт может отличаться у других провайдеров

        $mail->setFrom('sportatip@mail.ru'); // от кого будет уходить письмо?
        $mail->addAddress($email); // Кому будет уходить письмо
        //$mail->addAddress('ellen@example.com'); // Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');
        //$mail->addAttachment('/var/tmp/file.tar.gz'); // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg'); // Optional name
        $mail->isHTML(true); // Set email format to HTML

        $mail->Subject = 'Вы успешно сделали заказ на сайте Поэтика';
        $text = $text1;
        $mail->Body = $text;
        $mail->AltBody = '';
        $param = [
            'email' => $email,
            'theme' => $theme,
            'comment' => $comm,
            'cena' => $cena
        ];
        insert_db('zakaz', $param);

        header('location: ' . BASE_URL . 'user/buy/allz.php');
        if (!$mail->send()) {
            array_push($errMsg, "Запрос не отправлен.");
        } else {
            array_push($errMsg, "Запрос отправлен");
        }
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rasl-del'])) {
    delete('svaz', $_POST['mailing']);
    header('location: ' . BASE_URL . 'user/rassl/prof.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rasl-edit'])) {
    $id = $_POST['rasll'];

    $par = [
        'usersid' => $s['usersid'],
        'raslsid' => $id
    ];
    insert_db('svaz', $par);
    header('location: ' . BASE_URL . 'user/rassl/prof.php');
}
