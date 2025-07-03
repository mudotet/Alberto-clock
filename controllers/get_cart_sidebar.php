<?php
session_start(); // Bắt đầu session để lấy thông tin người dùng đăng nhập

// Nạp các model cần thiết để thao tác với giỏ hàng và sản phẩm
require_once '../models/Cart.php';
require_once '../models/CartDetail.php';
require_once '../models/Watch.php';

// Đặt header trả về là JSON để phía client (JS) dễ xử lý
header('Content-Type: application/json');

// Lấy user_id từ session (nếu chưa đăng nhập thì user_id = 0)
$user_id = $_SESSION['user']['id'] ?? 0;

// Nếu chưa đăng nhập thì trả về mảng rỗng (giỏ hàng trống)
if (!$user_id) {
    echo json_encode(['items' => []]);
    exit;
}

// Khởi tạo các model để thao tác dữ liệu
$cartModel = new Cart();
$cartDetailModel = new CartDetail();
$watchModel = new Watch();

// Lấy thông tin giỏ hàng của user hiện tại
$cart = $cartModel->getCartByUserId($user_id);
$items = []; // Mảng chứa các sản phẩm trong giỏ

if ($cart) {
    // Lấy chi tiết các sản phẩm trong giỏ hàng
    $details = $cartDetailModel->getCartDetailsByCartId($cart['cart_id']);
    foreach ($details as $detail) {
        // Lấy thông tin đồng hồ theo watch_id
        $watch = $watchModel->getWatchById($detail['watch_id']);
        if ($watch) {
            // Thêm thông tin từng sản phẩm vào mảng $items
            $items[] = [
                'watches_images' => $watch['watches_images'], // Đường dẫn ảnh sản phẩm
                'quantity' => $detail['quantity'],            // Số lượng sản phẩm
                'model' => $watch['model']                    // Tên model sản phẩm
            ];
        }
    }
}

// Trả về dữ liệu giỏ hàng dưới dạng JSON cho phía client sử dụng
echo json_encode(['items' => $items]);