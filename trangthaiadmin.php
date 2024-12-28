<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trạng thái sân bóng</title>
    <!-- Thêm Bootstrap CSS từ CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
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
        .btn-warning {
            background-color: orange;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .btn-warning:hover {
            background-color: darkorange;
        }
        .btn-primary {
            background-color: blue;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .btn-primary:hover {
            background-color: darkblue;
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

        // Fetch status of the football fields from the database
        $sql_tt = "SELECT ID, TenSan, IF(TrangThai = 1, 'Đang hoạt động', 'Đang bảo trì') AS TrangThai FROM sanbong";
        $result_tt = mysqli_query($conn, $sql_tt);

        if (mysqli_num_rows($result_tt) == 0) {
            echo '<p class="text-center text-light">Không có sân bóng nào được tìm thấy.</p>';
        }
    ?>
    
    <div class="container my-4">
        <div class="status-div">
            <h2 class="text-center mb-4">TRẠNG THÁI SÂN BÓNG</h2>
            <table class="table table-striped table-bordered table-status">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Tên Sân</th>
                        <th>Trạng Thái</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while ($row = mysqli_fetch_assoc($result_tt)) {
                            echo '<form action="chinhtrangthai.php?id=' . $row['ID'] . '" method="POST">';
                            echo '<tr>';
                            echo '<td>' . $row['ID'] . '</td>';
                            echo '<td>' . $row['TenSan'] . '</td>';
                            echo '<td>' . $row['TrangThai'] . '</td>';
                            echo '<td><button type="submit" class="btn btn-warning">Sửa</button></td>';
                            echo '</tr>';
                            echo '</form>';
                        }
                    ?>
                </tbody>
            </table>   
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
</body>
</html>
