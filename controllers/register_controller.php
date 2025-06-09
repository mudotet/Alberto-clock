<?php
session_start();
require_once '../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name       = $_POST['name'];
    $email      = $_POST['email'];
    $password   = $_POST['password'];
    $phone      = $_POST['phone'];
    $created_at = $_POST['created_at'];
    $role_id    = $_POST['role_id'];
    $address    = $_POST['address'];

    try {
        $pdo = Db_connect::getConnection();

        // Kiểm tra email đã tồn tại chưa
        $stmt = $pdo->prepare("SELECT user_id FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        if ($stmt->fetch()) {
            echo "<script>alert('Email đã được sử dụng!'); window.location.href='../views/register.php';</script>";
            exit();
        }

       $stmt = $pdo->prepare("INSERT INTO users (email, password, role_id, name, phone_number, address, registration_date) VALUES (:email, :password, :role_id, :name, :phone_number, :address, :registration_date)");
        $stmt->execute([
            ':email'             => $email,
            ':password'          => $password, 
            ':role_id'           => $role_id,
            ':name'              => $name,
            ':phone_number'      => $phone,
            ':address'           => $address,
            ':registration_date' => $created_at
        ]);

        echo "<script>alert('Đăng ký thành công! Vui lòng đăng nhập.'); window.location.href='../views/login.php';</script>";
        exit();
    } catch (PDOException $e) {
        echo "<script>alert('Lỗi hệ thống: " . $e->getMessage() . "'); window.location.href='../views/register.php';</script>";
        exit();
    }
} else {
    header("Location: ../views/register.php");
    exit();
}