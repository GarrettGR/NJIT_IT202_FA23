<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();

  // setting the logged_in variable to false if it is not already set 
  if (!isset($_SESSION['logged_in'])) {
    $_SESSION['logged_in'] = false;
  }
}
?>

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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="src/css/style.css" />

  <!-- jQuery JS -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

  <!-- Popper.js and Boostrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

  <!-- Custom JavaScript -->
  <script src="src/js/login_data.js"></script>

</head>