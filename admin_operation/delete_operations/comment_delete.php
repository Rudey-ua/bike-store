<?php
require_once '../../config/connect.php';

$id = $_GET['id'];
$bike_id = $_GET['bike_id'];

mysqli_query($connect, "DELETE FROM `comments` WHERE `comments`.`comment_id` = '$id'");

header('Location: /admin_forms/view_comment_form.php?id='.$bike_id);

    