<!-- a page to display any error that may arise when trying to connect to a MySQL database -->

<!DOCTYPE html>
<html>
    <!-- the head section -->
    <head>
        <title>Hartrum's Pet Shop</title>

        <!-- metadata -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Garrett Gonzalez-Rivas">
        <meta name="description" content="Pet shop website">
        <meta name="keywords" content="Pet, Store, Pet Store">

        <!-- linking styling / images -->
        <link rel = 'stylesheet' href = 'style.css'>

        <link rel = 'icon' href = "images\wild-lines-2-behance-solos-cat-1-6380ceff5ce94-png__700-modified-removebg-preview.png" type = "image/x-icon" media="(prefers-color-scheme:no-preference)">
        <link rel = 'icon' href = "images\wild-lines-2-behance-solos-cat-1-6380ceff5ce94-png__700-removebg-preview.png" type = "image/x-icon" media="(prefers-color-scheme:dark)">
        <link rel = 'icon' href = "images\wild-lines-2-behance-solos-cat-1-6380ceff5ce94-png__700-modified-removebg-preview.png" type = "image/x-icon" media="(prefers-color-scheme:light)">
    </head>
 
    <!-- the body section -->
    <body>
        <!-- including the header -->
        <span><?php $page = 'pets'; include_once('header.php'); ?></span>

        <main>
            <h1>Database Error</h1>
            <p>There was an error connecting to the database.</p>
            
            <!-- displaying the error message -->
            <p>Error message: <?php echo $error_message; ?></p>
        </main>

        <!-- include the footer -->
        <span><?php include_once('footer.php'); ?></span>
    </body>
</html>
