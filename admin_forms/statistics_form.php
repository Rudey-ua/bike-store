<?php
require_once '../config/connect.php';

$seller_avg_receipt = mysqli_query($connect, "SELECT sellers.salesman_id, sellers.name, sellers.doc_num, AVG(bikes.price) FROM bikes NATURAL JOIN bike_purchase NATURAL JOIN purchase NATURAL JOIN sellers GROUP BY sellers.name,sellers.doc_num ORDER BY AVG(bikes.price) DESC");
$seller_avg_receipt = mysqli_fetch_all($seller_avg_receipt);

$top_5_bikes = mysqli_query($connect, "SELECT bikes.bike_id, bikes.bike_name, bikes.price, COUNT(bike_purchase.purchase_id) as TOP FROM bikes NATURAL JOIN bike_purchase GROUP BY bikes.bike_id, bikes.price ORDER BY COUNT(bike_purchase.purchase_id) DESC LIMIT 5");
$top_5_bikes = mysqli_fetch_all($top_5_bikes);

$quantity_in_category = mysqli_query($connect, "SELECT categorie_id.id_categorie, categorie_id.title, COUNT(*) as cnt FROM categorie_id, bikes WHERE categorie_id.id_categorie = bikes.categorie_id GROUP BY categorie_id.id_categorie ORDER BY COUNT(*) DESC");
$quantity_in_category = mysqli_fetch_all($quantity_in_category);

$avg_bike_rate = mysqli_query($connect, "SELECT bikes.bike_id, bikes.bike_name, AVG(comments.bike_rate) FROM bikes LEFT JOIN comments on bikes.bike_id = comments.bike_id GROUP BY bikes.bike_id ORDER BY AVG(comments.bike_rate) DESC");
$avg_bike_rate = mysqli_fetch_all($avg_bike_rate);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../style/admin_table.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="https://img.icons8.com/external-filled-outline-chattapat-/50/000000/external-bicycle-holiday-filled-outline-chattapat-.png"/>
    <title>Statistics</title>
</head>
<body>

    <h2 style="margin-left:10px;">Средний чек продавца</h2>

    <table style="margin-left:10px;">
        <tr>
            <th>id</th>
            <th>name</th>
            <th>doc_num</th>
            <th>avg_receipt</th>
        </tr>

        <?php
            foreach($seller_avg_receipt as $item) {
            ?>
                <tr>
                    <td><?php echo $item[0]?></td>
                    <td><?php echo $item[1]?></td>
                    <td><?php echo $item[2]?></td>
                    <td><?php echo round($item[3], 0) . ' грн'?></td>
                </tr>
            <?php
            }
        ?>  
    </table>

    <h2 style="margin-left:10px;">Топ-5 продаевмых велосипедов</h2>

    <table style="margin-left:10px;" class="mt-2">
        <tr>
            <th>id</th>
            <th>bike_name</th>
            <th>price</th>
            <th>quantity</th>
        </tr>

        <?php
            foreach($top_5_bikes as $item) {
            ?>
                <tr>
                    <td><?php echo $item[0]?></td>
                    <td><?php echo $item[1]?></td>
                    <td><?php echo $item[2]?></td>
                    <td><?php echo $item[3]?></td>
                </tr>
            <?php
            }
        ?>  
    </table>

    <h2 style="margin-left:10px;">Колличество велосипедов в категории</h2>

    <table style="margin-left:10px;" class="mt-2">
        <tr>
            <th>id</th>
            <th>category_title</th>
            <th>quantity</th>
        </tr>

        <?php
            foreach($quantity_in_category as $item) {
            ?>
                <tr>
                    <td><?php echo $item[0]?></td>
                    <td><?php echo $item[1]?></td>
                    <td><?php echo $item[2]?></td>
                </tr>
            <?php
            }
        ?>  
    </table>

    <h2 style="margin-left:10px;">Средний рейтинг велосипеда</h2>

    <table style="margin-left:10px;" class="mt-2">
        <tr>
            <th>id</th>
            <th>bike_name</th>
            <th>avg_rate</th>
        </tr>

        <?php
            foreach($avg_bike_rate as $item) {
            ?>
                <tr>
                    <td><?php echo $item[0]?></td>
                    <td><?php echo $item[1]?></td>
                    <td><?php echo $item[2] != NULL ? round($item[2], 1) : "-"?></td>
                </tr>
            <?php
            }
        ?>  
    </table> 
</body>
</html>