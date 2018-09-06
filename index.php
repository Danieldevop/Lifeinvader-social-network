<?php 
  session_start();
  require 'database.php';
  
  if(isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id=:id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;
    
    if (count($results) > 0) {
      $user = $results;
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="./assets/css/style.css">
  <title>Lifeinvader</title>
</head>
<body>
  <? require 'partials/header.php' ?>
  <?php if(!empty($user)) : ?>
    <section class="container">
      <div class="text-center">
        <img class="d-block mx-auto" src="assets/img/welcome.png" width="670" alt="Welcome">
        <p class=""><?= $user['email'] ?></p>
        <a class="btn-sm btn-primary px-4" href="logout.php">Logout</a>
      </div>
    </section>
  <?php else: ?>
    <section class="container mrgIndex">
      <div class="row">
        <div class="col-sm">
          <img class="d-block mx-auto"  src="./assets/img/lifeinvader.png" alt="">
        </div>
        <div class="col-sm text-center">
            <img class="marginLogin mx-auto d-block mb-5" src="./assets/img/logo-small.png" alt="Lifeinvader"/>
            <a class="btn-sm btn-primary px-4" href="login.php">Login</a> 
              <span class="orcolor d-block mt-2">OR</span>
            <a class="btn btn-primary mt-2 px-5" href="signup.php">Signup</a>
        </div>
      </div>
    </section>
  <?php endif; ?>
</body>
</html>