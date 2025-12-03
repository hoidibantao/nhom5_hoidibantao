<?php
session_start(); // Bắt đầu phiên làm việc
// Kiểm tra nếu người dùng chưa đăng nhập, chuyển họ đến trang đăng nhập
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI']; // Lưu lại URL hiện tại
    header("Location: admin-login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<<head>
    <meta charset="UTF-8">
    <title>Admin | hoidibantao</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/footer-style-admin.css">



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
    <h1>Lịch Sử Mua Hàng</h1>

    <?php
    include_once('../db/connect.php'); // Kết nối với cơ sở dữ liệu

    // Truy vấn dữ liệu từ bảng tb_transaction
    $query = "SELECT tb_transaction.transaction_id, tb_product.product_name, tb_transaction.transaction_many, tb_transaction.transaction_date, tb_client.client_name, tb_transaction.oder_status, tb_transaction.canceloder
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
                <th>Giao Dịch ID</th>
                <th>Tên Sản Phẩm</th>
                <th>Số Lần Giao Dịch</th>
                <th>Ngày Giao Dịch</th>
                <th>Tên Khách Hàng</th>
                <th>Trạng Thái Giao Dịch</th>
                <th>Hủy Giao Dịch</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $transaction): ?>
            <tr>
                <td><?php echo $transaction['transaction_id']; ?></td>
                <td><?php echo $transaction['product_name']; ?></td>
                <td><?php echo $transaction['transaction_many']; ?></td>
                <td><?php echo $transaction['transaction_date']; ?></td>
                <td><?php echo $transaction['client_name']; ?></td>
                <td><?php echo ($transaction['oder_status'] == 0)? 'Chưa Duyệt' : 'Duyệt'; ?></td>
                <td><?php echo ($transaction['canceloder'] == 0) ? 'Không' : 'Có'; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://ajax.googleapis.com/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>