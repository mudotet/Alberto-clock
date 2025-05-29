<?php
require_once '../includes/db_connect.php';

class CartDetail {
    private $conn;

    public function __construct() {
        $this->conn = Db_connect::getConnection();
        if ($this->conn === null) {
            throw new Exception('Database connection failed.');
        }
    }

    public function createCartDetail($data) {
        $sql = "INSERT INTO cart_details (cart_id, watch_id, quantity, item_price)
                VALUES (:cart_id, :watch_id, :quantity, :item_price)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':cart_id' => $data['cart_id'],
            ':watch_id' => $data['watch_id'],
            ':quantity' => $data['quantity'],
            ':item_price' => $data['item_price']
        ]);
    }
    
    // READ - Lấy tất cả CartDetail
    public function getAllCartDetails()
    {
        $sql = "SELECT * FROM cart_details";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    public function getDetailsByCartId($cart_id) {
        $sql = "SELECT * FROM cart_details WHERE cart_id = :cart_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':cart_id' => $cart_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateCartDetail($cart_detail_id, $data) {
        $sql = "UPDATE cart_details SET
                    cart_id = :cart_id,
                    watch_id = :watch_id,
                    quantity = :quantity,
                    item_price = :item_price
                WHERE cart_detail_id = :cart_detail_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':cart_detail_id' => $cart_detail_id,
            ':cart_id' => $data['cart_id'],
            ':watch_id' => $data['watch_id'],
            ':quantity' => $data['quantity'],
            ':item_price' => $data['item_price']
        ]);
    }

    public function deleteCartDetail($cart_detail_id) {
        $sql = "DELETE FROM cart_details WHERE cart_detail_id = :cart_detail_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':cart_detail_id' => $cart_detail_id]);
    }
}
