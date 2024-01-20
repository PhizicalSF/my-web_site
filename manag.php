<?php
require_once('app/database/database.php');
include "path.php";
$mysqli = new mysqli('localhost', 'root', 'mysql', 'datapoems');
$errMsg = '';
if(isset($_SESSION['login'])){
$prof = selectOne('users', ['login'=>$_SESSION['login']]);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mess'])) {
    $message = $_POST['text'];
    $parent_id = $_POST['parent_id'];


    if ($message === '') {
        $errMsg = "Напишите сообщение!";
        header('location: ' . BASE_URL . "group.php");
    } else {
        if ($parent_id == 'null') {
            $message = [
                'user_id' => $prof['usersid'],
                'text' => $message
            ];
        } else {
            $message = [
                'user_id' => $prof['usersid'],
                'parent_id' => $parent_id,
                'text' => $message
            ];
        }
        $id = insert_db('messages', $message);
        header('location: ' . BASE_URL . "group.php");
    }
}

// Функция для получения списка сообщений и комментариев
function getMessages($parent_id = null)
{
    if (isset($_SESSION['login'])) {
        $prof = selectOne('users', ['login'=>$_SESSION['login']]);
        global $pdo;
        if ($parent_id == null) {
            $stmt = $pdo->prepare("SELECT 
            messages.id, 
            messages.user_id, 
            messages.text, 
            messages.parent_id as par, 
            messages.created_at, 
            users.name
            FROM messages, users where messages.user_id = users.usersid and messages.parent_id is NULL 
            GROUP BY messages.id 
            ORDER BY messages.created_at DESC");
        } else {
            $stmt = $pdo->prepare("SELECT 
            messages.id, 
            messages.user_id, 
            messages.text, 
            messages.parent_id as par, 
            messages.created_at, 
            users.name
            FROM messages, users where messages.user_id = users.usersid and messages.parent_id = " . $parent_id . " 
            GROUP BY messages.id 
            ORDER BY messages.created_at DESC");
        }

        $stmt->execute();
        $messages = $stmt->fetchAll();

        foreach ($messages as $message) {
            $id = $message['id'];
            $user_id = $message['user_id'];
            $pare = $message['par'];
            $text = $message['text'];
            $created_at = $message['created_at'];
            $stmt1 = $pdo->prepare("SELECT 
            COUNT(IF(likes.is_like = 1, 1, NULL)) likes, 
            COUNT(IF(likes.is_like = 0, 1, NULL)) dislikes 
            FROM messages, likes where messages.id = likes.message_id and messages.id = " . $message['id']);
            $stmt1->execute();
            $lok = $stmt1->fetch();
            $likes = $lok['likes'];
            $dislikes = $lok['dislikes'];
            $stmt1 = $pdo->prepare("SELECT is_like FROM likes where user_id =" . $prof['usersid'] . " and  likes.message_id = " . $id);
            $stmt1->execute();
            $like = $stmt1->fetch();
            $num_rows = $stmt1->rowCount();
            $stmt2 = $pdo->prepare("SELECT id FROM messages where id =" . $id);
            $stmt2->execute();
            $mesid = $stmt2->fetch();

            // Выводим сообщение и кнопки "лайк" и "дизлайк"
            echo "<div class='message'>";
            echo '<p>' . $message['name'] . ": " . $message['text'] . '   Дата: ' . $created_at . '</p>';
            echo "<div class='buttons'>";
            echo "<span>$likes лайков, </span>";
            echo "<span>$dislikes дизлайков </span>";
            echo "<div class='like-dislike'>";
            echo '<form method="POST" action="group.php">';
            echo '<input type="hidden" name="user_id" value="' . $prof["usersid"] . '">';
            echo '<input type="hidden" name="message_id" value="' . $id . '">';
            echo '<input type="hidden" name="is_like" value="1">';
            if ($num_rows === 0) {
                echo '<button type="submit" name="like">👍</button>';
            } else {
                if ($like['is_like'] == 1) {
                    echo '<button type="submit" name="like" disabled>👍</button>';
                } else {
                    echo '<button type="submit" name="like">👍</button>';
                }
            }
            echo '</form>';
            echo '<form method="POST" action="group.php">';
            echo '<input type="hidden" name="user_id" value="' . $prof["usersid"] . '">';
            echo '<input type="hidden" name="message_id" value="' . $id . '">';
            echo '<input type="hidden" name="is_like" value="0">';
            if ($num_rows === 0) {
                echo '<button type="submit" name="dislike">👎</button>';
            } else {
                if ($like['is_like'] == 0) {
                    echo '<button type="submit" name="dislike" disabled>👎</button>';
                } else {
                    echo '<button type="submit" name="dislike">👎</button>';
                }
            }
            echo '</form>';
            // echo "</div>";
            // echo '<button class="open-form" data-form-id="' . $id . '">Ответить</button>';
            // echo '<div class="popup-bg">';
            // echo '<div class="popup">';
            // echo '<img class="close-popup" src="../assets/images/close.png" alt="">';
            // echo '<form id="' . $id . '" class="form" style="display:none;">';
            // echo "<input type='text' name='text' placeholder='Type your comment here'>"; ///////////////////////////////////////////
            // echo "<input type='hidden' name='parent_id' value='" . $mesid['id']  . "'>";
            // echo "<input type='submit' name='mess' value='Отправить'>";
            // echo "</form>";
            // echo "</div>";
            // echo "</div>";
            if ($_SESSION['admin_status'] == 1 || $prof['usersid'] == $user_id) {
                $url = 'group.php?id=' . ($id);
                echo '<a href="' . $url . '">';
                echo "Удалить";
                echo '</a>';
            }
            echo "</div>";

            echo "<form method='post' action='group.php'>";
            echo "<input type='text' name='text' placeholder='Оставьте комментарий тут'>";
            echo "<input type='hidden' name='parent_id' value='$id'>";
            echo "<input type='submit' name='mess' value='Отправить'>";
            echo "</form>";
            echo "</div>";

            // Выводим список пользователей, которые поставили лайки и дизлайки
            echo "<div class='likes'>";
            echo "<div class='like-list'>";
            $stmt = $pdo->prepare("SELECT users.name FROM likes JOIN users ON likes.user_id = users.usersid WHERE likes.message_id = " . $message['id'] . " AND likes.is_like = 1");
            $stmt->execute();
            $likes = $stmt->fetchAll();
            if (count($likes) > 0) {
                echo "<span>Лайкнули: </span>";
                foreach ($likes as $like) {
                    echo "<span>{$like['name']}, </span>";
                }
            }
            echo "</div>";
            echo "<div class='dislike-list'>";
            $stmt = $pdo->prepare("SELECT users.name FROM likes JOIN users ON likes.user_id = users.usersid WHERE likes.message_id = " . $message['id'] . " AND likes.is_like = 0");
            $stmt->execute();
            $dislikes = $stmt->fetchAll();
            if (count($dislikes) > 0) {
                echo "<span>Дизлайкнули: </span>";
                foreach ($dislikes as $dislike) {
                    echo "<span>{$dislike['name']}, </span>";
                }
            }
            echo "</div>";
            echo "</div>";

            // Выводим комментарии к сообщению
            echo "<div class='comments'>";
            getMessages($id);
            echo "</div>";
            // Выводим форму для добавления нового комментария
            echo "</div>";
        }
    } else {
        global $pdo;
        if ($parent_id == null) {
            $stmt = $pdo->prepare("SELECT 
            messages.id, 
            messages.user_id, 
            messages.text, 
            messages.parent_id, 
            messages.created_at, 
            users.name
            FROM messages, users where messages.user_id = users.usersid and messages.parent_id is NULL 
            GROUP BY messages.id 
            ORDER BY messages.created_at DESC");
        } else {
            $stmt = $pdo->prepare("SELECT 
            messages.id, 
            messages.user_id, 
            messages.text, 
            messages.parent_id, 
            messages.created_at, 
            users.name
            FROM messages, users where messages.user_id = users.usersid and messages.parent_id = " . $parent_id . " 
            GROUP BY messages.id 
            ORDER BY messages.created_at DESC");
        }

        $stmt->execute();
        $messages = $stmt->fetchAll();

        foreach ($messages as $message) {
            $id = $message['id'];
            $user_id = $message['user_id'];
            $text = $message['text'];
            $created_at = $message['created_at'];
            $stmt1 = $pdo->prepare("SELECT 
            COUNT(IF(likes.is_like = 1, 1, NULL)) likes, 
            COUNT(IF(likes.is_like = 0, 1, NULL)) dislikes 
            FROM messages, likes where messages.id = likes.message_id and messages.id = " . $message['id']);
            $stmt1->execute();
            $lok = $stmt1->fetch();
            $likes = $lok['likes'];
            $dislikes = $lok['dislikes'];

            // Выводим сообщение и кнопки "лайк" и "дизлайк"
            echo "<div class='message'>";
            echo '<p>' . $message['name'] . ": " . $message['text'] . '   Дата: ' . $created_at . '</p>';
            echo "<div class='buttons'>";
            echo "<span>$likes likes </span>";
            echo "<span>$dislikes dislikes </span>";
            echo "</div>";

            // Выводим список пользователей, которые поставили лайки и дизлайки
            echo "<div class='likes'>";
            echo "<div class='like-list'>";
            $stmt = $pdo->prepare("SELECT users.name FROM likes JOIN users ON likes.user_id = users.usersid WHERE likes.message_id = " . $message['id'] . " AND likes.is_like = 1");
            $stmt->execute();
            $likes = $stmt->fetchAll();
            if (count($likes) > 0) {
                echo "<span>Liked by:</span>";
                foreach ($likes as $like) {
                    echo "<span>{$like['name']}</span>";
                }
            }
            echo "</div>";
            echo "<div class='dislike-list'>";
            $stmt = $pdo->prepare("SELECT users.name FROM likes JOIN users ON likes.user_id = users.usersid WHERE likes.message_id = " . $message['id'] . " AND likes.is_like = 0");
            $stmt->execute();
            $dislikes = $stmt->fetchAll();
            if (count($dislikes) > 0) {
                echo "<span>Disliked by:</span>";
                foreach ($dislikes as $dislike) {
                    echo "<span>{$dislike['name']}</span>";
                }
            }
            echo "</div>";
            echo "</div>";

            // Выводим комментарии к сообщению
            echo "<div class='comments'>";
            getMessages($id);
            echo "</div>";
            // Выводим форму для добавления нового комментария
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && (isset($_POST['like']) || (isset($_POST['dislike'])))) {
    $user_id = $_POST['user_id'];
    $message_id = $_POST['message_id'];

    // Получаем значение кнопки (1 - like, 0 - dislike) из запроса
    $is_like = $_POST['is_like'];

    // Выполняем проверку, был ли пользователь уже совершенно действие с этим сообщением
    $stmt = $pdo->prepare("SELECT * FROM likes WHERE user_id = " . $prof['usersid'] . " AND message_id = " . $message_id);
    $stmt->execute();

    // Если запись в таблице уже существует, обновляем значение поля is_like. В противном случае - создаем новую запись
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch();
        $stmt = $pdo->prepare("UPDATE likes SET is_like = " . $is_like . " WHERE id = " . $row['id']);
        $stmt->execute();
        header('location: ' . BASE_URL . "group.php");
    } else {
        $stmt = $pdo->prepare("INSERT INTO likes (user_id, message_id, is_like) VALUES (" . $user_id . ", " . $message_id . ", " . $is_like . ")");
        $stmt->execute();
        header('location: ' . BASE_URL . "group.php");
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    delete('messages', $id);
    header('location: ' . BASE_URL . "group.php");
}
