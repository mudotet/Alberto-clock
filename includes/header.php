<!-- includes/header.php -->
<header>
  <nav class="navbar navbar-expand-lg custom-navbar shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="../assets/images/logo.png" alt="LogoWebsite" height="50" style="width: auto;">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mainNavbar">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link-custom active" href="../views/index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link-custom" href="../views/news.php">News</a>
          </li>
          <li class="nav-item">
            <a class="nav-link-custom" href="../views/about_us.php">About us</a>
          </li>
        </ul>

        <div class="d-flex align-items-center gap-3"> 
          <a href="#" class="nav-link-custom"> 
            <i class="fa-solid fa-cart-shopping fa-lg"></i>
          </a>
          <a href="../views/login.php" class="nav-link-custom">Login</a>
        </div>
      </div>
    </div>
  </nav>
</header>
