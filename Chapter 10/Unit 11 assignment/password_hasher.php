<?php

    include_once('database.php');

    function add_bread_manager($first_name, $last_name, $email, $password) {
        global $db;
        $query = 'INSERT INTO breadManagers (emailAddress, password, firstName, lastName) VALUES (:email, :password, :first_name, :last_name)';
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':first_name', $first_name);
        $statement->bindValue(':last_name', $last_name);
        $statement->execute();
        $statement->closeCursor();
    }

    $password = password_hash('password', PASSWORD_DEFAULT);
    add_bread_manager('John', 'Doe', 'email_1@gmail.com' , $password);

    $password = password_hash('admin', PASSWORD_DEFAULT);
    add_bread_manager('Jane', 'Doe', 'email_2@yahoo.com' , $password);

    $password = password_hash('qwerty', PASSWORD_DEFAULT);
    add_bread_manager('John', 'Smith', 'email_3@icloud.com' , $password);

?>