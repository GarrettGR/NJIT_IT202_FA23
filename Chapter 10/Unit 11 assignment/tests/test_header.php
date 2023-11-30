<header>
  <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
    <!-- image and brand name -->
    <a class="navbar-brand" href="index.php">
      <img src="images\pet-store-icon.png" width="30" height="30" alt="" />
      Hartrum's Pet Shop
    </a>

    <!-- navbar toggler for responsive (small screens) -->
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarNavDropdown"
      aria-controls="navbarNavDropdown"
      aria-expanded="true"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- navbar menu buttons -->
    <div class="navbar-collapse collapse show" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <!-- dropdown for the "home" page with section headings for auto-scroll -->
        <li class="nav-item dropdown">
          <a
            class="nav-link dropdown-toggle"
            href="#"
            id="navbarDropdown"
            role="button"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
            Home
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="index.php">Home</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#goods">Goods</a>
            <a class="dropdown-item" href="#animals">Animals</a>
            <a class="dropdown-item" href="#services">Services</a>
            <a class="dropdown-item" href="#description">Description</a>
          </div>
        </li>

        <!-- other button options -->
        <li class="nav-item">
          <a class="nav-link" href="pets.php">Pets</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="rescue.php">Rescue</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="shipping.php">Shipping</a>
        </li>
      </ul>
    </div>

    <!-- div holding login/logout button & modal -->
    <div class="pull-left">
      <!-- login button -->
      <button
        type="button"
        class="btn btn-outline-secondary"
        id="login-btn"
        data-bs-toggle="modal"
        data-bs-target="#login-modal"
      >
        Login
      </button>

      <!-- login modal -->
      <div
        class="modal fade"
        id="login-modal"
        tabindex="-1"
        aria-labelledby="login-modal"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
                &times;
              </button>
              <h4 class="modal-title">Login</h4>
            </div>
            <div class="modal-body">
              <form>
                <h1>LOGIN FORM HERE</h1>
              </form>
            </div>
            <div class="modal-footer">
              <button
                type="submit"
                class="btn btn-danger btn-default pull-left"
                data-dismiss="modal"
              >
                <span class="glyphicon glyphicon-remove"></span>
                Cancel
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
</header>
