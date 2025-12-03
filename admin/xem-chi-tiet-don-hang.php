<?php
session_start(); // Bắt đầu phiên làm việc

// Kiểm tra nếu người dùng chưa đăng nhập, chuyển họ đến trang đăng nhập
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: admin-login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Xem Chi Tiết Đơn Hàng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h1>Chi Tiết Đơn Hàng</h1>

    <?php
    include_once('../db/connect.php'); 

    if (isset($_GET['id'])) {
        $order_id = $_GET['id'];

        $query = "SELECT tb_order.*, tb_client.client_id, tb_client.client_name, tb_client.client_address, 
                tb_client.client_email, tb_client.client_phone, tb_product.product_name, tb_product.product_price, tb_product.product_warranty
                FROM tb_order
                INNER JOIN tb_client ON tb_order.client_id = tb_client.client_id
                INNER JOIN tb_product ON tb_order.product_id = tb_product.product_id
                WHERE tb_order.order_id = $order_id";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // Tính ngày hết bảo hành
            $orderDate = $row['order_date']; 
            $warranty = $row['product_warranty']; 

            if (strpos($warranty, 'năm') !== false) {
                $expireDate = date('d/m/Y', strtotime($orderDate . ' + ' . intval($warranty) . ' year'));
            } elseif (strpos($warranty, 'tháng') !== false) {
                $expireDate = date('d/m/Y', strtotime($orderDate . ' + ' . intval($warranty) . ' month'));
            } else {
                $expireDate = 'Không xác định';
            }

            echo '<p><strong>Tên Sản Phẩm:</strong> ' . $row['product_name'] . '</p>
                <p><strong>Tổng Tiền:</strong> ' . number_format($row['order_many'] * $row['product_price'], 0, ',', '.') . ' VND</p>
                <p><strong>Tên Khách Hàng:</strong> ' . $row['client_name'] . '</p>
                <p><strong>Địa Chỉ:</strong> ' . $row['client_address'] . '</p>
                <p><strong>Email:</strong> ' . $row['client_email'] . '</p>
                <p><strong>Số Điện Thoại:</strong> ' . $row['client_phone'] . '</p>
                <p><strong>Ngày Đặt Hàng:</strong> ' . date('d/m/Y', strtotime($orderDate)) . '</p>
                <p><strong>Hạn Bảo Hành:</strong> ' . $expireDate . '</p>';
        } else {
            echo 'Không tìm thấy thông tin chi tiết đơn hàng.';
        }
    } else {
        echo 'Vui lòng cung cấp ID đơn hàng.';
    }


    mysqli_close($conn);
    ?>

    <a href="./quanlydonhang.php" class="btn btn-primary">Quay lại</a>
</div>

<script src="https://ajax.googleapis.com/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>