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
  <link href="src/css/style.css" rel="stylesheet" />

  <!-- link to external javascript -->
  <script src="src/js/script.js"></script>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />

  <!-- jQuery, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>

</html>