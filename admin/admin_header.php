<?php
// ✅ KHÔNG in gì trước dòng PHP này!

// Bắt đầu session nếu chưa có
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ✅ Kiểm tra nếu không có quyền admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../views/login.php");
    exit();
}
?>

<!-- ✅ Sau đó mới được in HTML -->
<header>
  <nav class="navbar navbar-expand-lg" style="background-color: #8B4000;">
    <div class="container">
      <a class="navbar-brand text-white fw-bold" href="#">Admin Panel</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="adminNavbar">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link text-white" href="users_curd_page.php">Quản lý Người dùng</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="watches_curd_page.php">Quản lý Sản phẩm</a>
          </li>
        </ul>
        <div class="d-flex">
          <a href="../index.php" class="btn btn-light btn-sm">← Về trang chính</a>
        </div>
      </div>
    </div>
  </nav>
</header>
