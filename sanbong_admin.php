<!DOCTYPE html>
<html lang="vi">
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
            margin-top: 30px;
            padding: 20px;
            border: 5px inset coral;
            max-width: 90%;
            background-color: #ffffff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            color: #333;
        }
        .table-status {
            margin-top: 20px;
        }
        th, td {
            vertical-align: middle;
        }
        .btn {
            text-decoration: none;
            color: #ffffff;
        }
        .btn-danger {
            background-color: red;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .btn-danger:hover {
            background-color: darkred;
        }
        .btn-success {
            background-color: green;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .btn-success:hover {
            background-color: darkgreen;
        }
    </style>
    <script>
        function confirmDelete(id) {
            var result = confirm("Bạn có chắc muốn xóa sân bóng này?");
            if (result) {
                window.location.href = 'edit_sanbong.php?id=' + id + '&action=delete';
            }
        }
    </script>
</head>
<body>
    <?php
    include 'config.php';
    include 'header_admin.php';

    if (isset($_GET['timkiem']) && !empty($_GET['timkiem'])) {
        $timkiem = mysqli_real_escape_string($conn, $_GET['timkiem']);
        $sql = "SELECT * FROM sanbong WHERE TenSan LIKE '%$timkiem%' OR LoaiSan LIKE '%$timkiem%'";
    } else {
        $sql = "SELECT * FROM sanbong";
    }
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        echo '<p class="text-center text-light">Không có sân bóng nào được tìm thấy.</p>';
    }
    ?>
    <div class="container my-4">
        <form action="timkiem-pitch.php" method="GET" class="d-flex mb-4">
            <input type="text" placeholder="Nhập tên hoặc loại sân bóng muốn tìm" class="form-control me-2" name="timkiem">
            <button type="submit" class="btn btn-primary">Tìm</button>
        </form>

        <div class="status-div">
            <h2 class="text-center mb-4">DANH SÁCH SÂN BÓNG</h2>
            <table class="table table-striped table-bordered table-status">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Tên sân</th>
                        <th>Ảnh sân</th>
                        <th>Loại sân</th>
                        <th>Giá</th>
                        <th>Địa điểm</th>
                        <th>Mô tả</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                   
                        
                         while ($row = mysqli_fetch_assoc($result)) {
                    echo '<form action="edit_sanbong.php" method= "POST" id="add-form">';
                    echo '<tr>';
                    echo '<td>' . $row['ID'] . '</td>';
                    echo '<td>' . $row['TenSan'] . '</td>';
                    echo '<td><img src="data:image/jpeg;base64,'.base64_encode($row["AnhSan"]).'" alt="Ảnh sân" class="img-fluid" style="max-width:100px; height:auto;"></td>';
                    echo '<td>' . $row['LoaiSan'] . '</td>';
                    echo '<td>' . number_format($row['Gia']) . ' đ</td>';
                    echo '<td>' . $row['DiaDiem'] . '</td>';
                    echo '<td>' . $row['MoTa'] . '</td>';
                    echo '<td><input class="btn btn-success" type ="submit" name="suasb['.$row['ID'].']" value="Sửa"></td>';
                    echo '<td><input class="btn btn-danger" type="button" value="Xóa" onclick="confirmDelete('.$row['ID'].')"></td>';
                    echo '</tr>';
                }
                    ?>
                </tbody>
            </table>
            <div class="text-center">
            <a href="them_sanbong.php" class="btn btn-success">Thêm mới</a>
        </div>
        </div>
    </div>
</body>
</html>