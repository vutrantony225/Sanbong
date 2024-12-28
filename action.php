<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sân bóng</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        body {
            background-color: #125c0b;
            background-image: url('img/background.jpg'); 
            background-size: cover; 
            background-position: center; 
            background-attachment: fixed; 
        }

        .detail-div {
            text-align: center;
            padding: 40px;
            border: 10px inset coral;
            width: 50%;
            max-width: 800px;
            background-color: #ffffff;
            box-shadow: 0 5px 15px #111111;
            position: absolute;
            top: 55%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 999;
        }
        

        .btn {
            display: inline-block;
            vertical-align: middle;
            margin-left: 20px;
            color: #ec0909;
        }

        .back-button {
            margin-right: 20px;
            margin-bottom: 0px;
        }

        .back-a {
            text-decoration: none;
            color: red;
        }

        #datetimePicker {
            display: inline-block;
            vertical-align: middle;
            margin-left: 20px;
            color: #ec0909;
            border-radius: 5px;
            padding: 10px;
            font-size: 18px;
            cursor: pointer;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        function confirmAddlike(id) {
            var result = confirm("Bạn có chắc muốn thêm sân bóng này vào danh sách yêu thích?");
            if (result) {
                window.location.href = 'them_yeuthich.php?id=' + id;
            }
        }
    </script>
</head>
<body>
    <?php
        include('config.php');
        include('header.php');

        // Check if user is logged in
        if (isset($_SESSION['user'])) {
            $username = $_SESSION['login_user'];
            $loggedIn = true;
        } else {
            $username = 'guest';
            $loggedIn = false;
        }

        // Handle the detail page for a specific stadium
        if (isset($_POST['chitiet']) && $_POST['chitiet']) {
            $sanBongId = $_POST['id']; // Get stadium ID from POST
            $sql = "SELECT * FROM sanbong WHERE ID = '$sanBongId'";
            $result = mysqli_query($conn, $sql);
            if ($row = mysqli_fetch_array($result)) {
                echo '<div class="detail-div">
                        <form method="post" action="">
                            <img width="600" height="350" src="data:image/jpeg;base64,'.base64_encode($row["AnhSan"]).'" class="img-fluid">
                            <h2>' . $row['TenSan'] . '</h2>
                            <p>Giá: ' . $row['Gia'] . '</p>
                            <p>Loại sân: ' . $row['LoaiSan'] . '</p>
                            <p>Địa điểm: ' . $row['DiaDiem'] . '</p>
                            <p>Mô tả: ' . $row['MoTa'] . '</p>
                            <div>
                                <a href="sanbong.php" class="btn btn-danger back-button">Trở về</a>';
                                if ($row['TrangThai'] === 'bao_tri') {
                                    echo '<c style="color: red; font-weight: bold;">Đang bảo trì</c>';
                                } else {
                                    if ($loggedIn) {
                                        echo '<input class="btn btn-warning" type="button" value="❤️" onclick="confirmAddlike('.$row['ID'].')">';
                                        // Add hidden input to submit the ID with the form
                                        echo '<input type="hidden" name="id" value="' . $row['ID'] . '">';
                                        if ($row['TrangThai'] == 1) {
                                            // Sân hoạt động
                                            echo '<input type="submit" name="datsan['.$row['ID'].']" class="btn btn-danger" value="Đặt sân">';
                                        } else {
                                            // Sân bảo trì
                                            echo '<c style="color: red; font-weight: bold;">Đang bảo trì</c>';
                                        }
                                    }
                                }
                            echo '</div>
                        </form>
                    </div>';
            }
        }

        // Handle the booking functionality
        if (isset($_POST['datsan']) && $_POST['datsan']) {
            if ($loggedIn) {
                $idSan = $_POST['id']; // Get the stadium ID from POST
                $sql = "SELECT * FROM sanbong WHERE ID = '$idSan'";
                $result = mysqli_query($conn, $sql);
                if ($row = mysqli_fetch_array($result)) {
                    if ($row['TrangThai'] === '0') {
                    } else {
                        echo '<div class="detail-div">
                            <form method="post" action="datsan.php">
                                <img width="600" height="350" src="data:image/jpeg;base64,'.base64_encode($row["AnhSan"]).'" class="img-fluid">
                                <input type="hidden" name="id" value="'.$row['ID'].'">
                                <input type="hidden" name="price" value="'.$row['Gia'].'">
                                <h2>' . $row['TenSan'] . '</h2>
                                <p>Giá: ' . $row['Gia'] . '</p>
                                <p>Loại sân: ' . $row['LoaiSan'] . '</p>
                                <p>Mô tả: ' . $row['MoTa'] . '</p>
                                <div>
                                    <input type="text" id="datetimePicker" name="Timedatsan" placeholder="Chọn thời gian đặt sân" class="form-control">
                                    <input type="text" id="datetimePicker" name="Timetrasan" placeholder="Chọn thời gian trả sân" class="form-control">
                                    <input type="submit" name="DatSan['.$row['ID'].']" class="btn btn-success" value="Đặt sân">
                                    <a href="sanbong.php" class="btn btn-danger back-button">Trở về</a>
                                </div>
                            </form>
                        </div>';
                        echo '<script>
                        flatpickr("#datetimePicker", {
                            enableTime: true,
                            minDate: "today",
                            dateFormat: "Y-m-d H:i",
                        });
                    </script>';
                    }
                }
            } else {
                echo "<script>
                    alert('Vui lòng đăng nhập tài khoản!');
                    window.location.href='dangnhap.php';
                </script>";
            }
        } 
    ?>
</body>
</html>
