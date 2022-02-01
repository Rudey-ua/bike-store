<?php
require_once '../../config/connect.php';

$id = $_GET['id'];

mysqli_query($connect, "DELETE FROM `categorie_id` WHERE `categorie_id`.`id_categorie` = '$id'");

header('Location: /vendor/admin.php');