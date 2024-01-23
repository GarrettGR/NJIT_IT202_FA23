<?php
require_once('database.php');

if (session_status() == PHP_SESSION_NONE) {
  session_start();
  if (!isset($_SESSION['logged_in'])) {
    $_SESSION['logged_in'] = false;
  }
}

$login_error = array();
$_SESSION['login_error'] = array();
$login_data = array();
$_SESSION['login_data'] = array();


$action = filter_input(INPUT_POST, 'action');
if ($action == 'logout') {
  $_SESSION['logged_in'] = false;
  header('Location: ../../index.php');
  exit();
} else if ($action == 'login') {
  $email = filter_input(INPUT_POST, 'email');
  $password = filter_input(INPUT_POST, 'password');

  $login_data = array(
    'email' => $email,
    'password' => $password
  );

  validate_data($email, $password);
  verify_login($email, $password);

  if ($login_error != array()) {
    $_SESSION['login_error'] = $login_error;
    $_SESSION['login_data'] = $login_data;
    header('Location: ../../index.php');
    exit();
  } else {
    $_SESSION['login_error'] = array();
  }
} else {
  $_SESSION['logged_in'] = false;
  $_SESSION['login_data'] = array();
  header('Location: ../../index.php');
  exit();
}

function validate_data($email, $password)
{
  global $login_error;

  if (empty($email) || empty($password)) {
    $login_error = ['empty', 'Email and password are required'];
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $login_error = ['email', 'Email is not valid'];
  } else if (strlen($password) < 8) {
    $login_error = ['password', 'Password must be at least 8 characters'];
  } else {
    $login_error = array();
  }
}

function verify_login($email, $password)
{
  global $login_error;
  global $db;
  $query = 'SELECT * FROM breadManagers WHERE emailAddress = :email';
  $statement = $db->prepare($query);
  $statement->bindValue(':email', $email);
  $statement->execute();
  $data = $statement->fetch();
  $statement->closeCursor();

  if (empty($data)) {
    $login_error = ['email', 'Email not found'];
  } else if (password_verify($password, $data['password'])) {
    //set session variable 'logged in' to true
    $_SESSION['logged_in'] = true;
    $_SESSION['first_name'] = $data['firstName'];
    $_SESSION['last_name'] = $data['lastName'];
    $_SESSION['email'] = $data['emailAddress'];
    header('Location: ../../index.php');
    exit();
  } else {
    $login_error = ['password', 'Password is incorrect'];
  }
}
