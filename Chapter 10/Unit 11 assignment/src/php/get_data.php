<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();

  // setting up session variables if they don't exist
  if (!isset($_SESSION['login_error'])) {
    $_SESSION['login_error'] = array();
  }
  if (!isset($_SESSION['login_data'])) {
    $_SESSION['login_data'] = array();
  }
  if (!isset($_SESSION['login_data'])) {
    $_SESSION['logged_in'] = false;
  }

  $login_error = $_SESSION['login_error'];
  $login_data = $_SESSION['login_data'];
}

//creating data array to pass using AJAX
if ($_SESSION['logged_in']) {
  $data = array(

    'logged_in' => true,
    'login_data' => $login_data,
    'login_error' => $login_error,

    'first_name' => $_SESSION['first_name'],
    'last_name' => $_SESSION['last_name'],
    'email' => $_SESSION['email']

    // 'first_name' => 'Garrett',
    // 'last_name' => 'Gonzalez-Rivas',
    // 'email' => 'grg@njit.edu'
  );
} else {
  $data = array(
    'logged_in' => false,
    'login_data' => $login_data,
    'login_error' => $login_error
  );
}

//encoding the data array as JSON and echoing it
echo json_encode($data);
