<?php
session_start();
include_once('../db/connect.php');

// Lấy tổng tiền thực từ giỏ hàng
$paymentAmount = isset($_SESSION['totalPayment']) ? $_SESSION['totalPayment'] : 0;

// Biến điều khiển trạng thái hiển thị
$showQR = false;  // false: form thông tin; 'selectMethod': chọn phương thức; true: hiển thị QR

// Khởi tạo session chọn phương thức
if (!isset($_SESSION['selectedPaymentMethod'])) {
    $_SESSION['selectedPaymentMethod'] = '';
}

// Khởi tạo client_id session (giữ để dùng khi bấm "Đã thanh toán")
if (!isset($_SESSION['client_id'])) {
    $_SESSION['client_id'] = 0;
}

// Xử lý submit thông tin khách hàng
if (isset($_POST['submit_payment'])) {
    $client_name = mysqli_real_escape_string($conn, $_POST['client_name']);
    $client_phone = mysqli_real_escape_string($conn, $_POST['client_phone']);
    $client_address = mysqli_real_escape_string($conn, $_POST['client_address']);
    $client_email = mysqli_real_escape_string($conn, $_POST['client_email']);
    $client_note = mysqli_real_escape_string($conn, $_POST['client_note']);
    $transport = mysqli_real_escape_string($conn, $_POST['transport']);
    $client_password = md5('123456');

    $insertClientQuery = "INSERT INTO tb_client (client_name, client_phone, client_address, client_email, client_note, transport, client_password)
                          VALUES ('$client_name', '$client_phone', '$client_address', '$client_email', '$client_note', '$transport', '$client_password')";
    
    if (mysqli_query($conn, $insertClientQuery)) {
        $client_id = mysqli_insert_id($conn);
        $_SESSION['client_id'] = $client_id; // lưu session client_id
        $cartQuery = "SELECT * FROM tb_cart";
        $cartResult = mysqli_query($conn, $cartQuery);
        
        while ($cartRow = mysqli_fetch_assoc($cartResult)) {
            $product_id = $cartRow['product_id'];
            $order_many = $cartRow['cart_many'];
            $product_price = $cartRow['product_price']; // lấy giá thực
            
            $oder_status = 0; // Chưa duyệt
            $cancel_oder = 0;
            $createOrderQuery = "INSERT INTO tb_order (client_id, order_date, oder_status, cancel_oder, product_id, order_many)
                                VALUES ('$client_id', NOW(), '$oder_status', '$cancel_oder', '$product_id', '$order_many')";
            
            if (mysqli_query($conn, $createOrderQuery)) {
                mysqli_query($conn, "DELETE FROM tb_cart WHERE product_id = '$product_id'");
                $paymentAmount += $order_many * $product_price;
            }
        }
        $_SESSION['totalPayment'] = $paymentAmount;

        $transaction_date = date('Y-m-d');  
        $oder_status = '0';  
        $canceloder = '0';  

        $transactionQuery = "INSERT INTO tb_transaction (product_id, transaction_many, transaction_date, client_id, oder_status, canceloder)
                    SELECT product_id, order_many, '$transaction_date', '$client_id', '$oder_status', '$canceloder'
                    FROM tb_order
                    WHERE client_id = '$client_id'";
        mysqli_query($conn, $transactionQuery);

        // Sau khi nhập thông tin, hiển thị chọn phương thức
        $showQR = 'selectMethod';
    }
}

