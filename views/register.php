<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Đăng ký tài khoản</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/css/register.css" />
</head>
<body>

<div class="registration-container">
  <div class="card">
    <div class="card-body">
      <h3 class="card-title">Đăng ký tài khoản</h3>
      <form method="post" action="../controllers/register_controller.php">
        <div class="row row-cols-1 row-cols-md-2 g-2">
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
          <div class="col">
            <div class="form-group">
              <label for="created_at" class="form-label">Ngày đăng ký</label>
              <input type="date" class="form-control" name="created_at" value="<?= date('Y-m-d') ?>" required>
            </div>
          </div>
          <input type="hidden" name="role_id" value="2">
        </div>
        <div class="form-group mt-2">
          <label for="address" class="form-label">Địa chỉ</label>
          <textarea class="form-control" name="address" rows="2" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100 mt-3">Đăng ký</button>
      </form>
      <div class="text-center mt-3">
        <span>Đã có tài khoản?</span>
        <a href="./login.php" class="ms-1">Đăng nhập</a>
      </div>
    </div>
  </div>
</div>

</body>
</html>