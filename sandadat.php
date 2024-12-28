<html>
<head>
    <meta charset="UTF-8">
    <title>Sân bóng QNU</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .status-div {
            text-align: center;
            margin: 12.5%;
            margin-top: 100px;
            padding: 10px 40px;
            border: 5px inset coral;
            width: 70%;
            background-color: #ffffff;
            box-shadow: 0 5px 15px #111111;
            display: inline-block;
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
            background-image: url('img/background.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .btn {
            display: inline-block;
            vertical-align: middle;
            color: #ec0909;
        }
        .filter-form {
            margin: 20px 0;
        }
        .btn-xacnhan {
            padding: 5px 10px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        .btn-xacnhan:hover {
            background-color: #218838;
        }
        .date-filter, .time-filter {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php
    include 'config.php';
    include 'header.php';
    ?>

    <div class="status-div">
        <h2>DANH SÁCH SÂN ĐÃ ĐƯỢC ĐẶT</h2>
        <form class="filter-form" method="GET" action="">
            <label for="filter-date">Lọc theo ngày:</label>
            <input type="date" id="filter-date" name="filter_date" class="date-filter" value="<?= isset($_GET['filter_date']) ? $_GET['filter_date'] : '' ?>">

            <label for="start-time">Từ giờ:</label>
            <input type="time" id="start-time" name="start_time" class="time-filter" value="<?= isset($_GET['start_time']) ? $_GET['start_time'] : '' ?>">

            <label for="end-time">Đến giờ:</label>
            <input type="time" id="end-time" name="end_time" class="time-filter" value="<?= isset($_GET['end_time']) ? $_GET['end_time'] : '' ?>">

            <button type="submit" class="btn-xacnhan">Lọc</button>
        </form>

        <table class="table-status" border="1">
            <thead>
                <tr>
                    <th>Tên sân</th>
                    <th>Tên khách hàng</th>
                    <th>Giờ đặt</th>
                    <th>Giờ trả</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Lấy giá trị lọc từ biểu mẫu
                $filter_date = isset($_GET['filter_date']) ? $_GET['filter_date'] : '';
                $start_time = isset($_GET['start_time']) ? $_GET['start_time'] : '';
                $end_time = isset($_GET['end_time']) ? $_GET['end_time'] : '';

                // Tạo truy vấn SQL với điều kiện lọc
                $sql = "SELECT sanbong.TenSan, datsan.* FROM datsan INNER JOIN sanbong ON sanbong.ID = datsan.IDSan";
                $conditions = [];

                if ($filter_date) {
                    $conditions[] = "DATE(datsan.GioDat) = '$filter_date'";
                }
                if ($start_time) {
                    $conditions[] = "TIME(datsan.GioDat) >= '$start_time'";
                }
                if ($end_time) {
                    $conditions[] = "TIME(datsan.GioDat) <= '$end_time'";
                }

                if (!empty($conditions)) {
                    $sql .= " WHERE " . implode(' AND ', $conditions);
                }

                $result = mysqli_query($conn, $sql);

                // Kiểm tra và hiển thị dữ liệu
                if (mysqli_num_rows($result) == 0) {
                    echo '<tr><td colspan="5" style="text-align: center; font-weight: bold;">Không có sân bóng nào được đặt.</td></tr>';
                } else {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $row['TenSan'] . '</td>';
                        $tenkh = $row['TenTK'];
                
                        // Lấy thông tin khách hàng
                        $sql2 = "SELECT khachhang.TenKH 
                                 FROM khachhang INNER JOIN taikhoan
                                 ON khachhang.Email = taikhoan.Email
                                 WHERE TenTK = '$tenkh'";
                        $result2 = $conn->query($sql2);
                
                        if ($result2 && $row2 = $result2->fetch_assoc()) {
                            echo '<td>' . $row2['TenKH'] . '</td>';
                        } else {
                            echo '<td>Không có thông tin khách hàng</td>';
                        }
                
                        echo '<td>' . $row['GioDat'] . '</td>';
                        echo '<td>' . $row['GioTra'] . '</td>';
                
                        // Hiển thị trạng thái thanh toán
                        if ($row['DaThanhToan'] == 1) {
                            echo '<td><span class="badge bg-success">Đã Xác nhận</span></td>';
                        } else {
                            echo '<td><span class="badge bg-danger">Đang xử lý</span></td>';
                        }
                        echo '</tr>';
                    }
                }

                // Đóng kết nối
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
