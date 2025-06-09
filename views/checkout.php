<?php
$amount = isset($_GET['amount']) ? (int)$_GET['amount'] : 1000000;
$model = isset($_GET['model']) ? $_GET['model'] : 'ThanhToanAlbertoClock';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../includes/css_includes/footer.css">
    <link rel="stylesheet" href="../includes/css_includes/header.css">
</head>

<body>
    <?php include '../includes/header.php'; ?>
    <div class="container text-center mt-5">
        <h1>Checkout Page</h1>
        <p class="lead">Quét mã QR để thanh toán đơn hàng của bạn</p>
        <div class="row justify-content-center mb-3">
            <div class="col-md-4 text-start mx-auto">
                <div class="mb-2">Ngân hàng: <span id="bank_id" data-value="VCB" class="fw-semibold text-dark">VCB</span></div>
                <div class="mb-2">Số tài khoản: <span id="account_no" data-value="0123456789" class="fw-semibold text-dark">0123456789</span></div>
                <div class="mb-2">Số tiền: <span id="amount" data-value="<?= $amount ?>" class="fw-bold text-danger" style="font-size:1.2em;"><?= number_format($amount, 0, ',', '.') ?> VNĐ</span></div>
                <div class="mb-2">Nội dung: <span id="add_info" data-value="<?= htmlspecialchars($model) ?>" class="fw-semibold text-dark"><?= htmlspecialchars($model) ?></span></div>
                <div class="mb-2">Tên tài khoản: <span id="account_name" data-value="ALBERTO CLOCK" class="fw-semibold text-dark">ALBERTO CLOCK</span></div>
            </div>
        </div>
        <img id="vietqr-img" class="img-fluid my-4" style="max-width:320px;">
        <div class="alert alert-info w-50 mx-auto">Vui lòng chuyển khoản đúng số tiền và nội dung để đơn hàng được xác nhận nhanh chóng.</div>
    </div>
    <?php include '../includes/footer.php'; ?>
    <script src="../assets/js/checkout.js"></script>
</body>

</html>