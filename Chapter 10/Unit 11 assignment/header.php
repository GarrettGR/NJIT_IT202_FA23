<!DOCTYPE html>

<header class="topnav">
  <div>
    <img src="images/3048235.png" alt="logo" width="42" height="42" />
    <h1>Hartrum's Pet Shop</h1>
    <br />
    <button onclick="toggleTheme()" id="themeButton" name="themeButton" style="display: inline">
      Toggle Theme
    </button>

    <form action="login.php" method="post">
      <input type="submit" name="submit" id="submit" value="Login" style="display: inline" />
    </form>

    <?php if ($_SESSION['logged_in']) { ?>
      <p style="display: block"> Welcome, <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name'] . " (" . $_SESSION['email'] ?>)</p>
    <?php } ?>

  </div>

  <nav>
    <ul>
      <li name="home_bttn"><a href="index.php">
          <a href="/">Home</a>

          <ul>
            <li name="services_bttn"><a href="index.php#services">Services</a></li>
            <li name="animals_bttn"><a href="index.php#animals">Animals</a></li>
            <li name="goods_bttn"><a href="index.php#goods">Goods</a></li>
            <li name="description_bttn"><a href="index.php#description">Description</a></li>
          </ul>
        </a></li>
      <li name="pets_bttn"><a href="pets.php">Pets</a></li>
      <li name="shipping_bttn"><a href="shipping.php">Shipping</a></li>
      <li name="rescue_bttn"><a href="rescue.php">Rescue</a></li>
    </ul>
  </nav>
</header>
<script>
  if(localStorage.getItem('theme') == 'dark') {
    document.documentElement.setAttribute('data-theme', 'dark');
    document.getElementById('themeButton').innerHTML = 'Light Mode';
    document.querySelector("link[rel*='icon']").href = 'images/light-icon.png';
  } else {
    document.documentElement.setAttribute('data-theme', 'light');
    document.getElementById('themeButton').innerHTML = 'Dark Mode';
    document.querySelector("link[rel*='icon']").href = 'images/dark-icon.png';
  }

  function toggleTheme() {
    let htmlDataset = document.documentElement.dataset;
    if (htmlDataset.theme == 'dark') {
      htmlDataset.theme = 'light';
      document.getElementById('themeButton').innerHTML = 'Dark Mode';
      localStorage.setItem('theme', 'light');
    } else {
      htmlDataset.theme = 'dark';
      document.getElementById('themeButton').innerHTML = 'Light Mode';
      localStorage.setItem('theme', 'dark');
    }
  }
</script>

</html>