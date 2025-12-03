<?php
include_once('../db/connect.php');

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: admin-login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: quanlydonhang.php");
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id']; 
    $oder_status = isset($_POST['oder_status']) ? 1 : 0;
    $cancel_oder = isset($_POST['cancel_oder']) ? 1 : 0;

    // Thực hiện truy vấn cập nhật đơn hàng
    $updateQuery = "UPDATE tb_order SET oder_status = $oder_status, cancel_oder = $cancel_oder WHERE order_id = $order_id";

    if (mysqli_query($conn, $updateQuery)) {
        header("Location: quanlydonhang.php");
        exit;
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }
}

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];
    $selectQuery = "SELECT * FROM tb_order WHERE order_id = $order_id";
    $result = mysqli_query($conn, $selectQuery);
    $row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cập Nhật Đơn Hàng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h1>Cập Nhật Đơn Hàng</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
        
        <div class="form-group">
    <label for="oder_status">Tình Trạng Đơn:</label>
    <input type="checkbox" name="oder_status" value="1" <?php if ($row['oder_status'] == 1) echo "checked"; ?>> Duyệt
</div>

        
        <div class="form-group">
            <label for="cancel_oder">Hủy Đơn:</label>
            <input type="checkbox" name="cancel_oder" value="1" <?php if ($row['cancel_oder'] == 1) echo "checked"; ?>>
        </div>

        <button type="submit" class="btn btn-primary">Cập Nhật</button>
        <a href="quanlydonhang.php" class="btn btn-primary">Quay Lại</a>

    </form>
</div>

<script src="https://ajax.googleapis.com/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>