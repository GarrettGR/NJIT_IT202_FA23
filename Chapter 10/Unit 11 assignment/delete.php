<?php

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
        if (!isset($_SESSION['logged_in'])) {
            $_SESSION['logged_in'] = false;
        }
    }

    include_once('database.php');

    //deletes the pet with the breadcode passed in post array

    $breadCode = filter_input(INPUT_POST, 'breadCode');

    $query = 'DELETE FROM bread WHERE breadCode = :breadCode';
    $statement = $db->prepare($query);
    $statement->bindValue(':breadCode', $breadCode);
    $statement->execute();
    $statement->closeCursor();

    //display the bread list page
    include('pets.php');

?>