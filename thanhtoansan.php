<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán đặt sân bóng</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #125c0b;
            background-image: url('img/background.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            font-family: 'Poppins', sans-serif;
        }
        .payment-form {
            max-width: 500px;
            background-color: #f1f1f1;
            margin: 100px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }
        .payment-form h1 {
            text-align: center;
            color: #1ae034;
            margin-bottom: 20px;
        }
        .btn-custom {
            width: 45%;
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <?php
        include 'config.php';
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            echo "<div class='alert alert-danger text-center'>Lỗi: Không có ID sân được chỉ định.</div>";
            exit;
        }
        if (isset($_POST['huy'])) {
            header('location: danhsachdatsan.php');
        }
        if (isset($_POST['luu'])) {
            $stk = $_POST['stk'];
            $ten = $_POST['tenTK'];
            if (!empty($ten)) {
                if (!empty($stk)) {
                    $sql = "UPDATE datsan SET DaThanhToan = 1 WHERE MaDat = '$id'";

                    if (mysqli_query($conn, $sql)) {
                        echo "<script>
                        alert('Bạn đã thanh toán thành công!');
                        window.location = 'danhsachdatsan.php';
                        </script>";
                    } else {
                        echo "<div class='alert alert-danger'>Lỗi: " . mysqli_error($conn) . "</div>";
                    }
                } else {
                    echo "<script>
                        alert('Vui lòng nhập số tài khoản!');
                        window.history.back();
                        </script>";
                }
            } else {
                echo "<script>
                        alert('Vui lòng nhập tên chủ tài khoản!');
                        window.history.back();
                        </script>";
            }
        }

        $sql = "SELECT * FROM datsan WHERE MaDat = $id";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        } else {
            echo "<div class='alert alert-danger text-center'>Lỗi: Không tìm thấy thông tin đặt sân.</div>";
            exit;
        }
        $i = $row['IDSan'];
        $sql1 = "SELECT TenSan FROM sanbong WHERE ID = $i";
        $result1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_assoc($result1);
    ?>
    <div class="payment-form">
        <h1>Thông tin thanh toán</h1>
        <form method="post" action="">
            <div class="mb-3">
                <label for="madat" class="form-label">Mã đặt:</label>
                <input type="text" id="madat" name="madat" class="form-control" value="<?= $id ?>" disabled>
            </div>

            <div class="mb-3">
                <label for="tensan" class="form-label">Tên Sân:</label>
                <input type="text" id="tensan" name="tensan" class="form-control" value="<?= $row1['TenSan'] ?>" disabled>
            </div>

            <div class="mb-3">
                <label for="tenKhachHang" class="form-label">Tên chủ tài khoản:</label>
                <input type="text" id="tenKhachHang" name="tenTK" class="form-control">
            </div>

            <div class="mb-3">
                <label for="stk" class="form-label">Số tài khoản:</label>
                <input type="text" id="stk" name="stk" class="form-control">
            </div>

            <div class="mb-3">
                <label for="tien" class="form-label">Số tiền phải thanh toán:</label>
                <input type="text" id="tien" name="tien" class="form-control" value="<?= $row['ThanhTien'] ?>" disabled>
            </div>

            <div class="btn-container">
                <input type="submit" name="luu" value="Thanh toán" class="btn btn-success btn-custom">
                <input type="submit" name="huy" value="Hủy" class="btn btn-danger btn-custom">
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>