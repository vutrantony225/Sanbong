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
            background-image: url('img/background.jpg'); /* Đặt đường dẫn ảnh nền tại đây */
            background-size: cover; /* Bao phủ toàn bộ trang */
            background-position: center; /* Căn giữa ảnh */
            background-attachment: fixed; /* Ảnh cố định khi cuộn trang */
        }
        .btn {
            display: inline-block;
            vertical-align: middle;
            color: #ec0909;
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
    </style>
</head>
<body>
    <?php
    include 'config.php';
    include 'header_admin.php';

    // Xử lý xác nhận thanh toán
    if (isset($_POST['xacnhan'])) {
        $idDat = $_POST['idDat'];
        $updateSql = "UPDATE datsan SET DaThanhToan = 1 WHERE MaDat = '$idDat'";
        mysqli_query($conn, $updateSql);
    }
    ?>

    <div class="status-div">
        <h2>DANH SÁCH ĐẶT SÂN</h2>
        <table class="table-status" border="1">
            <thead>
                <tr>
                    <th>Mã đặt</th>
                    <th>Tên sân</th>
                    <th>Tên khách hàng</th>
                    <th>Giờ đặt</th>
                    <th>Giờ trả</th>
                    <th>Trạng thái</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query to get booking details
                $sql = "SELECT sanbong.TenSan, datsan.*
                        FROM datsan INNER JOIN sanbong
                        ON sanbong.ID = datsan.IDSan";
                $result = mysqli_query($conn, $sql);

                // Loop through the results
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['MaDat'] . '</td>';
                    echo '<td>' . $row['TenSan'] . '</td>';
                    $tenkh = $row['TenTK'];

                    // Query to get the customer name based on the user (TenTK)
                    $sql2 = "SELECT khachhang.TenKH 
                             FROM khachhang INNER JOIN taikhoan
                             ON khachhang.Email = taikhoan.Email
                             WHERE TenTK = '$tenkh'";
                    $result2 = $conn->query($sql2);

                    // Check if customer data was found
                    if ($result2 && $row2 = $result2->fetch_assoc()) {
                        echo '<td>' . $row2['TenKH'] . '</td>';
                    } else {
                        // If no customer data found, display a fallback message
                        echo '<td>Không có thông tin khách hàng</td>';
                    }

                    echo '<td>' . $row['GioDat'] . '</td>';
                    echo '<td>' . $row['GioTra'] . '</td>';

                    // Check if the payment has been made
                    if ($row['DaThanhToan'] == 1) {
                        echo '<td>Đã thanh toán</td>';
                    } else {
                        echo '<td>Chờ xác nhận <form style="display:inline-block" method="POST">
                                <input type="hidden" name="idDat" value="' . $row['MaDat'] . '">
                                <button type="submit" name="xacnhan" class="btn-xacnhan">Xác nhận</button>
                              </form></td>';
                    }

                    echo '<td>' . $row['ThanhTien'] . '</td>';
                    echo '</tr>';
                }

                // Close database connection
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
        <br>
        <form action="xuat_excel.php" method="POST">
            <input class="btn btn-danger" type="submit" name="xuat" value="Ghi file excel">
        </form>
    </div>
</body>
</html>
