<?php
require_once '../includes/db_connect.php';
require_once '../models/User.php';
require_once '../models/Role.php';

$userModel = new User();
$roleModel = new Role();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                $userModel->createUser([
                    'email' => $_POST['email'],
                    'password' => $_POST['password'],
                    'role_id' => $_POST['role_id'],
                    'name' => $_POST['name'],
                    'phone_number' => $_POST['phone_number'],
                    'address' => $_POST['address'],
                    'registration_date' => date('Y-m-d H:i:s')
                ]);
                break;
            case 'delete':
                if (isset($_POST['user_id'])) {
                    $userModel->deleteUser($_POST['user_id']);
                }
                break;
            case 'update':
                if (isset($_POST['user_id'])) {
                    $updateData = [
                        'email' => $_POST['email'],
                        'role_id' => $_POST['role_id'],
                        'name' => $_POST['name'],
                        'phone_number' => $_POST['phone_number'],
                        'address' => $_POST['address']
                    ];
                    // Chỉ thêm mật khẩu vào updateData nếu người dùng nhập mật khẩu mới
                    if (!empty($_POST['password'])) {
                        $updateData['password'] = $_POST['password'];
                    }
                    $userModel->updateUser($_POST['user_id'], $updateData);
                }
                break;
        }
    }
    header('Location: users_crud_page.php');
    exit();
}

$users = $userModel->getAllUsers();
$roles = $roleModel->getAllRoles();

$userToEdit = null;
if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['user_id'])) {
    $userToEdit = $userModel->getUserById($_GET['user_id']);
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Quản lý người dùng</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../includes/css_includes/footer.css">
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
  <div class="admin-box">
    <h2><?= $userToEdit ? 'Sửa người dùng' : 'Thêm người dùng mới' ?></h2>
    <form method="POST" class="row g-3">
      <input type="hidden" name="action" value="<?= $userToEdit ? 'update' : 'add' ?>">
      <?php if ($userToEdit): ?>
        <input type="hidden" name="user_id" value="<?= htmlspecialchars($userToEdit['user_id']) ?>">
      <?php endif; ?>

      <div class="col-md-4">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($userToEdit['email'] ?? '') ?>" required>
      </div>
      <div class="col-md-4">
        <label for="password" class="form-label">Mật khẩu</label>
        <input type="password" class="form-control" id="password" name="password" <?= $userToEdit ? '' : 'required' ?>>
        <?php if ($userToEdit): ?>
          <small class="form-text text-muted">Bỏ trống nếu không muốn thay đổi mật khẩu.</small>
        <?php endif; ?>
      </div>
      <div class="col-md-4">
        <label for="role_id" class="form-label">Vai trò</label>
        <select class="form-select" id="role_id" name="role_id">
          <?php foreach ($roles as $role): ?>
            <option value="<?= htmlspecialchars($role['role_id']) ?>"
                    <?= ($userToEdit && $userToEdit['role_id'] == $role['role_id']) ? 'selected' : '' ?>>
              <?= htmlspecialchars($role['role_name']) ?>
            </option>

          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-4">

        <label for="name" class="form-label">Họ tên</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($userToEdit['name'] ?? '') ?>">
      </div>
      <div class="col-md-4">
        <label for="phone_number" class="form-label">Số điện thoại</label>
        <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?= htmlspecialchars($userToEdit['phone_number'] ?? '') ?>">
      </div>
      <div class="col-md-4">
        <label for="address" class="form-label">Địa chỉ</label>
        <input type="text" class="form-control" id="address" name="address" value="<?= htmlspecialchars($userToEdit['address'] ?? '') ?>">
      </div>
      <div class="col-12 text-end">
        <button type="submit" class="btn btn-orange">
          <?= $userToEdit ? '💾 Cập nhật' : '➕ Thêm' ?>
        </button>
        <?php if ($userToEdit): ?>
          <a href="users_crud_page.php" class="btn btn-secondary">Hủy</a>
        <?php endif; ?>
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
          <th>Họ tên</th>
          <th>Vai trò</th>
          <th>SĐT</th>
          <th>Địa chỉ</th>
          <th>Ngày tạo</th>

          <th colspan="2">Thao tác</th>

        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $u): ?>
          <tr>

            <td><?= htmlspecialchars($u['user_id']) ?></td>
            <td><?= htmlspecialchars($u['email']) ?></td>
            <td><?= htmlspecialchars($u['name']) ?></td>
            <td><?= htmlspecialchars($u['role_id'] == 1 ? 'Admin' : 'User') ?></td>
            <td><?= htmlspecialchars($u['phone_number']) ?></td>
            <td><?= htmlspecialchars($u['address']) ?></td>
            <td><?= htmlspecialchars($u['registration_date']) ?></td>
            <td>
              <a href="users_crud_page.php?action=edit&user_id=<?= htmlspecialchars($u['user_id']) ?>" class="btn btn-sm btn-primary">Sửa</a>
            </td>
            <td>
              <form method="POST" class="d-inline">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="user_id" value="<?= htmlspecialchars($u['user_id']) ?>">
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xoá người dùng này không?')">Xoá</button>

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

</html>

