<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sân bóng QNU</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <style>
        body {
            background-color: #125c0b;
            background-image: url('img/background.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .box {
            margin: 70px auto;
            padding: 10px;
            border: 5px inset coral;
            width: 80%;
            background-color: #ffffff;
            box-shadow: 0 5px 15px #111111;
        }
        .box-1 {
            text-align: center;
            border: 5px solid black;
            width: 26%; 
            margin: 25px;
            background-color: #ffffff;
            display: inline-block;
        }
        .box img {
            max-width: 252px;
        }
        .box h2 {
            margin-top: 10px;
        }
        .favorite-button {
            margin-left: 10px;
        }
        .btn {
            color: #ec0909;
        }
        .table-status {
            margin: auto;
            text-align: center;
        }
        th, td {
            padding: 10px;
        }
    </style>
</head>
<body>
    <?php
    include 'config.php';
    include 'header_admin.php'; 

    $sql_sb = "SELECT * FROM sanbong ORDER BY ID ASC LIMIT 6";
    $sql_kh = "SELECT * FROM khachhang";
    $rs_sb = mysqli_query($conn, $sql_sb);
    $rs_kh = mysqli_query($conn, $sql_kh);
    ?>

    <div class="container mt-5">
        <div class="box">
            <h4 class="text-center">SÂN BÓNG</h4>
            <div class="text-end mb-3">
                <a href="sanbong_admin.php" class="btn btn-link text-danger">Tùy chỉnh <i class="fas fa-chevron-right"></i></a>
            </div>
            <div class="d-flex flex-wrap justify-content-center">
                <?php while($row_sb = mysqli_fetch_assoc($rs_sb)) { ?>
                    <div class="box-1">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($row_sb["AnhSan"]); ?>" class="img-fluid mb-2">
                        <h5><?php echo $row_sb['TenSan']; ?></h5>
                        <p>Giá: <?php echo $row_sb['Gia']; ?> đ</p>
                        <p>Loại sân: <?php echo $row_sb['LoaiSan']; ?></p>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="container mt-5">
        <div class="box">
            <h4 class="text-center">KHÁCH HÀNG</h4>
            <div class="text-end mb-3">
                <a href="khachhang_admin.php" class="btn btn-link text-danger">Tùy chỉnh <i class="fas fa-chevron-right"></i></a>
            </div>
            <table class="table table-bordered table-hover table-status">
                <thead class="table-dark">
                    <tr>
                        <th>Mã khách</th>
                        <th>Tên khách</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row_kh = mysqli_fetch_assoc($rs_kh)) { ?>
                        <tr>
                            <td><?php echo $row_kh['MaKH']; ?></td>
                            <td><?php echo $row_kh['TenKH']; ?></td>
                            <td><?php echo $row_kh['Email']; ?></td>
                            <td><?php echo $row_kh['SoDT']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php mysqli_close($conn); ?>

    
</body>
</html>
