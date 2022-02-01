<?php

require_once 'config/connect.php';

$maxValue = mysqli_query($connect, "SELECT MAX(bikes.price) FROM bikes");
$maxValue = mysqli_fetch_all($maxValue);

/* $quantity_in_category = mysqli_query($connect, "SELECT categorie_id.id_categorie, categorie_id.title, COUNT(*) as cnt FROM categorie_id, bikes WHERE categorie_id.id_categorie = bikes.categorie_id GROUP BY categorie_id.id_categorie ORDER BY COUNT(*) DESC");
$quantity_in_category = mysqli_fetch_all($quantity_in_category); */

/* Пагинация */

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else { 
    $pageno = 1;
}
$size_page = 3;
$offset = ($pageno - 1) * $size_page;

$count_sql = "SELECT COUNT(*) FROM `bikes`";
$result = mysqli_query($connect, $count_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $size_page);

/* Пагинация */

function getOptions()
{

    $categorie_ID = (isset($_GET['categorie'])) ? "'" . implode("','", $_GET['categorie']) . "'" : null;
    $minPrice = (isset($_GET['from_price'])) ? (int)$_GET['from_price'] : 0;
    $maxPrice = (isset($_GET['to_price'])) ? (int)$_GET['to_price'] : 999999;
    $frame_material = (isset($_GET['frame_material'])) ? "'" . implode("','", $_GET['frame_material']) . "'" : null;
    $wheel_size = (isset($_GET['wheel_size'])) ?  "'" . implode("','", $_GET['wheel_size']) . "'" : null;
    $brake_type = (isset($_GET['brake_type'])) ?  "'" . implode("','", $_GET['brake_type']) . "'" : null;
    $model_year = (isset($_GET['model_year'])) ?  "'" . implode("','", $_GET['model_year']) . "'" : null;
    $fork_type = (isset($_GET['fork_type'])) ? "'" . implode("','", $_GET['fork_type']) . "'" : null;
    $sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'Rating';

    return array(
        'categorie' => $categorie_ID,
        'min_price' => $minPrice,
        'max_price' => $maxPrice,
        'frame_material' => $frame_material,
        'wheel_size' => $wheel_size,
        'brake_type' => $brake_type,
        'model_year' => $model_year,
        'fork_type' => $fork_type,
        'sort' => $sort
    );
}

$options = getOptions();

function getGoods($options)
{

    $minPrice = $options['min_price'];
    $maxPrice = $options['max_price'];
    $cat = $options['categorie'];
    $frame_material = $options['frame_material'];
    $wheel_size = $options['wheel_size'];
    $brake_type = $options['brake_type'];
    $model_year = $options['model_year'];
    $fork_type = $options['fork_type'];
    $sort = $options['sort'];

    $brandsWhere =
        ($cat !== null) ? " categorie_id in ($cat) AND " : '';

    $frame_materialWhere =
        ($frame_material !== null) ? " frame_material in ($frame_material) AND " : '';

    $wheel_sizeWhere =
        ($wheel_size !== null) ? " wheel_size in ($wheel_size) AND " : '';

    $brake_typeWhere =
        ($brake_type !== null) ? " brake_type in ($brake_type) AND " : '';

    $model_yearWhere =
        ($model_year !== null) ? " model_year in ($model_year) AND " : '';

    $fork_typeWhere =
        ($fork_type !== null) ? " fork_type in ($fork_type) AND " : '';

    if ($sort == 'Rating') {

        return $query = "SELECT bikes.bike_id, bikes.bike_name, bikes.categorie_id, bikes.description, 
            bikes.img_src, bikes.frame_material, bikes.wheel_size, bikes.brake_type, bikes.model_year, bikes.fork_type,
            bikes.weight, bikes.equipment, bikes.quantity, bikes.price, AVG(comments.bike_rate)
            FROM bikes
            LEFT JOIN comments on bikes.bike_id = comments.bike_id
            WHERE 
            $brandsWhere 
            $frame_materialWhere
            $wheel_sizeWhere 
            $brake_typeWhere
            $model_yearWhere
            $fork_typeWhere
            bikes.price BETWEEN $minPrice AND $maxPrice
            GROUP BY bikes.bike_id 
            ORDER BY AVG(comments.bike_rate) DESC";
    }

    return $query = "SELECT bikes.bike_id, bikes.bike_name, bikes.categorie_id, bikes.description, 
        bikes.img_src, bikes.frame_material, bikes.wheel_size, bikes.brake_type, bikes.model_year, bikes.fork_type,
        bikes.weight, bikes.equipment, bikes.quantity, bikes.price, AVG(comments.bike_rate)
        FROM bikes
        LEFT JOIN comments on bikes.bike_id = comments.bike_id
        WHERE 
        $brandsWhere 
        $frame_materialWhere
        $wheel_sizeWhere 
        $brake_typeWhere
        $model_yearWhere
        $fork_typeWhere
        bikes.price BETWEEN $minPrice AND $maxPrice
        GROUP BY bikes.bike_id 
        ORDER BY bikes.price $sort";
}

