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
        <h1>Thêm Sản Phẩm</h1>
        <form method="post" action="them-san-pham.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="product_name">Tên Sản Phẩm:</label>
                <input type="text" class="form-control" name="product_name" id="product_name" required>
            </div>

            <div class="form-group">
                <label for="category_id">ID Danh Mục:</label>
                <input type="number" class="form-control" name="category_id" id="category_id" required>
            </div>

            <div class="form-group">
                <label for="product_price">Giá Sản Phẩm:</label>
                <input type="number" class="form-control" name="product_price" id="product_price" required>
            </div>

            <div class="form-group">
                <label for="product_detail">Chi tiết sản phẩm:</label>
                <input type="text" class="form-control" name="product_detail" id="product_detail" required>
            </div>

            <div class="form-group">
                <label for="product_active">Tình trạng:</label>
                <select class="form-control" name="product_active" id="product_active">
                    <option value="0">Không hoạt động</option>
                    <option value="1">Hoạt động</option>
                </select>
            </div>

            <div class="form-group">
                <label for="product_hot">Sản Phẩm Hot:</label>
                <select class="form-control" name="product_hot" id="product_hot">
                    <option value="0">Không</option>
                    <option value="1">Có</option>
                </select>
            </div>

            <div class="form-group">
                <label for="product_many">Số Lượng Sản Phẩm:</label>
                <input type="number" class="form-control" name="product_many" id="product_many" required>
            </div>

            <div class="form-group">
                <label for="product_image">Hình Ảnh Sản Phẩm:</label>
                <input type="file" class="form-control" name="product_image" id="product_image" accept="image/*" required>
            </div>

            <button type="submit" name="submit_product" class="btn btn-primary">Thêm Sản Phẩm</button>
        </form>
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