<?php
include "C:/Ampps/www/my-web_site/app/database/database.php";
include "../../path.php";
$errMsg = [];
$id_poem = '';
$star = '';
$reviews = '';
$id_author = '';
$img = '';
$db_poem = selectall('poems');
$db_poem_text = selectall('poems_text');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['poem_button'])) {
   
  
    if(!empty($_FILES['img']['name'])){
        $imgName = time() . "_" . $_FILES['img']['name'];
        $fileTmpName = $_FILES['img']['tmp_name'];
        $fileType = $_FILES['img']['type'];
        $destination = ROOT_PATH . "\assets\images\posts\\" . $imgName;

        if(strpos($fileType,'image')===false){
            array_push($errMsg, "Можно загружать только изображения.");
 
        }
        else{
            $result = move_uploaded_file($fileTmpName, $destination);
            if($result){
                $_POST['img'] = $imgName;
            } else {
                array_push($errMsg, "Ошибка загрузки изображения на сервер.");
                }
        }
    }else{
        array_push($errMsg, "Ошибка получения изображения.");
    }


    
    $name = trim($_POST['name_poem']);
    $text_poem = trim($_POST['text_poem']);
    $id_user = trim($_POST['id_user']);
    $theme_poem = trim($_POST['theme_poem']);

  
    $existence1 = selectOne('users', ['usersid' => $id_user]);
    if ($existence1) {

        if ($name === '' || $text_poem === '' || $id_user === '' ||  $theme_poem === '') {
            array_push($errMsg, "Не все поля заполнены.");
        } else {
            $post1 = [
                'usersid' => $id_user,
                'theme' => $theme_poem,
                'name' => $name,
                'img'=>$_POST['img']
            ];
            $post2 = ['poem' => $text_poem];         
            insert_db('poems', $post1);
            insert_db('poems_text', $post2);
            
           
        } array_push($errMsg, "Стихотворение добавлено.");
    } else {
        array_push($errMsg, "Пользователя с таким ID не существует.");
    }
} else {
    $name = '';
    $text_poem = '';
    $theme_poem = '';
}

//EDIT

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['poemsid'])) {
    $poemsid = $_GET['poemsid'];
    $topic = selectOne('poems', ['poemsid' => $_GET['poemsid']]);
    $topic_t = selectOne('poems_text', ['poemsid' => $_GET['poemsid']]);
    $name = $topic['name'];
    $id_user = $topic['usersid'];
    $theme_poem = $topic['theme'];
    $text_poem = $topic_t['poem'];
    $img =  "../../assets/images/posts/" . $topic['img'];


}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['poem-edit'])) {

    if(!empty($_FILES['img']['name'])){
        $imgName = time() . "_" . $_FILES['img']['name'];
        $fileTmpName = $_FILES['img']['tmp_name'];
        $fileType = $_FILES['img']['type'];
        $destination = ROOT_PATH . "\assets\images\posts\\" . $imgName;
   
        if(strpos($fileType,'image')===false){
            array_push($errMsg, "Можно загружать только изображения.");
        }
        else{
            $result = move_uploaded_file($fileTmpName, $destination);
            if($result){
                $_POST['img'] = $imgName;
            } else {
                array_push($errMsg, "Ошибка загрузки изображения на сервер.");
                }
        }
    }else{
        array_push($errMsg, "Ошибка получения изображения.");
    }
    $name = trim($_POST['name_poem']);
    $text_poem = trim($_POST['textpoem']);
    $id_user = trim($_POST['id_user']);
    $theme_poem = trim($_POST['theme_poem']);

    $existence1 = selectOne('users', ['usersid' => $id_user]);
    if ($existence1) {

        if ($name === '' || $text_poem === '' || $id_user === '' ||  $theme_poem === '') {
            array_push($errMsg, "Не все поля заполнены.");
        } else {
            $post1 = [
                'usersid' => $id_user,
                'theme' => $theme_poem,
                'name' => $name,
                'img'=>$_POST['img']
            ];
            $post2 = ['poem' => $text_poem];
             
            $id = $_POST['poid'];
           
            update('poems',$id, $post1);
            update('poems_text',$id, $post2);
            array_push($errMsg, "Стихотворение изменено.");

            header('location: ' . BASE_URL . 'admin/posts/index.php');
        }
    } else {
     
    array_push($errMsg, "Пользователя с таким ID не существует.");
    }
} 

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_poem_id'])) {
    $id = $_GET['del_poem_id'];
    delete('poems', $id);
    delete('poems_text', $id);
    header('location: ' . BASE_URL . 'admin/posts/index.php');
}
