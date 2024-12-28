<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi mật khẩu</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
         body {
            background-color: #125c0b;
            background-image: url('img/background.jpg'); /* Đặt đường dẫn ảnh nền tại đây */
            background-size: cover; /* Bao phủ toàn bộ trang */
            background-position: center; /* Căn giữa ảnh */
            background-attachment: fixed; /* Ảnh cố định khi cuộn trang */
        }
        .status-div {
            padding: 20px;
            border: 5px inset coral;
            background-color: #ffffff;
            box-shadow: 0 5px 15px #111111;
            border-radius: 8px;
        }
        .form-label {
            font-size: 16px;
        }
        h1 {
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-full {
            width: 100%;
            margin-top: 10px;
        }
        .btn-custom {
            width: 100%;
            margin-top: 10px;
        }

        @media (max-width: 767px) {
            .status-div {
                max-width: 100%;
                padding: 15px;
            }
            .container {
                margin-top: 20px;
            }
        }
    </style>
</head>
<body>
    <?php
    include 'config.php';
    include 'header.php';

    $email = $_SESSION['email'];
    $sql = "SELECT * FROM taikhoan WHERE TenTK = '{$_SESSION['login_user']}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container mt-5 d-flex justify-content-center">
        <div class="status-div col-12 col-md-8 col-lg-5 rounded">
            <h1>ĐỔI MẬT KHẨU</h1>
            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label">Tên tài khoản:</label>
                    <input type="text" class="form-control bg-warning bg-opacity-25" 
                           value="<?php echo $_SESSION['login_user']; ?>" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mật khẩu cũ:</label>
                    <input type="password" class="form-control" name="pass" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mật khẩu mới:</label>
                    <input type="password" class="form-control" name="npass" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nhập lại mật khẩu mới:</label>
                    <input type="password" class="form-control" name="rnpass" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-custom" name="submit-pass">Đổi mật khẩu</button>
                </div>
                <div class="text-center mt-3">
                    <a href="thongtin.php" class="btn btn-secondary btn-full">Quay lại</a>
                </div>
            </form>
        </div>
    </div>

    <?php
    if(isset($_POST['submit-pass'])) {
        $pass = $_POST['pass'];
        $newpass = $_POST['npass'];
        $rnewpass = $_POST['rnpass'];
        $user = $_SESSION['login_user'];

        if ($pass == $row['MatKhau']) {
            if ($newpass === $rnewpass) {
                $sql = "UPDATE taikhoan SET MatKhau='$newpass' WHERE TenTK='$user'";
                if (mysqli_query($conn, $sql)) {
                    $_SESSION['login_pass'] = $newpass;
                    echo "<script>
                        alert('Thay đổi thành công! Vui lòng đăng nhập lại.');
                        window.location.href = 'dangnhap.php';
                        </script>";
                } else {
                    echo "<script>alert('Lỗi! Không thể thay đổi mật khẩu.');</script>";
                }
            } else {
                echo "<script>alert('Nhập lại mật khẩu mới không đúng!');</script>";
            }
        } else {
            echo "<script>alert('Mật khẩu cũ không đúng!');</script>";
        }
        mysqli_close($conn);
    }
    ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
