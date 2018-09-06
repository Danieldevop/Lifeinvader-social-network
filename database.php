<?php 
  $server = 'localhost';
  $username = 'root';
  $password = '';
  $database = 'php_login_database';

  try {
    $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOExeption $e) {
    die('Connection Failed: ' .$e->getMessage());
  }
?>