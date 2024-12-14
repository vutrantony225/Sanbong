<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trạng thái Sân bóng</title>
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
            text-align: center;
            margin: 5% auto;
            padding: 40px;
            border: 5px inset coral;
            width: 70%;
            background-color: #ffffff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }
        .table-status {
            margin: auto;
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
        .btn-back {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php
        include("config.php");
        include("header.php");
    ?>
    <div class="status-div">
        <h1 class="text-success">TRẠNG THÁI SÂN BÓNG</h1>
        <table class="table table-bordered table-hover table-status">
            <thead class="table-success">
                <tr>
                    <th>Tên Sân</th>
                    <th>Trạng Thái</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_tt = "SELECT ID, TenSan, 
                IF(TrangThai = 1, 'Đang hoạt động', 'Đang bảo trì') AS TrangThai
                FROM sanbong";
                $result_tt = mysqli_query($conn, $sql_tt);

                while ($row = mysqli_fetch_assoc($result_tt)) {
                    echo '<tr>';
                    echo '<td>' . $row['TenSan'] . '</td>';
                    echo '<td>' . $row['TrangThai'] . '</td>';
                    echo '</tr>';
                }

                mysqli_close($conn);
                ?>
            </tbody>
        </table>
        <a href="sanbong.php" class="btn btn-danger btn-back">Quay lại trang Sân bóng</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
