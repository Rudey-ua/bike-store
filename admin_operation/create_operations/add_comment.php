<?php 

require_once '../../config/connect.php';

$Name = $_POST['Name'];
$Comment_text = $_POST['Comment_text'];
$bike_id = $_POST['bike_id'];
$bike_rate = $_POST['bike_rate'];

mysqli_query($connect, "INSERT INTO `comments` (`Name`, `Comment_text`, `bike_id`, `bike_rate`) VALUES ('$Name', '$Comment_text', '$bike_id', '$bike_rate')");

header('Location: /vendor/view_bike.php'."?id=".$bike_id);


