<?php
session_start();
require_once '../models/Cart.php';
require_once '../models/CartDetail.php';
$user_id = $_SESSION['user']['id'] ?? 0;
if (!$user_id) {
    http_response_code(400);
    echo json_encode(['error' => 'Bạn chưa đăng nhập!']);
    exit;
}
if(!isset($_POST['watch_id']) || !isset($_POST['quantity'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Thiếu thông tin sản phẩm!']);
    exit;
}
$watch_id = $_POST['watch_id'] ?? 0;
$quantity = $_POST['quantity'] ?? 1;

$cartModel = new Cart();
$cartDetailModel = new CartDetail();

// 1. Kiểm tra đã có cart chưa, nếu chưa thì tạo mới
$cart = $cartModel->getCartByUserId($user_id);
if (!$cart) {
    $cart_id = $cartModel->createCart($user_id);
} else {
    $cart_id = $cart['cart_id'];
}

// 2. Kiểm tra sản phẩm đã có trong cart_detail chưa
$cartDetail = $cartDetailModel->getCartDetailByCartIdAndWatchId($cart_id, $watch_id);

if ($cartDetail) {
    // Nếu đã có, cập nhật số lượng
    $cartDetailModel->updateQuantity($cartDetail['cart_detail_id'], $cartDetail['quantity'] + $quantity);
} else {
    // Nếu chưa có, thêm mới
    // Lấy giá sản phẩm từ bảng watches
    require_once '../models/Watch.php';
    $watchModel = new Watch();
    $watch = $watchModel->getWatchById($watch_id);
    $item_price = $watch['price'];
    $cartDetailModel->addCartDetail($cart_id, $watch_id, $quantity, $item_price);
}

// Trả về dữ liệu giỏ hàng mới nhất (dùng cho AJAX)
$items = $cartModel->getCartItemsWithImageAndQuantity($user_id);
echo json_encode(['success' => true, 'items' => $items]);