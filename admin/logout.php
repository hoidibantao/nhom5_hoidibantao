<?php
session_start(); // Bắt đầu hoặc nạp lại phiên làm việc

// Xóa tất cả dữ liệu phiên làm việc
session_unset();

// Hủy phiên làm việc
session_destroy();

// Chuyển hướng người dùng về trang đăng nhập sau khi đăng xuất
header("Location: admin-login.php");
exit;
?>