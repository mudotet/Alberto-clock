<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
    <div class="login-container">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Đăng nhập</h3>
                <form action="../controllers/login_controller.php" method="POST">
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
                </form>
                <div class="text-center mt-3">
                    <span>Chưa có tài khoản?</span>
                    <a href="../views/register.php" class="ms-1">Đăng ký</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 