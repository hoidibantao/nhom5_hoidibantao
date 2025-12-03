<?php
include_once('../db/connect.php'); // Kết nối với cơ sở dữ liệu

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI']; // Lưu lại URL hiện tại
    header("Location: admin-login.php");
    exit;
}


if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Truy vấn để xóa sản phẩm dựa trên $product_id
    $query = "DELETE FROM tb_product WHERE product_id = $product_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script>alert("Sản phẩm đã được xóa thành công.");</script>';
        echo '<script>window.location.href = "./hienthisanpham.php";</script>';
    } else {
        echo '<script>alert("Không thể xóa sản phẩm. Vui lòng thử lại sau.");</script>';
        echo '<script>window.location.href = "./hienthisanpham.php";</script>';
    }
} else {
    echo '<script>alert("Vui lòng cung cấp ID sản phẩm.");</script>';
    echo '<script>window.location.href = "./hienthisanpham.php";</script>';
}

mysqli_close($conn);
?>