<?php
session_start();
include_once('../db/connect.php'); // Kết nối đến cơ sở dữ liệu

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Mã hóa mật khẩu
    $hashedPassword = md5($password);

    // Truy vấn cơ sở dữ liệu để kiểm tra thông tin đăng nhập
    $query = "SELECT admin_name, email, password FROM tb_admin WHERE email = '$email' AND password = '$hashedPassword'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Đăng nhập thành công, bắt đầu phiên làm việc
        
        $_SESSION['loggedin'] = true;
        
        // Chuyển hướng đến trang admin
        if (isset($_SESSION['redirect_to'])) {
            $redirect = $_SESSION['redirect_to'];
            unset($_SESSION['redirect_to']);
            header("Location: " . $redirect);
            exit;
        }

        // Nếu không có trang trước đó thì vào dashboard
        header("Location: admin-dashboard.php");
        exit;
    } else {
        // Đăng nhập không thành công
        $loginError = "Sai tên đăng nhập hoặc mật khẩu";
    }
    
}


// Đóng kết nối cơ sở dữ liệu
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Đăng Nhập | Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/admin-style.css">


</head>
<body>
    <div class="container">
        <div class="dn">
        <h1>Đăng Nhập | Admin</h1>

        <form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password">Mật Khẩu:</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Đăng Nhập</button>
            </div>

            <?php if (isset($loginError)) { ?>
                <p class="text-danger"><?php echo $loginError; ?></p>
            <?php } ?>
        </form>
    </div>
    </div>
    
    <script src="https://ajax.googleapis.com/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>