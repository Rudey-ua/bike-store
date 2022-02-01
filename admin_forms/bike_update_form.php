<?php

require_once '../config/connect.php';

$bike_id = $_GET['id'];

$bike = mysqli_query($connect, "SELECT * FROM `bikes` WHERE `bike_id` = '$bike_id'");

$bike = mysqli_fetch_all($bike);

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
    <title>Редакторовать товар</title>
</head>
<body>
    
<h2 style="font-size:28px;margin-bottom:15px;">Редактировать велосипед</h2>

    <form action="../admin_operation/update_operations/bike_update.php" method="post">

        <input type="hidden" name="id" value="<?= $bike_id?>">

        <input type="text" name="bike_name" value="<? foreach($bike as $item) echo $item[1] ?>">

        <br><select name="categorie" id="categorie" style="padding:5px;font-size: 16px;margin-bottom:15px;width:258px;">

            <option disabled selected>Выберите категорию:</option>

            <?php
                while($row = mysqli_fetch_array($categorie_id)) { 
            ?>
                    <option value="<?php echo $row['id_categorie']?>"><?php echo $row['title']?></option>
            <?php
                }
            ?>

        </select>

        <br><textarea name="description" style="width:500px;height:150px;font-size:15px;margin-bottom:10px;"><? foreach($bike as $item) echo $item[3]?></textarea>

        <br><input type="text" name="img_src" value="<? foreach($bike as $item) echo $item[4] ?>">

        <br><select name="frame_material" style="padding:5px;font-size: 16px;margin-bottom:15px;width:258px;">
                <?php foreach($bike as $item) { ?>
                    <option disabled selected><?php echo $item[5]?></option> 
                    <?php if($item[5] == "Алюминий") { ?>
                        <option value="Хром-молибден">Хром-молибден</option>
                        <option value="Карбон">Карбон</option>
                    <?php } ?>
                    
                    <?php if($item[5] == "Хром-молибден") { ?>
                        <option value="Алюминий">Алюминий</option>
                        <option value="Карбон">Карбон</option>
                    <?php } ?>

                    <?php if($item[5] == "Карбон") { ?>
                        <option value="Хром-молибден">Хром-молибден</option>
                        <option value="Алюминий">Алюминий</option>
                    <?php } ?>
                <?php } ?>
        </select>


        <br><select name="wheel_size" style="padding:5px;font-size: 16px;margin-bottom:15px;width:258px;">
                <?php foreach($bike as $item) { ?>
                    <option disabled selected><?php echo $item[6]?></option> 
                    <?php if($item[6] == "29") { ?>
                        <option value="28">28</option>
                        <option value="27.5">27.5</option>
                        <option value="26">26</option>
                    <?php } ?>
                    
                    <?php if($item[6] == "28") { ?>
                        <option value="29">29</option>
                        <option value="27.5">27.5</option>
                        <option value="26">26</option>
                    <?php } ?>

                    <?php if($item[6] == "27.5") { ?>
                        <option value="29">29</option>
                        <option value="28">28</option>
                        <option value="26">26</option>
                    <?php } ?>

                    <?php if($item[6] == "26") { ?>
                        <option value="29">29</option>
                        <option value="28">28</option>
                        <option value="27.5">27.5</option>
                    <?php } ?>
                <?php } ?>
        </select>

        <br><select name="brake_type" style="padding:5px;font-size: 16px;margin-bottom:15px;width:258px;">
                <?php foreach($bike as $item) { ?>
                    <option disabled selected><?php echo $item[7]?></option> 
                    <?php if($item[7] == "Диск гидр.") { ?>
                        <option value="Диск мех.">Диск мех.</option>
                        <option value="Ободные">Ободные</option>
                    <?php } ?>
                    
                    <?php if($item[7] == "Диск мех.") { ?>
                        <option value="Диск гидр.">Диск гидр.</option>
                        <option value="Ободные">Ободные</option>
                    <?php } ?>

                    <?php if($item[7] == "Ободные") { ?>
                        <option value="Диск гидр.">Диск гидр.</option>
                        <option value="Диск мех.">Диск мех.</option>
                    <?php } ?>
                <?php } ?>
        </select>

        <br><select name="model_year" style="padding:5px;font-size: 16px;margin-bottom:15px;width:258px;">
                <?php foreach($bike as $item) { ?>
                    <option disabled selected><?php echo $item[8]?></option> 
                    <?php if($item[8] == "2020") { ?>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                    <?php } ?>
                    
                    <?php if($item[8] == "2021") { ?>
                        <option value="2020">2020</option>
                        <option value="2022">2022</option>
                    <?php } ?>

                    <?php if($item[8] == "2022") { ?>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                    <?php } ?>
                <?php } ?>
        </select>

        <br><select name="fork_type" style="padding:5px;font-size: 16px;margin-bottom:15px;width:258px;">
                <?php foreach($bike as $item) { ?>
                    <option disabled selected><?php echo $item[9]?></option> 
                    <?php if($item[9] == "Регидная(жесткая)") { ?>
                        <option value="Карбоновая">Карбоновая</option>
                        <option value="Пружинно-эластомерная">Пружинно-эластомерная</option>
                        <option value="Пружинно-масленая">Пружинно-масленая</option>
                        <option value="Воздушная">Воздушная</option>
                    <?php } ?>
                    
                    <?php if($item[9] == "Карбоновая") { ?>
                        <option value="Регидная(жесткая)">Регидная(жесткая)</option>
                        <option value="Пружинно-эластомерная">Пружинно-эластомерная</option>
                        <option value="Пружинно-масленая">Пружинно-масленая</option>
                        <option value="Воздушная">Воздушная</option>
                    <?php } ?>

                    <?php if($item[9] == "Пружинно-эластомерная") { ?>
                        <option value="Регидная(жесткая)">Регидная(жесткая)</option>
                        <option value="Карбоновая">Карбоновая</option>
                        <option value="Пружинно-масленая">Пружинно-масленая</option>
                        <option value="Воздушная">Воздушная</option>
                    <?php } ?>

                    <?php if($item[9] == "Пружинно-масленая") { ?>
                        <option value="Регидная(жесткая)">Регидная(жесткая)</option>
                        <option value="Карбоновая">Карбоновая</option>
                        <option value="Пружинно-эластомерная">Пружинно-эластомерная</option>
                        <option value="Воздушная">Воздушная</option>
                    <?php } ?>

                    <?php if($item[9] == "Воздушная") { ?>
                        <option value="Регидная(жесткая)">Регидная(жесткая)</option>
                        <option value="Карбоновая">Карбоновая</option>
                        <option value="Пружинно-эластомерная">Пружинно-эластомерная</option>
                        <option value="Пружинно-масленая">Пружинно-масленая</option>
                    <?php } ?>

                <?php } ?>
        </select>

        <br><input type="number" step="0.01" name="weight" value="<? foreach($bike as $item) echo $item[10] ?>">

        <br><input type="text" name="equipment" value="<? foreach($bike as $item) echo $item[11] ?>">

        <br><input type="number" name="quantity" value="<? foreach($bike as $item) echo $item[12] ?>">

        <br><input type="number" name="price" value="<? foreach($bike as $item) echo $item[13] ?>">
    
        <br><button type="submit">Редактировать</button>
    </form>

</body>
</html>