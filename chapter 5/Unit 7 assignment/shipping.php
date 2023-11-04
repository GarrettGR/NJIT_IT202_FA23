<?php
    if (!isset($first_name)) { $first_name = ''; }
    if (!isset($last_name)) { $last_name = ''; }
    if (!isset($address_one)) { $address_one = ''; }
    if (!isset($address_two)) { $address_two = ''; }
    if (!isset($state)) { $state = ''; }
    if (!isset($city)) { $city = ''; }
    if (!isset($zip_code)) { $zip_code = ''; }
    if (!isset($ship_date)) { $ship_date = ''; }
    if (!isset($package_dimensions)) { $package_dimensions = ''; }
    if (!isset($package_weight)) { $package_weight = ''; }
    if (!isset($order_number)) { $order_number = ''; }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Hartrum's Pet Shop - Shipping</title>

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
        <span><?php $page = 'shipping'; include_once('header.php'); ?></span>
        <main>
            <h1>Delivery and Shipping Details</h1>

            <?php if (!empty($error_message)) { ?>
                <p style="color: red; font-weight: bold"><?php echo htmlspecialchars($error_message); ?></p>
            <?php } ?>

            <form action="display_label.php" method="post">
                <div id="data">
                    <h2>Address Information: </h2>
                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && empty($first_name)) { ?>
                        <label style="color: red">First Name:</label>
                    <?php } else { ?>
                        <label>First Name:</label>
                    <?php } ?>
                    <input type="text" name="first_name" id="first_name" value="<?php echo htmlspecialchars($first_name); ?>"><br>

                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && empty($last_name)) { ?>
                        <label style="color: red">Last Name:</label>
                    <?php } else { ?>
                        <label>Last Name:</label>
                    <?php } ?>
                    <input type="text" name="last_name" id="last_name" value="<?php echo htmlspecialchars($last_name); ?>"><br>

                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && empty($address_one)) { ?>
                        <label style="color: red">Address 1:</label>
                    <?php } else { ?>
                        <label>Address Line 1:</label>
                    <?php } ?>
                    <input type="text" name="address_one" id="address_one" value="<?php echo htmlspecialchars($address_one); ?>"><br>

                    <label>Address Line 2:</label>
                    <input type="text" name="address_two" id="address_two" value="<?php echo htmlspecialchars($address_two); ?>"><br>

                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && empty($state)) { ?>
                        <label style="color: red">State (abbrev.):</label>
                    <?php } else { ?>
                        <label>State (abbrev.):</label>
                    <?php } ?>
                    <input type="text" name="state" id="state" value="<?php echo htmlspecialchars($state); ?>"><br>

                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && empty($city)) { ?>
                        <label style="color: red">City:</label>
                    <?php } else { ?>
                        <label>City:</label>
                    <?php } ?>
                    <input type="text" name="city" id="city" value="<?php echo htmlspecialchars($city); ?>"><br>

                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && empty($zip_code)) { ?>
                        <label style="color: red">Zip Code:</label>
                    <?php } else { ?>
                        <label>Zip Code:</label>
                    <?php } ?>
                    <input type="number" name="zip_code" id="zip_code" value="<?php echo htmlspecialchars($zip_code); ?>"><br>

                    <h2>Package Information: </h2>

                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && empty($ship_date)) { ?>
                        <label style="color: red">Ship Date:</label>
                    <?php } else { ?>
                        <label>Ship Date:</label>
                    <?php } ?>
                    <input type="date" name="ship_date" id="ship_date" value="<?php echo htmlspecialchars($ship_date); ?>"><br>

                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && empty($package_dimensions)) { ?>
                        <label style="color: red">Package Dimensions (l,w,h):</label>
                    <?php } else { ?>
                        <label>Package Dimensions (l,w,h):</label>
                    <?php } ?>
                    <input type="text" name="package_dimensions" id="package_dimensions" value="<?php echo htmlspecialchars($package_dimensions); ?>"><br>

                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && empty($package_weight)) { ?>
                        <label style="color: red">Package Weight:</label>
                    <?php } else { ?>
                        <label>Package Weight:</label>
                    <?php } ?>
                    <input type="number" name="package_weight" id="package_weight" value="<?php echo htmlspecialchars($package_weight); ?>"><br>

                    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && empty($order_number)) { ?>
                        <label style="color: red">Order Number:</label>
                    <?php } else { ?>
                        <label>Order Number:</label>
                    <?php } ?>
                    <input type="number" name="order_number" id="order_number" value="<?php echo htmlspecialchars($order_number); ?>"><br>
                </div>

                <div id="buttons">
                    <label>&nbsp;</label>
                    <input type="submit" value="Calculate"><br>
                </div>
            </form>
        </main>
        <span><?php include_once('footer.php'); ?></span>
    </body>
<html>