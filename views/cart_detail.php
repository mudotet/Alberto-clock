<?php
include '../includes/header.php'; 
require_once '../models/Cart.php';
require_once '../models/CartDetail.php';
require_once '../models/Watch.php';

$user_id = $_SESSION['user']['id'] ?? 0;
$cartModel = new Cart();
$cartDetailModel = new CartDetail();
$cart = $cartModel->getCartByUserId($user_id);
$cart_id = $cart['cart_id'] ?? 0;
$items = $cart_id ? $cartDetailModel->getCartDetailsByCartId($cart_id) : [];
$total = $cartDetailModel->getTotalPriceByCartId($cart_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng của bạn</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../includes/css_includes/footer.css">
    <link rel="stylesheet" href="../includes/css_includes/header.css">
</head>
<body>
    <div class="container my-5">
        <h3 class="mb-4">🛒 Giỏ hàng của bạn</h3>
        <?php if (empty($items)): ?>
            <div class="alert alert-info text-center">Giỏ hàng của bạn đang trống.</div>
        <?php else: ?>
        <table class="table table-bordered align-middle">
            <thead class="table-light">
            <tr>
                <th>Ảnh</th>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th class="text-center">Số lượng</th>
                <th>Thành tiền</th>
                <th>Xóa</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($items as $item):
                $watch = (new Watch())->getWatchById($item['watch_id']);
            ?>
            <tr>
                <td><img src="../assets/<?= htmlspecialchars($watch['watches_images']) ?>" style="width:60px;height:60px;object-fit:cover"></td>
                <td><?= htmlspecialchars($watch['model']) ?></td>
                <td><?= number_format($item['item_price'], 0, ',', '.') ?> VNĐ</td>
                <td class="text-center">
                    <form method="post" action="../controllers/Cart/update_cart_detail.php" class="d-inline">
                        <input type="hidden" name="cart_detail_id" value="<?= $item['cart_detail_id'] ?>">
                        <button name="action" value="decrease" class="btn btn-sm btn-outline-secondary" <?= $item['quantity'] <= 1 ? 'disabled' : '' ?>>-</button>
                        <span class="mx-2"><?= $item['quantity'] ?></span>
                        <button name="action" value="increase" class="btn btn-sm btn-outline-secondary">+</button>
                    </form>
                </td>
                <td><?= number_format($item['item_price'] * $item['quantity'], 0, ',', '.') ?> VNĐ</td>
                <td>
                    <form method="post" action="../controllers/Cart/delete_cart_detail.php" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?');">
                        <input type="hidden" name="cart_detail_id" value="<?= $item['cart_detail_id'] ?>">
                        <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
            <tr>
                <th colspan="4" class="text-end">Tổng tiền:</th>
                <th><?= number_format($total, 0, ',', '.') ?> VNĐ</th>
            </tr>
            </tfoot>
        </table>
        <?php endif; ?>
        <form action="checkout.php" method="get" class="d-inline ">
            <input type="hidden" name="amount" value="<?= $total ?>">
            <input type="hidden" name="model" value="ThanhToanAlbertoClock">
            <button type="submit" class="btn" style="background-color: #212529; color: #fff;">
                <i class="fa-solid fa-credit-card me-1"></i> Thanh toán
            </button>
        </form>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>
</html>