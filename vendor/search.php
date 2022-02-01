<?php 

require_once '../config/connect.php';

$search = $_GET['search'];

$search_result = mysqli_query($connect, "SELECT * FROM `bikes` WHERE bikes.bike_name LIKE '%$search%' OR `description` LIKE '%$search%'");

$bike_row_count = mysqli_num_rows($search_result);

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
    <link rel="shortcut icon" type="image/png" href="https://img.icons8.com/external-filled-outline-chattapat-/50/000000/external-bicycle-holiday-filled-outline-chattapat-.png"/>
    <title>Поиск</title>
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col" style=background-color:#212529;height:56px;>
            <p style="margin-left:16%;margin-top:2px;" class="logo"><a href="/" style="text-decoration:none;color:white;font-style:normal;font-family:comic sans ms;">VeloGo</a></p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col mt-4">
                <h3>Результаты поиска: <?="«".$search."»"?></h3>
            </div>
        </div>
        <?php if($bike_row_count > 0) { ?>
    </div>

    

    <div class="container">
        <div class="row review" style="background: #f2f2f2;padding-top:8px;padding-bottom:20px;margin-bottom:1.2rem;">
            <div class="col mt-3">
                <form action="/vendor/search.php" method="GET">
                    <span style="font-size:20px;">Сортировать по: </span>
                    <select onchange="this.form.submit()" class="sort" name="sort" id="sort" style="padding:3px;">
                        <option value="" disabled selected>Выберите тип сортировки</option>
                        <option name = "ASC" value="ASC">От дешевых к дорогим</option>
                        <option name = "DESC" value="DESC">От дорогих к дешевым</option>
                        <input type="hidden" name="search" value="<?= $search?>">
                    </select>
                </form>
            </div>  
        </div>
    </div>

    <div class="container">

        <div class="row">

        <?php
            if (isset($_GET['sort'])) {
                if ($_GET['sort'] == "ASC") {
                    $filt = mysqli_query($connect, "SELECT * FROM `bikes` WHERE bikes.bike_name LIKE '%$search%' OR bikes.description LIKE '%$search%' ORDER BY `bikes`.`price` ASC;");
                    $filt = mysqli_fetch_all($filt); ?>
                    <?php
                    foreach ($filt as $item) {
                    ?>
                        <div class="col-4 mb-4 mt-5">
                            <div class="example">
                                <a href="view_bike.php?id=<?= $item[0] ?>"><img src="<?php echo $item[4] ?>" alt="Pride Rocx 8.3" height="200px"></a>
                                <p class="title"><?= $item[1] ?></p>
                                <p class="in_stock"><b>В наличии</b></p>
                                <p class="price"><b>Цена:</b> <?= $item[13] ?></p>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            <?php } ?>

            <?php
            if (isset($_GET['sort'])) {
                if ($_GET['sort'] == "DESC") {
                    $filt = mysqli_query($connect, "SELECT * FROM `bikes` WHERE bikes.bike_name LIKE '%$search%' OR bikes.description LIKE '%$search%' ORDER BY `bikes`.`price` DESC;");
                    $filt = mysqli_fetch_all($filt); ?>
                    <?php
                    foreach ($filt as $item) {
                    ?>
                        <div class="col-4 mb-4 mt-5">
                            <div class="example">
                                <a href="view_bike.php?id=<?= $item[0] ?>"><img src="<?php echo $item[4] ?>" alt="Pride Rocx 8.3" height="200px"></a>
                                <p class="title"><?= $item[1] ?></p>
                                <p class="in_stock"><b>В наличии</b></p>
                                <p class="price"><b>Цена:</b> <?= $item[13] ?></p>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            <?php } ?>

            <?php
                if(isset($_GET['sort']) == false) { ?>
                <?php
                    foreach ($search_result as $item) {
                    ?>
                        <div class="col-4 mb-4 mt-5">
                            <div class="example">
                                <a href="view_bike.php?id=<?= $item[0] ?>"><img src="<?php echo $item[4] ?>" alt="Pride Rocx 8.3" height="200px"></a>
                                <p class="title"><?= $item[1] ?></p>
                                <p class="in_stock"><b>В наличии</b></p>
                                <p class="price"><b>Цена:</b> <?= $item[13] ?></p>
                            </div>
                        </div>
                    <?php } ?>    
                <?php } ?>
            <?php }else echo "<h4 style='margin-top:20px; font-size: 22px;'>К сожалению, на странице нет записей.</h4><p style='margin-top:15px;'>Попробуйте уточнить ваш запрос...</p>" ?>
        </div>
    </div>
</body>
</html>