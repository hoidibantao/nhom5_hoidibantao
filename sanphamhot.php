<section id="portfolio" class="bg-light-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Xu hướng 2025</h2>
                <h3 class="section-subheading text-muted"></h3>
            </div>
        </div>
        <div class="row">
            <?php
            // Kết nối cơ sở dữ liệu
            include_once('../db/connect.php');

            // Thực hiện truy vấn để lấy dữ liệu sản phẩm
            $query = "SELECT * FROM tb_product WHERE product_hot = 1 AND product_active = 1";
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