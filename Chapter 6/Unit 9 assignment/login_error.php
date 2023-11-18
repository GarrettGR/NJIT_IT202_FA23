<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

?>

<!DOCTYPE html>
<html lang="en" data-theme="light">
    <head>
        <title>Hartrum's Pet Shop - Home</title>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Garrett Gonzalez-Rivas">
        <meta name="description" content="Pet shop website">
        <meta name="keywords" content="Pet, Store, Pet Store">

        <link rel = 'icon' href = "images\wild-lines-2-behance-solos-cat-1-6380ceff5ce94-png__700-modified-removebg-preview.png" type = "image/x-icon" media="(prefers-color-scheme:no-preference)">
        <link rel = 'icon' href = "images\wild-lines-2-behance-solos-cat-1-6380ceff5ce94-png__700-removebg-preview.png" type = "image/x-icon" media="(prefers-color-scheme:dark)">
        <link rel = 'icon' href = "images\wild-lines-2-behance-solos-cat-1-6380ceff5ce94-png__700-modified-removebg-preview.png" type = "image/x-icon" media="(prefers-color-scheme:light)">
        <link rel = 'stylesheet' href = 'style.css'>   
    </head>
    <body>
        <span><?php $page = 'login_error'; include_once('header.php'); ?></span>
        
        <main>
            
            <h1> Error 401: Unauthorizaed </h1>
            <img src=https://http.cat/401.jpg alt="unauthorized" class="errorIMG">

        </main>

        <span><?php include_once('footer.php'); ?></span>
    </body>
</html>

