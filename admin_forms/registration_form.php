<?php 

$id = $_GET['id'];



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/png" href="https://img.icons8.com/external-filled-outline-chattapat-/50/000000/external-bicycle-holiday-filled-outline-chattapat-.png"/>
    <title>Регистрация</title>
</head>
<body>
    
<section class="vh-100" style="background-color: #a29f9f;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <h3 class="mb-5">Регистрация</h3>

            <form action="../admin_operation/user_operations/registration.php" method="POST">

                
                <input type="hidden" id="bike_id" name="bike_id" value="<?= $id ?>">

                <div class="form-outline mb-4">
                    <input required type="text" placeholder="Login" name="login" id="typeEmailX-2" class="form-control form-control-lg" />
                </div>

                <div class="form-outline mb-4">
                    <input required type="password" placeholder="Password" name="password" id="typePasswordX-2" class="form-control form-control-lg" />              
                </div>

                <div class="form-outline mb-4">
                    <input required type="text" placeholder="Name" name="name" id="typePasswordX-2" class="form-control form-control-lg" />              
                </div>

                <div class="form-outline mb-4">
                    <input required type="text" placeholder="Surname" name="surname" id="typePasswordX-2" class="form-control form-control-lg" />              
                </div>

                <div class="form-outline mb-4">
                    <input required type="text" placeholder="Phone" name="phone" id="typePasswordX-2" class="form-control form-control-lg" />              
                </div>

                <button style="background-color:#198754;border-color:#198754;width:300px;" class="btn btn-primary btn-lg btn-block" type="submit">Зарегистрироваться</button>

            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>