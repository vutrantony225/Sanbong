<?php
@session_start();
include 'config.php';
$user = (isset($_SESSION['user'])) ? $_SESSION['user'] : [];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sân bóng</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        .navbar-brand img {
            height: 30px;
            width: 30px;
        }
        .dropdown-menu a:hover {
            background-color: #cc6600;
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="sanbong.php">
                <img src="img/logo.png" alt="Logo">
                Sân bóng QNU
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($user['TenTK'])) { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo $user['TenTK']; ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="thongtin.php">Thông tin</a></li>
                                <li><a class="dropdown-item" href="dangxuat.php">Thoát</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="sanbong.php">Trang chủ</a></li>
                        <li class="nav-item"><a class="nav-link" href="trangthai.php">Trạng thái</a></li>
                        <li class="nav-item"><a class="nav-link" href="sanyeuthich.php">Yêu thích</a></li>
                        <li class="nav-item"><a class="nav-link" href="danhsachdatsan.php">Danh sách đặt</a></li>
                        <li class="nav-item"><a class="nav-link" href="lienhe.php">Liên hệ</a></li>
                    <?php } else { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Tài khoản
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
                                <li><a class="dropdown-item" href="dangnhap.php">Đăng nhập</a></li>
                                <li><a class="dropdown-item" href="dangky.php">Đăng ký</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="trangthai.php">Trạng thái</a></li>
                        <li class="nav-item"><a class="nav-link" href="lienhe.php">Liên hệ</a></li>
                        <li class="nav-item"><a class="nav-link" href="sanbong.php">Sân bóng</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Bootstrap JS (cần để dropdown hoạt động) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
