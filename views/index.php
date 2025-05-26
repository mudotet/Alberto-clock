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
  <style>
    .watch-card img {
      width: 100%;
      height: 240px;
      object-fit: contain;
      margin-bottom: 8px;
    }
    .watch-card {
      text-align: center;
      margin-bottom: 30px;
    }
    .watch-title {
      font-size: 0.95rem;
      min-height: 50px;
    }
    .watch-price {
      font-weight: bold;
      color: #d10000;
      font-size: 1.1rem;
    }
  </style>
</head>
<body>

<?php include '../includes/header.php'; ?>

<div class="container my-5">
  <h2 class="text-center mb-4">ĐỒNG HỒ NAM BÁN CHẠY</h2>

  <!-- Bộ lọc thương hiệu -->
  <div class="text-center mb-4">
    <a href="?brand=1" class="btn btn-outline-primary mx-2 <?= $brand_id == 1 ? 'active' : '' ?>">Omega</a>
    <a href="?brand=2" class="btn btn-outline-success mx-2 <?= $brand_id == 2 ? 'active' : '' ?>">Patek Philippe</a>
    <a href="?brand=3" class="btn btn-outline-danger mx-2 <?= $brand_id == 3 ? 'active' : '' ?>">Rolex</a>
  </div>

  <!-- Danh sách đồng hồ -->
  <div class="row">
    <?php foreach ($watches as $watch): ?>
      <div class="col-6 col-md-4 col-lg-3">
        <a href="watch_detail.php?id=<?= $watch['watch_id'] ?>" class="text-decoration-none text-dark">
          <div class="watch-card">
            <?php
              $brandFolder = isset($watch['brand_name']) ? urlencode($watch['brand_name']) : 'default';
              $imagePath = !empty($watch['watches_images'])
                ? "../assets/images/Ảnh đồng hồ/{$brandFolder}/" . htmlspecialchars($watch['watches_images'])
                : "../assets/images/Ảnh đồng hồ/default.jpg";
            ?>
            <img src="<?= $imagePath ?>" alt="Đồng hồ">
            <p class="watch-title"><?= htmlspecialchars($watch['model']) ?></p>
            <p class="watch-price"><?= number_format($watch['price'], 0, ',', '.') ?> đ</p>
          </div>
        </a>
      </div>
    <?php endforeach; ?>
  </div>

  </div>

  <!-- Phân trang -->
  <?php if ($totalPages > 1): ?>
    <nav class="d-flex justify-content-center mt-4">
      <ul class="pagination">
        <?php if ($page > 1): ?>
          <li class="page-item">
            <a class="page-link" href="?brand=<?= $brand_id ?>&page=<?= $page - 1 ?>">Trước</a>
          </li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
          <li class="page-item <?= $i == $page ? 'active' : '' ?>">
            <a class="page-link" href="?brand=<?= $brand_id ?>&page=<?= $i ?>"><?= $i ?></a>
          </li>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
          <li class="page-item">
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
