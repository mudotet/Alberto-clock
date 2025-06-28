<?php
require_once '../models/Watch.php';
$watchModel = new Watch();

// Lấy brand_id từ query string (?brand=...), mặc định là 1 (Rolex)
$brand_id = isset($_GET['brand']) ? (int)$_GET['brand'] : 1;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 8;
$offset = ($page - 1) * $limit;

// Lấy danh sách đồng hồ và tổng số lượng theo hãng
$watches = $watchModel->getWatchesByBrandPaginated($brand_id, $limit, $offset);
$total = $watchModel->countWatchesByBrand($brand_id);
$totalPages = ceil($total / $limit);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Trang chủ - Alberto Clock</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../includes/css_includes/footer.css">
  <link rel="stylesheet" href="../includes/css_includes/header.css">
  <link rel="stylesheet" href="../includes/css_includes/index.css">
</head>
<body>
<?php include '../includes/header.php'; ?>
<?php include  '../includes/banner.php'; ?>


<!-- Nội dung chính -->
<div class="container my-5">
  <h2 class="text-center mb-4 text-uppercase fw-bold" style="color: #924F0D; letter-spacing:1px;">
  Đồng hồ nam bán chạy
</h2>

  <!-- Bộ lọc thương hiệu -->
  <div class="text-center mb-4">
    <a href="?brand=1" class="btn btn-brand mx-2 <?= $brand_id == 1 ? 'active' : '' ?>">Omega</a>
    <a href="?brand=2" class="btn btn-brand mx-2 <?= $brand_id == 2 ? 'active' : '' ?>">Patek Philippe</a>
    <a href="?brand=3" class="btn btn-brand mx-2 <?= $brand_id == 3 ? 'active' : '' ?>">Rolex</a>
  </div>

  <!-- Danh sách đồng hồ -->
  <div class="row">
    <?php foreach ($watches as $watch): ?>
      <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
        <a href="watch_detail.php?id=<?= $watch['watch_id'] ?>" class="text-decoration-none">
          <div class="watch-card shadow-sm h-100">
            <?php
              $imagePath = !empty($watch['watches_images'])
                ? "../assets/" . htmlspecialchars($watch['watches_images'])
                : "../assets/images/Ảnh đồng hồ/default.jpg";
            ?>
            <img src="<?= $imagePath ?>" alt="Đồng hồ" class="img-fluid mb-2 watch-img">
            <div class="watch-info">
              <p class="watch-title"><?= htmlspecialchars($watch['model']) ?></p>
              <p class="watch-price"><?= number_format($watch['price'], 0, ',', '.') ?> đ</p>
            </div>
          </div>
        </a>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Phân trang -->
  <?php if ($totalPages > 1): ?>
    <nav class="d-flex justify-content-center mt-4">
      <ul class="pagination">
        <?php
        // Nếu không phải trang đầu tiên thì hiển thị nút "Trước"
        if ($page > 1): ?>
          <li class="page-item">
            <!-- Khi bấm sẽ chuyển về trang trước (page - 1) -->
            <a class="page-link" href="?brand=<?= $brand_id ?>&page=<?= $page - 1 ?>">Trước</a>
          </li>
        <?php endif; ?>

        <?php
        // Vòng lặp để hiển thị số trang (1, 2, 3, ...)
        for ($i = 1; $i <= $totalPages; $i++): ?>
          <li class="page-item <?= $i == $page ? 'active' : '' ?>">
            <!-- Khi bấm sẽ chuyển đến trang $i -->
            <a class="page-link" href="?brand=<?= $brand_id ?>&page=<?= $i ?>"><?= $i ?></a>
          </li>
        <?php endfor; ?>

        <?php
        // Nếu chưa phải trang cuối thì hiển thị nút "Sau"
        if ($page < $totalPages): ?>
          <li class="page-item">
            <!-- Khi bấm sẽ chuyển về trang sau (page + 1) -->
            <a class="page-link" href="?brand=<?= $brand_id ?>&page=<?= $page + 1 ?>">Sau</a>
          </li>
        <?php endif; ?>
      </ul>
    </nav>
  <?php endif; ?>
</div>


<?php include '../includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

