<?php
include_once('../db/connect.php');
session_start();

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: admin-login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: quanlydonhang.php");
    exit;
}


if (isset($_GET['id'])) {
    $donHangID = $_GET['id'];

    // Thực hiện truy vấn xóa đơn hàng
    $query = "DELETE FROM tb_order WHERE order_id = $donHangID";

    if (mysqli_query($conn, $query)) {
        header("Location: quanlydonhang.php");
        exit;
    } else {
        echo 'Lỗi xóa đơn hàng: ' . mysqli_error($conn);
    }
} else {
    echo 'ID đơn hàng không hợp lệ.';
}

mysqli_close($conn);
?>