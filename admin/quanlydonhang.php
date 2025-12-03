<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI']; // Lưu lại URL hiện tại
    header("Location: admin-login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
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
    <h1>Quản Lý Đơn Hàng</h1>

    <?php
    
include_once('../db/connect.php'); // Kết nối với cơ sở dữ liệu

// Truy vấn cơ sở dữ liệu để lấy danh sách đơn hàng từ bảng tb_order, thông tin khách hàng từ bảng tb_client, và thông tin giá sản phẩm từ bảng tb_cart
$query = "SELECT tb_order.*, tb_client.client_name, tb_product.product_price FROM tb_order
          INNER JOIN tb_client ON tb_order.client_id = tb_client.client_id
          INNER JOIN tb_product ON tb_order.product_id = tb_product.product_id";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo '<table class="table table-striped">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên Khách Hàng</th>
                    <th>Số Lượng</th>
                    <th>Giá Sản Phẩm</th>
                    <th>Tổng Số Tiền</th>
                    <th>Ngày Tháng</th>
                    <th>Tình Trạng Đơn</th>
                    <th>Hủy Đơn</th>
                    <th >Quản Lý</th>
                    <th>Chi tiết</th>
                </tr>
            </thead>
            <tbody>';

    $stt = 1; // Khởi tạo biến đếm STT
    while ($row = mysqli_fetch_assoc($result)) {
        $soTien = $row['product_price'];
        $tongSoTien = $row['order_many'] * $soTien;
                
        echo '<tr>
                <td>' . $stt . '</td>
                <td>' . $row['client_name'] . '</td>
                <td>' . $row['order_many'] . '</td>
                <td>' . number_format($soTien, 0, ',', '.') . ' VND' . '</td>
                <td>' . number_format($soTien * $row['order_many'], 0, ',', '.') . ' VND' . '</td>
                <td>' . $row['order_date'] . '</td>
                <td>' . ($row['oder_status'] == 0 ? 'Chưa Duyệt' : 'Duyệt') . '</td>
                <td>' . ($row['cancel_oder'] == 1 ? 'Có' : 'Không') . '</td>
                <td>
                    <div class="btn-group">
                        <a href="xoa-don-hang.php?id=' . $row['order_id'] . '" onclick="return confirm(\'Bạn có chắc chắn muốn xóa đơn hàng không?\')" class="btn btn-danger">Xóa</a>
                        <a href="cap-nhat-don-hang.php?id=' . $row['order_id'] . '" class="btn btn-primary">Cập Nhật</a>
                    </div>
                </td>
                <td><a href="xem-chi-tiet-don-hang.php?id=' . $row['order_id'] . '"  class="btn btn-default">Xem chi tiết</a></td>
            </tr>';

        $stt++; // Tăng biến đếm STT sau mỗi đơn hàng
    }

    echo '</tbody>
        </table>';
} else {
    echo 'Không có đơn hàng nào.';
}

mysqli_close($conn);
?>

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