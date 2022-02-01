<?php
require_once '../../config/connect.php';

$id = $_POST['id'];
$bike_id = $_POST['bike_id'];
$name = $_POST['name'];
$comment_text = $_POST['comment_text'];
$bike_rate = $_POST['bike_rate'];
$comment_time = $_POST['comment_time'];

mysqli_query($connect, "UPDATE `comments` SET `Name` = '$name', `Comment_text` = '$comment_text', `bike_rate` = '$bike_rate', `comment_time` = '$comment_time' WHERE `comments`.`comment_id` = '$id'");

header('Location: /admin_forms/view_comment_form.php?id='.$bike_id);