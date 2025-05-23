<?php
require_once '../includes/db_connect.php'; // Nhúng file kết nối PDO

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name       = $_POST["name"];
    $email      = $_POST["email"];
    $password   = $_POST["password"];
    $phone      = $_POST["phone"];
    $address    = $_POST["address"];
    $created_at = $_POST["created_at"];
    $role_id    = $_POST["role_id"];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $pdo = Db_connect::getConnection(); // Lấy kết nối

        $sql = "INSERT INTO users (email, password, role_id, name, phone_number, address, registration_date)
                VALUES (:email, :password, :role_id, :name, :phone, :address, :created_at)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':email'      => $email,
            ':password'   => $hashed_password,
            ':role_id'    => $role_id,
            ':name'       => $name,
            ':phone'      => $phone,
            ':address'    => $address,
            ':created_at' => $created_at
        ]);

        echo "<script>alert('Đăng ký thành công!'); window.location.href='register.html';</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Lỗi khi đăng ký: " . $e->getMessage() . "'); window.history.back();</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Đăng ký tài khoản</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #fdf7f1;
    }
    .card {
      border: 1px solid #804a06;
    }
    .card-title {
      color: #804a06;
    }
    .btn-primary {
      background-color: #804a06;
      border-color: #804a06;
    }
    .btn-primary:hover {
      background-color: #a05d14;
      border-color: #a05d14;
    }
    label {
      color: #804a06;
      font-weight: 500;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="row justify-content-center mt-5">
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <h3 class="card-title text-center mb-4">Đăng ký</h3>
          <form method="post" action="register.php">
            <div class="mb-3">
              <label for="name" class="form-label">Họ tên</label>
              <input type="text" class="form-control" name="name" required>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" name="email" required>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Mật khẩu</label>
              <input type="password" class="form-control" name="password" required>
            </div>

            <div class="mb-3">
              <label for="phone" class="form-label">Số điện thoại</label>
              <input type="text" class="form-control" name="phone" required>
            </div>

            <div class="mb-3">
              <label for="address" class="form-label">Địa chỉ</label>
              <textarea class="form-control" name="address" rows="2" required></textarea>
            </div>

            <div class="mb-3">
              <label for="created_at" class="form-label">Ngày đăng ký</label>
              <input type="date" class="form-control" name="created_at" value="<?= date('Y-m-d') ?>" required>
            </div>

            <div class="mb-3">
              <label for="role_id" class="form-label">Vai trò</label>
              <select class="form-select" name="role_id" required>
                <option value="2" selected>Khách hàng</option>
                <option value="1">Quản trị viên</option>
              </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
