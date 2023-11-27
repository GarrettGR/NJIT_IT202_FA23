<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    if (!isset($_SESSION['logged_in'])) {
        $_SESSION['logged_in'] = false;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <script>
        function toggleTheme() {
            let htmlDataset = document.documentElement.dataset;
            if (htmlDataset.theme === 'light') {
                htmlDataset.theme = 'dark';
            } else {
                htmlDataset.theme = 'light';
            }
        }
    </script>
</head>

<header class="topnav">

    <div style="float:left; margin-left: 10px; margin-top: 10px;">
        <img style="float:left;width:42px;height:42px;" src="images\3048235.png" alt="Hartrum's Pet Shop Logo">
        <h1>Hartrum's Pet Shop</h1><br>
        <p style="display:inline; color: var(--text)">Where your pets are family!</p>
        <button onclick="toggleTheme()" style="display: inline">Toggle theme</button>

        <?php if ($_SESSION['logged_in']) { ?>
            <form action="login.php" method="POST" style="display: inline">
                <input type="hidden" name="action" value="logout" style="display: inline">
                <input type="submit" value="Logout" style="display: inline">
            </form>
        <?php } else { ?>
            <form action="login.php" method="POST" style='display: inline'>
                <input type="hidden" name="action" value="login" style="display: inline">
                <input type="submit" value="Login" style="display: inline">
            </form>
        <?php } ?>

        <?php if ($_SESSION['logged_in']) { ?>
            <p style="display: block">Welcome, <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name'] . " (" . $_SESSION['email'] ?>) </p>
        <?php } ?>

    </div>

    <ul>
        <li style="list-style-type: none;"> <a href="#contact">
                <img style="float:right;width:42px;height:42px;" src="images\588a64e7d06f6719692a2d11.png" alt="hamburger logo icon">
            </a>
            <ul>
                <li><a href="#services">Services</a></li>
                <li><a href="#animals">Animals</a></li>
                <li><a href="#goods">Goods</a></li>
                <li><a href="#description">Description</a></li>
            </ul>
        </li>
    </ul>

    <?php if ($page == 'shipping') { ?>
        <a href="shipping.?phpactive=shipping.php" class="active">Shipping</a>
    <?php } else { ?>
        <a href="shipping.php?active=shipping.php">Shipping</a>
    <?php } ?>

    <?php if ($page == 'rescue') { ?>
        <a href="add_pet.php?active=add_pet.php" class="active">Rescue</a>
    <?php } else { ?>
        <a href="add_pet.php?active=add_pet.php">Rescue</a>
    <?php } ?>

    <?php if ($page == 'pets') { ?>
        <a href="pets.php?active=pets.php" class="active">Pets</a>
    <?php } else { ?>
        <a href="pets.php?active=pets.php">Pets</a>
    <?php } ?>

    <?php if ($page == 'index') { ?>
        <a href="index.php?active=index.php" class="active">Home</a> <!-- giving up on a query param in the url -->
    <?php } else { ?>
        <a href="index.php?active=index.php">Home</a>
    <?php } ?>

</header>

</html>