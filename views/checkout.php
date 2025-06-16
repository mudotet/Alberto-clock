<?php
$amount = isset($_GET['amount']) ? (int)$_GET['amount'] : 1000000;
$model = isset($_GET['model']) ? $_GET['model'] : 'ThanhToanAlbertoClock';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán đơn hàng | Alberto Clock</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../includes/css_includes/footer.css">
    <link rel="stylesheet" href="../includes/css_includes/header.css">
    <link rel="stylesheet" href="../includes/css_includes/checkout.css">
</head>
<body>
<?php include '../includes/header.php'; ?>
<div class="container">
    <div class="checkout-box mt-5">
        <div class="text-center mb-3">
            <div class="checkout-title"><i class="fa-solid fa-credit-card me-2"></i>Thanh toán đơn hàng</div>
            <div class="text-secondary mb-3">Quét mã QR để thanh toán nhanh chóng và an toàn</div>
        </div>
        <div class="mb-3">
            <div class="row g-2">
                <div class="col-6 checkout-info-label">Ngân hàng:</div>
                <div class="col-6 checkout-info-value" id="bank_id" data-value="VCB">VCB</div>
                <div class="col-6 checkout-info-label">Số tài khoản:</div>
                <div class="col-6 checkout-info-value" id="account_no" data-value="0123456789">0123456789</div>
                <div class="col-6 checkout-info-label">Tên tài khoản:</div>
                <div class="col-6 checkout-info-value" id="account_name" data-value="ALBERTO CLOCK">ALBERTO CLOCK</div>
                <div class="col-6 checkout-info-label">Số tiền:</div>
                <div class="col-6 checkout-amount" id="amount" data-value="<?= $amount ?>"><?= number_format($amount, 0, ',', '.') ?> VNĐ</div>
                <div class="col-6 checkout-info-label">Nội dung:</div>
                <div class="col-6 checkout-info-value" id="add_info" data-value="<?= htmlspecialchars($model) ?>"><?= htmlspecialchars($model) ?></div>
            </div>
        </div>
        <img id="vietqr-img" class="checkout-qr" alt="QR thanh toán">
        <div class="alert checkout-alert text-center mt-3">
            <i class="fa-solid fa-circle-info me-1"></i>
            Vui lòng chuyển khoản <b>đúng số tiền và nội dung</b> để đơn hàng được xác nhận nhanh chóng.<br>
            Nếu có vấn đề, liên hệ <a href="tel:+84123456789" class="fw-bold" style="color:#8d4a06;">0123 456 789</a>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>
<script src="../assets/js/checkout.js"></script>
</body>
</html>