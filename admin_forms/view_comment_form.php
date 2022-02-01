<?php 

    require_once '../config/connect.php';

    $id = $_GET['id'];

    $view_comments = mysqli_query($connect, "SELECT * FROM `comments` WHERE `bike_id` = '$id'");
    $view_comments = mysqli_fetch_all($view_comments);
    $bike_id = mysqli_query($connect, "SELECT bike_name FROM `crud`.`bikes` WHERE `bike_id` = '$id'");
    $bike_id = mysqli_fetch_all($bike_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../style/admin_table.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="https://img.icons8.com/external-filled-outline-chattapat-/50/000000/external-bicycle-holiday-filled-outline-chattapat-.png"/>
    <title>Просмотр комментария</title>
</head>
<body>
    <h3 style="font-size:28px;">Просмотр комментариев</h3>

    <table>
        <tr>
            <th>id</th>
            <th>Имя</th>
            <th style="width:900px;">Комментарий </th>
            <th>Название велосипеда</th>
            <th>Rate</th>
            <th>Время публикации</th>
            <th>&#9998;</th>
            <th>&#10006;</th>
        </tr>

        <?php
            foreach($view_comments as $item) { ?>
                <tr>
                    <td><?php echo $item[0] ?></td>  
                    <td><?php echo $item[1] ?></td>  
                    <td><?php echo $item[2] ?></td>  
                    <td><?php foreach($bike_id as $i) echo $i[0]?></td>
                    <td><?php echo $item[4] . " / 5" ?></td>  
                    <td><?php echo $item[5] ?></td>  
                    <td><a style="padding:6px;" href="../admin_forms/comment_update_form.php?id=<?php echo $item[0]?>&bike_id=<?php echo $id?>"><img style="height:25px;width:25px;" src="https://cdn-icons-png.flaticon.com/512/1159/1159633.png"></a></td>
                    <td class="delete_button"><a style="padding:6px;color:rgb(204, 45, 45);" href="../admin_operation/delete_operations/comment_delete.php?id=<?php echo $item[0]?>&bike_id=<?php echo $id?>"><img style="height:25px;width:25px;" src="https://cdn-icons-png.flaticon.com/512/1345/1345823.png"></a></td>
                </tr>
            <?php }?>  
    </table>

</body>
</html>