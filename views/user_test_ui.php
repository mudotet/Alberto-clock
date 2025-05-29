<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../includes/db_connect.php';
require_once '../models/User.php';
require_once '../models/Brand.php';
require_once '../models/Cart.php';
require_once '../models/CartDetail.php';
require_once '../models/Role.php';

$userModel = new User();
$brandModel = new Brand();
$cartModel = new Cart();
$cartDetailModel = new CartDetail();
$roleModel = new Role();

$users = $userModel->getAllUsers();
$brands = $brandModel->getAllBrands();
$carts = $cartModel->getAllCarts();
$cartDetails = $cartDetailModel->getAllCartDetails();
$roles = $roleModel->getAllRoles();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['form_type'])) {
        switch ($_POST['form_type']) {
            case 'cart':
                $user_id = $_POST['user_id'];
                $cart_date = $_POST['cart_date'];
                $cartModel->createCart($user_id, $cart_date);
                break;
            case 'user':
                $userModel->createUser([
                    'email' => $_POST['email'],
                    'password' => $_POST['password'],
                    'role_id' => $_POST['role_id'],
                    'name' => $_POST['name'],
                    'phone_number' => $_POST['phone_number'],
                    'address' => $_POST['address'],
                    'registration_date' => $_POST['registration_date'],
                ]);
                break;
            case 'brand':
                $brandModel->createBrand([
                    'brand_name' => $_POST['brand_name'],
                    'brand_description' => $_POST['brand_description'],
                    'stock_quantity' => $_POST['stock_quantity'],
                    'brands_images' => $_POST['brands_images'],
                ]);
                break;
            case 'cart_detail':
                $cartDetailModel->createCartDetail([
                    'cart_id' => $_POST['cart_id'],
                    'watch_id' => $_POST['watch_id'],
                    'quantity' => $_POST['quantity'],
                ]);
                break;
            case 'role':
                $roleModel->createRole([
                    'role_name' => $_POST['role_name'],
                    'role_description' => $_POST['role_description'],
                ]);
                break;
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Test All Models</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-4">
    <h1 class="text-center mb-4">🧪 Model Data Viewer</h1>

    <div class="accordion" id="modelAccordion">

      <!-- USER FORM -->
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseUsers">
            👤 Users
          </button>
        </h2>
        <div id="collapseUsers" class="accordion-collapse collapse show">
          <div class="accordion-body">
            <form method="post" class="row g-3 mb-4">
              <input type="hidden" name="form_type" value="user">
              <div class="col-md-4"><label>Email</label><input name="email" class="form-control" required></div>
              <div class="col-md-4"><label>Password</label><input name="password" type="password" class="form-control" required></div>
              <div class="col-md-4">
                <label>Role</label>
                <select name="role_id" class="form-select" required>
                  <option value="">-- Select Role --</option>
                  <?php foreach ($roles as $role): ?>
                    <option value="<?= $role['role_id'] ?>"><?= $role['role_name'] ?> (<?= $role['role_id'] ?>)</option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-md-4"><label>Name</label><input name="name" class="form-control"></div>
              <div class="col-md-4"><label>Phone</label><input name="phone_number" class="form-control"></div>
              <div class="col-md-4"><label>Address</label><input name="address" class="form-control"></div>
              <div class="col-md-4"><label>Registration Date</label><input name="registration_date" type="datetime-local" class="form-control"></div>
              <div class="col-md-4 align-self-end"><button class="btn btn-success">➕ Add User</button></div>
            </form>
            <table class="table table-bordered table-sm">
              <thead><tr><th>ID</th><th>Email</th><th>Name</th><th>Role</th></tr></thead>
              <tbody>
                <?php foreach ($users as $user): ?>
                  <tr><td><?= $user['user_id'] ?></td><td><?= $user['email'] ?></td><td><?= $user['name'] ?></td><td><?= $user['role_id'] ?></td></tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- (Các phần còn lại giữ nguyên) -->

    </div>
  </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
