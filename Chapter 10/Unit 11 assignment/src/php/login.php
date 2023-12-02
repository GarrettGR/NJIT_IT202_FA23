<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
    if (!isset($_SESSION['logged_in'])) {
        $_SESSION['logged_in'] = false;
    }
}

$action = filter_input(INPUT_POST, 'action');
if ($action == 'logout') {
    $_SESSION['logged_in'] = false;
    header('Location: ../../index.php');
    exit();
} else if ($action == 'login') {
    $email = filter_input(INPUT_POST, 'email');
    $password_login = filter_input(INPUT_POST, 'password_login');

    validate_data($email, $password_login);
    verify_login($email, $password_login);
} else {
    header('Location: ../../index.php');
    exit();
}

require_once('database.php');

function validate_data($email, $password_login)
{
    $_SESSION['login_error'] = [0, ''];
    if (empty($email) || empty($password_login)) {
        $_SESSION['login_error'] = [1, 'Email and password are required'];
        header('Location: ../../index.php');
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['login_error'] = [2, 'Email is not valid'];
        header('Location: ../../index.php');
        exit();
    }
}

function verify_login($email, $password_login)
{
    global $db;
    $query = 'SELECT * FROM breadManagers WHERE emailAddress = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $data = $statement->fetch();
    $statement->closeCursor();

    if (empty($data)) {
        //display the login page
        $_SESSION['login_error'] = [3, 'Email not found'];
        header('Location: ../../index.php');
        exit();
    } else if (password_verify($password_login, $data['password'])) {
        //set session variable 'logged in' to true
        $_SESSION['logged_in'] = true;
        $_SESSION['first_name'] = $data['firstName'];
        $_SESSION['last_name'] = $data['lastName'];
        $_SESSION['email'] = $data['emailAddress'];
        header('Location: ../../index.php');
        exit();
    } else {
        //display the login page
        $_SESSION['login_error'] = [4, 'Password incorrect'];
        header('Location: ../../index.php');
        exit();
    }
}
