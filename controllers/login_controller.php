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
            // Đăng nhập thành công
            $_SESSION['user'] = [
                'id'      => $user['user_id'],
                'name'    => $user['name'],
                'email'   => $user['email'],
                'role_id' => $user['role_id']
            ];
            header("Location: ../views/index.php");
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
    header("Location: ../views/login.php");
    exit();
}