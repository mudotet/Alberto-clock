<?php
// filepath: c:\xampp\htdocs\PHP\Alberto-clock\controllers\Cart\update_cart_detail.php
session_start();
require_once '../../models/CartDetail.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cart_detail_id = $_POST['cart_detail_id'] ?? 0;
    $action = $_POST['action'] ?? '';
    $cartDetailModel = new CartDetail();

    // Lấy chi tiết hiện tại
    $detail = $cartDetailModel->getCartDetailById($cart_detail_id);
    $quantity = $detail ? (int)$detail['quantity'] : 1;

    if ($cart_detail_id && $action) {
        if ($action === 'increase') {
            $quantity++;
        } elseif ($action === 'decrease' && $quantity > 1) {
            $quantity--;
        }
        $cartDetailModel->updateQuantity($cart_detail_id, $quantity);
    }
}
header('Location: ../../views/cart_detail.php');
exit;