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

       <!-- Navigation -->
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
        <input type="text" class="form-control" id="search-input" placeholder="Tìm kiếm">
        <span class="input-group-btn">
    <button class="btn btn-ocean-blue" type="submit">
        <i class="glyphicon glyphicon-search"></i>
    </button>
</span>
    </div>
    <div id="search-suggestions"></div>
        </li>

        <!-- Thêm biểu tượng (icon) cho giỏ hàng -->
        <li class="">
            <a class="page-scroll" href="./giohang.php">
                <i class="fas fa-shopping-cart"></i> Giỏ hàng
            </a>
        </li>
        
        <!-- Loại bỏ 3 thẻ li không cần thiết -->
    </ul>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#search-input').on('input', function() {
        var keyword = $(this).val();
        if (keyword.length >= 3) { // Only start suggesting after 3 characters
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

                
                
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    
   <!-- Portfolio Grid Section -->
<section id="portfolio" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">iPhone</h2>
                <h3 class="section-subheading text-muted"></h3>
            </div>
        </div>
        <div class="row">
            <?php
            // Kết nối cơ sở dữ liệu
            include_once('../db/connect.php');

            // Thực hiện truy vấn để lấy dữ liệu sản phẩm
            $query = "SELECT * FROM tb_product WHERE product_active = 1 AND category_id = 2";
            $result = mysqli_query($conn, $query);

            // Lặp qua các sản phẩm và hiển thị chúng
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="col-md-4 col-sm-6 portfolio-item">';
                echo '<a href="chitietsanpham.php?product_id=' . $row['product_id'] . '" class="portfolio-link" data-toggle="modal">';
                echo '<div class="portfolio-hover">';
                echo '<div class="portfolio-hover-content">';
                echo 'Xem chi tiết';
                echo '</div>';
                echo '</div>';
                // Hiển thị hình ảnh sản phẩm 
                echo '<img src="../images/products/' . $row['product_img'] . '" class="img-responsive" alt="">';
                echo '</a>';
                // Hiển thị tên sản phẩm 
                echo '<div class="portfolio-caption">';
                echo '<h4>' . $row['product_name'] . '</h4>';
                echo '</div>';
                echo '</div>';
            }

            // Đóng kết nối cơ sở dữ liệu
            mysqli_close($conn);
            ?>
        </div>
    </div>
</section>    
       

       

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