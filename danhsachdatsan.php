<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8"/>
    <title>Sân bóng QNU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #125c0b;
            background-image: url('img/background.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .status-div {
            text-align: center;
            margin: 50px auto;
            padding: 40px;
            border: 5px inset coral;
            width: 80%;
            background-color: #ffffff;
            box-shadow: 0 5px 15px #111111;
            border-radius: 10px;
        }
        .table-status {
            margin: auto;
        }
        a {
            text-decoration: none;
            color: red;
        }
        button {
            padding: 10px 20px;
            background-color: coral;
            border: none;
            border-radius: 5px;
        }
        button a {
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php
        include("config.php");
        include("header.php");

        if(isset($_GET['id'])) {
            $id1 = $_GET['id'];

            // Xóa thông tin đặt sân nếu mã đặt tồn tại
            $sql_tt = "SELECT * FROM datsan WHERE MaDat = '$id1'";
            $result_tt = mysqli_query($conn, $sql_tt);

            if(mysqli_num_rows($result_tt) > 0) {
                // Nếu tồn tại, thực hiện xóa
                $sql_tt1 = "DELETE FROM datsan WHERE MaDat = '$id1'";
                if (mysqli_query($conn, $sql_tt1)) {
                    echo '<script>alert("Hủy sân thành công!"); window.location.href="danhsachdatsan.php";</script>';
                } else {
                    echo '<script>alert("Lỗi khi hủy sân: ' . mysqli_error($conn) . '"); window.location.href="danhsachdatsan.php";</script>';
                }
            } else {
                echo '<script>alert("Không tìm thấy mã đặt sân này!"); window.location.href="danhsachdatsan.php";</script>';
            }
        }
    ?>

    <div class="status-div">
        <h2 class="mb-4">DANH SÁCH SÂN ĐÃ ĐẶT</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Mã đặt</th>
                        <th>Tên Sân</th>
                        <th>Giờ đặt</th>
                        <th>Giờ trả</th>
                        <th colspan="2">Cập nhật</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Kiểm tra đăng nhập
                        if (isset($_SESSION['login_user'])) {
                            $username = $_SESSION['login_user'];
                            $sql_tt = "SELECT datsan.MaDat, sanbong.TenSan, datsan.GioDat, datsan.GioTra, datsan.DaThanhToan
                                       FROM datsan INNER JOIN sanbong ON sanbong.ID = datsan.IDSan 
                                       WHERE datsan.TenTK = '$username'";
                            $result_tt = mysqli_query($conn, $sql_tt);

                            while ($row = mysqli_fetch_assoc($result_tt)) {
                                echo '<tr>';
                                echo '<td>' . $row['MaDat'] . '</td>';
                                echo '<td>' . $row['TenSan'] . '</td>';
                                echo '<td>' . $row['GioDat'] . '</td>';
                                echo '<td>' . $row['GioTra'] . '</td>';
                                echo '<td><a href="danhsachdatsan.php?id=' . $row['MaDat'] . '" class="btn btn-danger btn-sm">Hủy</a></td>';
                                if($row['DaThanhToan'] == 1) {
                                    echo '<td><span class="badge bg-success">Đã thanh toán</span></td>';
                                } else {
                                    echo '<td><a href="thanhtoansan.php?id=' . $row['MaDat'] . '" class="btn btn-warning btn-sm">Thanh toán</a></td>';
                                }
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="6">Vui lòng đăng nhập để xem thông tin đặt sân.</td></tr>';
                        }
                        mysqli_close($conn);
                    ?>
                </tbody>
            </table>
        </div>
        <br>
        <a href="sanbong.php" class="btn btn-danger btn-back">Quay lại trang Sân bóng</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
