<?php 

require_once '../config/connect.php';

$customers = mysqli_query($connect, "SELECT * FROM `customer`");
$customers = mysqli_fetch_all($customers);


$login = $_POST['login'];
$password = $_POST['password'];
$seller_id = $_POST['seller'];
$bike_id = $_POST['bike_id'];
$customer_id;

foreach($customers as $item) {
    if($item[1] == $login && $item[2] == $password) {
        $customer_id = $item[0];
    }
}

if(!empty($customer_id)) {
    
    mysqli_query($connect, "INSERT INTO `purchase` (`customer_id`, `salesman_id`) VALUES ('$customer_id', '$seller_id')");

    $bike_purchase = mysqli_query($connect, "SELECT purchase_id FROM purchase ORDER BY purchase_id DESC LIMIT 1");
    $bike_purchase = mysqli_fetch_all($bike_purchase);
    $purchase_id;

    foreach($bike_purchase as $item) $purchase_id = $item[0];

    mysqli_query($connect, "INSERT INTO `bike_purchase` (`bike_id`, `purchase_id`) VALUES ('$bike_id', '$purchase_id')");

    mysqli_query($connect, "UPDATE `bikes` SET bikes.quantity = bikes.quantity - 1 WHERE bikes.bike_id = '$bike_id'");
    
    echo header("Location: ../admin_operation/report/receipt.php?customer_id=$customer_id&bike_id=$bike_id");
}
else {
    header("Location: ../errors/login_error.php?bike_id=$bike_id");
}

?>

