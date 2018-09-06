<?php 
  require 'database.php';

  session_start();

  if (isset($_SESSION['user_id'])) {
    header('Location: /php-login');
  }

  if(!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email=:email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
      $_SESSION['user_id'] = $results['id'];
      header('Location: /php-login');
    } else {
      $message = 'Incorrect Password';
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
  <title>Login</title>
</head>
<body>
  <? require 'partials/header.php' ?>
  <section class="container mrgIndex text-center">
    <h1>Login</h1>
    <span>or <a href="signup.php">Signup</a></span>

    <?php if(!empty($message)): ?>
      <p class="alert alert-danger"><?= $message ?></p>
    <?php endif ?>

    <form action="login.php" method="post">
      <input type="text" name="email" placeholder="Enter your email">
      <input type="password" name="password" placeholder="Enter your password">
      <input type="submit" value="Send">
    </form>
  </section>
</body>
</html>