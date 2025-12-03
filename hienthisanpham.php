<?php
session_start(); // Bắt đầu phiên làm việc
// Kiểm tra nếu người dùng chưa đăng nhập, chuyển họ đến trang đăng nhập
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    $_SESSION['redirect_to'] = $_SERVER['REQUEST_URL']; // Lưu lại URL hiện tại
    header("Location: admin-login.php");
    exit;
}

include_once('../db/connect.php');

// Truy vấn dữ liệu từ bảng tb_product
$query = "SELECT * FROM tb_product";
$result = mysqli_query($conn, $query);

// Kiểm tra nếu có dữ liệu sản phẩm
if (mysqli_num_rows($result) > 0) {
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $products = array(); // Nếu không có sản phẩm, khởi tạo mảng trống
}

// Đóng kết nối cơ sở dữ liệu
mysqli_close($conn);
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
        <h1>Danh Sách Sản Phẩm</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>ID</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Danh Mục</th>
                    <th>Giá Sản Phẩm</th>
                    <th>Chi Tiết</th>
                    <th>Tình Trạng</th>
                    <th>Sản Phẩm Hot</th>
                    <th>Số Lượng</th>
                    <th>Hình Ảnh</th>
                    <th>Chỉnh Sửa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stt = 1; // Khởi tạo biến đếm STT
                foreach ($products as $product): ?>
                <tr>
                    <td><?php echo $stt; ?></td>
                    <td><?php echo $product['product_id']; ?></td>
                    <td><?php echo $product['product_name']; ?></td>
                    <td><?php echo $product['category_id']; ?></td>
                    <td><?php echo $product['product_price']; ?></td>
                    <td><?php echo $product['product_detail']; ?></td>
                    <td><?php echo ($product['product_active'] == 0) ? 'Không hoạt động' : 'Hoạt động'; ?></td>
                    <td><?php echo ($product['product_hot'] == 0) ? 'Không' : 'Có'; ?></td>
                    <td><?php echo $product['product_many']; ?></td>
                    <td><img src="../images/products/<?php echo $product['product_img']; ?>" alt="<?php echo $product['product_name']; ?>" width="50"></td>
                    <td><a href="sua-san-pham.php?product_id=<?php echo $product['product_id']; ?>" class="btn btn-primary">Chỉnh Sửa</a></td>
                    <td><a href="javascript:void(0);" onclick="confirmDelete(<?php echo $product['product_id']; ?>);" class="btn btn-danger">Xóa</a></td>
                </tr>
                <?php
                $stt++; // Tăng biến đếm STT sau mỗi sản phẩm
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
    <script>
function confirmDelete(product_id) {
    if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này không?")) {
        window.location.href = "xoa-san-pham.php?product_id=" + product_id;
    }
}
</script>

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