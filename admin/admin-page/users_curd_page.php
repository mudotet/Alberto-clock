<?php
require_once '../../includes/db_connect.php';
require_once '../../models/User.php';
require_once '../../models/Role.php';

$userModel = new User();
$roleModel = new Role();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'add') {
        $userModel->createUser([
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'role_id' => $_POST['role_id'],
            'name' => $_POST['name'],
            'phone_number' => $_POST['phone_number'],
            'address' => $_POST['address'],
            'registration_date' => date('Y-m-d H:i:s')
        ]);
    } elseif (isset($_POST['action']) && $_POST['action'] === 'delete') {
        $userModel->deleteUser($_POST['user_id']);
    }
    header('Location: users_curd_page.php');
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
    body { background-color: #f3f3f3; font-family: Arial; }
    .admin-box { background: #fffdf8; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
    h2 { color: #8B4000; margin-bottom: 20px; }
    .form-control, .form-select { font-size: 14px; }
    table th { background-color: #8B4000; color: white; }
    .btn-orange { background-color: #8B4000; color: white; }
    .btn-orange:hover { background-color: #a35400; }
  </style>
</head>
<body>
<div class="container my-5">
  <div class="admin-box">
    <h2>Thêm người dùng</h2>
    <form method="POST" class="row g-3">
      <input type="hidden" name="action" value="add">
      <div class="col-md-4">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
      </div>
      <div class="col-md-4">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <div class="col-md-4">
        <label>Role</label>
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
        <label>Điện thoại</label>
        <input type="text" name="phone_number" class="form-control">
      </div>
      <div class="col-md-4">
        <label>Địa chỉ</label>
        <input type="text" name="address" class="form-control">
      </div>
      <div class="col-md-12 text-end">
        <button type="submit" class="btn btn-orange">Thêm mới</button>
      </div>
    </form>
  </div>

  <div class="admin-box mt-5">
    <h2>Danh sách người dùng</h2>
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Email</th>
          <th>Tên</th>
          <th>Role</th>
          <th>Điện thoại</th>
          <th>Địa chỉ</th>
          <th>Ngày tạo</th>
          <th>Hành động</th>
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
</body>
</html>
