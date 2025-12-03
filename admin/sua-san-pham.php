<?php
session_start();
include_once('../db/connect.php'); // Kết nối với cơ sở dữ liệu

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: admin-login.php");
    exit;
}

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Truy vấn cơ sở dữ liệu để lấy thông tin sản phẩm dựa trên product_id
    $query = "SELECT * FROM tb_product WHERE product_id = $product_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        // Xử lý trường hợp sản phẩm không tồn tại
        echo "Sản phẩm không tồn tại.";
        exit;
    }
} else {
    // Xử lý trường hợp thiếu tham số product_id
    echo "Thiếu tham số product_id.";
    exit;
}

if (isset($_POST['updateProduct'])) {
    // Lấy thông tin sản phẩm từ form chỉnh sửa
    $product_name = $_POST['product_name'];
    $category_id = $_POST['category_id'];
    $product_price = $_POST['product_price'];
    $product_active = $_POST['product_active'];
    $product_hot = $_POST['product_hot'];
    $product_many = $_POST['product_many'];

    // Thực hiện truy vấn SQL để cập nhật thông tin sản phẩm
    $updateQuery = "UPDATE tb_product
                    SET product_name = '$product_name',
                        category_id = $category_id,
                        product_price = $product_price,
                        product_active = $product_active,
                        product_hot = $product_hot,
                        product_many = $product_many
                    WHERE product_id = $product_id";

    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        $product['product_name'] = $product_name;
        $product['category_id'] = $category_id;
        $product['product_price'] = $product_price;
        $product['product_active'] = $product_active;
        $product['product_hot'] = $product_hot;
        $product['product_many'] = $product_many;
    } else {
        echo "Lỗi trong quá trình cập nhật sản phẩm. Vui lòng thử lại.";
    }
    
    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Sản Phẩm</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h1>Chỉnh Sửa Sản Phẩm</h1>
    <form method="post" action="sua-san-pham.php?product_id=<?php echo $product_id; ?>">
        <div class="form-group">
            <label for="product_name">Tên Sản Phẩm:</label>
            <input type="text" class="form-control" name="product_name" id="product_name" value="<?php echo $product['product_name']; ?>" required>
        </div>

        <div class="form-group">
            <label for="category_id">ID Danh Mục:</label>
            <input type="number" class="form-control" name="category_id" id="category_id" value="<?php echo $product['category_id']; ?>" required>
        </div>

        <div class="form-group">
            <label for="product_price">Giá Sản Phẩm:</label>
            <input type="number" class="form-control" name="product_price" id="product_price" value="<?php echo $product['product_price']; ?>" required>
        </div>


        <div class="form-group">
            <label for="product_active">Tình Trạng:</label>
            <select class="form-control" name="product_active" id="product_active">
                <option value="0" <?php if ($product['product_active'] == 0) echo "selected"; ?>>Không hoạt động</option>
                <option value="1" <?php if ($product['product_active'] == 1) echo "selected"; ?>>Hoạt động</option>
            </select>
        </div>

        <div class="form-group">
            <label for="product_hot">Sản Phẩm Hot:</label>
            <select class="form-control" name="product_hot" id="product_hot">
                <option value="0" <?php if ($product['product_hot'] == 0) echo "selected"; ?>>Không</option>
                <option value="1" <?php if ($product['product_hot'] == 1) echo "selected"; ?>>Có</option>
            </select>
        </div>

        <div class="form-group">
            <label for="product_many">Số Lượng Sản Phẩm:</label>
            <input type="number" class="form-control" name="product_many" id="product_many" value="<?php echo $product['product_many']; ?>" required>
        </div>

        <button type="submit" name="updateProduct" class="btn btn-primary">Cập Nhật Sản Phẩm</button>
        <a href="hienthisanpham.php" class="btn btn-primary">Quay Lại</a>


    </form>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>