$str = getGoods($options);
//echo $str;

$bike = mysqli_query($connect, $str);
$bike_row_count = mysqli_num_rows($bike);
$bike = mysqli_fetch_all($bike);

$from = (isset($_GET['from_price'])) ? $from = $_GET['from_price'] : '';
$to = (isset($_GET['to_price'])) ? $to = $_GET['to_price'] : '';



$cat_arr = (isset($_GET['categorie'])) ? $cat_arr = $_GET['categorie'] : '';
$frame_arr = (isset($_GET['frame_material'])) ? $frame_arr = $_GET['frame_material'] : '';
$wheel_arr = (isset($_GET['wheel_size'])) ? $wheel_arr = $_GET['wheel_size'] : '';
$brake_arr = (isset($_GET['brake_type'])) ? $brake_arr = $_GET['brake_type'] : '';
$frame_arr = (isset($_GET['frame_material'])) ? $frame_arr = $_GET['frame_material'] : '';
$year_arr = (isset($_GET['model_year'])) ? $year_arr = $_GET['model_year'] : '';
$fork_arr = (isset($_GET['fork_type'])) ? $fork_arr = $_GET['fork_type'] : '';

?>

<?php function view($arr)
{

    foreach ($arr as $item) { ?>
        <div class="col-4 mb-4 mt-5">
            <div class="example">
                <a href="vendor/view_bike.php?id=<?= $item[0] ?>"><img src="<?php echo $item[4] ?>" alt="Pride Rocx 8.3" height="200px"></a>
                <p class="title"><?= $item[1] ?></p>
                <p class="in_stock" style="margin-bottom:5px;"><b><?php echo ($item[12] > 0) ? "В наличии" : "Нет в наличии" ?></b></p>
                <p class="title" style="margin-top: 15px; margin-bottom:9px; font-size: 14px;">Рейтинг: <b><?php echo $item[14] != NULL ? round($item[14], 1) . "/5" : "-" ?></b></p>
                <p class="price"><b>Цена:</b> <?= $item[13] . " грн" ?></p>
            </div>
        </div>
    <?php } ?>
<?php } ?>


<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="style/main.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="https://img.icons8.com/external-filled-outline-chattapat-/50/000000/external-bicycle-holiday-filled-outline-chattapat-.png" />
    <title>VeloGo</title>
</head>

