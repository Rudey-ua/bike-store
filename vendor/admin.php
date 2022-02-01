<?php

require_once '../config/connect.php';

$bikes = mysqli_query($connect, "SELECT * FROM `bikes`");
$bikes = mysqli_fetch_all($bikes);

$categorie_id = mysqli_query($connect, "SELECT * FROM `categorie_id`");
$categorie_id = mysqli_fetch_all($categorie_id);

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
    <link rel="shortcut icon" type="image/png" href="https://img.icons8.com/external-filled-outline-chattapat-/50/000000/external-bicycle-holiday-filled-outline-chattapat-.png"/>
    <title>Admin panel</title>
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <div class="col-7" style=background-color:#212529;height:56px;>
                <p class="logo"><a href="/" style="text-decoration:none;color:white;font-family:comic sans ms;font-style:normal;">VeloGo</a></p>
            </div>

            <div class="col-5" style=background-color:#212529;height:56px;>

                <form style="margin-left: 5%" action="../admin_forms/admin_search_form.php" method="GET">
                    <input required class="search_btn" type="search" name="search" placeholder="Search">
                    <button style="margin-bottom: 10px;width:73px;height:38px;" class="btn btn-outline-success" type="submit">Search</button>
                    <a style="margin-bottom: 6px;" class="btn btn-danger" href="/" role="button">Log out</a>
                    <a style="margin-bottom: 6px;background-color:#198754;border-color: #198754;" class="btn btn-danger" href="../admin_forms/statistics_form.php" role="button">Statistics</a>
                </form>
                
            </div>
        </div>
    </div>

    <h3 class="mt-4 mb-4" style="margin-left:10px;">Панель администратора:</h3>

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
        foreach ($bikes as $item) {
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
        <?php
        }
        ?>
    </table>

    <a href="../admin_forms/add_bike_form.php"><h3 class="btn btn-success mt-3" role="button" style="margin-left: 10px;">Добавить товар</h3></a>

    <table style="margin-left:10px;" class="mt-2">
        <tr>
            <th>id</th>
            <th>Название</th>
            <th>&#9998;</th>
            <th>&#10006;</th>
        </tr>

        <?php
            foreach($categorie_id as $item) {
            ?>
                <tr>
                    <td><?php echo $item[0]?></td>
                    <td><?php echo $item[1]?></td>
                    <td><a style="padding:6px;" href="../admin_forms/categorie_update_form.php?id=<?php echo $item[0] ?>"><img style="height:25px;width:25px;" src="https://cdn-icons-png.flaticon.com/512/1159/1159633.png"></a></td>
                    <td class="delete_button"><a style="padding:6px;color:rgb(204, 45, 45);" href="../admin_operation/delete_operations/categorie_delete.php?id=<?php echo $item[0] ?>"><img style="height:25px;width:25px;" src="https://cdn-icons-png.flaticon.com/512/1345/1345823.png"></a></td>
                </tr>
            <?php
            }
        ?>  
    </table>

    <a href="../admin_forms/add_categorie_form.php"><h3 class="btn btn-success mt-3" role="button" style="margin-left: 10px;">Добавить категорию</h3></a>

    <footer style="background-color:#212529; color:white;" class="page-footer font-small">

    <div class="footer-copyright text-center py-3" style="margin-top:10px;">© 2021 Copyright:
    <a href="/" style="text-decoration:none; color:#80ff74;"> Bike.com.ua</a>
    </div>
    
    </footer>


</body>

</html>