// Khi khách chọn phương thức thanh toán
if (isset($_POST['selectPaymentMethod'])) {
    $_SESSION['selectedPaymentMethod'] = $_POST['method'];
    $showQR = true; // hiển thị QR
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Thanh Toán | Hoidibantao</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style>
body { background:#f7f7f7; }
.container { max-width:500px; margin:50px auto; background:#fff; padding:30px; border-radius:8px; box-shadow:0 0 15px rgba(0,0,0,0.1);}
h2 { text-align:center; margin-bottom:20px; }
label { display:block; margin-top:10px; font-weight:bold; }
input[type="text"], input[type="tel"], input[type="email"], select, textarea {
    width:100%; padding:10px; margin-top:5px; border:1px solid #ccc; border-radius:4px; box-sizing:border-box;
}
textarea { resize: vertical; height:100px; }
input[type="submit"], button { width:100%; background:#007bff; color:#fff; padding:10px; border:none; border-radius:4px; margin-top:20px; cursor:pointer; }
input[type="submit"]:hover, button:hover { background:#0056b3; }
.qr-section { text-align:center; }
.qr-section img { margin-top:20px; }
button.payment-btn { border:none; background:none; cursor:pointer; }
</style>
</head>
<body>
<div class="container">

<?php if ($showQR === false): ?>
    <!-- Form thông tin khách hàng -->
    <h2>Thông Tin Khách Hàng</h2>
    <form method="post" action="">
        <label>Tên:</label>
        <input type="text" name="client_name" required>
        <label>Số điện thoại:</label>
        <input type="tel" name="client_phone" required>
        <label>Địa chỉ:</label>
        <input type="text" name="client_address" required>
        <label>Email:</label>
        <input type="email" name="client_email" required>
        <label>Ghi chú:</label>
        <textarea name="client_note"></textarea>
        <label>Hình thức giao hàng:</label>
        <select name="transport">
            <option value="1">Giao hàng nhanh</option>
            <option value="2">Giao hàng tiêu chuẩn</option>
        </select>
        <input type="submit" name="submit_payment" value="Tiến Hành Thanh Toán">
    </form>

<?php elseif ($showQR === 'selectMethod'): ?>
    <!-- Chọn phương thức thanh toán -->
    <h2>Chọn phương thức thanh toán</h2>
    <p>Số tiền: <?php echo number_format($paymentAmount); ?> VNĐ</p>
    <div style="display:flex; flex-wrap:wrap; justify-content:center; gap:20px; margin-top:20px;">
        <form method="post">
            <input type="hidden" name="method" value="momo">
            <button type="submit" name="selectPaymentMethod" class="payment-btn">
                <img src="../images/momo.png" alt="Momo" width="150">
            </button>
        </form>
        <form method="post">
            <input type="hidden" name="method" value="vietqr">
            <button type="submit" name="selectPaymentMethod" class="payment-btn">
                <img src="../images/vietqr.png" alt="VietQR" width="150">
            </button>
        </form>
        <form method="post">
            <input type="hidden" name="method" value="zalopay">
            <button type="submit" name="selectPaymentMethod" class="payment-btn">
                <img src="../images/zalopay.png" alt="ZaloPay" width="150">
            </button>
        </form>
        <form method="post">
            <input type="hidden" name="method" value="bank">
            <button type="submit" name="selectPaymentMethod" class="payment-btn">
                <img src="../images/bank.png" alt="Ngân hàng" width="150">
            </button>
        </form>
    </div>

<?php else: ?>
    <!-- Hiển thị QR tương ứng phương thức -->
    <div class="qr-section">
        <h2>Thanh toán qua <?php echo strtoupper($_SESSION['selectedPaymentMethod']); ?></h2>

        <!-- QR tự thêm, file trùng: momo_qr.png, vietqr_qr.png, zalopay_qr.png, bank_qr.png -->
        <img src="../images/<?php echo $_SESSION['selectedPaymentMethod']; ?>_qr.png" 
             width="250" alt="QR <?php echo $_SESSION['selectedPaymentMethod']; ?>">

        <form method="post" action="../includes/xacnhan_thanhtoan.php" style="margin-top:20px;">
            <input type="hidden" name="client_id" value="<?php echo $_SESSION['client_id']; ?>">
            <input type="hidden" name="method" value="<?php echo $_SESSION['selectedPaymentMethod']; ?>">
            <button type="submit" class="btn btn-success">Đã thanh toán</button>
        </form>
    </div>
<?php endif; ?>

</div>
</body>
</html>
