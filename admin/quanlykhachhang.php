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
    <title>Quản Lý Sản Phẩm</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="../css/footer-style-admin.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>
<body>
<nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
            <a href="./admin-dashboard.php" class="navbar-brand">Admin</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="./themsanpham.php">Thêm Sản Phẩm</a></li>
                <li><a href="./hienthisanpham.php">Danh Sách Sản Phẩm</a></li>
                <li><a href="./quanlykhachhang.php">Quản Lý Khách Hàng</a></li>
                <li><a href="./quanlydonhang.php">Quản Lý Đơn Hàng</a></li>
            </ul>
            <p class="navbar-text navbar-right">Xin chào, admin | <a href="logout.php">Đăng Xuất</a></p>

        </div>
    </nav>
    <div class="container">

    <h1>Quản Lý Khách Hàng</h1>

<?php
include_once('../db/connect.php'); // Kết nối với cơ sở dữ liệu

// Truy vấn dữ liệu từ bảng tb_transaction
$query = "SELECT tb_transaction.transaction_id, tb_client.client_id, tb_client.client_name, tb_client.client_address, tb_client.client_email, tb_client.client_phone, tb_product.product_name, tb_transaction.transaction_many, tb_transaction.transaction_date, tb_transaction.oder_status, tb_transaction.canceloder
          FROM tb_transaction
          INNER JOIN tb_product ON tb_transaction.product_id = tb_product.product_id
          INNER JOIN tb_client ON tb_transaction.client_id = tb_client.client_id";

$result = mysqli_query($conn, $query);

if ($result) {
    $transactions = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $transactions = array(); // Nếu không có giao dịch, khởi tạo mảng trống
}

// Đóng kết nối cơ sở dữ liệu
mysqli_close($conn);
?>

<table class="table table-striped">
    <thead>
        <tr>
             <th>STT</th>
            <th>Giao Dịch ID</th>
            <th>Tên Khách Hàng</th>
            <th>Địa Chỉ</th>
            <th>Email</th>
            <th>Số Điện Thoại</th>
            <th>Tên Sản Phẩm</th>
            <th>Ngày Giao Dịch</th>

        </tr>
    </thead>
    <tbody>
        <?php 
         $stt = 1; // Khởi tạo biến đếm STT
         foreach ($transactions as $transaction): ?>
        <tr>
            <td><?php echo $stt; ?></td>
            <td><?php echo $transaction['transaction_id']; ?></td>
            <td><?php echo $transaction['client_name']; ?></td>
            <td><?php echo $transaction['client_address']; ?></td>
            <td><?php echo $transaction['client_email']; ?></td>
            <td><?php echo $transaction['client_phone']; ?></td>
            <td><?php echo $transaction['product_name']; ?></td>
            <td><?php echo $transaction['transaction_date']; ?></td>

        </tr>
        <?php
                $stt++; // Tăng biến đếm STT sau mỗi sản phẩm
                endforeach;
                ?>
    </tbody>
</table>
</div>
    </div>

    <footer>
            <div class="container">
                <div class="row">
                    <div class="">
                        <span class="copyright">Copyright © Hoidibantao 2025</span>
                    </div>
                </div>
            </div>
        </footer>
    <script src="https://ajax.googleapis.com/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>