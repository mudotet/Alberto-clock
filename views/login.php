<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập | Alberto Clock</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../includes/css_includes/login.css">
</head>
<body>
    <div class="login-container">
        <div class="card login-card p-4">
            <div class="card-body">
                <h3 class="card-title text-center">Đăng nhập</h3>
                <form action="../controllers/login_controller.php" method="POST" autocomplete="off">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required placeholder="Nhập email...">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu</label>
                        <input type="password" class="form-control" id="password" name="password" required placeholder="Nhập mật khẩu...">
                    </div>
                    <button type="submit" class="btn btn-login w-100 mt-2">
                        <i class="fa fa-sign-in-alt me-1"></i> Đăng nhập
                    </button>
                </form>
                <div class="text-center mt-3">
                    <span>Chưa có tài khoản?</span>
                    <a href="../views/register.php" class="login-link ms-1">Đăng ký</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>