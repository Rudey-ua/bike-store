<?php
require_once '../config/connect.php';

$bike_id = $_GET['id'];

$bike = mysqli_query($connect, "SELECT bikes.bike_id ,bikes.bike_name, bikes.description, 
bikes.img_src, bikes.frame_material, bikes.wheel_size, bikes.brake_type, bikes.model_year, bikes.fork_type,
bikes.weight, bikes.equipment, bikes.quantity, bikes.price, categorie_id.title
FROM bikes, categorie_id
WHERE categorie_id.id_categorie = bikes.categorie_id AND bikes.bike_id = '$bike_id'");

$bike = mysqli_fetch_all($bike);

$bike_categorie = mysqli_query($connect, "SELECT categorie_id.title FROM categorie_id, bikes WHERE categorie_id.id_categorie = bikes.categorie_id and bikes.bike_id = '$bike_id'");
$bike_categorie = mysqli_fetch_all($bike_categorie);

$comments = mysqli_query($connect, "SELECT * FROM `comments` WHERE comments.bike_id = '$bike_id'");
$comments_row_count = mysqli_num_rows($comments);
$comments = mysqli_fetch_all($comments);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/314f59b6f9.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../style/main.css" rel="stylesheet">
    <link href="../style/table_style.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="https://img.icons8.com/external-filled-outline-chattapat-/50/000000/external-bicycle-holiday-filled-outline-chattapat-.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../js/js-image-zoom.js"></script>
    
    <title><?php foreach ($bike as $item) echo $item[1] ?></title>
    <style>
        @media print{
            body{
                visibility: hidden;
            }
            .print{
                visibility: visible;
            }
        }
    </style>
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

            <div class="col-md title mb-4 print">
                <h3><?php foreach ($bike as $item) echo $item[1] ?></h3>
            </div>

        </div>

        <div class="row print">
            <div class="col-md">
                <div id="img-container">
                    <img class="print" src="<?php foreach ($bike as $item) echo $item[3] ?>" alt="Pride Rocx 8.3" height="400px">
                </div>
            </div>
            <div class="col-md buy">
                <h3 style="margin-bottom:0px;"><? foreach ($bike as $item) echo $item[12] ?> грн</h3>
                <?php if ($item[11] > 0) { ?>
                    <label><a style="color:white;text-decoration:none;" href="../admin_forms/buy_form.php?id=<?php echo $bike_id ?>"><button style="width:230px;" class="buy_button"><i style="padding-right: 10px;" class="fas fa-shopping-cart fa-lg"></i></i>Купить</button></a></label>
                    <label><button style="width:75px; height:42px; background-color:gray" onclick="javascript:window.print()"><i class="fas fa-print fa-lg"></i></button></label>
                <?php } else { ?>
                    <label><a style="color:black;"><button style="background-color:black;" class="buy_button">Нет в наличии</button></a></label>
                    <label><button style="width:75px; height:42px; background-color:gray" onclick="javascript:window.print()"><i class="fas fa-print fa-lg"></i></button></label>
                <?php } ?>
            </div>
        </div>

    </div>

    <div class="container mt-5">
        <div class="row print">
            <h3 class="mb-4">Описание:</h3>
            <p><?php foreach ($bike as $item) echo $item[2] ?></p>
        </div>

        <div class="row mt-2 print">
            <h3>Характеристики:</h3>
        </div>

        <div class="row mt-4 print">
            <table class="table_block">
                <tr>
                    <th>Название велосипеда</th>
                    <th>Тип велосипеда</th>
                    <th>Материал рамы</th>
                    <th>Размер колес</th>
                    <th>Тип тормозов</th>
                    <th>Год выпуска</th>
                    <th>Тип вилки</th>
                    <th>Вес</th>
                    <th>Оборудование</th>
                    <th>Цена</th>
                </tr>

                <?php
                foreach ($bike as $item) {
                ?>
                    <tr>
                        <td><?php echo $item[1] ?></td>
                        <td><?php echo $item[13] ?></td>
                        <td><?php echo $item[4] ?></td>
                        <td><?php echo $item[5] ?></td>
                        <td><?php echo $item[6] ?></td>
                        <td><?php echo $item[7] ?></td>
                        <td><?php echo $item[8] ?></td>
                        <td><?php echo $item[9] ?></td>
                        <td><?php echo $item[10] ?></td>
                        <td><?php echo $item[12] ?></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>

        <?php if ($comments_row_count > 0) { ?>

            <div class="row mt-4 print">
                <div class="review">
                    <h3>Отзывы покупателей:</h3>
                </div>
            </div>

            <?php
            foreach ($comments as $item) { ?>
                <div class="row print">
                    <div class="col-md">
                        <b style="font-size: 20px;"><?= $item[1] ?></b>
                        <div class="rating-mini">
                            <?php for ($i = 0; $i < 5; $i++) {
                                if ($i < $item[4]) { ?>
                                    <span class="active"></span>
                                <?php } else { ?>
                                    <span></span>
                                <?php } ?>
                            <?php } ?>
                        </div>
                        <span style="margin-left: 10px;"><?= $item[5] ?></span>
                        <div class="comment_text">
                            <p><?= $item[2] ?></p>
                        </div>
                        <hr>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>

        <div class="row mt-3">
            <div class="review">
                <h3>Написать отзыв:</h3>
            </div>
        </div>

        <div class="row">
            <div class="review">
                <form action="../admin_operation/create_operations/add_comment.php" method="post">

                    <input type="hidden" name="bike_id" value="<?= $bike_id ?>">

                    <p style="font-size:20px;">Имя:</p>

                    <input type="text" name="Name" required style="height:35px;">

                    <p style="font-size:20px;">Комментарий:</p>

                    <textarea name="Comment_text" required style="width:400px;"></textarea></p>

                    <div class="form-group">
                        <label style="font-size:20px; margin-bottom: 10px;"><em>Ваша оценка:</em></label>
                        <div class="star-rating">
                            <div class="star-rating__wrap">
                                <input required class="star-rating__input" id="star-5" type="radio" name="bike_rate" value="5">
                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-5" title="Отлично"></label>
                                <input required class="star-rating__input" id="star-4" type="radio" name="bike_rate" value="4">
                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-4" title="Хорошо"></label>
                                <input required class="star-rating__input" id="star-3" type="radio" name="bike_rate" value="3">
                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-3" title="Удовлетворительно"></label>
                                <input required class="star-rating__input" id="star-2" type="radio" name="bike_rate" value="2">
                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-2" title="Плохо"></label>
                                <input required class="star-rating__input" id="star-1" type="radio" name="bike_rate" value="1">
                                <label class="star-rating__ico fa fa-star-o fa-lg" for="star-1" title="Ужасно"></label>
                            </div>
                        </div>
                    </div>

                    <button class="add_button" type="submit">Добавить комментарий</button>

                </form>
            </div>
        </div>

    </div>

    <footer style="background-color:#212529; color:white;" class="page-footer font-small">

        <div class="footer-copyright text-center py-3">© 2021 Copyright:
            <a href="/" style="text-decoration:none; color:#80ff74;"> Bike.com.ua</a>
        </div>

    </footer>

    <script>
        var options1 = {
            width: 700,
            zoomWidth: 500,
            offset: {
            vertical: 0,
            horizontal: 10
            }
        };
        new ImageZoom(document.getElementById("img-container"), options1);
    </script>

</body>

</html>