<?php
session_start(); // Bắt đầu phiên làm việc

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: admin-login.php");
    exit;
}

?>
<style>
    body{
        text-align: center;
    }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin | hoidibantao</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/admin-style.css">
    <link rel="stylesheet" href="../css/footer-style-admin.css">

</head>
<body style='text-align: center;'>
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

    <div id="cv">
        <div id="header">
            <h2>BÁO CÁO BÀI TẬP NHÓM</h2>
            <h3>MÔN PHÁT TRIỂN PHẦN MỀM MÃ NGUỒN MỞ</h3>
            <h3>ĐỀ TÀI</h3> 
            <h4>XÂY DỰNG WEBSITE BÁN HÀNG QUA MẠNG <br> CỦA CỬA HÀNG HỘI ĐI BÁN TÁO CHUYÊN CUNG CẤP ĐỒ CÔNG NGHỆ APPLE</h4>
        </div>
        <br>
        <div id="gv">
            <h2>Giảng viên</h2>
            <ul>
                <li>Họ và tên: Nguyễn Hải Triều</li>
                <li>Email: trieunh@ntu.edu.vn</li>
            </ul>
        </div>
        
        <div id="tt">
            <h2>Sinh viên thực hiện</h2>
            <ul>
                <li>Nguyễn Thị Diễm Quỳnh</li>
                <li>Nguyễn Thị Thu Vân</li>
                <li>Thái Văn Trung</li>
                <li>Trần Đức Việt</li>
                <li>Trương Trần Tâm</li>
                <li>Lê Thị Kim Đào</li>
            </ul>
        </div>
        
        <div id="pc">
            <h2>Công việc</h2>
            <ul>
                <li>Phân tích dự án</li>
                <li>Thiết kế dự án</li>
                <li>Kiểm thử dự án</li>
            </ul>
        </div>

        <div id="gd">
            <h2>Giao diện website</h2>
            <ul>
                <li>Website: <a href="../includes/home.php">hoidibantao</a></li>
            </ul>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>