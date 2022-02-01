<?php $bike_id = $_GET['bike_id'];?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="https://img.icons8.com/external-filled-outline-chattapat-/50/000000/external-bicycle-holiday-filled-outline-chattapat-.png"/>
    <title>Ошибка входа</title>
</head>
<body>
    <h1>Вы ввели неверный логин или пароль!</h1>
    <p style="font-size:22px;">Чтобы повторить попытку нажмите <a style="text-decoration:none;color:black;font-weight:bold;" href="/admin_forms/buy_form.php?id=<?php echo $bike_id?>">здесь</a>.</p>
</body>
</html>