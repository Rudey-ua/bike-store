<?php

require_once '../config/connect.php';

$categorie_id = $_GET['id'];

$categorie = mysqli_query($connect, "SELECT * FROM `categorie_id` WHERE `id_categorie` = '$categorie_id'");

$categorie = mysqli_fetch_all($categorie);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../style/admin_table.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="https://img.icons8.com/external-filled-outline-chattapat-/50/000000/external-bicycle-holiday-filled-outline-chattapat-.png"/>
    <title>Редактирование категории</title>
</head>
<body>

    <h3 style="font-size:28px;margin-bottom:0;">Редактировать категорию</h3>

    <form action="../admin_operation/update_operations/categorie_update.php" method="post">

        <input type="hidden" name="id" value="<?= $categorie_id ?>">
        
        <br><input style="font-size:18px;" type="text" placeholder="Название категории" name="title" value="<? foreach($categorie as $item) echo $item[1] ?>">

        <br><button type="submit">Редактировать</button>

    </form>

</body>
</html>