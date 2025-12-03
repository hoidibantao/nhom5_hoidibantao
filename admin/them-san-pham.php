<?php
include_once('../db/connect.php'); // Kết nối với cơ sở dữ liệu

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: admin-login.php");
    exit;
}

if (isset($_POST['submit_product'])) {
    $product_name = $_POST['product_name'];
    $category_id = $_POST['category_id'];
    $product_price = $_POST['product_price'];
    $product_detail = $_POST['product_detail'];
    $product_status = $_POST['product_active'];
    $product_hot = $_POST['product_hot'];
    $product_quantity = $_POST['product_many'];

    // Xử lý upload hình ảnh sản phẩm
    $product_image = $_FILES['product_image']['name'];
    $image_path = "../images/products/" . $product_image;
    move_uploaded_file($_FILES['product_image']['tmp_name'], $image_path);

    // Thực hiện truy vấn SQL để thêm sản phẩm vào cơ sở dữ liệu
    $insertQuery = "INSERT INTO tb_product (product_name, category_id, product_price, product_detail, product_active, product_hot, product_many, product_img)
                    VALUES ('$product_name', '$category_id', '$product_price', '$product_detail', '$product_status', '$product_hot', '$product_quantity', '$product_image')";
    $insertResult = mysqli_query($conn, $insertQuery);

    if ($insertResult) {
        header("Location: hienthisanpham.php");
        exit;
    } else {
        echo "Lỗi trong quá trình thêm sản phẩm. Vui lòng thử lại.";
    }
}
?>