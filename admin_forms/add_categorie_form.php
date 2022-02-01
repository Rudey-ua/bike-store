<?php
require_once '../config/connect.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/admin_table.css">
    <link rel="shortcut icon" type="image/png" href="https://img.icons8.com/external-filled-outline-chattapat-/50/000000/external-bicycle-holiday-filled-outline-chattapat-.png"/>
    <title>Создать категорию</title>
</head>
<body>
    <h2 style="font-size:28px;">Создать категорию</h2>

    <form action="../admin_operation/create_operations/add_categorie.php" method="post">

        <input required type="text" name="title" placeholder="Название категории">

        <br><button type="submit">Создать категорию</button>

    </form>

    
</body>
</html>