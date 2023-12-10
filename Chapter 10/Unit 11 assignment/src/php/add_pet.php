<?php
include_once('login_verify.php');
include_once('database.php');

// clear error message and animal data (and from session)
$error_message = [0, ''];
$_SESSION['pet_error_message'] = array();
$animal_data = array();
$_SESSION['animal_data'] = array();

// get codes from session
$codes = $_SESSION['codes'];

// get control data from the form
$automatic_code = filter_input(INPUT_POST, 'automatic');
$override_code = filter_input(INPUT_POST, 'override-radio');

// get the data from the form
$animal_type = filter_input(INPUT_POST, 'animal_type');
$animal_name = filter_input(INPUT_POST, 'breadName');
$animal_description = filter_input(INPUT_POST, 'description');
$animal_price = filter_input(INPUT_POST, 'price');

$animal_code = filter_input(INPUT_POST, 'breadCode');
if ($animal_code == "") {
  $animal_code = $codes[$animal_type];
}

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
} else if (empty($animal_name)) {
  $error_message[0] = 'name';
  $error_message[1] = 'Animal name cannot be empty.';
} else if (empty($animal_description)) {
  $error_message[0] = 'description';
  $error_message[1] = 'Animal description cannot be empty.';
} else if (empty($animal_price)) {
  $error_message[0] = 'price';
  $error_message[1] = 'Animal price cannot be empty.';
}


// if there is an error store the error message and animal data in the session
if ($error_message[0] != 0) {
  $_SESSION['pet_error_message'] = $error_message;
  $_SESSION['animal_data'] = $animal_data;
  header('Location: ../../rescue.php');
  exit();
}

// TODO: handle automatic code generation (and everything else after that point)
// echo "codes: ", var_dump($codes), '<br /><br />';
// echo "animal data: ", var_dump($animal_data), '<br /><br />';
// echo "automatic / overide: ", var_dump($automatic_code), '/ ', var_dump($override_code);

// get or generate animal code
if ($automatic_code) {

  // if it is a valid animal_type, but has no corresponding enteries and therefore no exisiting breadcode prefix
  if ($animal_code == '%') {
    $error_message[0] = 'code';
    $error_message[1] = 'There are no existing entries for this animal type. Please enter a unique animal code prefix (Ex: \'BRD\').';
    $_SESSION['new_animal'] = true;
  } else {
    // get the corresponding breadcode based off of the bread type
    $query = 'SELECT breadCode FROM bread WHERE breadCode LIKE :animal_code ORDER BY breadCode DESC LIMIT 1';
    $statement = $db->prepare($query);
    $statement->bindValue(':animal_code', $animal_code);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();

    $animal_code = explode('-', $result['breadCode']);
    $breadCode = $animal_code[0] . '-' . str_pad(($animal_code[1] + 1), 3, '0', STR_PAD_LEFT);
  }
} else if ($override_code == 'numeric') {
  if (strlen($animal_code) > 6) {
    $error_message[0] = 'code';
    $error_message[1] = 'The numeric component of an Animal Code most be less than 6 charecters.';
  } else if (!ctype_digit($animal_code)) {
    $error_message[0] = 'code';
    $error_message[1] = 'Animal code prefix must be all numbers.';
  } else if ($codes[$animal_type] == '%') {
    $error_message[0] = 'code';
    $error_message[1] = 'There are no existing entries for this animal type. Please enter a unique animal code prefix (Ex: \'BRD\').';
    $_SESSION['new_animal'] = true;
  } else {
    $breadCode = substr($codes[$animal_type], 0, -1) . str_pad($animal_code, 3, '0', STR_PAD_LEFT);
  }
} else if ($override_code == 'prefix') {
  if (strlen($animal_code) != 3) {
    $error_message[0] = 'code';
    $error_message[1] = 'Animal code prefix must be 3 characters long.';
  } else if (!ctype_alpha($animal_code)) {
    $error_message[0] = 'code';
    $error_message[1] = 'Animal code prefix must be all letters.';
  } else if (in_array(($animal_code + "-%"), $codes)) {
    $error_message[0] = 'code';
    $error_message[1] = 'Animal code prefix must be unique.';
  } else {
    $breadCode = $animal_code . '-001';
  }
} else if ($override_code == 'entire') {
  if (strlen($animal_code) > 10) {
    $error_message[0] = 'code';
    $error_message[1] = 'Animal code must be 10 characters or less.';
  } else if (in_array($animal_code, $codes)) {
    $error_message[0] = 'code';
    $error_message[1] = 'Animal code must be unique.';
  } else if (!is_string($animal_code)) {
    $error_message[0] = 'code';
    $error_message[1] = 'Please enter a valid animal code.';
  } else {
    $breadCode = $animal_code;
  }
} else {
  $error_message[0] = 'code';
  $error_message[1] = 'Something when wrong assigning a unique code to the animal';
}

// if there is an error store the error message and animal data in the session
if ($error_message[0] != 0) {
  $_SESSION['pet_error_message'] = $error_message;
  $_SESSION['animal_data'] = $animal_data;
  header('Location: ../../rescue.php');
  exit();
}

// if it continued to here, then insert the data into the database
$statement = $db->query("INSERT INTO bread (breadCategoryID, breadCode, breadName, description, price, dateAdded) VALUES ('$animal_type', '$breadCode', '$animal_name', '$animal_description', '$animal_price', NOW())");

//redirect to the pets page
header('Location: ../../pets.php');
