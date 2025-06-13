<?php
require_once '../models/Watch.php';

$watchModel = new Watch();
$action = $_GET['action'] ?? '';
$message = '';

// Thêm mới
if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'brand_id' => $_POST['brand_id'],
        'model' => $_POST['model'],
        'price' => $_POST['price'],
        'type' => $_POST['type'],
        'description' => $_POST['description'],
        'store_quantity' => $_POST['store_quantity'],
        'purchase_date' => $_POST['purchase_date'],
        'watches_images' => $_POST['watches_images']
    ];
    $message = $watchModel->createWatch($data) ? "Thêm đồng hồ thành công!" : "Thêm đồng hồ thất bại!";
}

// Xóa
if ($action === 'delete' && isset($_GET['id'])) {
    $message = $watchModel->deleteWatch($_GET['id']) ? "Xóa đồng hồ thành công!" : "Xóa đồng hồ thất bại!";
}

// Sửa
if ($action === 'edit' && isset($_GET['id'])) {
    $watch = $watchModel->getWatchById($_GET['id']);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'brand_id' => $_POST['brand_id'],
            'model' => $_POST['model'],
            'price' => $_POST['price'],
            'type' => $_POST['type'],
            'description' => $_POST['description'],
            'store_quantity' => $_POST['store_quantity'],
            'purchase_date' => $_POST['purchase_date'],
            'watches_images' => $_POST['watches_images']
        ];
        if ($watchModel->updateWatch($_GET['id'], $data)) {
            $message = "Cập nhật đồng hồ thành công!";
            $watch = $watchModel->getWatchById($_GET['id']);
        } else {
            $message = "Cập nhật đồng hồ thất bại!";
        }
    }
}

// Lấy danh sách
$watches = $watchModel->getAllWatches();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý đồng hồ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body { background: #f6f6f6; font-family: 'Segoe UI', Arial, sans-serif; }
        .main-title { color: #8B4000; text-align: center; margin: 40px 0 24px 0; font-weight: bold; }
        .admin-card { background: #fff; border-radius: 14px; box-shadow: 0 2px 16px rgba(128,64,0,0.08); padding: 32px 28px; margin-bottom: 32px; }
        .admin-card h2 { color: #8B4000; font-size: 1.4rem; margin-bottom: 24px; }
        .form-label { font-weight: 500; color: #8B4000; }
        .form-control:focus { border-color: #8B4000; box-shadow: 0 0 0 0.15rem #ffe7c2; }
        .btn-orange { background: #8B4000; color: #fff; border: none; }
        .btn-orange:hover, .btn-orange:focus { background: #a35400; color: #fff; }
        .message { color: #8B4000; background: #ffe7c2; border: 1px solid #b27f54; padding: 10px 18px; border-radius: 6px; margin-bottom: 18px; display: inline-block; font-weight: 500; }
        .table thead th { background: #8B4000; color: #fff; vertical-align: middle; }
        .table td, .table th { vertical-align: middle; }
        .watch-img {
            width: 80px; height: 80px; object-fit: cover;
            border-radius: 8px; border: 1px solid #e0c9b3; background: #fff8f0;
            display: block; margin: 0 auto;
            transition: transform 0.2s;
        }
        .watch-img:hover { transform: scale(1.08); box-shadow: 0 2px 8px #b27f5444; }
        .table-responsive { border-radius: 12px; overflow: hidden; }
        @media (max-width: 900px) {
            .admin-card { padding: 18px 6vw; }
        }
        @media (max-width: 600px) {
            .admin-card { padding: 10px 2vw; }
            .main-title { font-size: 1.2rem; }
        }
    </style>
</head>
<body>
<?php include './admin_header.php'; ?>

<div class="container my-5">
    <h1 class="main-title">Quản lý đồng hồ</h1>
    <?php if ($message): ?>
        <div class="message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <div class="admin-card mx-auto" style="max-width: 1100px;">
        <h2><?= ($action === 'edit' && isset($watch)) ? 'Sửa đồng hồ' : 'Thêm đồng hồ mới' ?></h2>
        <form method="post" action="<?= ($action === 'edit' && isset($watch)) ? '?action=edit&id=' . $watch['watch_id'] : '?action=add' ?>">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Brand ID</label>
                    <input type="text" name="brand_id" class="form-control" value="<?= $watch['brand_id'] ?? '' ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Model</label>
                    <input type="text" name="model" class="form-control" value="<?= $watch['model'] ?? '' ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" value="<?= $watch['price'] ?? '' ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Type</label>
                    <input type="text" name="type" class="form-control" value="<?= $watch['type'] ?? '' ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Description</label>
                    <input type="text" name="description" class="form-control" value="<?= $watch['description'] ?? '' ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Store Quantity</label>
                    <input type="number" name="store_quantity" class="form-control" value="<?= $watch['store_quantity'] ?? '' ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Purchase Date</label>
                    <input type="date" name="purchase_date" class="form-control" value="<?= $watch['purchase_date'] ?? '' ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Images</label>
                    <input type="text" name="watches_images" class="form-control" value="<?= $watch['watches_images'] ?? '' ?>">
                </div>
                <div class="col-12 text-end mt-3">
                    <button type="submit" class="btn btn-orange px-4"><?= ($action === 'edit' && isset($watch)) ? 'Cập nhật' : 'Thêm mới' ?></button>
                    <?php if ($action === 'edit'): ?>
                        <a href="watches_curd_page.php" class="btn btn-secondary ms-2">Hủy</a>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </div>

    <div class="admin-card mt-5">
        <h2>Danh sách đồng hồ</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Brand ID</th>
                        <th>Model</th>
                        <th>Price</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Purchase Date</th>
                        <th>Images</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($watches as $w): ?>
                        <tr>
                            <td><?= htmlspecialchars($w['watch_id']) ?></td>
                            <td><?= htmlspecialchars($w['brand_id']) ?></td>
                            <td><?= htmlspecialchars($w['model']) ?></td>
                            <td><?= htmlspecialchars($w['price']) ?></td>
                            <td><?= htmlspecialchars($w['type']) ?></td>
                            <td><?= htmlspecialchars($w['description']) ?></td>
                            <td><?= htmlspecialchars($w['store_quantity']) ?></td>
                            <td><?= htmlspecialchars($w['purchase_date']) ?></td>
                            <td>
                                <?php if (!empty($w['watches_images'])): ?>
                                    <img src="../assets/<?= htmlspecialchars($w['watches_images']) ?>" alt="Ảnh đồng hồ" class="watch-img">
                                <?php else: ?>
                                    <span class="text-muted">Không có ảnh</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="?action=edit&id=<?= $w['watch_id'] ?>" class="btn btn-sm btn-orange mb-1" title="Sửa">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="?action=delete&id=<?= $w['watch_id'] ?>" class="btn btn-sm btn-danger mb-1" title="Xóa" onclick="return confirm('Bạn có chắc muốn xóa?')">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
</body>
</html>