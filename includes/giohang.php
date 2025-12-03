<?php
include_once('../db/connect.php');

// Xử lý xóa sản phẩm khỏi giỏ hàng
if (isset($_POST['removeFromCart'])) {
    $cart_id = mysqli_real_escape_string($conn, $_POST['cart_id']);
    $deleteQuery = "DELETE FROM tb_cart WHERE cart_id = $cart_id";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if (!$deleteResult) {
        die('Error deleting record: ' . mysqli_error($conn));
    }
}

// Xử lý cập nhật số lượng sản phẩm trong giỏ hàng
if (isset($_POST['updateCart'])) {
    $cart_id = mysqli_real_escape_string($conn, $_POST['cart_id']);
    $new_quantity = mysqli_real_escape_string($conn, $_POST['new_quantity']);
    $updateQuery = "UPDATE tb_cart SET cart_many = $new_quantity WHERE cart_id = $cart_id";
    $updateResult = mysqli_query($conn, $updateQuery);

    if (!$updateResult) {
        die('Error updating record: ' . mysqli_error($conn));
    }
}

// Xử lý thêm sản phẩm vào giỏ hàng
if (isset($_POST['addToCart'])) {
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);

    // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
    $existingProductQuery = "SELECT * FROM tb_cart WHERE product_id = $product_id";
    $existingProductResult = mysqli_query($conn, $existingProductQuery);

    if (mysqli_num_rows($existingProductResult) > 0) {
        // Nếu có, cập nhật số lượng
        $existingProduct = mysqli_fetch_assoc($existingProductResult);
        $new_quantity = $existingProduct['cart_many'] + $quantity;
        $updateQuery = "UPDATE tb_cart SET cart_many = $new_quantity WHERE product_id = $product_id";
        $updateResult = mysqli_query($conn, $updateQuery);

        if (!$updateResult) {
            die('Error updating record: ' . mysqli_error($conn));
        }
    } else {
        // Nếu không có, thêm mới vào giỏ hàng
        $query = "SELECT * FROM tb_product WHERE product_id = $product_id";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $product = mysqli_fetch_assoc($result);
            $product_name = $product['product_name'];
            $product_price = $product['product_price'];
            $product_img = $product['product_img'];

            // Giảm số lượng sản phẩm trong cơ sở dữ liệu
            $newProductMany = $product['product_many'] - $quantity;
            $updateProductQuery = "UPDATE tb_product SET product_many = $newProductMany WHERE product_id = $product_id";
            mysqli_query($conn, $updateProductQuery);

            // Thêm sản phẩm vào giỏ hàng
            $insertQuery = "INSERT INTO tb_cart (product_id, product_name, product_price, cart_many, product_img)
                            VALUES ('$product_id', '$product_name', '$product_price', '$quantity', '$product_img')";
            $insertResult = mysqli_query($conn, $insertQuery);

            if (!$insertResult) {
                die('Error inserting record: ' . mysqli_error($conn));
            }
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../js/main.js">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <title>Hội Đi Bán Táo | Nguyễn Thị Thu Vân - 65134243</title>
</head>
<body>
    <body id="page-top" class="index" data-pinterest-extension-installed="cr1.3.4">
    <?php
include_once('../db/connect.php');

// Truy vấn cơ sở dữ liệu để lấy danh sách danh mục
$query = "SELECT * FROM tb_category"; // Thay 'tb_category' bằng tên bảng danh mục thực tế
$result = mysqli_query($conn, $query);

// Khởi tạo mảng lưu trữ danh sách danh mục
$categories = array();

while ($row = mysqli_fetch_assoc($result)) {
    $categories[] = $row;
}
?>

      <nav class="navbar navbar-default navbar-fixed-top navbar-link">
            <div class="container">
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

        $categoryQuery = "SELECT * FROM tb_category";
        $categoryResult = mysqli_query($conn, $categoryQuery);

        $count = 0; // Số biểu tượng (icon) đã sử dụng
        while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
            $categoryLink = $categoryRow['category_link'];
            $categoryName = $categoryRow['category_name'];

            $icon = $icons[$count];

            echo '<li class="">
                    <a href="' . $categoryLink . '" class="page-scroll">
                        <i class="' . $icon . '"></i> ' . $categoryName . '
                    </a>
                </li>';
            
            $count++;
            if ($count >= count($icons)) {
                $count = 0;
            }
        }


        ?>
        
        <li class="navbar-form">
        <div class="input-group">
        <input type="text" class="form-control" id="search-input" placeholder="Tìm kiếm">
        <span class="input-group-btn">
    <button class="btn btn-ocean-blue" type="submit">
        <i class="glyphicon glyphicon-search"></i>
    </button>
