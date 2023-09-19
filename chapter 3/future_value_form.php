<?php
    if (!isset($investment)) { $investment = ''; }
    if (!isset($interest_rate)) { $interest_rate = ''; }
    if (!isset($years)) { $years = ''; }
?>

<!DOCTYPE html>
    <head>
        <title>Future Value Calculator</title>
    </head>
    <body>
        <main>
            <h1>Future Value Calculator</h1>

            <?php if (!empty($error_message)) { ?>
                <p style="color: red; font-weight: bold"><?php echo htmlspecialchars($error_message); ?></p>
            <?php } ?>

            <form action="display_results.php" method="post">
                <div id="data">
                    <?php if (!empty($investment_error_message)) { ?>
                        <label style="color: red">Investment Amount:</label>
                    <?php } else { ?>
                        <label>Investment Amount:</label>
                    <?php } ?>

                    <input type="text" name="investment" value="<?php echo htmlspecialchars($investment); ?>"><br>

                    <?php if (!empty($interest_error_message)) { ?>
                        <label style="color: red">Yearly Interest Rate:</label>
                    <?php } else { ?>
                        <label class="interest">Yearly Interest Rate:</label>
                    <?php } ?>

                    <input type="text" name="interest_rate" value="<?php echo htmlspecialchars($interest_rate); ?>"><br>

                    <?php if (!empty($years_error_message)) { ?>
                        <label style="color: red">Yearly Interest Rate:</label>
                    <?php } else { ?>
                        <label class="years">Number of Years:</label>
                    <?php } ?>

                    <input type="text" name="years" value="<?php echo htmlspecialchars($years); ?>"><br>
                </div>

                <div id="buttons">
                    <label>&nbsp;</label>
                    <input type="submit" value="Calculate"><br>
                </div>
            </form>
        </main>
    </body>
<html>