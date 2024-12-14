<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>DANH SÁCH YÊU THÍCH</title>
    
    <!-- Thêm Bootstrap CSS từ CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #125c0b;
            background-image: url('img/background.jpg'); /* Đặt đường dẫn ảnh nền tại đây */
            background-size: cover; /* Bao phủ toàn bộ trang */
            background-position: center; /* Căn giữa ảnh */
            background-attachment: fixed; /* Ảnh cố định khi cuộn trang */
        }
        .box {
            margin-left: 100px;
            text-align: center;
            margin-top: 15px;
            padding: 10px;
            border: 5px inset coral;
            width: 35%;
            background-color: #ffffff;
            box-shadow: 0 5px 15px #111111;
            display: inline-block;
            margin-bottom: 25px;
        }
        .box img {
            max-width: 300px;
            display: inline-block;
            vertical-align: middle;
        }
        .box h2 {
            display: inline-block;
            vertical-align: middle;
            margin-left: 10px;
        }
        .favorite-button {
            display: inline-block;
            vertical-align: middle;
            margin-left: 10px;
        }
        .btn {
            display: inline-block;
            vertical-align: middle;
            margin-left: 20px;
            margin-bottom: 10px;
            color: #ec0909;
        }
        .box c {
            display: block;
            vertical-align: middle;
            color: green;
        }
        .sanbong-div {
            margin-left: 50px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .search {
            height: 30px;
            width: 400px;
            padding-left: 10px;
            box-sizing: border-box; 
        }

        .search-bt {
            height: 36px;
            width: 60px;
            color: red;
            padding: 0; 
            text-align: center; 
            vertical-align: middle; 
        }   

        .status-div-rong {
            margin: 12.5%;
            border: 5px inset coral;
            width: 70%;
            background-color: #ffffff;
            box-shadow: 0 5px 15px #111111;
            display: inline-block;
            margin-bottom: 25px;
            margin-top: 15px;
            padding: 10px 40px;
        }

        /* Center form */
        .search-form {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 50px;
        }
    </style>
</head>
<body>

    <?php
        include 'config.php';
        include 'header.php';
    ?>
    
    <div class="search-form">
        <form action="timkiem.php" method="GET">
            <input type="text" placeholder="Nhập tên sân bóng muốn tìm" class="search" name="timkiem"/>
            <input class="search-bt btn btn-danger" type="submit" name="search-sb" value="Tìm"/>
        </form>
    </div>

    <?php
        // Xử lý hủy yêu thích
        if (isset($_POST['huyyeuthich'])) {
            $id = $_POST['huyyeuthich_id'];
            $sql = "DELETE FROM sanyeuthich WHERE ID = '$id'";
            $result = mysqli_query($conn, $sql);
        }

        $id = $_SESSION['login_user'];
        $sql = "SELECT *, sanyeuthich.ID AS idyeu
                FROM sanyeuthich, sanbong 
                WHERE sanyeuthich.TenTK = '$id' AND sanbong.ID = sanyeuthich.IDSan 
                GROUP BY sanbong.ID ASC";

        $products = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($products) == 0) {
            echo '<div class="status-div-rong"><p>Không có sân bóng yêu thích.</p></div>';
        } else {
            echo '<div class="sanbong-div">';
            while ($row = mysqli_fetch_assoc($products)) {
                echo '<div class="box">
                        <form method="POST" action="sanyeuthich.php">
                            <img width="100" height="50" src="data:image/jpeg;base64,' . base64_encode($row["AnhSan"]) . '">
                            <h2>' . $row['TenSan'] . '</h2>';
                echo '<input type="hidden" name="huyyeuthich_id" value="' . $row['idyeu'] . '">';
                echo '<button type="submit" name="huyyeuthich" class="favorite-button btn btn-outline-danger" onclick="showCancelAlert()">Hủy ❤️</button>';          
                echo '<c>Giá: ' . $row['Gia'] . 'đ</c>
                      <c>Loại sân: ' . $row['LoaiSan'] . '</c>
                    </form>
                    <form method="POST" action="action.php">
                        <input type="hidden" name="id" value="' . $row['ID'] . '">';
                
                // Kiểm tra trạng thái của sân bóng
                if ($row['TrangThai'] == 1) {
                    // Sân hoạt động
                    echo '<input type="submit" name="datsan['.$row['ID'].']" class="btn btn-danger" value="Đặt sân">';
                } else {
                    // Sân bảo trì
                    echo '<c style="color: red; font-weight: bold;">Đang bảo trì</c>';
                }

                echo '<input type="submit" name="chitiet['.$row['ID'].']" class="btn btn-info" value="Chi tiết">
                    </form>
                </div>';
            }
            echo '</div>';
        }
    ?>
    
    <!-- Nút Quay lại -->
    <div class="text-center mt-4">
    <a href="sanbong.php" class="btn btn-danger btn-back">Quay lại trang Sân bóng</a>
    </div>
    
   
    <script>
        function showCancelAlert() {
            alert('Bạn muốn hủy yêu thích sân bóng này!');
        }
    </script>
</body>
</html>
