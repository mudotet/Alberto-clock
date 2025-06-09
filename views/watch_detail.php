<?php
require_once '../models/Watch.php';
$watchModel = new Watch();

// Lấy ID từ URL
$watch_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$watchDetail = $watchModel->getWatchById($watch_id);

// Nếu không có, chuyển về index
if (!$watchDetail) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($watchDetail['model']) ?> - Alberto Clock</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../includes/css_includes/footer.css">
  <link rel="stylesheet" href="../includes/css_includes/header.css">
  <style>
    .product-image { width: 100%; max-height: 400px; object-fit: contain; }
    .watch-card img { height: 250px; object-fit: contain; }
  </style>
</head>
<body>
<?php include '../includes/header.php'; ?>
<div class="container my-5">
  <div class="row mb-5">
    <div class="col-md-6">
      <img src="../assets/images/Ảnh đồng hồ/<?= urlencode($watchDetail['brand_name']) ?>/<?= htmlspecialchars($watchDetail['watches_images']) ?>" class="product-image img-fluid shadow" alt="<?= $watchDetail['model'] ?>">
    </div>
    <div class="col-md-6">
      <h2><?= $watchDetail['model'] ?></h2>
      <h4 class="text-danger"><?= number_format($watchDetail['price'], 0, ',', '.') ?> VNĐ</h4>
      <p><?= $watchDetail['description'] ?></p>
      <ul class="list-group list-group-flush mb-3">
        <li class="list-group-item"><strong>Loại:</strong> <?= $watchDetail['type'] ?></li>
        <li class="list-group-item"><strong>Số lượng còn:</strong> <?= $watchDetail['store_quantity'] ?></li>
        <li class="list-group-item"><strong>Ngày nhập:</strong> <?= date('d/m/Y', strtotime($watchDetail['purchase_date'])) ?></li>
      </ul>
      <form method="post" action="../controllers/add_to_cart.php" class="d-inline">
        <input type="hidden" name="watch_id" value="<?= $watchDetail['watch_id'] ?>">
        <input type="hidden" name="quantity" value="1">
        <button type="submit" class="btn btn-outline-secondary me-2">
          <i class="fa-solid fa-cart-shopping me-1"></i> Thêm vào giỏ
        </button>
      </form>
      <button class="btn btn-dark">
        <i class="fa-solid fa-bolt me-1"></i> Mua ngay
      </button>
    </div>
  </div>

  <!-- Sản phẩm liên quan -->
  <h4 class="mb-3">⏱ Sản phẩm cùng thương hiệu</h4>
  <div class="row">
    <?php
    $related = [];
    $all = $watchModel->getWatchesByBrand($watchDetail['brand_id']);
    foreach ($all as $item) {
      if ($item['watch_id'] == $watch_id) continue; // Loại chính nó
      $related[] = $item;
      if (count($related) >= 4) break;
    }

    foreach ($related as $item):
    ?>
      <div class="col-6 col-md-3 mb-4">
        <a href="watch_detail.php?id=<?= $item['watch_id'] ?>" class="text-decoration-none text-dark">
          <div class="card h-100 text-center">
            <img src="../assets/images/Ảnh đồng hồ/<?= urlencode($item['brand_name']) ?>/<?= htmlspecialchars($item['watches_images']) ?>" class="card-img-top watch-card" alt="<?= htmlspecialchars($item['model']) ?>">
            <div class="card-body">
              <h6 class="card-title"><?= htmlspecialchars($item['model']) ?></h6>
              <p class="text-danger fw-bold"><?= number_format($item['price'], 0, ',', '.') ?> VNĐ</p>
            </div>
          </div>
        </a>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<?php include '../includes/footer.php'; ?>
</body>
</html>
