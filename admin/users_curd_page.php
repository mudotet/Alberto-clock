<?php
require_once '../includes/db_connect.php';
require_once '../models/User.php';
require_once '../models/Role.php';

$userModel = new User();
$roleModel = new Role();

// Xử lý POST thêm hoặc xoá user
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action'] === 'add') {
        $userModel->createUser([
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'role_id' => $_POST['role_id'],
            'name' => $_POST['name'],
            'phone_number' => $_POST['phone_number'],
            'address' => $_POST['address'],
            'registration_date' => date('Y-m-d H:i:s')
        ]);
    } elseif ($_POST['action'] === 'delete') {
        $userModel->deleteUser($_POST['user_id']);
    }
    header('Location: users_crud_page.php');
    exit();
}

$users = $userModel->getAllUsers();
$roles = $roleModel->getAllRoles();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Quản lý người dùng</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body { background-color: #f9f9f9; font-family: Arial; }
    .admin-box { background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.08); }
    h2 { color: #8B4000; margin-bottom: 20px; }
    table th { background-color: #8B4000; color: white; }
    .btn-orange { background-color: #8B4000; color: white; }
    .btn-orange:hover { background-color: #a35400; }
  </style>
</head>
<body>

<?php include './admin_header.php'; ?>

<div class="container my-5">
  <!-- FORM THÊM NGƯỜI DÙNG -->
  <div class="admin-box">
    <h2>Thêm người dùng</h2>
    <form method="POST" class="row g-3">
      <input type="hidden" name="action" value="add">
      <div class="col-md-4">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="col-md-4">
        <label>Mật khẩu</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <div class="col-md-4">
        <label>Vai trò</label>
        <select name="role_id" class="form-select">
          <?php foreach ($roles as $role): ?>
            <option value="<?= $role['role_id'] ?>"><?= $role['role_name'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-4">
        <label>Họ tên</label>
        <input type="text" name="name" class="form-control">
      </div>
      <div class="col-md-4">
        <label>Số điện thoại</label>
        <input type="text" name="phone_number" class="form-control">
      </div>
      <div class="col-md-4">
        <label>Địa chỉ</label>
        <input type="text" name="address" class="form-control">
      </div>
      <div class="col-12 text-end">
        <button type="submit" class="btn btn-orange">➕ Thêm</button>
      </div>
    </form>
  </div>
  <!-- DANH SÁCH NGƯỜI DÙNG -->
  <div class="admin-box mt-5">
    <h2>Danh sách người dùng</h2>
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Email</th>
          <th>Họ tên</th>
          <th>Vai trò</th>
          <th>SĐT</th>
          <th>Địa chỉ</th>
          <th>Ngày tạo</th>
          <th>Xoá</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $u): ?>
          <tr>
            <td><?= $u['user_id'] ?></td>
            <td><?= $u['email'] ?></td>
            <td><?= $u['name'] ?></td>
            <td><?= $u['role_id'] == 1 ? 'Admin' : 'User' ?></td>
            <td><?= $u['phone_number'] ?></td>
            <td><?= $u['address'] ?></td>
            <td><?= $u['registration_date'] ?></td>
            <td>
              <form method="POST" class="d-inline">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="user_id" value="<?= $u['user_id'] ?>">
                <button class="btn btn-sm btn-danger" onclick="return confirm('Xoá người dùng này?')">Xoá</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html