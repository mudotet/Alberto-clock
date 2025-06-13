<?php
session_start();
include '../models/User.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    try {
        $userModel = new User();
        $user = $userModel->authenticate($email, $password);

        if ($user) {
            // Đăng nhập thành công, lưu thông tin người dùng vào session
            $_SESSION['user'] = [
                'id'      => $user['user_id'],
                'name'    => $user['name'],
                'email'   => $user['email'],
                'role_id' => $user['role_id']
            ];

            // Kiểm tra nếu là admin, chuyển hướng đến trang quản trị admin
            if ($user['role_id'] == 1) { // Giả sử 'role_id' = 1 là admin
                header("Location: ../admin/users_curd_page.php"); // Đảm bảo đường dẫn đúng
            } else {
                header("Location: ../views/index.php"); // Nếu không phải admin, chuyển đến trang chính
            }
            exit();
        } else {
            // Sai thông tin đăng nhập
            echo "<script>alert('Email hoặc mật khẩu không đúng!'); window.location.href='../views/login.php';</script>";
            exit();
        }
    } catch (PDOException $e) {
        echo "<script>alert('Lỗi hệ thống: " . $e->getMessage() . "'); window.location.href='../views/login.php';</script>";
        exit();
    }
} else {
    // Nếu không phải POST request, chuyển về trang đăng nhập
    header("Location: ../views/login.php");
    exit();
}
