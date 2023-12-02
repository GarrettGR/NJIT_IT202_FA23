<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();

  // setting the logged_in variable to false if it is not already set 
  if (!isset($_SESSION['logged_in'])) {
    $_SESSION['logged_in'] = false;
  }
}

//creating data array to pass using AJAX
if ($_SESSION['logged_in']) {
  $data = array(

    'logged_in' => true,

    // 'first_name' => $_SESSION['first_name'],
    // 'last_name' => $_SESSION['last_name'],
    // 'email' => $_SESSION['email']

    'first_name' => 'Garrett',
    'last_name' => 'Gonzalez-Rivas',
    'email' => 'grg@njit.edu'
  );

  if (isset($_SESSION['login_error'])) {
    $data['login_error'] = $_SESSION['login_error'];
    unset($_SESSION['login_error']);
  }
} else {
  $data = array(
    'logged_in' => false
  );

  if (isset($_SESSION['login_error'])) {
    $data['login_error'] = $_SESSION['login_error'];
    unset($_SESSION['login_error']);
  }
}

//encoding the data array as JSON and echoing it
echo json_encode($data);
