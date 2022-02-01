<?php
require_once '../../config/connect.php';

$id = $_GET['id'];

mysqli_query($connect, "DELETE FROM `bikes` WHERE `bikes`.`bike_id` = '$id'");

header('Location: /vendor/admin.php');


