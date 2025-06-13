<header>
  <nav class="navbar navbar-expand-lg" style="background-color: #804a06;">
    <div class="container">
      <a class="navbar-brand text-white fw-bold" href="#">Admin Panel</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="adminNavbar">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link text-white" href="users_crud_page.php">Quản lý Người dùng</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="watches_crud_page.php">Quản lý Sản phẩm</a>
          </li>
        </ul>
        <div class="d-flex">
          <a href="../controllers/logout.php" class="nav-link-custom" 
          style=" 
          background-color: transparent;
          border: none;
          color: white;
          font-size: 20px;
          cursor: pointer;"
          >Logout</a>
        </div>
      </div>
    </div>
  </nav>
</header>


<!-- admin_header.php -->