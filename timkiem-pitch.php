<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sân bóng QNU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .status-div {
            text-align: center;
            margin: 12.5%;
            margin-top: 15px;
            padding: 10px 40px;
            border: 5px inset coral;
            width: 70%;
            background-color: #ffffff;
            box-shadow: 0 5px 15px #111111;
            display: inline-block;
            margin-bottom: 25px;
        }
        .status-div-rong {
            margin: 12.5%;
            border: 5px inset coral;
            width: 70%;
            background-color: #ffffff;
            box-shadow: 0 5px 15px #111111;
            display: inline-block;
            margin-bottom: 25px;
            margin-top: 15px;
            padding: 10px 40px;
        }
        .table-status {
            text-align: center;
            margin: auto;
        }
        th, td {
            padding: 10px;
        }
        body {
            background-color: #125c0b;
        }
        .btn {
            display: inline-block;
            vertical-align: middle;
            color: #ec0909;
        }
        button {
            padding: 5px;
        }
        a {
            text-decoration: none;
            color: red;
        }
        .search-bt {
            height: 25px;
            margin-left: 5px;
            width: 60px;
            color: red;
        }
        .search {
            height: 25px;
            width: 400px;
            margin-left: 12.5%;
            margin-top: 80px;
        }
        .navbar-brand img {
            height: 30px;
            width: 30px;
            margin-right: 10px;
        }
        .dropdown-menu a:hover {
            background-color: #CC6600;
            color: #fff;
        }
    </style>
    <script>
        function confirmDelete(id) {
            var result = confirm("Bạn có chắc muốn xóa sân bóng này?");
            if (result) {
                window.location.href = 'edit_sanbong.php?id=' + id;
            }
        }
    </script>
</head>
<body>
    <?php
    @session_start();
    include 'config.php';
    include 'header_admin.php';
    ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-success fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="trangchu.php">
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
        <form action="timkiem-pitch.php" method="GET">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Nhập tên hoặc loại sân bóng muốn tìm" name="timkiem">
                <button class="btn btn-danger" type="submit" name="search-sb">Tìm</button>
            </div>
        </form>

        <?php
            if (isset($_GET['timkiem'])) {
                $timkiem = $_GET['timkiem'];
                if(empty($timkiem)) {
                    echo '<script>
                        alert("Vui lòng nhập thông tin tìm kiếm!");
                        window.history.back();
                    </script>';
                }
                else {
                    $sql = "SELECT * FROM sanbong WHERE TenSan LIKE '%$timkiem%' OR LoaiSan LIKE '%$timkiem%'";
                    $result = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($result);
                    if($num>0 && $timkiem!="") {
                        echo '<div class="status-div">
                            <b>KẾT QUẢ TÌM KIẾM</b><br />
                            <br>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên sân</th>
                                        <th>Ảnh sân</th>
                                        <th>Loại sân</th>
                                        <th>Giá</th>
                                        <th>Địa điểm</th>
                                        <th>Mô tả</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>';
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<form action="edit_sanbong.php" method= "POST" id="add-form">';
                                    echo '<tr>';
                                    echo '<td>' . $row['ID'] . '</td>';
                                    echo '<td>' . $row['TenSan'] . '</td>';
                                    echo '<td> <img class="img-thumbnail" width="100" height="50" src="data:image/jpeg;base64,'.base64_encode($row["AnhSan"]).'"> </td>';
                                    echo '<td>' . $row['LoaiSan'] . '</td>';
                                    echo '<td>' . $row['Gia'] . '</td>';
                                    echo '<td>' . $row['DiaDiem'] . '</td>';
                                    echo '<td>' . $row['MoTa'] . '</td>';
                                    echo '<td><input class="btn btn-warning" type ="submit" name="suasb['.$row['ID'].']" value="Sửa"></td>';
                                    echo '<td><input class="btn btn-danger" type="button" value="Xóa" onclick="confirmDelete('.$row['ID'].')"></td>';
                                    echo '</tr>';
                                }    
                                mysqli_close($conn);
                                echo '</tbody>
                            </table>
                            <br>
                            <a href="them_sanbong.php" class="btn btn-primary">Thêm mới</a>
                        </div>';
                    }
                    else {
                        echo '<div class="status-div-rong text-center">Không có kết quả nào được tìm thấy.</div>';
                    }
                }
            }                
        ?>
    </div>
</body>
</html>