<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$action = filter_input(INPUT_POST, 'action');
if ($action == 'logout') {
    $_SESSION['logged_in'] = false;
    include('index.php');
    exit();
} 

include_once('database.php');

if (!function_exists('verify_login')) {
    function verify_login($email, $password_login)
    {
        global $db;
        $query = 'SELECT * FROM breadManagers WHERE emailAddress = :email';
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $data = $statement->fetch();
        $statement->closeCursor();

        if (empty($data)) {
            //display the login page
            $error = [3, 'Email not found'];
            unset($_POST['formSubmit']);
            include('login.php');
            exit();
        } else if (password_verify($password_login, $data['password'])) {
            //set session variable 'logged in' to true
            $_SESSION['logged_in'] = true;
            $_SESSION['first_name'] = $data['firstName'];
            $_SESSION['last_name'] = $data['lastName'];
            $_SESSION['email'] = $data['emailAddress'];
            include('index.php');
            exit();
        } else {
            //display the login page
            $error = [4, 'Password incorrect'];
            unset($_POST['formSubmit']);
            include('login.php');
            exit();
        }
    }
}

//verify the email and password passed in post array

if (!isset($email)) {
    $email = '';
}
if (!isset($password_login)) {
    $password_login = '';
}
if (!isset($error)) {
    $error = [0, ''];
}

if (isset($_POST['formSubmit'])) {
    $email = filter_input(INPUT_POST, 'email');
    $password_login = filter_input(INPUT_POST, 'password');
    $error = [0, ''];

    if (empty($email)) {
        $error = [1, 'Email is required'];
    } else if (empty($password_login)) {
        $error = [2, 'Password is required'];
    }

    if ($error[0] == 0) {
        verify_login($email, $password_login);
    } else {
        unset($_POST['formSubmit']);
        include('login.php');
        exit();
    }


    verify_login($email, $password_login);
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

    <link rel='icon' href="images\wild-lines-2-behance-solos-cat-1-6380ceff5ce94-png__700-modified-removebg-preview.png" type="image/x-icon" media="(prefers-color-scheme:no-preference)">
    <link rel='icon' href="images\wild-lines-2-behance-solos-cat-1-6380ceff5ce94-png__700-removebg-preview.png" type="image/x-icon" media="(prefers-color-scheme:dark)">
    <link rel='icon' href="images\wild-lines-2-behance-solos-cat-1-6380ceff5ce94-png__700-modified-removebg-preview.png" type="image/x-icon" media="(prefers-color-scheme:light)">
    <link rel='stylesheet' href='style.css'>
</head>

<body>
    <span><?php $page = 'login';
            include_once('header.php'); ?></span>

    <main>
        <h1>Login</h1>
        <?php if ($error[0] != 0) { ?>
            <p style="color:red"><?php echo $error[1] ?></p>
        <?php } ?>
        <form action="login.php" method="POST">
            <label for = "email">Email:</label>
                <input type = "email" name = "email" id = "email" required><br>
                <label for = "password">Password:</label>
                <input type = "password" name = "password" id = "password" required><br>
                <input type = "submit" name = "formSubmit" value = "Login">

                <!-- <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && (empty($email) || $error[0]==1)) { ?>
                    <label for="email" style="color:red">Email:</label>
                <?php } else { ?>
                    <label for="email">Email:</label>
                <?php } ?>
                <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email) ?>" required><br>

                <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && (empty($password_login) || $error[0]==2)) { ?>
                    <label for="password" style="color:red">Password:</label>
                <?php } else { ?>
                    <label for="password">Password:</label>
                <?php } ?>
                <input type="password" name="password" id="password" value="<?php echo htmlspecialchars($password_login) ?>" required><br>

                <input type="submit" name="formSubmit" value="Login"> -->

        </form>
    </main>

    <span><?php $page = 'login';
            include_once('footer.php'); ?></span>
</body>

</html>