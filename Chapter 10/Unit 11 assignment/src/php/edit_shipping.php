<?php
session_start();
$shipping_data = unserialize($_POST['shipping_data']);
$_SESSION['shipping_data'] = $shipping_data;
header('Location: ../../shipping.php');
exit();