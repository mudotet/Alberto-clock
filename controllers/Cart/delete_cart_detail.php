<?php

session_start();
require_once '../../models/CartDetail.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cart_detail_id = $_POST['cart_detail_id'] ?? 0;
    if ($cart_detail_id) {
        $cartDetailModel = new CartDetail();
        $cartDetailModel->deleteCartDetail($cart_detail_id);
    }
}
header('Location: ../../views/cart_detail.php');
exit;