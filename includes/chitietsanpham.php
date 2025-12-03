<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../js/main.js">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <title>Hội Đi Bán Táo</title>
</head>
<body>
    <body id="page-top" class="index" data-pinterest-extension-installed="cr1.3.4">
    <?php
include_once('../db/connect.php');

// Truy vấn cơ sở dữ liệu để lấy danh sách danh mục
$query = "SELECT * FROM tb_category"; 
$result = mysqli_query($conn, $query);

// Khởi tạo mảng lưu trữ danh sách danh mục
$categories = array();

while ($row = mysqli_fetch_assoc($result)) {
    $categories[] = $row;
}
?>

       <!-- Navigation -->
       <nav class="navbar navbar-default navbar-fixed-top navbar-link">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="./home.php"><img src="../images/logo (1).png" width="180" height="60" alt=""></a>

                </div>
                
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav navbar-right">
        <li class="hidden active">
            <a href="#page-top"></a>
        </li>
        <?php

        // Mảng chứa các biểu tượng (icon)
        $icons = array(
            'fas fa-laptop',
            'fas fa-mobile-alt',
            'fas fa-tablet',
            'fas fa-headphones',
        );

        // Truy vấn danh mục từ bảng tb_category
        $categoryQuery = "SELECT * FROM tb_category";
        $categoryResult = mysqli_query($conn, $categoryQuery);

        $count = 0; // Số biểu tượng (icon) đã sử dụng
        // Lặp qua danh mục và lấy từng category_id
        while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
            $categoryLink = $categoryRow['category_link'];
            $categoryName = $categoryRow['category_name'];

            // Sử dụng biểu tượng từ mảng
            $icon = $icons[$count];

            // Tạo liên kết riêng lẻ
            echo '<li class="">
                    <a href="' . $categoryLink . '" class="page-scroll">
                        <i class="' . $icon . '"></i> ' . $categoryName . '
                    </a>
                </li>';
            
            $count++;
            // Nếu đã sử dụng tất cả biểu tượng, reset lại
            if ($count >= count($icons)) {
                $count = 0;
            }
        }


        ?>
        
        <!-- Thêm ô tìm kiếm (thanh input) -->
        <li class="navbar-form">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Tìm kiếm">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="glyphicon glyphicon-search"></i>
                    </button>
                </span>
            </div>
        </li>
        <!-- Thêm biểu tượng (icon) cho giỏ hàng -->
        <li class="">
            <a class="page-scroll" href="./giohang.php">
                <i class="fas fa-shopping-cart"></i> Giỏ hàng
            </a>
        </li>
        
    </ul>
</div>
    </div>
        </nav>
        <div class="container product-details">
        <?php
    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];

        $query = "SELECT * FROM tb_product WHERE product_id = $product_id";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $product = mysqli_fetch_assoc($result);

            echo '<div class="container">';
            echo '<div class="row">';
            echo '<div class="col-md-6">';
            echo '<img src="../images/products/' . $product['product_img'] . '" alt="' . $product['product_name'] . '" class="img-responsive">';
            echo '</div>';
            echo '<div class="col-md-6">';
            echo '<h1>' . $product['product_name'] . '</h1>';
            echo '<p>' . $product['product_detail'] . '</p>';
            echo '<p class="product-price">' . number_format($product['product_price']) . ' VNĐ</p>';
            echo '<p class="product-many">' . $product['product_many'] . ' sản phẩm có sẵn</p>';
            echo '<p class="product-warranty"><strong>Bảo hành:</strong> ' . $product['product_warranty'] . '</p>';
 
            echo '<form method="post" action="giohang.php">';
            echo '<div class="form-group form-group-sm" style="width: 120px; display: flex; align-items: center;">';
            echo '<button type="button" class="btn btn-default" onclick="decreaseQuantity()">-</button>';
            echo '<input type="number" name="quantity" id="quantity" value="1" min="1" max="' . $product['product_many'] . '" class="form-control" style="width: 50px; text-align: center;" readonly>';
            echo '<button type="button" class="btn btn-default" onclick="increaseQuantity()">+</button>';
            echo '</div>';
            
            if ($product['product_many'] == 0) {
                echo '<p style="color: red;">Sản phẩm tạm thời hết hàng.</p>';
            } else {
                echo '<button type="submit" name="addToCart" class="btn btn-default" style="width: 120px;"><i class="fas fa-cart-plus"></i> Thêm</button>';
            }
            echo '<input type="hidden" name="product_id" value="' . $product_id . '">';
            echo '</form>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        } else {
            echo 'Không tìm thấy sản phẩm.';
        }
    } else {
        echo 'Vui lòng cung cấp ID sản phẩm.';
    }
?>


</div>



<script>
    function increaseQuantity() {
        var quantityInput = document.getElementById('quantity');
        var currentQuantity = parseInt(quantityInput.value);
        var maxQuantity = parseInt(quantityInput.max);

        if (currentQuantity < maxQuantity) {
            quantityInput.value = currentQuantity + 1;
        }
    }

    function decreaseQuantity() {
        var quantityInput = document.getElementById('quantity');
        var currentQuantity = parseInt(quantityInput.value);

        if (currentQuantity > 1) {
            quantityInput.value = currentQuantity - 1;
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
</body>
</html>