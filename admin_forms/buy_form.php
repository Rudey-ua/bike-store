<?php 

require_once '../config/connect.php';

$sellers = mysqli_query($connect, "SELECT * FROM `sellers`");

$id = $_GET['id'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../style/login.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="https://img.icons8.com/external-filled-outline-chattapat-/50/000000/external-bicycle-holiday-filled-outline-chattapat-.png"/>
    <title>Оформление</title>
</head>
<body>

<section class="vh-100" style="background-color: #a29f9f;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <h3 class="mb-5">Оформление заказа</h3>

            <form action="../vendor/checkout.php" method="POST">

                <div class="form-outline mb-2">
                    <input required type="text" placeholder="Login" name="login" id="typeEmailX-2" class="form-control form-control-lg" />
                </div>

                <div class="form-outline mb-2">
                    <input required type="password" placeholder="Password" name="password" class="form-control form-control-lg" />              
                </div>

                <select required class="select" name="seller" style="padding:5px;font-size: 18px;margin-bottom:15px;width:427.81px;height:48px;">

                    <option value="" disabled selected>Выберите продавца:</option>

                    <?php
                    while ($row = mysqli_fetch_array($sellers)) {
                    ?>
                        <option value="<?php echo $row['salesman_id']?>"><?php echo $row['name'] . " " . $row['surname']?></option>
                    <?php } ?>

                </select>

                <input type="hidden" name="bike_id" value="<?= $id?>">

                <button class="btn btn-primary btn-lg btn-block mt-4" style="background-color:#198754;border-color:#198754;width:300px;" type="submit">Купить</button>

                <div class="form-outline mt-3" style="font-size:18px;">
                    <a href="registration_form.php?id=<?= $id?>">Зарегистрироваться</a>              
                </div>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>