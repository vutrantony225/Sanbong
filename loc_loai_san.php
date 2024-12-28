<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sân bóng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #125c0b;
            background-image: url('img/background.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .action-bar {
            margin: 10px auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 10%; /* Thu hẹp chiều rộng */
            max-width: 1200px; /* Đặt chiều rộng tối đa */
            padding: 10px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        .filter-form {
            display: flex;
            align-items: center;
        }
        .filter-btn {
            width: 150px;
        }
        .sanbong-div {
            margin-top: 20px;
            margin-left: 50px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
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
            border-radius: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .box:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }
        .box img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        .box h2 {
            display: inline-block;
            vertical-align: middle;
            margin-left: 10px;
        }
        .box c {
            display: inline-block;
            vertical-align: middle;
            color: green;
        }
    </style>
</head>
<body>
<?php
include 'config.php';
include 'header.php';
?>
 <div class="action-bar">
        <!-- Lọc sân -->
        <form class="filter-form" method="GET" action="loc_loai_san.php">
            <select class="form-select filter-btn" name="loai_san" onchange="this.form.submit()">
                <option value="5" <?= isset($_GET['loai_san']) && $_GET['loai_san'] == '5' ? 'selected' : '' ?>>Sân 5 người</option>
                <option value="7" <?= isset($_GET['loai_san']) && $_GET['loai_san'] == '7' ? 'selected' : '' ?>>Sân 7 người</option>
                <option value="11" <?= isset($_GET['loai_san']) && $_GET['loai_san'] == '11' ? 'selected' : '' ?>>Sân 11 người</option>
            </select>
        </form>
    </div>
 <?php       
// Kiểm tra trạng thái đăng nhập
if (isset($_SESSION['user'])) {
    $username = $_SESSION['login_user'];
    $loggedIn = true;
} else {
    $username = 'guest';
    $loggedIn = false;
}

// Phân trang
$item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 4;
$current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
$offset = ($current_page - 1) * $item_per_page;

// Lấy loại sân từ URL
$loai_san = !empty($_GET['loai_san']) ? $_GET['loai_san'] : '';

// Xây dựng điều kiện lọc loại sân
$where_clause = "";
if (!empty($loai_san)) {
    $where_clause = "WHERE LoaiSan = '$loai_san'";
}

// Truy vấn dữ liệu sân bóng
$products_query = "SELECT * FROM `sanbong` $where_clause ORDER BY `ID` ASC LIMIT $item_per_page OFFSET $offset";
$products = mysqli_query($conn, $products_query);

$totalRecords_query = "SELECT * FROM `sanbong` $where_clause";
$totalRecords = mysqli_query($conn, $totalRecords_query);
$totalRecords = $totalRecords->num_rows;
$totalPages = ceil($totalRecords / $item_per_page);

// Hiển thị dữ liệu sân bóng
if (mysqli_num_rows($products) == 0) {
    echo '<p>Không có sân bóng nào được tìm thấy.</p>';
} else {
    echo '<div class="sanbong-div">';
    while ($row = mysqli_fetch_assoc($products)) {
        echo '<div class="box">
            <form method="post" action="action.php">
                <img width="100" height="50" src="data:image/jpeg;base64,'.base64_encode($row["AnhSan"]).'">
                <input type="hidden" name="id" value="'.$row['ID'].'">
                <input type="hidden" name="price" value="'.$row['Gia'].'">
                <h2>' . $row['TenSan'] . '</h2>';
        if ($loggedIn) {
            echo '<input class="favorite-button" type="button" value="❤️" onclick="confirmAddlike('.$row['ID'].')">';
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
}
?>
</body>
</html>
