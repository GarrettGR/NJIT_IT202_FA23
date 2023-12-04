<?php
//including the database file to get access to the database
require_once('src/php/database.php');

//query statement to get all data from the bread table and join it with the breadCategories table
$statement = $db->query("SELECT breadCategoryName, breadID, breadCode, breadName, description, price FROM breadCategories INNER JOIN bread ON breadCategories.breadCategoryID = bread.breadCategoryID");
$data = $statement->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'src/php/head.php'; ?>

<body>
  <?php include 'src/html/header.html'; ?>
  <main class="bg-light text-dark">
    <div class="row justify-content-md-center"> <!-- bg-dark text-light -->
      <div class="col-10">
        <h1> Our Pets: </h1>

        <!-- table to display the data from the database -->
        <table class="table table-bordered"> <!-- table-dark (if dark) --> <!-- table-hover (if logged in) -->
          <thread>
            <tr>
              <th scope="col">bread category name </th>
              <th scope="col">bread code</th>
              <th scope="col">bread name</th>
              <th scope="col">description</th>
              <th scope="col">price</th>

              <!-- New column for details -->
              <th scope="col">details</th>
              
              <!-- New column for delete -->
              <?php if ($_SESSION['logged_in']) { ?>
                <th scope="col">delete</th>
              <?php } ?>

            </tr>
          </thread>

          <!-- loop through the data from SQL table -->
          <tbody>
            <?php foreach ($data as $row) : ?>
              <tr>
                <td><?php echo $row['breadCategoryName']; ?></td>
                <td><?php echo $row['breadCode']; ?></td>
                <td><?php echo $row['breadName']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['price']; ?></td>

                <!-- details button -->
                <td>
                  <!-- <a href="details.php?breadID=<?php echo $row['breadID']; ?>">Details</a> -->
                  <button type="button" class="btn btn-outline-info btn-sm" onclick="window.location.href='details.php?breadID=<?php echo $row['breadID']; ?>'">Details</button>
                </td>

                <!-- delete button -- only if the user is logged in -->
                <?php if ($_SESSION['logged_in']) { ?>
                  <?php $bread_code = $row['breadCode'] ?>

                  <td>
                    <form action="delete.php" method="POST" onsubmit="return confirm('Are you sure?');">
                      <input type="hidden" name="breadCode" value="<?php echo $bread_code ?>">
                      <input class="btn btn-outline-danger btn-sm" type="submit" value="Delete">
                    </form>
                  </td>
                <?php } ?>

              <tr>
              <?php endforeach; ?>
          </tbody>

        </table>
      </div>

    </div>
  </main>
  <?php include 'src/html/footer.html'; ?>
</body>

</html>