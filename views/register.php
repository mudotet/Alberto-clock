<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Đăng ký tài khoản</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">

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

            <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
