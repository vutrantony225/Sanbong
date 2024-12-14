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
            background-image: url('img/background.jpg'); /* Đặt đường dẫn ảnh nền tại đây */
            background-size: cover; /* Bao phủ toàn bộ trang */
            background-position: center; /* Căn giữa ảnh */
            background-attachment: fixed; /* Ảnh cố định khi cuộn trang */
        }

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

        .table-status {
            text-align: center;
            margin: auto;
        }

        th,
        td {
            padding: 10px;
        }

        .btn {
            color: #ec0909;
            border: none;
            font-weight: bold;
            padding: 8px 16px;
            cursor: pointer;
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

        .btn:hover {
            background-color: #d00c0c;
            color: white;
        }
    </style>
</head>

<body>
    <?php
    include 'config.php';
    include 'header_admin.php';
    ?>

    <!-- Search Form -->
    <div class="container mt-5 pt-5">
        <form action="timkiem-khach.php" method="GET">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Nhập tên khách hàng cần tìm" name="timkiem">
                <button class="btn btn-danger" type="submit" name="search-sb">Tìm</button>
            </div>
        </form>

    <div class="status-div">
        <b>DANH SÁCH KHÁCH HÀNG</b><br />
        <br>
        <table class="table table-bordered table-striped table-hover table-status">
            <thead class="table-dark">
                <tr>
                    <th>MaKH</th>
                    <th>Tên khách hàng</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $sql = "SELECT * FROM khachhang";
                $result = mysqli_query($conn, $sql);

                // Loop through the result
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<form action="edit_khachhang.php" method= "POST" id="add-form">';
                    echo '<tr>';
                    echo '<td>' . $row['MaKH'] . '</td>';
                    echo '<td>' . $row['TenKH'] . '</td>';
                    echo '<td>' . $row['Email'] . '</td>';
                    echo '<td>' . $row['SoDT'] . '</td>';
                    echo '<td><input class="btn btn-warning btn-custom" type ="submit" name="suakh['.$row['MaKH'].']" value="Sửa"></td>';
                    //echo '<td><input class="btn" type ="submit" name="xoasb['.$row['ID'].']" value="Xóa"></td>';
                    echo '<td><input class="btn btn-danger btn-custom" type="button" value="Xóa" onclick="confirmDelete('.$row['MaKH'].')"></td>';
                    echo '</tr>';
                }

                // Close connection
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
        <div class="text-center">
            <a href="them_khachhang.php" class="btn btn-success">Thêm mới</a>
        </div>
    </div>

    <script>
        function confirmDelete(id) {
            var result = confirm("Bạn có chắc muốn xóa khách hàng này?");
            if (result) {
                window.location.href = 'edit_khachhang.php?id=' + id;
            }
        }
    </script> 

</body>

</html>
