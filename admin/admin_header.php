<?php
session_start();
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
?>
<header>
  <nav class="navbar navbar-expand-lg custom-navbar shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="../views/index.php">
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
          <?php if ($user && $user['role_id'] == 1): // Only admins see these links ?>
            <li class="nav-item">
              <a class="nav-link-custom" href="../views/user_curd.php">Quản lý người dùng</a>
            </li>
            <li class="nav-item">
              <a class="nav-link-custom" href="../views/product_curd.php">Quản lý sản phẩm</a> <!-- Added Product Management -->
            </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link-custom" href="../views/news.php">News</a>
            </li>
            <li class="nav-item">
              <a class="nav-link-custom" href="../views/about_us.php">About us</a>
            </li>
          <?php endif; ?>
        </ul>

        <div class="d-flex align-items-center gap-3">
          <a href="javascript:void(0);" id="openSidebar" class="nav-link-custom">
            <i class="fa-solid fa-cart-shopping fa-lg"></i>
          </a>
          <?php if ($user): ?>
            <span class="fw-semibold">
              Xin chào, 
              <?php
                if ($user['role_id'] == 1) {
                  echo "Admin";
                } else {
                  echo htmlspecialchars($user['name']);
                }
              ?>
            </span>
            <a href="../controllers/logout.php" class="nav-link-custom">Logout</a>
          <?php else: ?>
            <a href="../views/login.php" class="nav-link-custom">Login</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>
</header>
