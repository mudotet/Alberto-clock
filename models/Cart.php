<?php
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

    // Tạo giỏ hàng mới cho user
    public function createCart($user_id)
    {
        $stmt = $this->conn->prepare("INSERT INTO cart (user_id, created_at) VALUES (:user_id, NOW())");
        $stmt->execute([':user_id' => $user_id]);
        return $this->conn->lastInsertId();
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