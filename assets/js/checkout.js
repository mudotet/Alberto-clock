document.addEventListener('DOMContentLoaded', function() {
    function getValue(id, defaultValue) {
        const el = document.getElementById(id);
        if (!el) return defaultValue;
        return el.getAttribute('data-value') || el.textContent || defaultValue;
    }

    const qrImg = document.getElementById('vietqr-img');

    function updateQR() {
        const bank = getValue('bank_id', 'VCB');
        const account = getValue('account_no', '0123456789');
        const amount = getValue('amount', '1000000').replace(/[^0-9]/g, ''); // Lấy số
        const info = encodeURIComponent(getValue('add_info', 'ThanhToanAlbertoClock'));
        const name = encodeURIComponent(getValue('account_name', 'ALBERTO CLOCK'));
        const template = 'compact2';
        const qrUrl = `https://img.vietqr.io/image/${bank}-${account}-${template}.png?amount=${amount}&addInfo=${info}&accountName=${name}`;
        qrImg.src = qrUrl;
    }

    updateQR();
});