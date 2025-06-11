<?php
session_start();
require_once '../models/Cart.php';
require_once '../models/CartDetail.php';
require_once '../models/Watch.php';

header('Content-Type: application/json');

$user_id = $_SESSION['user']['id'] ?? 0;
if (!$user_id) {
    echo json_encode(['items' => []]);
    exit;
}

$cartModel = new Cart();
$cartDetailModel = new CartDetail();
$watchModel = new Watch();

$cart = $cartModel->getCartByUserId($user_id);
$items = [];
if ($cart) {
    $details = $cartDetailModel->getCartDetailsByCartId($cart['cart_id']);
    foreach ($details as $detail) {
        $watch = $watchModel->getWatchById($detail['watch_id']);
        if ($watch) {
            $items[] = [
                'watches_images' => $watch['watches_images'],
                'quantity' => $detail['quantity'],
                'model' => $watch['model']
            ];
        }
    }
}
echo json_encode(['items' => $items]);