</span>
    </div>
    <div id="search-suggestions"></div>
        </li>

        <li class="">
            <a class="page-scroll" href="./giohang.php">
                <i class="fas fa-shopping-cart"></i> Giỏ hàng
            </a>
        </li>
        
    </ul>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#search-input').on('input', function() {
        var keyword = $(this).val();
        if (keyword.length >= 3) {
            $.ajax({
                type: 'POST',
                url: 'suggest.php',
                data: { keyword: keyword },
                success: function(response) {
                    $('#search-suggestions').html(response);
                }
            });
        } else {
            $('#search-suggestions').html('');
        }
    });
});
</script>            
            </div>
        </nav>
     <div class="main">
    <h1>Giỏ Hàng</h1>
    <form method="post" action="giohang.php">
        <table class="table">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
            <?php
$cartQuery = "SELECT tb_cart.*, tb_product.product_many FROM tb_cart
              INNER JOIN tb_product ON tb_cart.product_id = tb_product.product_id";
$cartResult = mysqli_query($conn, $cartQuery);

while ($cartRow = mysqli_fetch_assoc($cartResult)) {
    echo '<form method="post" action="giohang.php">';
    echo '<tr>';
    echo '<td><img src="../images/products/' . $cartRow['product_img'] . '" width="70" height="70" alt="' . $cartRow['product_name'] . '"></td>';
    echo '<td>' . $cartRow['product_name'] . '</td>';
    echo '<td>
            <div class="quantity-input">
                <button class="quantity-btn" type="button" onclick="decreaseQuantity(' . $cartRow['cart_id'] . ')"><i class="fas fa-minus"></i></button>
                <input type="number" id="quantity_' . $cartRow['cart_id'] . '" name="new_quantity" value="' . $cartRow['cart_many'] . '" min="1" max="' . $cartRow['product_many'] . '">
                <button class="quantity-btn" type="button" onclick="increaseQuantity(' . $cartRow['cart_id'] . ')"><i class="fas fa-plus"></i></button>
                <input type="hidden" name="cart_id" value="' . $cartRow['cart_id'] . '">
                <button type="submit" name="updateCart" class="btn btn-default">Cập nhật</button>
            </div>
          </td>';   
    echo '<td>' . number_format($cartRow['product_price']) . ' VNĐ</td>';
    echo '<td>
            <input type="hidden" name="cart_id" value="' . $cartRow['cart_id'] . '">
            <button type="submit" name="removeFromCart" class="btn btn-default">Xóa</button>
          </td>';
    echo '</tr>';
    echo '</form>';
}


if (isset($_POST['updateCart'])) {
    $cart_id = $_POST['cart_id'];
    $new_quantity = $_POST['new_quantity'];

    $cartQuery = "SELECT tb_cart.*, tb_product.product_many FROM tb_cart
                  INNER JOIN tb_product ON tb_cart.product_id = tb_product.product_id
                  WHERE tb_cart.cart_id = $cart_id";
    $cartResult = mysqli_query($conn, $cartQuery);
    $cartRow = mysqli_fetch_assoc($cartResult);

    if (isset($cartRow['product_many']) && $new_quantity <= $cartRow['product_many']) {
        $updateQuery = "UPDATE tb_cart SET cart_many = $new_quantity WHERE cart_id = $cart_id";
        $updateResult = mysqli_query($conn, $updateQuery);

        echo '<div class="alert alert-success">Cập nhật số lượng sản phẩm thành công!</div>';
    } else {
        echo '<div class="alert alert-danger">Số lượng sản phẩm không thể vượt quá giới hạn!</div>';
    }
}
?>

            </tbody>
        </table>
    </form>
    <div class="text-right">
        <td>
            <span>
                <i class="fa fa-truck"></i> Miễn phí vận chuyển
            </span>
        </td>
        <?php
$totalPayment = 0;
$hasProductsInCart = false; 

$cartQuery = "SELECT * FROM tb_cart";
$cartResult = mysqli_query($conn, $cartQuery);

while ($cartRow = mysqli_fetch_assoc($cartResult)) {
    $product_id = $cartRow['product_id'];
    $productQuery = "SELECT product_price FROM tb_product WHERE product_id = $product_id";
    $productResult = mysqli_query($conn, $productQuery);
    $productData = mysqli_fetch_assoc($productResult);
    $product_price = $productData['product_price'];

    $totalPayment += $product_price * $cartRow['cart_many'];
    $hasProductsInCart = true; 
}

if (!$hasProductsInCart) {
    echo '<p><strong class="text-danger">Giỏ hàng trống!</strong></p>';
} else {
    echo '<p><strong>Tổng thanh toán: ' . number_format($totalPayment) . ' VNĐ</strong></p>';
    echo '<div class="text-center">
              <a href="thanhtoan.php" class="btn btn-primary">Tiến Hành Thanh Toán</a>
          </div>';
}
?>
<script>
    function increaseQuantity(cartId) {
        var inputElement = document.getElementById('quantity_' + cartId);
        inputElement.stepUp();
    }

    function decreaseQuantity(cartId) {
        var inputElement = document.getElementById('quantity_' + cartId);
        inputElement.stepDown();
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