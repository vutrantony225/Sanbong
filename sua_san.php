<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sân bóng</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('img/baotri.jpg'); /* Đặt đường dẫn ảnh nền tại đây */
            background-size: cover; /* Bao phủ toàn bộ trang */
            background-position: center; /* Căn giữa ảnh */
            background-attachment: fixed; /* Ảnh cố định khi cuộn trang */
            font-family: 'Poppins', sans-serif;
        }
        .edit-field-div {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            margin-top: 50px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #1ae034;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .form-label {
            font-weight: 600;
        }
        .btn-custom {
            width: 100%;
            margin-top: 10px;
        }
        @media (max-width: 767px) {
            .edit-field-div {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center">
        <div class="edit-field-div col-12 col-md-8 col-lg-6">
            <h1>Sửa thông tin sân bóng</h1>
            <?php
                include 'config.php';

          
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                } else {
                    echo "<div class='alert alert-danger'>Lỗi: Không có ID sân bóng được chỉ định.</div>";
                    exit;
                }

               
                if (isset($_POST['luu'])) {
                    $tenSan = $_POST['tenSan'];
                    $loaiSan = $_POST['loaiSan'];
                    $gia = $_POST['gia'];
                    $diaDiem = $_POST['diaDiem'];
                    $moTa = $_POST['moTa'];

               
                    if (isset($_FILES['image']) && $_FILES['image']['tmp_name'] != "") {
                        $imageData = file_get_contents($_FILES['image']['tmp_name']);
                        $imageData = mysqli_real_escape_string($conn, $imageData);

                     
                        $sql = "UPDATE sanbong 
                                SET TenSan = '$tenSan', AnhSan = '$imageData', LoaiSan = '$loaiSan', Gia = '$gia', DiaDiem = '$diaDiem', MoTa = '$moTa' 
                                WHERE ID = $id";
                    } else {
                      
                        $sql = "UPDATE sanbong 
                                SET TenSan = '$tenSan', LoaiSan = '$loaiSan', Gia = '$gia', DiaDiem = '$diaDiem', MoTa = '$moTa' 
                                WHERE ID = $id";
                    }

                    if (mysqli_query($conn, $sql)) {
                        echo "<script>
                        alert('Sân bóng đã được cập nhật thành công!');
                        window.location = 'sanbong_admin.php';
                        </script>";
                    } else {
                        echo "<div class='alert alert-danger'>Lỗi: " . mysqli_error($conn) . "</div>";
                    }
                }

                $sql = "SELECT * FROM sanbong WHERE ID = $id";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                } else {
                    echo "<div class='alert alert-danger'>Lỗi: Không tìm thấy thông tin sân bóng.</div>";
                    exit;
                }
            ?>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="tenSan" class="form-label">Tên sân bóng:</label>
                    <input type="text" class="form-control" name="tenSan" id="tenSan" value="<?= $row['TenSan'] ?>" required>
                </div>

                <div class="mb-3">
                    <label for="loaiSan" class="form-label">Loại sân:</label>
                    <input type="text" class="form-control" name="loaiSan" id="loaiSan" value="<?= $row['LoaiSan'] ?>" required>
                </div>

                <div class="mb-3">
                    <label for="gia" class="form-label">Giá:</label>
                    <input type="text" class="form-control" name="gia" id="gia" value="<?= $row['Gia'] ?>" required>
                </div>

                <div class="mb-3">
                    <label for="diaDiem" class="form-label">Địa điểm:</label>
                    <input type="text" class="form-control" name="diaDiem" id="diaDiem" value="<?= $row['DiaDiem'] ?>" required>
                </div>

                <div class="mb-3">
                    <label for="moTa" class="form-label">Mô tả:</label>
                    <textarea class="form-control" name="moTa" id="moTa" required><?= $row['MoTa'] ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Ảnh sân bóng:</label>
                    <input type="file" class="form-control" name="image" id="image">
                    <img class="mt-3" width="100" height="50" src="data:image/jpeg;base64,<?= base64_encode($row["AnhSan"]) ?>" alt="Ảnh sân bóng">
                </div>

                <button type="submit" name="luu" class="btn btn-success btn-custom">Lưu</button>
            </form>
        </div>
    </div>
</body>
</html>
