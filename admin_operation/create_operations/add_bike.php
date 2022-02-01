<?php
require_once '../../config/connect.php';

$bike_name = $_POST['bike_name'];
$description = $_POST['description'];
$categorie_id = $_POST['categorie_id'];
$img_src = $_POST['img_src'];
$frame_material = $_POST['frame_material'];
$wheel_size = $_POST['wheel_size'];
$brake_type = $_POST['brake_type'];
$model_year = $_POST['model_year'];
$fork_type = $_POST['fork_type'];
$weight = $_POST['weight'];
$equipment = $_POST['equipment'];
$quantity = $_POST['quantity'];
$price = $_POST['price'];

mysqli_query($connect, "INSERT INTO `bikes` (`bike_id`, `bike_name`, `categorie_id`, `description`, `img_src`, `frame_material`, `wheel_size`, `brake_type`, `model_year`,`fork_type`, `weight`, `equipment`, `quantity`,`price`) VALUES (NULL, '$bike_name', '$categorie_id', '$description', '$img_src','$frame_material', '$wheel_size', '$brake_type','$model_year', '$fork_type','$weight','$equipment', '$quantity', '$price')");

header('Location: /vendor/admin.php');