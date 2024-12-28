<?php
session_start(); // Bắt đầu phiên làm việc
include 'config.php';
include 'header.php';

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['email'])) {
    // Chuyển hướng về trang đăng nhập nếu chưa đăng nhập
    header('Location: login.php');
    exit();
}

$email = $_SESSION['email'];

// Truy vấn lấy thông tin tài khoản
$sql = "SELECT * FROM taikhoan
        INNER JOIN khachhang ON taikhoan.email = khachhang.email
        WHERE taikhoan.email = '$email'";

$result = mysqli_query($conn, $sql);

if (!$result) {
    // Hiển thị lỗi nếu truy vấn thất bại
    die('Lỗi truy vấn: ' . mysqli_error($conn));
}

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    // Hiển thị thông báo nếu không có dữ liệu
    echo '<div class="alert alert-danger text-center mt-5">Không tìm thấy thông tin tài khoản!</div>';
    exit(); // Kết thúc chương trình để không hiển thị biểu mẫu
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Tài Khoản</title>
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
        .btn-custom {
            width: 48%; /* Cân đối giữa hai nút */
            margin-top: 10px;
        }
        .btn-full {
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
            .btn-custom {
                width: 100%; /* Nút chiếm toàn bộ chiều rộng trên màn hình nhỏ */
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5 d-flex justify-content-center">
        <div class="status-div col-12 col-md-8 col-lg-5 rounded">
            <h1>THÔNG TIN TÀI KHOẢN</h1>
            <form action="thongtin_submit.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Tên tài khoản:</label>
                    <input type="text" class="form-control bg-warning bg-opacity-25" value="<?php echo htmlspecialchars($_SESSION['login_user']); ?>" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Họ và tên:</label>
                    <input type="text" class="form-control" name="ten" value="<?php echo htmlspecialchars($row['TenKH']); ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" class="form-control bg-warning bg-opacity-25" value="<?php echo htmlspecialchars($row['Email']); ?>" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">Số điện thoại:</label>
                    <input type="text" class="form-control" name="sdt" value="<?php echo htmlspecialchars($row['SoDT']); ?>" required>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success btn-custom" name="submit-tt">Cập nhật</button>
                    <button type="submit" class="btn btn-warning btn-custom" name="submit-pass">Đổi mật khẩu</button>
                </div>
                <div class="text-center mt-3">
                    <a href="sanbong.php" class="btn btn-secondary btn-full">Quay lại trang chính</a>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
