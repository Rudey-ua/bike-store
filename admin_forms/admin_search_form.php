<?php 

require_once '../config/connect.php';

$search = $_GET['search'];

$search_result = mysqli_query($connect, "SELECT * FROM `bikes` WHERE bikes.bike_name LIKE '%$search%' OR `description` LIKE '%$search%'");

$search_result = mysqli_fetch_all($search_result);
 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../style/main.css" rel="stylesheet">
    <link href="../style/admin_table.css" rel="stylesheet">
    <title>Поиск</title>
</head>
<body>
<div class="container-fluid">
        <div class="row">
            <div class="col" style=background-color:#212529;height:56px;>
            <p style="margin-left:16%;margin-top:2px;" class="logo"><a href="/" style="text-decoration:none;color:white;font-style:normal;font-family:comic sans ms;font-size:28px;">VeloGo</a></p>
            </div>
        </div>
    </div>

    <div class="col mt-4 mb-4">
        <h3 style="margin-left:5px;">Результаты поиска: <?="«".$search."»"?></h3>
    </div>

    <table style="margin-left:7px;">
        <tr>
            <th>id</th>
            <th>Название велосипеда</th>
            <th>Cat_id</th>
            <th>Материал рамы</th>
            <th>Размер колес</th>
            <th>Тип тормозов</th>
            <th>Год выпуска</th>
            <th>Тип вилки</th>
            <th>Вес</th>
            <th>Оборудование</th>
            <th>Цена</th>
            <th>&#9998;</th>
            <th>&#10006;</th>
            <th>Комментарии</th>
        </tr>

        <?php
        foreach ($search_result as $item) {
        ?>
            <tr>
                <td><?php echo $item[0] ?></td>
                <td><?php echo $item[1] ?></td>
                <td><?php echo $item[2] ?></td>
                <td><?php echo $item[5] ?></td>
                <td><?php echo $item[6] ?></td>
                <td><?php echo $item[7] ?></td>
                <td><?php echo $item[8] ?></td>
                <td style="padding: 10px;"><?php echo $item[9] ?></td>
                <td><?php echo $item[10] ?></td>
                <td><?php echo $item[11] ?></td>
                <td><?php echo $item[13] ?></td>
                <td><a style="padding:6px;" href="../admin_forms/bike_update_form.php?id=<?php echo $item[0] ?>"><img style="height:25px;width:25px;" src="https://cdn-icons-png.flaticon.com/512/1159/1159633.png"></a></td>
                <td class="delete_button"><a style="padding:6px;color:rgb(204, 45, 45);" href="../admin_operation/delete_operations/bike_delete.php?id=<?php echo $item[0] ?>"><img style="height:25px;width:25px;" src="https://cdn-icons-png.flaticon.com/512/1345/1345823.png"></a></td>
                <td class="view"><a href="../admin_forms/view_comment_form.php?id=<?php echo $item[0] ?>">Просмотр</a></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>