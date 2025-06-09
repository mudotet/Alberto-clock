<?php
require_once '../includes/db_connect.php';
require_once '../models/User.php';
require_once '../models/Watch.php';
require_once '../models/Role.php';

$userModel = new User();
$watchModel = new Watch();
$roleModel = new Role();

$users = $userModel->getAllUsers();
$products = $watchModel->getAllWatches();
$roles = $roleModel->getAllRoles();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
            font-size: 15px;
        }
        .section-title {
            background-color: #8B4000;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            margin-top: 30px;
        }
        .table-wrapper {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .action-icons i {
            cursor: pointer;
            margin: 0 6px;
        }
        .btn-add {
            float: right;
        }
        .checkbox-col {
            width: 40px;
        }
    </style>
</head>
<body>

<?php include '../includes/header.php'; ?>

<main class="container py-4">
    <!-- USERS -->
    <div class="section-title d-flex justify-content-between align-items-center">
        <span>Quản lý Người dùng</span>
        <button class="btn btn-success btn-sm">➕ Thêm Người dùng</button>
    </div>
    <div class="table-wrapper mt-3">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th class="checkbox-col"><input type="checkbox"></th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                    <th>Điện thoại</th>
                    <th>Role</th>
                    <th class="text-center">Chỉnh sửa</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td><?= $user['name'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['address'] ?></td>
                        <td><?= $user['phone_number'] ?></td>
                        <td><?= $user['role_id'] == 1 ? 'Admin' : 'User' ?></td>
                        <td class="text-center action-icons">
                            <i class="fas fa-pen text-warning"></i>
                            <i class="fas fa-trash text-danger"></i>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- WATCHES -->
    <div class="section-title d-flex justify-content-between align-items-center">
        <span>Quản lý Sản phẩm</span>
        <button class="btn btn-success btn-sm">➕ Thêm Sản phẩm</button>
    </div>
    <div class="table-wrapper mt-3">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th class="checkbox-col"><input type="checkbox"></th>
                    <th>Model</th>
                    <th>Giá</th>
                    <th>Loại</th>
                    <th>Ngày nhập</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><input type="checkbox"></td>
                        <td><?= $product['model'] ?></td>
                        <td><?= number_format($product['price']) ?> đ</td>
                        <td><?= $product['type'] ?></td>
                        <td><?= $product['purchase_date'] ?></td>
                        <td class="text-center action-icons">
                            <i class="fas fa-pen text-warning"></i>
                            <i class="fas fa-trash text-danger"></i>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
