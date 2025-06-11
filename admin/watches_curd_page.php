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
    <link rel="stylesheet" href="admin_watches_crud.css">
</head>
<body>
    <h1>Quản lý đồng hồ</h1>
    <?php if ($message): ?>
        <p class="message"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <?php if ($action === 'edit' && isset($watch)): ?>
        <h2>Sửa đồng hồ</h2>
        <form method="post" class="add-watch-form">
            <div class="grid-form">
                <label>Brand ID: <input type="text" name="brand_id" value="<?= htmlspecialchars($watch['brand_id']) ?>"></label>
                <label>Model: <input type="text" name="model" value="<?= htmlspecialchars($watch['model']) ?>"></label>
                <label>Price: <input type="number" name="price" value="<?= htmlspecialchars($watch['price']) ?>"></label>
                <label>Type: <input type="text" name="type" value="<?= htmlspecialchars($watch['type']) ?>"></label>
                <label>Description: <input type="text" name="description" value="<?= htmlspecialchars($watch['description']) ?>"></label>
                <label>Store Quantity: <input type="number" name="store_quantity" value="<?= htmlspecialchars($watch['store_quantity']) ?>"></label>
                <label>Purchase Date: <input type="date" name="purchase_date" value="<?= htmlspecialchars($watch['purchase_date']) ?>"></label>
                <label>Images: <input type="text" name="watches_images" value="<?= htmlspecialchars($watch['watches_images']) ?>"></label>
            </div>
            <button type="submit">Cập nhật</button>
            <a href="watches_curd_page.php" class="btn">Hủy</a>
        </form>
    <?php else: ?>
        <h2>Thêm đồng hồ mới</h2>
        <form method="post" action="?action=add" class="add-watch-form">
            <div class="grid-form">
                <label>Brand ID: <input type="text" name="brand_id"></label>
                <label>Model: <input type="text" name="model"></label>
                <label>Price: <input type="number" name="price"></label>
                <label>Type: <input type="text" name="type"></label>
                <label>Description: <input type="text" name="description"></label>
                <label>Store Quantity: <input type="number" name="store_quantity"></label>
                <label>Purchase Date: <input type="date" name="purchase_date"></label>
                <label>Images: <input type="text" name="watches_images"></label>
            </div>
            <button type="submit">Thêm mới</button>
        </form>
    <?php endif; ?>

    <h2>Danh sách đồng hồ</h2>
    <table>
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
                <td><?= htmlspecialchars($w['watches_images']) ?></td>
                <td>
                    <a href="?action=edit&id=<?= $w['watch_id'] ?>">Sửa</a> |
                    <a href="?action=delete&id=<?= $w['watch_id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>