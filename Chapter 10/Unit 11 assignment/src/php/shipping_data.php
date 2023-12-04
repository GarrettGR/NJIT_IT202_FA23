<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// setting up session variables if they don't exist

if (!isset($_SESSION['shipping_data'])) {
  $_SESSION['shipping_data'] = array();
}
if (!isset($_SESSION['label_error_message'])) {
  $_SESSION['label_error_message'] = array();
}

$data = array(
  'shipping_data' => $_SESSION['shipping_data'],
  'label_error_message' => $_SESSION['label_error_message']
);

//encoding the data array as JSON and echoing it
echo json_encode($data);