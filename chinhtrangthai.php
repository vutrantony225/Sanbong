<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh trạng thái sân</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('img/baotri.jpg'); /* Đặt đường dẫn ảnh nền tại đây */
            background-size: cover; /* Bao phủ toàn bộ trang */
            background-position: center; /* Căn giữa ảnh */
            background-attachment: fixed; /* Ảnh cố định khi cuộn trang */
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .form-container {
            background: #f1f1f1;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
        }

        .form-container h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #1ae034;
        }

        .form-container label {
            font-weight: bold;
            color: #555;
        }

        .form-container .btn-primary {
            background-color: #125c0b;
            border: none;
        }

        .form-container .btn-primary:hover {
            background-color: #0e4708;
        }

        .form-container .form-check-label {
            font-weight: normal;
        }
    </style>
</head>

<body>
    <?php
    include 'config.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        echo "<div class='alert alert-danger'>Lỗi: Không có ID trạng thái sân bóng được chỉ định.</div>";
        exit;
    }

    if (isset($_POST['luu'])) {
        $trangThai = isset($_POST['trangThai']) ? 1 : 0;
        $sql_tt = "UPDATE sanbong SET TrangThai = $trangThai WHERE ID = $id";

        if (mysqli_query($conn, $sql_tt)) {
            echo "<script>
                    alert('Trạng thái đã được cập nhật thành công!');
                    window.location = 'trangthaiadmin.php';
                  </script>";
        } else {
            echo "<div class='alert alert-danger'>Lỗi: " . mysqli_error($conn) . "</div>";
        }
    }

    $sql_tt = "SELECT * FROM sanbong WHERE ID = '$id'";
    $result_tt = mysqli_query($conn, $sql_tt);

    if (mysqli_num_rows($result_tt) > 0) {
        $row = mysqli_fetch_assoc($result_tt);
    } else {
        echo "<div class='alert alert-danger'>Lỗi: Không tìm thấy thông tin sân bóng.</div>";
        exit;
    }
    ?>

    <div class="form-container">
        <h1>Sửa trạng thái sân bóng</h1>
        <form method="post" action="">
            <div class="mb-3">
                <label for="tenSan" class="form-label">Tên sân bóng:</label>
                <div class="form-control bg-light"><?= htmlspecialchars($row['TenSan']) ?></div>
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" name="trangThai" id="trangThai" class="form-check-input" value="1" <?php echo ($row['TrangThai'] == 1) ? 'checked' : ''; ?>>
                <label for="trangThai" class="form-check-label">Đang hoạt động</label>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" name="luu" class="btn btn-primary">Lưu</button>
                <a href="trangthaiadmin.php" class="btn btn-secondary">Hủy</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
