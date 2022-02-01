<?php
require_once '../config/connect.php';

$categorie_id = mysqli_query($connect, "SELECT * FROM `categorie_id`");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/admin_table.css">
    <link rel="shortcut icon" type="image/png" href="https://img.icons8.com/external-filled-outline-chattapat-/50/000000/external-bicycle-holiday-filled-outline-chattapat-.png"/>
    <title>Добавление велосипеда</title>
</head>

<body>

    <h2 style="font-size:28px;margin-bottom:0;">Добавить новый товар</h2>

    <form action="../admin_operation/create_operations/add_bike.php" method="post">

        <br><input required type="text" name="bike_name" placeholder="Название велосипеда">

        <br><textarea required name="description" style="width:252px;height:50px;font-size:15px;" placeholder="Описание"></textarea>

        <br><select required class="select" name="categorie_id" id="categorie_id" style="padding:5px;font-size: 16px;margin-bottom:15px;width:258px;">

            <option value="" disabled selected>Выберите категорию:</option>

            <?php
            while ($row = mysqli_fetch_array($categorie_id)) {
            ?>
                <option value="<?php echo $row['id_categorie'] ?>"><?php echo $row['title'] ?></option>
            <?php } ?>

        </select>

        <br><input required type="text" name="img_src" class="input" placeholder="Ссылка на изображение">

        <br><select required name="frame_material" style="padding:5px;font-size: 16px;margin-bottom:15px;width:258px;">

            <option value="" disabled selected>Материал рамы:</option>
            <option value="Алюминий">Алюминий</option>
            <option value="Хром-молибден">Хром-молибден</option>
            <option value="Карбон">Карбон</option>

        </select>

        <br><select required name="wheel_size" style="padding:5px;font-size: 16px;margin-bottom:15px;width:258px;">

            <option value="" disabled selected>Размер колес:</option>
            <option value="29">29</option>
            <option value="28">28</option>
            <option value="27.5">27.5</option>
            <option value="26">26</option>

        </select>

        <br><select required name="brake_type" style="padding:5px;font-size: 16px;margin-bottom:15px;width:258px;">

            <option value="" disabled selected>Тип тормозов</option>
            <option value="Диск гидр.">Диск гидр.</option>
            <option value="Диск мех.">Диск мех.</option>
            <option value="Ободные">Ободные</option>

        </select>

        <br><select required name="model_year" style="padding:5px;font-size: 16px;margin-bottom:15px;width:258px;">

            <option value="" disabled selected>Модельный год</option>
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>

        </select>

        <br><select required name="fork_type" style="padding:5px;font-size: 16px;margin-bottom:15px;width:258px;">

            <option value="" disabled selected>Тип вилки</option>
            <option value="Регидная(жесткая)">Регидная(жесткая)</option>
            <option value="Карбоновая">Карбоновая</option>
            <option value="Пружинно-эластомерная">Пружинно-эластомерная</option>
            <option value="Пружинно-масленая">Пружинно-масленая</option>
            <option value="Воздушная">Воздушная</option>

        </select>

        <br><input required type="number" step="0.01" name="weight" placeholder="Вес">

        <br><input required type="text" name="equipment" placeholder="Оборудование">

        <br><input required type="number" name="quantity" placeholder="Количество">

        <br><input required type="number" name="price" placeholder="Цена">

        <br><button type="submit">Добавить товар</button>

    </form>

</body>

</html>