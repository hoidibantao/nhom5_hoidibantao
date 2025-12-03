<?php
session_start();

if (isset($_SESSION['payment_success']) && $_SESSION['payment_success']) {
    echo '<script>alert("Đang tiến hành giao dịch");</script>';

    unset($_SESSION['payment_success']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../js/main.js">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <title>Hội Đi Bán Táo</title>
</head>
<body>
    <body id="page-top" class="index" data-pinterest-extension-installed="cr1.3.4">
    <?php
    include_once('../db/connect.php');

$query = "SELECT * FROM tb_category";
$result = mysqli_query($conn, $query);

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
    


        <header>
            <div class="container">
                <div class="intro-text">
                    <div class="intro-lead-in"> hoidibantao
                    </div>
                    <div class="intro-heading">Độc quyền Apple chính hãng</div>
                </div>
            </div>
        </header>
    
        <?php include('../includes/sanphamhot.php'); ?>
       

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