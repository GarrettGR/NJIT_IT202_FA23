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

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- jQuery, then Popper.js, then Bootstrap JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


  <!-- link to external stylesheets -->
  <link href="src/css/style.css" rel="stylesheet" />

  <!-- link to external javascript -->
  <script src="src/js/login_data.js"></script>

</head>

</html>