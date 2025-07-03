<?php
session_start(); // Bắt đầu session để lưu thông tin đăng nhập
include '../models/User.php'; // Nạp model User để thao tác với dữ liệu người dùng

// Kiểm tra nếu request là POST (tức là người dùng submit form đăng nhập)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = $_POST['email'];    // Lấy email từ form
    $password = $_POST['password']; // Lấy mật khẩu từ form

    try {
        $userModel = new User(); // Khởi tạo đối tượng User
        $user = $userModel->authenticate($email, $password); // Kiểm tra thông tin đăng nhập

        if ($user) {
            // Nếu đăng nhập thành công, lưu thông tin user vào session
            $_SESSION['user'] = [
                'id'      => $user['user_id'],
                'name'    => $user['name'],
                'email'   => $user['email'],
                'role_id' => $user['role_id']
            ];
            // Nếu là admin thì chuyển hướng đến trang quản trị, ngược lại về trang chủ
            if ($user['role_id'] == 1) {
                header("Location: ../admin/users_curd_page.php");
            } else {
                header("Location: ../views/index.php");
            }
            exit();
        } else {
            // Nếu thông tin đăng nhập sai, hiển thị thông báo và quay lại trang đăng nhập
            echo "<script>alert('Email hoặc mật khẩu không đúng!'); window.location.href='../views/login.php';</script>";
            exit();
        }
    } catch (PDOException $e) {
        // Nếu có lỗi kết nối CSDL, hiển thị thông báo lỗi và quay lại trang đăng nhập
        echo "<script>alert('Lỗi hệ thống: " . $e->getMessage() . "'); window.location.href='../views/login.php';</script>";
        exit();
    }
} else {
    // Nếu truy cập không phải bằng POST, chuyển hướng về trang đăng nhập
    header("Location: ../views/login.php");
    exit();
}