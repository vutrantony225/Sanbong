<?php
	@session_start();
	include 'config.php';
	$user = (isset($_SESSION['user'])) ? $_SESSION['user']: [];
?>

<!DOCTYPE>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sân bóng</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            margin-top: 0;
            margin-left: 0;
            position: relative;
        }
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="trangchu.php">
                <img src="img/logo.png" alt="Logo">
                Sân bóng QNU
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if(isset($user['TenTK'])) { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo $user['TenTK']; ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="thongkeadmin.php">Thống kê</a></li>
                                <li><a class="dropdown-item" href="dangxuat.php">Thoát</a></li>
                            </ul>
                        </li>
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
                    <?php } ?>
                    <li class="nav-item"><a class="nav-link" href="datsan_admin.php">Danh sách đặt</a></li>
                    <li class="nav-item"><a class="nav-link" href="trangthaiadmin.php">Trạng thái</a></li>
                    <li class="nav-item"><a class="nav-link" href="khachhang_admin.php">Khách hàng</a></li>
                    <li class="nav-item"><a class="nav-link" href="sanbong_admin.php">Sân bóng</a></li>
                    <li class="nav-item"><a class="nav-link" href="trangchu.php">Trang chủ</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5 pt-5">
        <!-- Content of the page -->
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
