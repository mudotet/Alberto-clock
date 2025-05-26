<?php
require_once '../models/Watch.php';
$watchModel = new Watch();
$watches = $watchModel->getAllWatches();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trang chủ - Alberto Clock</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../includes/css_includes/footer.css">
  <link rel="stylesheet" href="../includes/css_includes/header.css">
  <style>
    .watch-card {
      text-align: center;
      margin-bottom: 40px;
    }
    .watch-card img {
      width: 100%;
      height: 260px;
      object-fit: contain;
      margin-bottom: 10px;
    }
    .watch-title {
      font-size: 0.95rem;
      min-height: 50px;
    }
    .watch-price {
      font-weight: bold;
      font-size: 1.1rem;
      color: #000;
    }
  </style>
</head>
<body>

<?php include '../includes/header.php'; ?>

<div class="container my-5">
  <h2 class="text-center mb-4">ĐỒNG HỒ NAM BÁN CHẠY</h2>
  <div class="row">
    <?php foreach ($watches as $watch): ?>
      <div class="col-6 col-md-4 col-lg-3">
        <div class="watch-card">
          <?php
            $brandFolder = !empty($watch['brand_name']) ? urlencode($watch['brand_name']) : '';
            $imagePath = !empty($watch['watches_images'])
              ? "../assets/images/Ảnh đồng hồ/$brandFolder/" . htmlspecialchars($watch['watches_images'])
              : "../assets/images/Ảnh đồng hồ/default.jpg";
          ?>
          <img src="<?php echo $imagePath; ?>" alt="Hình ảnh đồng hồ">

          <p class="watch-title">
            <?php echo htmlspecialchars($watch['model']); ?>
          </p>

          <p class="watch-price">
            <?php echo number_format($watch['price'], 0, ',', '.') ?> đ
          </p>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<?php include '../includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
