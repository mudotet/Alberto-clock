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
      .btn-brand {
    color: #fff;
    background-color: #8D4A06;
    border: none;
  }

  .btn-brand:hover,
  .btn-brand.active {
    background-color: #924F0D;
  }

  .watch-title {
    font-weight: 500;
    color: #010500;
  }

  .watch-price {
    font-weight: bold;
    color: #924F0D;
  }

  .watch-card {
    border: 1px solid #B27F54;
    padding: 15px;
    margin-bottom: 25px;
    background-color: #fff;
    transition: transform 0.2s ease;
  }

  .watch-card:hover {
    transform: scale(1.02);
    box-shadow: 0 0 10px rgba(146, 79, 13, 0.3);
  }

  .pagination .page-link {
    color: #924F0D;
    border-color: #B27F54;
  }

  .pagination .page-item.active .page-link {
    background-color: #924F0D;
    color: #fff;
    border-color: #924F0D;
  }

  .pagination .page-link:hover {
    background-color: #B27F54;
    color: #fff;
  }
  </style>
</head>
<body>

<?php include '../includes/header.php'; ?>
<?php include  '../includes/banner.php'; ?>

<div class="container my-5">
  <h2 class="text-center mb-4 text-uppercase fw-bold" style="color: #924F0D;">Đồng hồ nam bán chạy</h2>

  <!-- Bộ lọc thương hiệu -->
  <div class="text-center mb-4">
    <a href="?brand=1" class="btn btn-brand mx-2 <?= $brand_id == 1 ? 'active' : '' ?>">Omega</a>
    <a href="?brand=2" class="btn btn-brand mx-2 <?= $brand_id == 2 ? 'active' : '' ?>">Patek Philippe</a>
    <a href="?brand=3" class="btn btn-brand mx-2 <?= $brand_id == 3 ? 'active' : '' ?>">Rolex</a>
  </div>

  <!-- Danh sách đồng hồ -->
  <div class="row">
    <?php foreach ($watches as $watch): ?>
      <div class="col-6 col-md-4 col-lg-3">
        <a href="watch_detail.php?id=<?= $watch['watch_id'] ?>" class="text-decoration-none">
          <div class="watch-card text-center">
            <?php
              $brandFolder = isset($watch['brand_name']) ? urlencode($watch['brand_name']) : 'default';
              $imagePath = !empty($watch['watches_images'])
                ? "../assets/images/Ảnh đồng hồ/{$brandFolder}/" . htmlspecialchars($watch['watches_images'])
                : "../assets/images/Ảnh đồng hồ/default.jpg";
            ?>
            <img src="<?= $imagePath ?>" alt="Đồng hồ" class="img-fluid mb-2" style="height: 220px; object-fit: contain;">
            <p class="watch-title"><?= htmlspecialchars($watch['model']) ?></p>
            <p class="watch-price"><?= number_format($watch['price'], 0, ',', '.') ?> đ</p>
          </div>
        </a>
      </div>
    <?php endforeach; ?>
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
