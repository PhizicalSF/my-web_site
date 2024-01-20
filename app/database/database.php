<?php


session_start();
require('connect.php');

$poem_db_index_theme = selectBigAVG('poems', 'theme');

$db_poem_posts = selectPost();

;
$db_poem_top = selectTop();

function tt($value)
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';
    exit();
}
function  dbCheckError($query)
{
    $errInfo = $query->errorInfo();
    if ($errInfo[0] !== PDO::ERR_NONE) {
        echo $errInfo[2];
        exit();
    }
    return true;
}
//Все данные с таблицы
function selectall($table, $params = [])
{
    global $pdo;
    $sql = "select * from $table";

    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            if (!is_numeric($value)) {
                $value = "'" . $value . "'";
            }
            if ($i === 0) {
                $sql = $sql . " WHERE $key = $value ";
            } else {
                $sql = $sql . " AND $key = $value ";
            }
            $i++;
        }
    }
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}
function selectBigAVG($table, $params)
{
    global $pdo;
    $sql = "SELECT $params FROM `$table` group by $params having count($params)> (select avg(colt.thm) av from (SELECT count($params) thm FROM `$table` group by $params) colt )";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}

function selectTop()
{
    global $pdo;
    $sql = "SELECT poems.poemsid,avg(stars) st from reviews inner join poems on reviews.poemsid=poems.poemsid group by poems.poemsid order by st desc LIMIT 3";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}

function selectPost()
{
    global $pdo;
    $sql = "select img,poems.name,(select users.name from users where users.usersid=poems.usersid) 'author',(select poems_text.poem from poems_text where poems.poemsid=poems_text.poemsid) 'text',DATE_FORMAT(date_poem,'%d.%m.%Y') 'date',poemsid from poems order by date_poem DESC LIMIT 5;";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}
function selectPostSearch($params = [])
{
    global $pdo;
    foreach ($params as $key => $value) {
        $sql = "select img,poems.name,(select users.name from users where users.usersid=poems.usersid) 'author',(select poems_text.poem from poems_text where poems.poemsid=poems_text.poemsid) 'text',DATE_FORMAT(date_poem,'%d.%m.%Y') 'date' from poems where $key = '$value' order by date_poem DESC LIMIT 5;";
    }
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}
function searchTitleAndContent($text, $table1, $table2)
{
    $text = trim(strip_tags(stripcslashes(htmlspecialchars($text))));
    global $pdo;
    $sql = "SELECT
    p.name 'name',p.poemsid,p.img,(select poems_text.poem from poems_text where p.poemsid=poems_text.poemsid) 'text',DATE_FORMAT(p.date_poem,'%d.%m.%Y') 'date', u.name 'author'
    From $table1 As p
    Join $table2 As u
    ON p.usersid=u.usersid
    WHERE p.name like '%$text%' OR p.theme like '%$text%' OR u.name like '%$text%' ";

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}
function searchTheme($theme, $table1, $table2)
{
    global $pdo;
    $sql = "SELECT
    p.name 'name', p.poemsid,p.img,(select poems_text.poem from poems_text where p.poemsid=poems_text.poemsid) 'text',DATE_FORMAT(p.date_poem,'%d.%m.%Y') 'date', u.name 'author'
    From $table1 As p
    Join $table2 As u
    ON p.usersid=u.usersid
    WHERE p.theme='$theme'";

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchAll();
}
//Данные одной строки
function selectOne($table, $params = [])
{
    global $pdo;
    $sql = "select * from $table";
    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            if (!is_numeric($value)) {
                $value = "'" . $value . "'";
            }
            if ($i === 0) {
                $sql = $sql . " WHERE $key = $value ";
            } else {
                $sql = $sql . " AND $key = $value ";
            }
            $i++;
        }
    }
    //$sql = $sql . " LIMIT 1";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    $result = $query->fetch();
    return $result;
}
//Данные одной строки

