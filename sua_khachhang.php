<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa Khách Hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('img/baotri.jpg'); /* Đặt đường dẫn ảnh nền tại đây */
            background-size: cover; /* Bao phủ toàn bộ trang */
            background-position: center; /* Căn giữa ảnh */
            background-attachment: fixed; /* Ảnh cố định khi cuộn trang */
            font-family: 'Poppins', sans-serif;
            background-color: #125c0b;
            color: #ffffff;
        }
        .form-container {
            background: #f1f1f1;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0px 0px 5px 0px hsl(128, 80%, 49%);
            max-width: 500px;
            margin: 100px auto;
            color: #333;
        }
        .form-container h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #1ae034;
        }
        .form-container .btn-primary {
            background-color: #125c0b;
            border-color: #125c0b;
        }
        .form-container .btn-primary:hover {
            background-color: #0e4d09;
            border-color: #0e4d09;
        }
    </style>
</head>
<body>
    <?php
        include 'config.php';
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            echo "<div class='alert alert-danger text-center'>Lỗi: Không có ID khách hàng được chỉ định.</div>";
            exit;
        }

        if (isset($_POST['luu'])) {
            $tenKhachHang = $_POST['tenKhachHang'];
            $email = $_POST['email'];
            $soDT = $_POST['soDT'];

            // Cập nhật thông tin khách hàng trong CSDL
            $sql = "UPDATE khachhang SET TenKH = '$tenKhachHang', Email = '$email', SoDT = '$soDT' WHERE MaKH = $id";
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                    alert('Khách hàng đã được cập nhật thành công!');
                    window.location = 'khachhang_admin.php';
                </script>";
            } else {
                echo "<div class='alert alert-danger text-center'>Lỗi: " . mysqli_error($conn) . "</div>";
            }
        }

        // Lấy thông tin khách hàng hiện tại
        $sql = "SELECT * FROM khachhang WHERE MaKH = $id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        } else {
            echo "<div class='alert alert-danger text-center'>Lỗi: Không tìm thấy thông tin khách hàng.</div>";
            exit;
        }
    ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="form-container">
                    <h1>Sửa thông tin khách hàng</h1>
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="tenKhachHang" class="form-label">Tên khách hàng:</label>
                            <input type="text" class="form-control" name="tenKhachHang" id="tenKhachHang" value="<?= $row['TenKH'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="text" class="form-control" name="email" id="email" value="<?= $row['Email'] ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="soDT" class="form-label">Số Điện Thoại:</label>
                            <input type="text" class="form-control" name="soDT" id="soDT" value="<?= $row['SoDT'] ?>" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" name="luu" class="btn btn-primary btn-lg w-100">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
