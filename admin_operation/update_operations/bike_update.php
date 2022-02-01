<?php
require_once '../../config/connect.php';

$id = $_POST['id'];

$bike = mysqli_query($connect, "SELECT * FROM `bikes` WHERE `bike_id` = '$id'");

$bike = mysqli_fetch_all($bike);


$bike_name = $_POST['bike_name'];
$categorie = $_POST['categorie'];
$description = $_POST['description'];
$img_src = $_POST['img_src'];

$frame_material = $_POST['frame_material'];

if($frame_material == NULL) {
    foreach ($bike as $item) {
        $frame_material = $item[5];
    }
} 

$wheel_size = $_POST['wheel_size'];

if($wheel_size == NULL) {
    foreach ($bike as $item) {
        $wheel_size = $item[6];
    }
}

$brake_type = $_POST['brake_type'];

if($brake_type  == NULL) {
    foreach ($bike as $item) {
        $brake_type  = $item[7];
    }
}

$model_year = $_POST['model_year'];

if($model_year  == NULL) {
    foreach ($bike as $item) {
        $model_year  = $item[8];
    }
}

$fork_type = $_POST['fork_type'];

if($fork_type  == NULL) {
    foreach ($bike as $item) {
        $fork_type  = $item[9];
    }
}

$weight = $_POST['weight'];
$equipment = $_POST['equipment'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];


if($categorie == NULL){
    mysqli_query($connect, "UPDATE `bikes` SET `bike_name` = '$bike_name', `description` = '$description', `img_src` = '$img_src', `frame_material` = '$frame_material', `wheel_size` = '$wheel_size', `brake_type` = '$brake_type', `model_year` = '$model_year', `fork_type` = '$fork_type', `weight` = '$weight', `equipment` = '$equipment', `quantity` = '$quantity', `price` = '$price' WHERE `bikes`.`bike_id` = '$id'");
}else{
    mysqli_query($connect, "UPDATE `bikes` SET `bike_name` = '$bike_name', `categorie_id` = '$categorie', `description` = '$description', `img_src` = '$img_src', `frame_material` = '$frame_material', `wheel_size` = '$wheel_size', `brake_type` = '$brake_type', `model_year` = '$model_year', `fork_type` = '$fork_type', `weight` = '$weight',`equipment` = '$equipment', `quantity` = '$quantity', `price` = '$price' WHERE `bikes`.`bike_id` = $id");
}

header('Location: /vendor/admin.php');