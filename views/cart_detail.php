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
    <style>
        .table thead th, .table tfoot th {
            background: #f9f3ea !important;
            color: #a86b1c !important;
            font-weight: 600;
            font-size: 1.05rem;
        }
        .table td, .table th {
            vertical-align: middle !important;
        }
        .btn-outline-warning {
            border-color: #ffc107;
            color: #a86b1c;
            background: #fffbe7;
        }
        .btn-outline-warning:hover, .btn-outline-warning:focus {
            background: #ffc107;
            color: #fff;
            border-color: #ffc107;
        }
        .btn-outline-danger {
            border-color: #dc3545;
            color: #dc3545;
            background: #fff;
        }
        .btn-outline-danger:hover, .btn-outline-danger:focus {
            background: #dc3545;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <h3 class="mb-4">🛒 Giỏ hàng của bạn</h3>
        <?php if (empty($items)): ?>
            <div class="alert alert-info text-center py-4 fs-5 rounded-3 shadow-sm" style="background:#fffbe7;">
                <i class="fa fa-cart-arrow-down fa-2x mb-2 text-warning"></i><br>
                Giỏ hàng của bạn đang trống.
            </div>
        <?php else: ?>
            <div class="table-responsive rounded-4 shadow-sm">
                <table class="table align-middle mb-0" style="background:#fff;">
                    <thead style="background: #f9f3ea;">
                        <tr>
                            <th style="color:#a86b1c;">Ảnh</th>
                            <th style="color:#a86b1c;">Sản phẩm</th>
                            <th style="color:#a86b1c;">Giá</th>
                            <th class="text-center" style="color:#a86b1c;">Số lượng</th>
                            <th style="color:#a86b1c;">Thành tiền</th>
                            <th style="color:#a86b1c;">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($items as $item):
                        $watch = (new Watch())->getWatchById($item['watch_id']);
                    ?>
                        <tr>
                            <td>
                                <img src="../assets/<?= htmlspecialchars($watch['watches_images']) ?>"
                                    alt="<?= htmlspecialchars($watch['model']) ?>"
                                    class="rounded-3 shadow-sm border"
                                    style="width:60px;height:60px;object-fit:cover;background:#f9f3ea;">
                            </td>
                            <td>
                                <span class="fw-semibold" style="color:#8d4a06;"><?= htmlspecialchars($watch['model']) ?></span>
                            </td>
                            <td class="text-nowrap fw-bold" style="color:#a86b1c;"><?= number_format($item['item_price'], 0, ',', '.') ?> VNĐ</td>
                            <td class="text-center">
                                <form method="post" action="../controllers/Cart/update_cart_detail.php" class="d-inline-flex align-items-center gap-1">
                                    <input type="hidden" name="cart_detail_id" value="<?= $item['cart_detail_id'] ?>">
                                    <button name="action" value="decrease" class="btn btn-sm btn-outline-warning px-2"
                                        <?= $item['quantity'] <= 1 ? 'disabled' : '' ?> title="Giảm">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <span class="mx-2 fs-5"><?= $item['quantity'] ?></span>
                                    <button name="action" value="increase" class="btn btn-sm btn-outline-warning px-2" title="Tăng">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="text-nowrap fw-bold" style="color:#198754;"><?= number_format($item['item_price'] * $item['quantity'], 0, ',', '.') ?> VNĐ</td>
                            <td>
                                <form method="post" action="../controllers/Cart/delete_cart_detail.php" class="d-inline"
                                    onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?');">
                                    <input type="hidden" name="cart_detail_id" value="<?= $item['cart_detail_id'] ?>">
                                    <button class="btn btn-sm btn-outline-danger" title="Xóa sản phẩm">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr style="background:#f9f3ea;">
                            <th colspan="4" class="text-end fs-5" style="color:#a86b1c;">Tổng tiền:</th>
                            <th class="fs-5 text-danger"><?= number_format($total, 0, ',', '.') ?> VNĐ</th>
                            <th class="text-end">
                                <form action="checkout.php" method="get" class="d-inline ">
                                    <input type="hidden" name="amount" value="<?= $total ?>">
                                    <input type="hidden" name="model" value="ThanhToanAlbertoClock">
                                    <button type="submit" class="btn" style="background-color: #212529; color: #fff;">
                                        <i class="fa-solid fa-credit-card me-1"></i> Thanh toán
                                    </button>
                                </form>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        <?php endif; ?>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>
</html>