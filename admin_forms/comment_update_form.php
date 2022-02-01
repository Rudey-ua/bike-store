<?php

require_once '../config/connect.php';

$comment_id = $_GET['id'];

$bike_id = $_GET['bike_id'];

$comment = mysqli_query($connect, "SELECT * FROM `comments` WHERE `comment_id` = '$comment_id'");

$comment = mysqli_fetch_all($comment);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../style/admin_table.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="https://img.icons8.com/external-filled-outline-chattapat-/50/000000/external-bicycle-holiday-filled-outline-chattapat-.png"/>
    <title>Редактирование комментария</title>
</head>
<body>
    
    <h3 style="font-size:28px;margin-bottom:0;">Редактировать комментарий</h3>

    <form action="../admin_operation/update_operations/comment_update.php" method="post">

        <input type="hidden" name="id" value="<?= $comment_id ?>">
        
        <input type="hidden" name="bike_id" value="<?= $bike_id ?>">

        <br><input style="font-size:18px;" type="text" placeholder="Имя комментатора" name="name" value="<? foreach($comment as $item) echo $item[1] ?>">

        <br><textarea name="comment_text" placeholder="Текст комментария" cols="50" rows="5" style="font-size:18px;"><? foreach($comment as $item) echo $item[2] ?></textarea><br>

        <br><input name="bike_rate" type="number" placeholder="Оценка велосипеда" value="<? foreach($comment as $item) echo $item[4] ?>">
        
        <br><input name="comment_time" type="text" placeholder="Время комментария" value="<? foreach($comment as $item) echo $item[5] ?>">

        <br><button type="submit">Редактировать</button>

    </form>

</body>
</html>
