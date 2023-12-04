<?php
include_once('login_verify.php');
include_once('database.php');

// clear error message and animal data (and from session)
$error_message = [0, ''];
$_SESSION['pet_error_message'] = array();
$animal_data = array();
$_SESSION['animal_data'] = array();

// get control data from the form
// $automatic_code = filter_input(INPUT_POST, 'automatic');
$override_code = filter_input(INPUT_POST, 'override-radio');

// get the data from the form
$animal_type = filter_input(INPUT_POST, 'animal_type');
$animal_name = filter_input(INPUT_POST, 'breadName');
$animal_description = filter_input(INPUT_POST, 'description');
$animal_price = filter_input(INPUT_POST, 'price');

// store the data in a serialized array in the session
$animal_data = array(
  'animal_type' => $animal_type,
  'animal_name' => $animal_name,
  'animal_description' => $animal_description,
  'animal_price' => $animal_price
);

// make sure no fields are empty
if ($animal_type == 0 || $animal_type == '') {
  $error_message[0] = 'type';
  $error_message[1] = 'Animal type cannot be empty.';
} else if (empty($animal_name)){
  $error_message[0] = 'name';
  $error_message[1] = 'Animal name cannot be empty.';
} else if (empty($animal_description)) {
  $error_message[0] = 'description';
  $error_message[1] = 'Animal description cannot be empty.';
} else if (empty($animal_price)) //! PUT BACK THE EMPTY
  $error_message[0] = 'price';
  $error_message[1] = 'Animal price cannot be empty.';


// if there is an error store the error message and animal data in the session
if ($error_message[0] != 0) {
  $_SESSION['pet_error_message'] = $error_message;
  $_SESSION['animal_data'] = $animal_data;
  header('Location: ../../rescue.php');
  exit();
}

// get codes from session
$codes = $_SESSION['codes'];
echo "codes: ";