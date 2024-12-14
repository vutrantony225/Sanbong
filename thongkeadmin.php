<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sân bóng QNU</title>
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
            margin: auto;
            margin-top: 100px;
            padding: 20px;
            border: 5px inset coral;
            max-width: 800px;
            background-color: #ffffff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            color: #333;
        }
        .table-status {
            margin-top: 20px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        button a {
            text-decoration: none;
            color: #ffffff;
        }
        button {
            background-color: coral;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #e67300;
        }
    </style>
</head>
<body>
    <?php
    include 'config.php';
    include 'header_admin.php';
    ?>

    <div class="status-div text-center">
        <h2 class="mb-4">THỐNG KÊ DOANH THU</h2>
        <table class="table table-striped table-bordered table-status">
            <thead class="table-dark">
                <tr>
                    <th>Tên Sân</th>
                    <th>Tổng Tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Câu truy vấn SQL
                $sql = "SELECT sanbong.TenSan, SUM(datsan.ThanhTien) AS TongTien
                        FROM datsan
                        INNER JOIN sanbong
                        ON sanbong.ID = datsan.IDSan
                        GROUP BY datsan.IDSan
                        ORDER BY TongTien ASC";
                $result = $conn->query($sql);

                // Kiểm tra và hiển thị kết quả
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['TenSan']}</td>
                                <td>" . number_format($row['TongTien']) . " đ</td>
                              </tr>";
                    }

                    $totalAll = $conn->query("SELECT SUM(ThanhTien) AS TongAll FROM datsan")->fetch_assoc();
                    echo "<tr class='fw-bold'>
                            <td>Tổng tất cả</td>
                            <td>" . number_format($totalAll['TongAll']) . " đ</td>
                          </tr>";
                } else {
                    echo "<tr><td colspan='2'>Không có dữ liệu</td></tr>";
                }
                // Đóng kết nối
                $conn->close();
                ?>
            </tbody>
        </table>
        <br>
        <button><a href="trangchu.php">Quay lại trang chủ</a></button>
    </div>
</body>
</html>