<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();

  // setting the logged_in variable to false if it is not already set 
  if (!isset($_SESSION['logged_in'])) {
    $_SESSION['logged_in'] = false;
  }
}
?>

<html>

<head>
  <title>Hartrum's Pet Shop - Home</title>

  <!-- setting meta-data -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <meta name="author" content="Garrett Gonzalez-Rivas" />
  <meta name="description" content="Pet shop website" />
  <meta name="keywords" content="Pet, Store, Pet Store" />

  <!-- link to favicons for tab preview -->
  <link rel="icon" href="images\light-icon.png" type="image/x-icon" media="(prefers-color-scheme: dark)" />
  <link rel="icon" href="images\dark-icon.png" type="image/x-icon" media="(prefers-color-scheme: light)" />

  <!-- link to external stylesheets -->
  <link rel="stylesheet" href="src/css/style.css" />

  <!-- link to external javascript -->
  <script src="src/js/script.js"></script>

  <!-- link to jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- link to boostrap css & js -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</head>

</html>