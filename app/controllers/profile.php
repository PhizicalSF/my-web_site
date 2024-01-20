<?php
include "C:/Ampps/www/my-web_site/app/database/database.php";
include "../../path.php";
$errMsg = '';
$name = '';
$email = '';
$city = '';
$status = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pdfone'])) {
    require('tfpdf/tfpdf.php');
    $id=selectOne('users', ['email'=>$_SESSION['email']]);
    $orders = selectAll('orders', ['user_id' => $id['usersid']]);
    $sum = 0;

    $pdf = new tFPDF('P', 'pt', 'Letter');
    define('tFPDF_FONTPATH', "tfpdf/font/");
    $pdf->AddPage();
    $pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
    $pdf->SetFont('DejaVu', '', 14);
    $pdf->Cell(40, 50, 'Заказы');

    // Создание таблицы
    $pdf->Ln();
    $pdf->SetFont('DejaVu', '', 12);
    $pdf->Cell(150, 30, 'Название', 1);
    $pdf->Cell(300, 30, 'Коммент', 1);
    $pdf->Cell(70, 30, 'Цена', 1);
    $pdf->Ln();
    // Заполнение таблицы данными из базы данных
    $pdf->SetFont('DejaVu', '', 12);

    foreach ($orders as $key => $value) {
        $price=selectOne('category',['category_id'=>$value['category_id']]);
        $pdf->Cell(150, 30, $value["theme"], 1);
        $pdf->Cell(300, 30, $value["comment"], 1);
        $pdf->Cell(70, 30, $price["price"], 1);
        $sum += $price["price"];
        $pdf->Ln();
    }
   
    $pdf->Cell(480, 30, "Сумма", 1);
    $pdf->Cell(70, 30, $sum , 1);
    $pdf->Ln();

    // Отправляем PDF-файл для скачивания
    $pdf->Output('orders.pdf', 'D');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pdftwo1'])) {
    require('tfpdf/tfpdf.php');
    global $pdo;

    $pdf = new tFPDF('P', 'pt', 'Letter');
    define('tFPDF_FONTPATH', "tfpdf/font/");
    $pdf->AddPage();
    $pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
    $pdf->SetFont('DejaVu', '', 14);
    $pdf->Cell(40, 50, 'Заказы');

    // Создание таблицы
    $pdf->Ln();
    $pdf->SetFont('DejaVu', '', 12);

    $pdf->Cell(200, 30, 'Название', 1);
    $pdf->Cell(70, 30, 'Цена', 1);
    $pdf->Ln();
    // Заполнение таблицы данными из базы данных
    $pdf->SetFont('DejaVu', '', 12);

    
  
    $list=selectall('category',['category_id'=>$_POST['category']]);
   

          
       foreach ($list as $key => $value) {
        $pdf->Cell(200, 30, $value['name'], 1);
        $pdf->Cell(70, 30, $value['price'], 1);
        $pdf->Ln();
         
       }
   
 
    // Отправляем PDF-файл для скачивания
    $pdf->Output('orders.pdf', 'D');
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pdftree1'])) {
    require('tfpdf/tfpdf.php');
    $pdf = new tFPDF('P', 'pt', 'Letter');
    $sql = "select *,MONTH(order_date) from orders ";
    $sdate = $_POST['sdate'];
    $edate = $_POST['edate'];
    if ($sdate && $edate) {
        $sql .= " Where order_date > '" . $sdate . "' and order_date < '" . $edate . "'";
  
    }
    if ($sdate && !$edate) {
        $sql .= " Where order_date > '" . $sdate . "'";

    }
    if (!$sdate && $edate) {
        $sql .= " Where order_date < '" . $edate . "'";

    }

    global $pdo;
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $orders = $stmt->fetchAll();

    $sum1 = 0;
    $sum2 = 0;
    $sum3 = 0;
    $sum4 = 0;
    $sum5 = 0;
    $sum6 = 0;
    $sum7 = 0;
    $sum8 = 0;
    $sum9 = 0;
    $sum10 = 0;
    $sum11 = 0;
    $sum12 = 0;
    foreach ($orders as $key => $value) {
        $price=selectOne('category',['category_id'=>$value['category_id']]);
        if ($value['MONTH(order_date)'] == 1) {
            $sum1 += $price['price'];
        }
        if ($value['MONTH(order_date)'] == 2) {
            $sum2 += $price['price'];
        }
        if ($value['MONTH(order_date)'] == 3) {
            $sum3 += $price['price'];
        }
        if ($value['MONTH(order_date)'] == 4) {
            $sum4 += $price['price'];
        }
        if ($value['MONTH(order_date)'] == 5) {
            $sum5 += $price['price'];
        }
        if ($value['MONTH(order_date)'] == 6) {
            $sum6 += $price['price'];
        }
        if ($value['MONTH(order_date)'] == 7) {
            $sum7 += $price['price'];
        }
        if ($value['MONTH(order_date)'] == 8) {
            $sum8 += $price['price'];
        }
        if ($value['MONTH(order_date)'] == 9) {
            $sum9 += $price['price'];
        }
        if ($value['MONTH(order_date)'] == 10) {
            $sum10 += $price['price'];
        }
        if ($value['MONTH(order_date)'] == 11) {
            $sum11 += $price['price'];
        }
        if ($value['MONTH(order_date)'] == 12) {
            $sum12 += $price['price'];
        }
    
                }
    define('tFPDF_FONTPATH', "tfpdf/font/");
    $pdf->AddPage();
    $pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
    $pdf->SetFont('DejaVu', '', 14);
    $pdf->Cell(40, 50, 'Выручка');

    // Создание таблицы
    $pdf->Ln();
    $pdf->SetFont('DejaVu', '', 12);
    $pdf->Cell(225, 30, 'Месяц', 1);
    $pdf->Cell(225, 30, 'Выручка', 1);
    $pdf->Ln();
    if ($sum1 != 0) {
        $pdf->Cell(225, 30, 'Январь', 1);
        $pdf->Cell(225, 30, $sum1, 1);
        $pdf->Ln();
    }
    if ($sum2 != 0) {
        $pdf->Cell(225, 30, 'Февраль', 1);
        $pdf->Cell(225, 30, $sum2, 1);
        $pdf->Ln();
    }
    if ($sum3 != 0) {
        $pdf->Cell(225, 30, 'Март', 1);
        $pdf->Cell(225, 30, $sum3, 1);
        $pdf->Ln();
    }
    if ($sum4 != 0) {
        $pdf->Cell(225, 30, 'Апрель', 1);
        $pdf->Cell(225, 30, $sum4, 1);
        $pdf->Ln();
    }
    if ($sum5 != 0) {
        $pdf->Cell(225, 30, 'Май', 1);
        $pdf->Cell(225, 30, $sum5, 1);
        $pdf->Ln();
    }
    if ($sum6 != 0) {
        $pdf->Cell(225, 30, 'Июнь', 1);
        $pdf->Cell(225, 30, $sum6, 1);
        $pdf->Ln();
    }
    if ($sum7 != 0) {
        $pdf->Cell(225, 30, 'Июль', 1);
        $pdf->Cell(225, 30, $sum7, 1);
        $pdf->Ln();
    }
    if ($sum8 != 0) {
        $pdf->Cell(225, 30, 'Август', 1);
        $pdf->Cell(225, 30, $sum8, 1);
        $pdf->Ln();
    }
    if ($sum9 != 0) {
        $pdf->Cell(225, 30, 'Сентябрь', 1);
        $pdf->Cell(225, 30, $sum9, 1);
        $pdf->Ln();
    }
    if ($sum10 != 0) {
        $pdf->Cell(225, 30, 'Октябрь', 1);
        $pdf->Cell(225, 30, $sum10, 1);
        $pdf->Ln();
    }
    if ($sum11 != 0) {
        $pdf->Cell(225, 30, 'Ноябрь', 1);
        $pdf->Cell(225, 30, $sum11, 1);
        $pdf->Ln();
    }
    if ($sum12 != 0) {
        $pdf->Cell(225, 30, 'Декабрь', 1);
        $pdf->Cell(225, 30, $sum12, 1);
        $pdf->Ln();
    }
    $pdf->Cell(225, 30, 'Суммарная выручка', 1);
    $pdf->Cell(225, 30, $sum1 + $sum2 + $sum3 + $sum4 + $sum5 + $sum6 + $sum7 + $sum8 + $sum9 + $sum10 + $sum11 + $sum12, 1);
    $pdf->Ln();
    $pdf->Output('orders.pdf', 'D');
}
