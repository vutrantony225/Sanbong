<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sân bóng QNU</title>

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
            text-align: center;
            padding: 20px;
            border: 5px inset coral;
            width: 100%;
            max-width: 350px;
            background-color: #ffffff;
            box-shadow: 0 5px 15px #111111;
            margin-bottom: 25px;
        }
        .box img {
            max-width: 300px;
        }
        .box h2 {
            font-size: 1.5rem;
        }
        .favorite-button {
            display: inline-block;
            margin-left: 10px;
        }
        .btn {
            margin-bottom: 10px;
        }
        .search-form {
            margin-top: 80px;
            display: flex;
            justify-content: center;
        }
        .status-div-rong {
            margin: 20px auto;
            border: 5px inset coral;
            max-width: 70%;
            background-color: #ffffff;
            box-shadow: 0 5px 15px #111111;
            padding: 20px;
        }
        .back-btn {
            background-color: #4CAF50; /* Green background */
            color: white; /* White text */
            padding: 10px 20px;
            text-align: center;
            font-size: 16px;
            border: none;
            cursor: pointer;
            display: block;
            margin: 20px auto;
            border-radius: 5px;
        }
        .back-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="search-form">
        <form action="timkiem.php" method="GET" class="d-flex">
            <input type="text" placeholder="Nhập tên sân bóng muốn tìm" class="form-control me-2" name="timkiem"/>
            <button class="btn btn-danger" type="submit" name="search-kh">Tìm</button>
        </form>
    </div>

    <?php 
    if (isset($_GET['timkiem'])) {
        $timkiem = $_GET['timkiem'];
        if (empty($timkiem)) {
            echo '<script>
                alert("Vui lòng nhập thông tin tìm kiếm!");
                window.history.back();
            </script>';
        } else {
            include 'config.php';
            if (isset($_SESSION['user'])) {
                $username = $_SESSION['login_user'];
                $loggedIn = true;
            } else {
                $username = 'guest';
                $loggedIn = false;
            }
            
            $item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:4;
                $current_page = !empty($_GET['page'])?$_GET['page']:1; //Trang hiện tại
                $offset = ($current_page - 1) * $item_per_page;

            // Chỉ tìm kiếm theo tên sân bóng
            $products = mysqli_query($conn, "SELECT * FROM `sanbong` WHERE TenSan LIKE '%$timkiem%' ORDER BY `ID` ASC LIMIT $item_per_page OFFSET $offset");

            $totalRecords = mysqli_query($conn, "SELECT * FROM `sanbong` WHERE TenSan LIKE '%$timkiem%'");
            $totalRecords = $totalRecords->num_rows;
            $totalPages = ceil($totalRecords / $item_per_page);

            if ($products) {
                echo '<div class="container mt-4">';
                echo '<h2 class="text-center text-warning">Kết quả tìm kiếm</h2>';
                $num = mysqli_num_rows($products);
                if ($num > 0) {
                    echo '<div class="row justify-content-center">';
                    while ($row = mysqli_fetch_assoc($products)) {
                        echo '<div class="col-md-4">';
                        echo '<div class="box">';
                        echo '<form method="post" action="action.php">';
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row["AnhSan"]) . '" alt="San bong" class="img-fluid mb-3">';
                        echo '<input type="hidden" name="id" value="' . $row['ID'] . '">';
                        echo '<h2>' . $row['TenSan'] . '</h2>';
                        if ($loggedIn) {
                            echo '<button name="add-favorite" class="btn btn-outline-danger mb-2">❤️</button>';
                        }
                        echo '<c>Giá: ' . $row['Gia'] . 'đ</c><br>
                        <c>Loại sân: ' . $row['LoaiSan'] . '</c><br>';
  
                  // Kiểm tra trạng thái sân
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
                } else {
                    echo '<div class="status-div-rong text-center">
                        <p>Không có sân bóng nào được tìm thấy.</p>
                    </div>';
                }
            }
        }
    }
    include 'phantrang.php';
?>

    <!-- Back to Football Fields Button -->
    <a href="sanbong.php" class="btn btn-success mt-4 d-block w-25 mx-auto"> Quay lại danh sách sân bóng</a>
</body>
</html>