//Запись в таблицу БД
function insert_db($table, $params)
{
    global $pdo;
    $i = 0;
    $coll = '';
    $mask = '';
    foreach ($params as $key => $value) {
        if ($i === 0) {
            $coll = $coll . "$key";
            $mask = $mask . "'" . "$value" . "'";
        } else {
            $coll = $coll . ", $key";
            $mask = $mask . ", '" . "$value" . "'";
        }
        $i++;
    }
    $sql = "INSERT INTO $table ($coll) VALUES ($mask)";
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
}
//Изменение строки в таблице
function update($table, $id, $params)
{
    global $pdo;
    $i = 0;
    $str = '';
    foreach ($params as $key => $value) {
        if ($i === 0) {
            $str = $str . $key . " = '" . "$value" . "'";
        } else {
            $str = $str . ", " . $key . " = '" . "$value" . "'";
        }
        $i++;
    }
    if ($table === "poems_text") {
        $sql = "UPDATE $table SET $str  WHERE " .  " poems" . "id " . " = $id";
    } else {
        $sql = "UPDATE $table SET $str WHERE " . " $table" . "id" . " = $id";
    }

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
}
//Удаление
function delete($table, $id)
{
    global $pdo;
    if ($table === "poems_text") {
        $sql = "DELETE FROM " . " $table " . " WHERE " . " poems" . "id " . " = $id";
    } else if($table === "rassl"){

        $sql = "DELETE FROM " . " $table " . " WHERE " . " rasl" . "id " . " = $id";
    } else if($table === "messages"){

        $sql = "DELETE FROM " . " $table " . " WHERE " .  " id " . " = $id";
    }else {
        $sql = "DELETE FROM " . " $table " . " WHERE " . " $table" . "id " . " = $id";
    }
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
}


function selectSinglePost($params = [])
{
    global $pdo;

    foreach ($params as $key => $value) {
        $sql = "select img,poems.name,(select users.name from users where users.usersid=poems.usersid) 'author',(select poems_text.poem from poems_text where poems.poemsid=poems_text.poemsid) 'text',DATE_FORMAT(date_poem,'%d.%m.%Y') 'date',poemsid from poems where $key = $value order by date_poem DESC LIMIT 5;";
    }
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetch();
}

function selectSinglePostStar($id)
{
    global $pdo;


    $sql = "SELECT avg(stars) from reviews where poemsid='$id'";

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetch();
}
function statistica()
{
    global $pdo;


    $sql = "select rassl.rname,rassl.raslid raslid, count(mailing_history.mailid) as num from rassl, mailing_history where mailing_history.mailid = rassl.raslid group by rassl.raslid";

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetchall();
}
function statistica2($value)
{
    global $pdo;


    $sql = "select count(*) count from svaz WHERE raslsid= $value";

    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);
    return $query->fetch();
}
function searchDate($date1, $date2, $table1, $table2)
{
    global $pdo;
    if (empty($date1) || empty($date2)) {
        if (empty($date1)) {
           
            $sql = "SELECT
    p.name 'name', p.poemsid,p.img,(select poems_text.poem from poems_text where p.poemsid=poems_text.poemsid) 'text',DATE_FORMAT(p.date_poem,'%Y.%m.%d') 'date', u.name 'author'
     From $table1 As p
     Join $table2 As u
     ON p.usersid=u.usersid
 WHERE DATE_FORMAT(p.date_poem,'%Y-%m-%d') = '$date2' ";
        }
        if(empty($date2)){
          
            $sql = "SELECT
   p.name 'name', p.poemsid,p.img,(select poems_text.poem from poems_text where p.poemsid=poems_text.poemsid) 'text',DATE_FORMAT(p.date_poem,'%Y.%m.%d') 'date', u.name 'author'
    From $table1 As p
    Join $table2 As u
    ON p.usersid=u.usersid
WHERE DATE_FORMAT(p.date_poem,'%Y-%m-%d') = '$date1' ";
        }
    } else {
        $sql = "SELECT
   p.name 'name', p.poemsid,p.img,(select poems_text.poem from poems_text where p.poemsid=poems_text.poemsid) 'text',DATE_FORMAT(p.date_poem,'%Y.%m.%d') 'date', u.name 'author'
    From $table1 As p
    Join $table2 As u
    ON p.usersid=u.usersid
WHERE DATE_FORMAT(p.date_poem,'%Y-%m-%d') BETWEEN '$date1' and '$date2' ";
    }
    $query = $pdo->prepare($sql);
    $query->execute();
    dbCheckError($query);

    return $query->fetchAll();
}
