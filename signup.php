<?php
  require 'database.php';

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /php-login');
  }

  //$message = '';

  if (!empty($_POST['email']) && !empty($_POST['password']) == !empty($_POST['comfirm_password']) ) {
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    if($stmt->execute()) {
      $message = 'Successfully created user';
      header('Location: /php-login/login.php');
    } else {
      $message = 'Sorry there must have been an issue creating new user';
    }
  } else {
    $messageErr = 'Please retype your password';
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
  <title>Signup</title>
</head>
<body>
  <?php require 'partials/header.php' ?>
  <section class="container mrgIndex text-center">
    <?php if(!empty($message)): ?>
      <p class="alert alert-info"><?= $message ?></p>
    <?php endif; ?>
    <?php if(!empty($_POST['password']) != !empty($_POST['comfirm_password'])): ?>
      <p class="alert alert-danger"><?= $messageErr ?></p>
    <?php endif; ?>
    <h1>SignUp</h1>
    <span>or <a href="login.php">Login</a></span>
    <form action="signup.php" method="post">
      <input type="text" name="email" placeholder="Enter a email">
      <input type="password" name="password" placeholder="Enter your new password">
      <input type="password" name="comfirm_password" placeholder="Confirm password">
      <input type="submit" value="Send">
    </form>
  </section>
</body>
</html>