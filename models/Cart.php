<?php
// filepath: c:\xampp\htdocs\PHP\alberto-clock\models\Cart.php

require_once '../includes/db_connect.php';

class Cart
{
    private $conn;

    public function __construct()
    {
        $this->conn = Db_connect::getConnection();
        if ($this->conn === null) {
            throw new Exception('Database connection failed.');
        }
    }

    // Tạo giỏ hàng mới cho user (nếu chưa có giỏ hàng đang mở)
    public function createCart($user_id)
    {
        $stmt = $this->conn->prepare("INSERT INTO cart (user_id, status, created_at, total_amount) VALUES (:user_id, 0, NOW(), 0)");
        $stmt->execute([':user_id' => $user_id]);
        return $this->conn->lastInsertId();
    }

    // Lấy giỏ hàng đang mở (status = 0) của user
    public function getOpenCartByUser($user_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM cart WHERE user_id = :user_id AND status = 0 LIMIT 1");
        $stmt->execute([':user_id' => $user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy giỏ hàng theo ID
    public function getCartById($cart_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM cart WHERE cart_id = :cart_id");
        $stmt->execute([':cart_id' => $cart_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy tất cả giỏ hàng
    public function getAllCarts()
    {
        $stmt = $this->conn->query("SELECT * FROM cart");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Xóa giỏ hàng
    public function deleteCart($cart_id)
    {
        $stmt = $this->conn->prepare("DELETE FROM cart WHERE cart_id = :cart_id");
        return $stmt->execute([':cart_id' => $cart_id]);
    }

    // Cập nhật tổng tiền cho giỏ hàng
    public function updateTotalAmount($cart_id)
    {
        $stmt = $this->conn->prepare("
            SELECT SUM(quantity * item_price) as total 
            FROM cart_details 
            WHERE cart_id = :cart_id
        ");
        $stmt->execute([':cart_id' => $cart_id]);
        $total = $stmt->fetchColumn();
        if ($total === null) $total = 0;
        $stmt = $this->conn->prepare("UPDATE cart SET total_amount = :total WHERE cart_id = :cart_id");
        $stmt->execute([':total' => $total, ':cart_id' => $cart_id]);
    }

    // Đổi trạng thái giỏ hàng (ví dụ khi đặt hàng thành công)
    public function checkout($cart_id)
    {
        $stmt = $this->conn->prepare("UPDATE cart SET status = 1 WHERE cart_id = :cart_id");
        $stmt->execute([':cart_id' => $cart_id]);
    }

    // Lấy giỏ hàng kèm thông tin user
    public function getCartWithUser($cart_id)
    {
        $stmt = $this->conn->prepare("
            SELECT 
                c.*, 
                u.user_id, u.name AS user_name, u.email, u.phone_number
            FROM cart c
            JOIN users u ON c.user_id = u.user_id
            WHERE c.cart_id = :cart_id
        ");
        $stmt->execute([':cart_id' => $cart_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}