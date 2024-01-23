<?php
// get the database connection
require_once('src/php/database.php');

// get the breadcode from the url
$breadID = $_GET['breadID'];
// filter the input
$breadID = filter_var($breadID, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

// get the animal from the database
$query = "SELECT * FROM bread WHERE breadID = :breadID";
$statement = $db->prepare($query);
$statement->bindValue(':breadID', $breadID);
$statement->execute();
$animal = $statement->fetch();
$statement->closeCursor();


?>

<!DOCTYPE html>
<html lang="en">
<?php include 'src/php/head.php'; ?>

<body>
  <?php include 'src/html/header.html'; ?>
  <main class="bg-light text-dark">
    <div class="row">
      <!-- display an error if the record does not exist, otherwise, display info about animal -->
      <?php if (empty($animal)) : ?>
        <div class="col-6">
          <h2>Error</h2>
          <p>Invalid animal ID.</p>
        </div>
      <?php else : ?>
        <div class="col-3">
          <h2>Name: <?php echo $animal['breadName']; ?></h2>
          <p>Description: <?php echo $animal['description']; ?></p>
          <p>Price: <?php echo $animal['price']; ?></p>
        </div>
        <div class="col-auto" id="display">

        <?php if (file_exists("src/img/animals/{$animal['breadCode']}.jpg")) : ?>
          <img class="img-fluid" id="pet-image" src="src/img/animals/<?php echo $animal['breadCode']; ?>.jpg" alt="<?php echo $animal['breadName']; ?>">
          <script src="src/js/modify_image.js"></script>
        <?php else : ?>
          <!-- access one of the photos from typicode since i don't have photos of all the animals -->
          <input type="hidden" id="breadID" value="<?php echo $animal['breadID']; ?>">
          <script src="src/js/display_image.js"></script>
        <?php endif; ?>

        </div>
      <?php endif; ?>
    </div>
  </main>
  <?php include 'src/html/footer.html'; ?>
</body>

</html>