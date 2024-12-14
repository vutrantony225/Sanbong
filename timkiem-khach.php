<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Sân bóng TTVHO</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #125c0b;
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

        .btn-custom {
            color: #ec0909;
            font-weight: bold;
            cursor: pointer;
        }

        .search-bt {
            height: 25px;
            margin-left: 5px;
            width: 80px;
            background-color: red;
            color: white;
        }

        .search {
            height: 25px;
            width: 400px;
            margin-left: 12.5%;
            margin-top: 80px;
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
    </style>
    <script>
        // Xác nhận xóa khách hàng
        function confirmDelete(id) {
            if (confirm("Bạn có chắc chắn muốn xóa khách hàng này?")) {
                // Nếu người dùng xác nhận xóa, điều hướng đến trang xóa khách hàng
                window.location.href = 'edit_khachhang.php?id=' + id;
            }
        }
    </script>
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

    <?php
    if (isset($_GET['timkiem'])) {
        $timkiem = $_GET['timkiem'];
        if (empty($timkiem)) {
            echo '<script>
                    alert("Vui lòng nhập thông tin tìm kiếm!");
                    window.history.back(); 
                </script>';
        } else {
            $sql = "SELECT * FROM khachhang WHERE TenKH LIKE '%$timkiem%'";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);
            if ($num > 0 && $timkiem != "") {
                echo '<div class="status-div">
                        <b>KẾT QUẢ TÌM KIẾM <span id="tieudetime"></span></b><br />
                        <br>
                        <table class="table table-bordered table-striped table-hover table-status">
                            <thead class="table-dark">
                                <tr>
                                    <th>Mã khách hàng</th>
                                    <th>Tên khách hàng</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>';
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
                mysqli_close($conn);
                echo '</tbody>
                        </table>
                        <br>
                        <a href="add_customer.php" class="btn btn-success btn-custom">Thêm mới</a>
                        <a href="khachhang_admin.php" class="btn btn-danger btn-custom">Quay lại</a>
                    </div>';
            } else {
                echo '<div class="status-div-rong">Không có kết quả nào được tìm thấy.</div>';
            }
        }
    }
    ?>
</body>

</html>
