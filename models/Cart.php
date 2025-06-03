<?php
require_once '../includes/db_connect.php';

class Cart {
    private $conn;

    public function __construct() {
        $this->conn = Db_connect::getConnection();
        if ($this->conn === null) {
            throw new Exception('Database connection failed.');
        }
    }

    // CREATE - Thêm giỏ hàng mới
    public function createCart($user_id, $cart_date) {
        $sql = "INSERT INTO carts (user_id, cart_date) VALUES (:user_id, :cart_date)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':user_id' => $user_id,
            ':cart_date' => $cart_date
        ]);
    }

    // READ - Lấy giỏ hàng theo ID
    public function getCartById($cart_id) {
        $sql = "SELECT * FROM cart WHERE cart_id = :cart_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':cart_id' => $cart_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // READ - Lấy tất cả giỏ hàng
    public function getAllCarts() {
        $sql = "SELECT * FROM cart";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // DELETE - Xóa giỏ hàng
    public function deleteCart($cart_id) {
        $sql = "DELETE FROM cart WHERE cart_id = :cart_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':cart_id' => $cart_id]);
    }
}