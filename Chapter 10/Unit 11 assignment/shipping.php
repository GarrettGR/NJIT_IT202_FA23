<?php
include_once('src/php/login_verify.php');

if (!isset($first_name)) {
    $first_name = '';
}
if (!isset($last_name)) {
    $last_name = '';
}
if (!isset($address_one)) {
    $address_one = '';
}
if (!isset($address_two)) {
    $address_two = '';
}
if (!isset($state)) {
    $state = '';
}
if (!isset($city)) {
    $city = '';
}
if (!isset($zip_code)) {
    $zip_code = '';
}
if (!isset($ship_date)) {
    $ship_date = '';
}
if (!isset($package_dimensions)) {
    $package_dimensions = '';
}
if (!isset($package_weight)) {
    $package_weight = '';
}
if (!isset($order_number)) {
    $order_number = '';
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'src/php/head.php'; ?>

<body>
    <?php include 'src/html/header.html'; ?>
    <main class="bg-light text-dark">
        <div class="row justify-content-md-center">
            <div class="col-6">
                <h1>Shipping</h1>
                <h5>Fill out this form to generate the shipping label!</h5>

                <form action="display_label.php" method="post" name="shipping_form" id="rescue_form">

                    <!-- error message -->
                    <div class="text-danger" id="general_error"></div>

                    <h2>Address Information: </h2>
                    <div class="mb-3" id="first-name">
                        <label for="first-name" class="form-label">First Name: </label>
                        <div class="text-danger" id="first_name_error"></div>
                        <input type="text" name="first-name" id="first-name" value="<?php echo htmlspecialchars($first_name); ?>">
                    </div>
                    <div class="mb-3" id="last-name">
                        <label for="last-name" class="form-label">Last Name: </label>
                        <div class="text-danger" id="last_name_error"></div>
                        <input type="text" name="last-name" id="last-name" value="<?php echo htmlspecialchars($last_name); ?>">
                    </div>
                    <div class="mb-3" id="address-one">
                        <label for="address-one" class="form-label">Address Line 1: </label>
                        <div class="text-danger" id="address_one_error"></div>
                        <input type="text" name="address-one" id="address-one" value="<?php echo htmlspecialchars($address_one); ?>">
                    </div>
                    <div class="mb-3" id="address-two">
                        <label for="address-two" class="form-label">Address Line 2: </label>
                        <div class="text-danger" id="address_two_error"></div>
                        <input type="text" name="address-two" id="address-two" value="<?php echo htmlspecialchars($address_two); ?>">
                    </div>
                    <div>
                        <label for="state" class="form-label">State (abbrev.): </label>
                        <div class="text-danger" id="state_error"></div>
                        <input type="text" name="state" id="state" value="<?php echo htmlspecialchars($state); ?>">
                    </div>
                    <div>
                        <label for="city" class="form-label">City: </label>
                        <div class="text-danger" id="city_error"></div>
                        <input type="text" name="city" id="city" value="<?php echo htmlspecialchars($city); ?>">
                    </div>
                    <div>
                        <label for="zip-code" class="form-label">Zip Code: </label>
                        <div class="text-danger" id="zip_code_error"></div>
                        <input type="number" name="zip-code" id="zip-code" value="<?php echo htmlspecialchars($zip_code); ?>">
                    </div>

                    <h2>Package Information: </h2>
                    <div>
                        <label for="ship-date" class="form-label">Ship Date: </label>
                        <div class="text-danger" id="ship_date_error"></div>
                        <input type="date" name="ship-date" id="ship-date" value="<?php echo htmlspecialchars($ship_date); ?>">
                    </div>
                    <div>
                        <label for="package-dimensions" class="form-label">Package Dimensions (l,w,h): </label>
                        <div class="text-danger" id="package_dimensions_error"></div>
                        <input type="text" name="package-dimensions" id="package-dimensions" value="<?php echo htmlspecialchars($package_dimensions); ?>">
                    </div>
                    <div>
                        <label for="package-weight" class="form-label">Package Weight: </label>
                        <div class="text-danger" id="package_weight_error"></div>
                        <input type="text" name="package-weight" id="package-weight" value="<?php echo htmlspecialchars($package_weight); ?>">
                    </div>
                    <div>
                        <label for="order-number" class="form-label">Order Number: </label>
                        <div class="text-danger" id="order_number_error"></div>
                        <input type="text" name="order-number" id="order-number" value="<?php echo htmlspecialchars($order_number); ?>">
                    </div>

                    <div>
                        <input type="submit" value="Create Label">
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="src/js/shipping_validation.js"></script>
    <?php include 'src/html/footer.html'; ?>
</body>

</html>