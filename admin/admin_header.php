<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<header>
  <nav class="navbar navbar-expand-lg shadow-sm" style="background: linear-gradient(90deg, #804a06 60%, #a86e1a 100%);">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center gap-2 text-white fw-bold" href="#">
        <i class="fas fa-user-shield fa-lg"></i>
        Admin Dashboard
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="adminNavbar">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link text-white fw-semibold d-flex align-items-center gap-1" href="./users_curd_page.php">
              <i class="fas fa-users"></i> Quản lý Người dùng
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white fw-semibold d-flex align-items-center gap-1" href="./watches_curd_page.php">
              <i class="fas fa-clock"></i> Quản lý Sản phẩm
            </a>
          </li>
        </ul>
        <div class="d-flex align-items-center gap-3">
          <span class="text-white fw-semibold d-none d-lg-inline"><i class="fas fa-user-circle"></i> Xin chào, Admin</span>
          <a href="../controllers/logout.php" class="btn btn-outline-light btn-sm d-flex align-items-center gap-1 px-3 py-2 logout-btn" style="font-size: 16px;">
            <i class="fas fa-sign-out-alt"></i> Đăng xuất
          </a>
        </div>
      </div>
    </div>
  </nav>
</header>

<style>
  .navbar-nav .nav-link {
    transition: background 0.2s, color 0.2s, box-shadow 0.2s;
    border-radius: 6px;
  }
  .navbar-nav .nav-link:hover {
    background: #fff3e0;
    color: #a86e1a !important;
    box-shadow: 0 2px 8px rgba(128,74,6,0.08);
    transform: translateY(-2px) scale(1.04);
  }
  .logout-btn {
    transition: background 0.2s, color 0.2s, box-shadow 0.2s, border 0.2s;
    border-radius: 6px;
  }
  .logout-btn:hover {
    background: #a86e1a !important;
    color: #fff !important;
    border-color: #a86e1a !important;
    box-shadow: 0 2px 8px rgba(168,110,26,0.15);
    transform: translateY(-2px) scale(1.04);
  }
</style>