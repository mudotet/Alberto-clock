<?php
session_start();
require_once '../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    =$_POST['email'];
    $password = $_POST['password'];

    try {
        $pdo = Db_connect::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Đăng nhập thành công
            $_SESSION['user'] = [
                'id'      => $user['id'],
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