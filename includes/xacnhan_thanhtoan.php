<?php
session_start();
include_once('../db/connect.php');


// Lấy client_id và phương thức thanh toán nếu cần
$client_id = isset($_POST['client_id']) ? $_POST['client_id'] : 0;
$method = isset($_POST['method']) ? $_POST['method'] : '';

// Nếu muốn, có thể cập nhật trạng thái đơn hàng ở đây
// Ví dụ đánh dấu đã thanh toán
if ($client_id > 0) {
    $updateQuery = "UPDATE tb_order SET oder_status = 1 WHERE client_id = '$client_id'";
    mysqli_query($conn, $updateQuery);
}

// Xóa session liên quan
unset($_SESSION['client_id']);
unset($_SESSION['selectedPaymentMethod']);
unset($_SESSION['totalPayment']);

// Chuyển hướng về trang home
header("Location: home.php");
exit();
