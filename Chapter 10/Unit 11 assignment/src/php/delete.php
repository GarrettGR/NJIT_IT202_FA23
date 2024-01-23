<?php
require_once('login_verify.php');
require_once('database.php');

// deletes the entry with the corresponding breadCode passed in the post array

$breadCode = filter_input(INPUT_POST, 'breadCode');

$query = 'DELETE FROM bread WHERE breadCode = :breadCode';
$statement = $db->prepare($query);
$statement->bindValue(':breadCode', $breadCode);
$statement->execute();
$statement->closeCursor();

//redirect to the pets page
header('Location: ../../pets.php');
