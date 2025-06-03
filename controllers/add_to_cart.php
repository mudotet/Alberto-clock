<?php
session_start();
require_once '../models/Cart.php';
require_once '../models/CartDetail.php';

if (!isset($_SESSION['user'])) {
    header('Location: ../views/login.php');
    exit;
}

$user_id = $_SESSION['user']['id'];
$watch_id = isset($_POST['watch_id']) ? (int)$_POST['watch_id'] : 0;
$quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

if ($watch_id <= 0) {
    header('Location: ../views/index.php');
    exit;
}

$cartModel = new Cart();
$cartDetailModel = new CartDetail();

// Lấy giỏ hàng đang mở hoặc tạo mới nếu chưa có
$cart = $cartModel->getOpenCartByUser($user_id);
if (!$cart) {
    $cart_id = $cartModel->createCart($user_id);
} else {
    $cart_id = $cart['cart_id'];
}

// Lấy giá sản phẩm
require_once '../models/Watch.php';
$watchModel = new Watch();
$watch = $watchModel->getWatchById($watch_id);
$item_price = $watch ? $watch['price'] : 0;

// Thêm hoặc cập nhật sản phẩm vào cart_details
$cartDetailModel->addOrUpdateCartDetail($cart_id, $watch_id, $quantity, $item_price);

// Cập nhật tổng tiền cho giỏ hàng
$cartModel->updateTotalAmount($cart_id);

// Quay lại trang trước
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;