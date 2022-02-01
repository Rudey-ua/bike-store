<?php 

require_once '../../config/connect.php';

$customer_id = $_GET['customer_id'];
$bike_id = $_GET['bike_id'];

$customer_information = mysqli_query($connect, "SELECT * FROM `customer` WHERE customer.customer_id = '$customer_id'");
$customer_information = mysqli_fetch_all($customer_information);

$bike_information = mysqli_query($connect, "SELECT * FROM `bikes` WHERE bikes.bike_id = '$bike_id'");
$bike_information = mysqli_fetch_all($bike_information);

$customer_info = "Покупатель: ";

$customer_phone = "Телефон: ";

foreach($customer_information as $item) {
    $customer_info .= $item[4] . " " . $item[3];
    $customer_phone .= $item[5];
}

$bike_info = "Товар: ";

foreach($bike_information as $item) {
    $bike_info .= $item[1] . " - " . $item[13] . " грн";
}

$introduction = 'Товарный чек магазина "VeloGo"';

$date = "Дата формирования чека: " . date('d-m-Y H:i:s');

$fp = fopen('report.txt', 'w+');

fwrite($fp, $introduction . "\n" ."\n");
fwrite($fp, $date . "\n"."\n");
fwrite($fp, $customer_info . "\n"."\n");
fwrite($fp, $customer_phone . "\n"."\n");
fwrite($fp, "-------------------------------------------" . "\n"."\n");
fwrite($fp, $bike_info . "\n"."\n");
fwrite($fp, "-------------------------------------------" . "\n"."\n");
fwrite($fp, "Cпасибо за покупку!" . "\n"."\n");
fclose($fp); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="https://img.icons8.com/external-filled-outline-chattapat-/50/000000/external-bicycle-holiday-filled-outline-chattapat-.png"/>
    <title>Чек</title>
</head>
<body>
    <h1 style="margin-bottom: 0">Ваш чек сгенерирован!</h1> <br>
    <p style="font-size: 22px;margin-top:0;">Вернуться на <a style="font-weight:bold;text-decoration:none;color:black;" href="/">главную страницу</a>.</p>
</body>
</html>
