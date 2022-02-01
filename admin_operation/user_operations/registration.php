<?php

require_once '../../config/connect.php';


$login = $_POST['login'];
$password = $_POST['password'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$phone = $_POST['phone'];

$bike_id = $_POST['bike_id'];

?>

<?php

if(mysqli_query($connect, "INSERT INTO `customer` (`customer_login`, `customer_password`, `customer_surname`, `customer_name`, `customer_phone`) VALUES ('$login', '$password', '$name', '$surname', '$phone')")) { ?>
    <h1 style="margin-top:22px;">Вы успешно зарегистрировались!</h1>
    <p style="font-size:22px;">Чтобы продолжить оформление заказа нажмите <a style="text-decoration:none;color:black;font-weight:bold;" href="http:/admin_forms/buy_form.php?id=<?php echo $bike_id?>">здесь</a>.</p>
    <?php }
    else{?>
    <h1 style="margin-top:22px;">Пользователь с таким ником уже существует!</h1>
    <p style="font-size:22px;">Чтобы повторить попытку нажмите <a style="text-decoration:none;color:black;font-weight:bold;" href="/admin_forms/registration_form.php?id=<?php echo $bike_id?>">здесь</a></p>
    <?php } ?>

  
    



