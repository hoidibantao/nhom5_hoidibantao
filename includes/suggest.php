<?php
include_once('../db/connect.php');

if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];

    $query = "SELECT product_id, product_name FROM tb_product WHERE product_name LIKE '%$keyword%' LIMIT 5";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $productId = $row['product_id'];
            $productName = $row['product_name'];
            echo '<div class="search-suggestion"><a href="chitietsanpham.php?product_id=' . $productId . '">' . $productName . '</a></div>';
        }
    } else {
        echo 'Không tìm thấy gợi ý.';
    }
}
?>