<body>

    <div class="content">

        <div class="container-fluid">
            <div class="row">

                <div class="col-8" style=background-color:#212529;height:56px;>
                    <p class="logo"><a href="/" style="text-decoration:none;color:white;font-family:comic sans ms;">VeloGo</a></p>
                </div>

                <div class="col-4" style=background-color:#212529;height:56px;>

                    <form style="margin-left: -5%" action="vendor/search.php" method="GET">
                        <input required class="search_btn" type="search" name="search" placeholder="Я ищу...">
                        <button class="btn btn-outline-success" type="submit">Поиск</button>
                        <a style="margin-bottom: 6px;" class="btn btn-success" href="admin_forms/login_form.php" role="button">Admin</a>
                    </form>

                </div>
            </div>
        </div>

        <div class="container" style="max-width:1600px;">
            <div class="row">
                <div class="col-3 mt-4">

                    <div class="filtration">

                        <form action="/" method="GET">

                            <div class="body_filtr">
                                <div class="variations">
                                    <p class="title" style="margin-top:5px;">Подобрать по цене
                                    <p>
                                        <input placeholder="От" type="text" name="from_price" <?php if (isset($_GET['from_price'])) echo "value=$from" ?> value="0">
                                        <span>грн</span>
                                        <input placeholder="До" type="text" name="to_price" <?php if (isset($_GET['to_price'])) echo "value=$to" ?> style="margin-bottom:5px;" value="<?php foreach ($maxValue as $item) echo $item[0] ?>">
                                        <span>грн</span>
                                </div>
                            </div>

                            <div class="body_filtr">
                                <div class="variations sort">
                                    <p class="title" style="margin-top:5px;">Сортировка
                                    <p>
                                        <select class="sort" name="sort" style="padding:3px;margin-left:10px;margin-top:3px;margin-bottom:3px; font-size:15px;">
                                            <option <?php if (isset($_GET['sort']) && $_GET['sort'] == 'Rating') echo 'selected' ?> name="Rating" value="Rating">По рейтингу</option>
                                            <option <?php if (isset($_GET['sort']) && $_GET['sort'] == 'ASC') echo 'selected' ?> name="ASC" value="ASC">От дешевых к дорогим</option>
                                            <option <?php if (isset($_GET['sort']) && $_GET['sort'] == 'DESC') echo 'selected' ?> name="DESC" value="DESC">От дорогих к дешевым</option>
                                        </select>
                                </div>
                            </div>

                            <div class="body_filtr">
                                <div class="variations">
                                    <p class="title">Тип велосипеда
                                    <p>
                                        <label><input <?php for ($i = 0; $i < count($cat_arr); $i++) if ($cat_arr[$i] == '1') echo 'checked'; ?> type="checkbox" value="1" name="categorie[]" />Горный</label>
                                        <br><label><input <?php for ($i = 0; $i < count($cat_arr); $i++) if ($cat_arr[$i] == '2') echo 'checked'; ?> type="checkbox" value="2" name="categorie[]" />Городской</label>
                                        <br><label><input <?php for ($i = 0; $i < count($cat_arr); $i++) if ($cat_arr[$i] == '3') echo 'checked'; ?> type="checkbox" value="3" name="categorie[]" />Шоссейный</label>
                                        <br><label><input <?php for ($i = 0; $i < count($cat_arr); $i++) if ($cat_arr[$i] == '4') echo 'checked'; ?> type="checkbox" value="4" name="categorie[]" />Гравийный</label>
                                </div>
                            </div>

                            <div class="body_filtr">
                                <div class="variations">
                                    <p class="title">Материал рамы
                                    <p>
                                        <label><input <?php for ($i = 0; $i < count($frame_arr); $i++) if ($frame_arr[$i] == 'Алюминий') echo 'checked'; ?> type="checkbox" value="Алюминий" name="frame_material[]" />Алюминий</label>
                                        <br><label><input <?php for ($i = 0; $i < count($frame_arr); $i++) if ($frame_arr[$i] == 'Хром-молибден') echo 'checked'; ?> type="checkbox" value="Хром-молибден" name="frame_material[]" />Хром-молибден</label>
                                        <br><label><input <?php for ($i = 0; $i < count($frame_arr); $i++) if ($frame_arr[$i] == 'Карбон') echo 'checked'; ?> type="checkbox" value="Карбон" name="frame_material[]" />Карбон</label>
                                </div>
                            </div>

                            <div class="body_filtr">

                                <div class="variations">
                                    <p class="title">Размер колес
                                    <p>
                                        <label><input <?php for ($i = 0; $i < count($wheel_arr); $i++) if ($wheel_arr[$i] == '29') echo 'checked'; ?> type="checkbox" value="29" name="wheel_size[]" />29</label>
                                        <br><label><input <?php for ($i = 0; $i < count($wheel_arr); $i++) if ($wheel_arr[$i] == '28') echo 'checked'; ?> type="checkbox" value="28" name="wheel_size[]" />28</label>
                                        <br><label><input <?php for ($i = 0; $i < count($wheel_arr); $i++) if ($wheel_arr[$i] == '27.5') echo 'checked'; ?> type="checkbox" value="27.5" name="wheel_size[]" />27.5</label>
                                        <br><label><input <?php for ($i = 0; $i < count($wheel_arr); $i++) if ($wheel_arr[$i] == '26') echo 'checked'; ?> type="checkbox" value="26" name="wheel_size[]" />26</label>
                                </div>
                            </div>

                            <div class="body_filtr">

                                <div class="variations">
                                    <p class="title">Тип тормозов
                                    <p>
                                        <label><input <?php for ($i = 0; $i < count($brake_arr); $i++) if ($brake_arr[$i] == 'Диск гидр.') echo 'checked'; ?> type="checkbox" value="Диск гидр." name="brake_type[]" />Диск гидр.</label>
                                        <br><label><input <?php for ($i = 0; $i < count($brake_arr); $i++) if ($brake_arr[$i] == 'Диск мех.') echo 'checked'; ?> type="checkbox" value="Диск мех." name="brake_type[]" />Диск мех.</label>
                                        <br><label><input <?php for ($i = 0; $i < count($brake_arr); $i++) if ($brake_arr[$i] == 'Ободные') echo 'checked'; ?> type="checkbox" value="Ободные" name="brake_type[]" />Ободные</label>
                                </div>
                            </div>

                            <div class="body_filtr">

                                <div class="variations">
                                    <p class="title">Модельный год
                                    <p>
                                        <label><input <?php for ($i = 0; $i < count($year_arr); $i++) if ($year_arr[$i] == '2020') echo 'checked'; ?> type="checkbox" value="2020" name="model_year[]" />2020</label>
                                        <br><label><input <?php for ($i = 0; $i < count($year_arr); $i++) if ($year_arr[$i] == '2021') echo 'checked'; ?> type="checkbox" value="2021" name="model_year[]" />2021</label>
                                        <br><label><input <?php for ($i = 0; $i < count($year_arr); $i++) if ($year_arr[$i] == '2022') echo 'checked'; ?> type="checkbox" value="2022" name="model_year[]" />2022</label>
                                </div>
                            </div>

                            <div class="body_filtr">

                                <div class="variations">
                                    <p class="title">Тип вилки
                                    <p>
                                        <label><input <?php for ($i = 0; $i < count($fork_arr); $i++) if ($fork_arr[$i] == 'Регидная(жесткая)') echo 'checked'; ?> type="checkbox" value="Регидная(жесткая)" name="fork_type[]" />Регидная(жесткая)</label>
                                        <br><label><input <?php for ($i = 0; $i < count($fork_arr); $i++) if ($fork_arr[$i] == 'Карбоновая') echo 'checked'; ?> type="checkbox" value="Карбоновая" name="fork_type[]" />Карбоновая</label>
                                        <br><label><input <?php for ($i = 0; $i < count($fork_arr); $i++) if ($fork_arr[$i] == 'Пружинно-эластомерная') echo 'checked'; ?> type="checkbox" value="Пружинно-эластомерная" name="fork_type[]" />Пружинно-эластомерная</label>
                                        <br><label><input <?php for ($i = 0; $i < count($fork_arr); $i++) if ($fork_arr[$i] == 'Пружинно-масленая') echo 'checked'; ?> type="checkbox" value="Пружинно-масленая" name="fork_type[]" />Пружинно-масленая</label>
                                        <br><label><input <?php for ($i = 0; $i < count($fork_arr); $i++) if ($fork_arr[$i] == 'Воздушная') echo 'checked'; ?> type="checkbox" value="Воздушная" name="fork_type[]" />Воздушная</label>
                                </div>
                            </div>
                            <button style="margin-bottom: 0px; font-weight: bold;" class="filtration_btn" type="submit">Ок</button>
                            <button class="filtration_btn" type="submit" onclick="unchecked();">Сбросить фильтры</button>
                        </form>

                    </div>
                </div>

                <div class="col-9 mt-4">
                    <div class="row">
                        <?php if ($bike_row_count > 0) view($bike);
                        else echo "<h2>Ничего не найдено!</h2>"; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <footer style="background-color:#212529; color:white;" class="page-footer font-small">

        <div class="footer-copyright text-center py-3">© 2021 Copyright:
            <a href="/" style="text-decoration:none; color:#80ff74;"> Bike.com.ua</a>
        </div>

    </footer>

    <script>
        function unchecked() {
            var ele = document.querySelectorAll("input[type=checkbox]");
            for (var i = 0; i < ele.length; i++) {
                ele[i].checked = false;
            }
        }
    </script>

</body>

</html>