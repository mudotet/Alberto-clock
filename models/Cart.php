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

    // Tạo giỏ hàng mới cho user (nếu chưa có giỏ hàng đang mở)
    public function createCart($user_id)
    {
        $stmt = $this->conn->prepare("INSERT INTO cart (user_id, status, created_at, total_amount) VALUES (:user_id, 0, NOW(), 0)");
        $stmt->execute([':user_id' => $user_id]);
        return $this->conn->lastInsertId();
    }

    
}