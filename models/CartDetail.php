<?php
require_once __DIR__ . '/../includes/db_connect.php';

class CartDetail
{
    private $conn;

    public function __construct()
    {
        $this->conn = Db_connect::getConnection();
        if ($this->conn === null) {
            throw new Exception('Database connection failed.');
        }
    }

    // Thêm sản phẩm vào giỏ hàng
    public function addCartDetail($cart_id, $watch_id, $quantity, $item_price)
    {
        $stmt = $this->conn->prepare("INSERT INTO cart_details (cart_id, watch_id, quantity, item_price) VALUES (:cart_id, :watch_id, :quantity, :item_price)");
        return $stmt->execute([
            ':cart_id' => $cart_id,
            ':watch_id' => $watch_id,
            ':quantity' => $quantity,
            ':item_price' => $item_price
        ]);
    }

    // Lấy chi tiết giỏ hàng theo cart_id
    public function getCartDetailsByCartId($cart_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM cart_details WHERE cart_id = :cart_id");
        $stmt->execute([':cart_id' => $cart_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Xóa chi tiết giỏ hàng
    public function deleteCartDetail($cart_detail_id)
    {
        $stmt = $this->conn->prepare("DELETE FROM cart_details WHERE cart_detail_id = :cart_detail_id");
        return $stmt->execute([':cart_detail_id' => $cart_detail_id]);
    }

    // Lấy tổng giá tiền của các đồng hồ trong giỏ hàng
    public function getTotalPriceByCartId($cart_id)
    {
        $stmt = $this->conn->prepare("SELECT SUM(quantity * item_price) AS total_price FROM cart_details WHERE cart_id = :cart_id");
        $stmt->execute([':cart_id' => $cart_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_price'] ?? 0;
    }
    
    // Lấy chi tiết giỏ hàng theo cart_id và watch_id
    public function getCartDetailByCartIdAndWatchId($cart_id, $watch_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM cart_details WHERE cart_id = :cart_id AND watch_id = :watch_id");
        $stmt->execute([':cart_id' => $cart_id, ':watch_id' => $watch_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cập nhật số lượng sản phẩm trong giỏ hàng
    public function updateQuantity($cart_detail_id, $quantity)
    {
        $stmt = $this->conn->prepare("UPDATE cart_details SET quantity = :quantity WHERE cart_detail_id = :cart_detail_id");
        return $stmt->execute([':quantity' => $quantity, ':cart_detail_id' => $cart_detail_id]);
    }
    public function getCartDetailById($cart_detail_id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM cart_details WHERE cart_detail_id = :cart_detail_id");
        $stmt->execute([':cart_detail_id' => $cart_detail_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}