<?php
    // get data from the email form
    $email = filter_input(INPUT_GET, 'email_address');

    // validate the email address
    if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
        $error_message = 'Email address must contain an @ sign.';
        include('email_list.html');
        exit();
    }
?>
<!DOCTYPE html>
<html>

<head>
    <title>Join our email list</title>
</head>

<body>
    <main>
        <h1>Thank you for joining our email list!</h1>
        <p>Here is the information you submitted:</p>
        <ul>
            <li>Email address: <?php echo $email; ?></li>
        </ul>
    </main>
</body>

</html>