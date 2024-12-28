<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sân Bóng</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #125c0b;
        }
        .form-container {
            margin-top: 100px;
            background: #f1f1f1;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #1ae034;
        }
        .btn-submit {
            background-color: #125c0b;
            color: white;
        }
        .btn-submit:hover {
            background-color: #0e4a08;
        }
    </style>
</head>
<body>
<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra các giá trị từ form đã được gửi hay chưa
    $tenSan = isset($_POST["tenSan"]) ? $_POST["tenSan"] : '';
    $loaiSan = isset($_POST["loaiSan"]) ? $_POST["loaiSan"] : '';
    $gia = isset($_POST["gia"]) ? $_POST["gia"] : '';
    $diaDiem = isset($_POST["diaDiem"]) ? $_POST["diaDiem"] : '';
    $moTa = isset($_POST["moTa"]) ? $_POST["moTa"] : '';
    $image = isset($_FILES['image']) ? $_FILES['image'] : null;

    // Kiểm tra nếu ảnh được tải lên và không có lỗi
    if ($image && $image['error'] == 0) {
        $imageData = file_get_contents($image['tmp_name']);
        $imageData = mysqli_real_escape_string($conn, $imageData);

        $sql = "INSERT INTO sanbong (TenSan, AnhSan, LoaiSan, Gia, DiaDiem, MoTa, TrangThai)
                VALUES ('$tenSan', '$imageData', '$loaiSan', '$gia', '$diaDiem', '$moTa', 0)";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "<script>
                alert('Thêm sân bóng thành công!');
                window.location.href='sanbong_admin.php';
            </script>";
        } else {
            echo "<div class='alert alert-danger'>Lỗi: " . mysqli_error($conn) . "</div>";
        }
    }
}
?>

<div class="container">
    <div class="form-container mx-auto col-md-6">
        <h1>Nhập thông tin sân bóng</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="tenSan" class="form-label">Tên sân bóng:</label>
                <input type="text" class="form-control" name="tenSan" id="tenSan" required>
            </div>

            <div class="mb-3">
                <label for="loaiSan" class="form-label">Loại sân:</label>
                <input type="text" class="form-control" name="loaiSan" id="loaiSan" required>
            </div>

            <div class="mb-3">
                <label for="gia" class="form-label">Giá:</label>
                <input type="text" class="form-control" name="gia" id="gia" required>
            </div>

            <div class="mb-3">
                <label for="diaDiem" class="form-label">Địa điểm:</label>
                <input type="text" class="form-control" name="diaDiem" id="diaDiem" required>
            </div>

            <div class="mb-3">
                <label for="moTa" class="form-label">Mô tả:</label>
                <textarea class="form-control" name="moTa" id="moTa" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Ảnh sân bóng:</label>
                <input type="file" class="form-control" name="image" id="image" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-submit w-100">Thêm</button>
        </form>
    </div>
</div>
</body>
</html>
