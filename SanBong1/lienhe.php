<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên hệ với chúng tôi</title>
    <!-- Thêm thư viện Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
         body {
            background-color: #125c0b;
            background-image: url('img/background.jpg'); /* Đặt đường dẫn ảnh nền tại đây */
            background-size: cover; /* Bao phủ toàn bộ trang */
            background-position: center; /* Căn giữa ảnh */
            background-attachment: fixed; /* Ảnh cố định khi cuộn trang */
        }
        .contact-img {
            width: 75%; /* Điều chỉnh kích thước ảnh */
            max-width: 600px; /* Giới hạn tối đa */
            margin: 30px auto; /* Căn giữa ảnh */
            display: block;
        }
        .contact-div {
            margin: 30px auto;
            max-width: 800px;
            position: relative;
        }
        .contact-text {
            color: white;
            background-color: rgba(0, 0, 0, 0.6); /* Làm mờ nền chữ */
            padding: 20px;
            border-radius: 10px;
            margin-top: -250px; /* Điều chỉnh vị trí */
        }
        h1 {
            color: yellow;
        }
        .contact-link {
            color: #F7941D;
        }
    </style>
</head>
<body>
    <?php include('header.php'); ?>
    
    <div class="container contact-div text-center">
        <img src="img/nenlienhe.jpg" class="contact-img img-fluid rounded">
        <div class="contact-text">
            <h1>Liên hệ với chúng tôi</h1>
            <p>
                Địa chỉ: Số nhà 541 An Dương Vương, Phường Nguyễn Văn Cừ, Thành phố Quy Nhơn, tỉnh Bình Định, Việt Nam<br>
                Phone: 0328052922<br>
                Email: <a class="contact-link" href="mailto:nguyenvu22503@gmail.com">qnuteam@gmail.com.vn</a>
            </p>
            <a href="sanbong.php" class="btn btn-danger btn-back">Quay lại trang Sân bóng</a>
        </div>
    </div>

    <!-- Thêm thư viện JavaScript Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
