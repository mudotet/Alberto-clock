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
      min-height: 100vh;
      margin: 0;
      padding: 10px;
      background-color: #804a06;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .registration-container {
      width: 100%;
      max-width: 600px; /* Tăng max-width để chứa 2 cột */
      max-height: 95vh;
    }
    
    .card {
      border: 1px solid #804a06;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
      background-color: #fff;
    }
    
    .card-body {
      padding: 1.5rem;
    }
    
    .card-title {
      color: #804a06;
      text-align: center;
      margin-bottom: 1rem;
      font-weight: 600;
      font-size: 1.5rem;
    }
    
    .form-group {
      margin-bottom: 0.75rem;
    }
    
    label {
      color: #804a06;
      font-weight: 500;
      margin-bottom: 0.25rem;
      font-size: 0.9rem;
    }
    
    .form-control, .form-select {
      border: 1px solid #ced4da;
      padding: 8px 12px;
      border-radius: 6px;
      font-size: 0.9rem;
      height: calc(1.5em + 0.75rem + 2px);
    }
    
    textarea.form-control {
      min-height: 60px;
      resize: vertical;
    }
    
    .btn-primary {
      background-color: #804a06;
      border-color: #804a06;
      padding: 8px;
      font-weight: 500;
      font-size: 0.9rem;
      margin-top: 0.5rem;
    }
    
    @media (max-width: 768px) {
      .row-cols-md-2 > * {
        flex: 0 0 100%;
        max-width: 100%;
      }
    }
  </style>
</head>
<body>

<div class="registration-container">
  <div class="card">
    <div class="card-body">
      <h3 class="card-title">Đăng ký tài khoản</h3>
      <form method="post" action="register.php">
        <div class="row row-cols-1 row-cols-md-2 g-2"> <!-- Hàng chứa 2 cột -->
          <!-- Dòng 1: Họ tên + Email -->
          <div class="col">
            <div class="form-group">
              <label for="name" class="form-label">Họ tên</label>
              <input type="text" class="form-control" name="name" required>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" name="email" required>
            </div>
          </div>
          
          <!-- Dòng 2: Mật khẩu + Số điện thoại -->
          <div class="col">
            <div class="form-group">
              <label for="password" class="form-label">Mật khẩu</label>
              <input type="password" class="form-control" name="password" required>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="phone" class="form-label">Số điện thoại</label>
              <input type="text" class="form-control" name="phone" required>
            </div>
          </div>
          
          <!-- Dòng 3: Ngày đăng ký + Vai trò -->
          <div class="col">
            <div class="form-group">
              <label for="created_at" class="form-label">Ngày đăng ký</label>
              <input type="date" class="form-control" name="created_at" value="<?= date('Y-m-d') ?>" required>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="role_id" class="form-label">Vai trò</label>
              <select class="form-select" name="role_id" required>
                <option value="2" selected>Khách hàng</option>
                <option value="1">Quản trị viên</option>
              </select>
            </div>
          </div>
        </div>
        
        <!-- Địa chỉ (chiếm full width) -->
        <div class="form-group mt-2">
          <label for="address" class="form-label">Địa chỉ</label>
          <textarea class="form-control" name="address" rows="2" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100 mt-3">Đăng ký</button>
      </form>
    </div>
  </div>
</div>

</body>
</html>