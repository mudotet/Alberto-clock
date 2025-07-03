<?php
session_start();
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
?>
<header>
  <link rel="stylesheet" href="../includes/css_includes/header.css">
  <nav class="navbar navbar-expand-lg custom-navbar shadow-sm">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center gap-2" href="../views/index.php">
        <img src="../assets/images/logo.png" alt="LogoWebsite" height="48" style="width:auto;">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mainNavbar">
             <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link-custom active" href="../views/index.php">Trang Chủ</a>
          </li>
          <?php if ($user): ?>
            <li class="nav-item"><a class="nav-link-custom" href="../views/news.php">Tin Tức</a></li>
            <li class="nav-item"><a class="nav-link-custom" href="../views/about_us.php">Về Chúng Tôi</a></li>
          <?php endif; ?>
        </ul>
        <div class="d-flex align-items-center gap-3">
          <a href="javascript:void(0);" id="openSidebar" class="nav-link-custom position-relative">
            <i class="fa-solid fa-cart-shopping fa-lg"></i>
            <span id="cart-badge" class="cart-badge"></span>
          </a>
          <?php if ($user): ?>
            <span class="fw-semibold text-white">
              Xin chào, <?= htmlspecialchars($user['name']) ?>
            </span>
            <a href="../controllers/logout.php" class="nav-link-custom">Đăng Xuất</a>
          <?php else: ?>
            <a href="../views/login.php" class="nav-link-custom">Đăng Nhập</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>
</header>

<!-- Sidebar -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>
<div class="sidebar" id="cartSidebar">
  <div class="sidebar-content">
    <button class="btn-close" id="closeSidebar" aria-label="Close">&times;</button>
    <h4>🛒 Giỏ hàng của bạn</h4>
    <div class="sidebar-cart-list" id="cart-items">
      <!-- Nội dung giỏ hàng sẽ được cập nhật bằng JS -->
    </div>
    <div class="sidebar-total" id="cart-total"></div>
    <form action="../views/cart_detail.php" method="get">
      <button type="submit" class="btn btn-cart-detail">
        <i class="fa-solid fa-arrow-right"></i> Xem chi tiết giỏ hàng
      </button>
    </form>
  </div>
</div>

<script>
  // Kiểm tra tồn tại phần tử trước khi gán sự kiện
  const openSidebarBtn = document.getElementById('openSidebar');
  const closeSidebarBtn = document.getElementById('closeSidebar');
  const cartSidebar = document.getElementById('cartSidebar');
  const sidebarOverlay = document.getElementById('sidebarOverlay');
  const cartItemsDiv = document.getElementById('cart-items');
  const cartBadge = document.getElementById('cart-badge');

  // Hàm này dùng để lấy dữ liệu giỏ hàng từ server và cập nhật giao diện sidebar giỏ hàng
  function loadCartSidebar() {
    // Gửi request GET tới file PHP để lấy dữ liệu giỏ hàng (dạng JSON)
    fetch('../controllers/get_cart_sidebar.php')
      .then(res => res.json()) // Chuyển response thành object JSON
      .then(data => {
        // Khởi tạo biến html để xây dựng bảng sản phẩm trong giỏ
        let html = '<table><thead><tr><th>Ảnh</th><th>Số lượng</th></tr></thead><tbody>';
        let totalItems = 0; // Biến đếm tổng số sản phẩm

        // Nếu có sản phẩm trong giỏ hàng
        if (data.items && data.items.length > 0) {
          data.items.forEach(item => {
            // Thêm từng dòng sản phẩm vào bảng
            html += `<tr>
              <td><img src="../assets/${item.watches_images}" alt="" /></td>
              <td>${item.quantity}</td>
            </tr>`;
            // Cộng dồn số lượng sản phẩm
            totalItems += parseInt(item.quantity);
          });
        } else {
          // Nếu giỏ hàng trống, hiển thị thông báo
          html += '<tr><td colspan="2" class="text-center">Giỏ hàng trống</td></tr>';
        }
        html += '</tbody></table>';

        // Gán nội dung bảng vào div hiển thị sản phẩm trong sidebar
        cartItemsDiv.innerHTML = html;

        // Hiển thị tổng số sản phẩm (nếu có) ở dưới bảng
        document.getElementById('cart-total').innerText = totalItems > 0 ? `Tổng sản phẩm: ${totalItems}` : '';

        // Hiển thị badge số lượng trên icon giỏ hàng (nếu có sản phẩm)
        if (cartBadge) {
          cartBadge.textContent = totalItems > 0 ? totalItems : '';
        }
      });
  }

  if (openSidebarBtn && cartSidebar && sidebarOverlay) {
    openSidebarBtn.addEventListener('click', function() {
      loadCartSidebar();
      cartSidebar.classList.add('show');
      sidebarOverlay.classList.add('show');
    });
  }

  if (closeSidebarBtn && cartSidebar && sidebarOverlay) {
    closeSidebarBtn.addEventListener('click', function() {
      cartSidebar.classList.remove('show');
      sidebarOverlay.classList.remove('show');
    });
  }

  if (sidebarOverlay && cartSidebar) {
    sidebarOverlay.addEventListener('click', function() {
      cartSidebar.classList.remove('show');
      sidebarOverlay.classList.remove('show');
    });
  }

  // Tải số lượng sản phẩm lên badge khi load trang
  document.addEventListener('DOMContentLoaded', loadCartSidebar);
</script>