<?php
require_once '../../config/connect.php';

$title = $_POST['title'];

mysqli_query($connect, "INSERT INTO `categorie_id` (`title`) VALUES ('$title')");

header('Location: /vendor/admin.php');