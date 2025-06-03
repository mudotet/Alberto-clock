<?php
// filepath: c:\xampp\htdocs\PHP\alberto-clock\models\CartDetail.php

require_once '../includes/db_connect.php';

class CartDetail
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Db_connect::getConnection();
    }

    // Thêm sản phẩm vào chi tiết giỏ hàng (nếu đã có thì cộng dồn số lượng)
    public function addOrUpdateCartDetail($cart_id, $watch_id, $quantity, $item_price)
    {
        // Kiểm tra sản phẩm đã có trong giỏ chưa
        $stmt = $this->pdo->prepare("SELECT * FROM cart_details WHERE cart_id = :cart_id AND watch_id = :watch_id");
        $stmt->execute([':cart_id' => $cart_id, ':watch_id' => $watch_id]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($item) {
            // Nếu đã có thì cập nhật số lượng
            $stmt = $this->pdo->prepare("UPDATE cart_details SET quantity = quantity + :quantity WHERE cart_detail_id = :cart_detail_id");
            $stmt->execute([
                ':quantity' => $quantity,
                ':cart_detail_id' => $item['cart_detail_id']
            ]);
        } else {
            // Nếu chưa có thì thêm mới
            $stmt = $this->pdo->prepare("INSERT INTO cart_details (cart_id, watch_id, quantity, item_price) VALUES (:cart_id, :watch_id, :quantity, :item_price)");
            $stmt->execute([
                ':cart_id'    => $cart_id,
                ':watch_id'   => $watch_id,
                ':quantity'   => $quantity,
                ':item_price' => $item_price
            ]);
        }
    }

    // Lấy chi tiết giỏ hàng theo cart_id, kèm thông tin watches
    public function getCartDetailsWithInfo($cart_id)
    {
        $stmt = $this->pdo->prepare("
            SELECT 
                cd.*, 
                w.model, w.price, w.brand_name, w.watches_images
            FROM cart_details cd
            INNER JOIN watches w ON cd.watch_id = w.watch_id
            WHERE cd.cart_id = :cart_id
        ");
        $stmt->execute([':cart_id' => $cart_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Cập nhật số lượng sản phẩm trong chi tiết giỏ hàng
    public function updateQuantity($cart_detail_id, $quantity)
    {
        $stmt = $this->pdo->prepare("UPDATE cart_details SET quantity = :quantity WHERE cart_detail_id = :cart_detail_id");
        $stmt->execute([
            ':quantity' => $quantity,
            ':cart_detail_id' => $cart_detail_id
        ]);
    }

    // Xóa sản phẩm khỏi chi tiết giỏ hàng
    public function removeCartDetail($cart_detail_id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM cart_details WHERE cart_detail_id = :cart_detail_id");
        $stmt->execute([':cart_detail_id' => $cart_detail_id]);
    }
}