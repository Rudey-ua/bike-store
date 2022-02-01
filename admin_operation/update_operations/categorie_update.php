<?php
require_once '../../config/connect.php';

$id = $_POST['id'];

$title = $_POST['title'];

mysqli_query($connect, "UPDATE `categorie_id` SET `title` = '$title' WHERE `categorie_id`.`id_categorie` = '$id'");

header('Location: /vendor/admin.php');