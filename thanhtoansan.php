<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thông tin chuyển khoản</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #125c0b;
            background-image: url('img/background.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .transfer-container {
            margin: 50px auto;
            max-width: 600px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        .form-label {
            font-weight: bold;
        }
        .btn-submit {
            background-color: #125c0b;
            color: white;
            transition: transform 0.3s ease;
        }
        .btn-submit:hover {
            transform: scale(1.05);
        }
        .transfer-info {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="transfer-container">
        <h2 class="text-center">Thông tin chuyển khoản</h2>
        <p class="transfer-info">Vui lòng chuyển khoản theo thông tin sau để hoàn tất giao dịch:</p>
        <ul>
            <li><strong>Ngân hàng:</strong> Quân Đội MB BANK</li>
            <li><strong>Số tài khoản:</strong> 0328052922</li>
            <li><strong>Chủ tài khoản:</strong> Trần Nguyên Vũ</li>
            <li><strong>Nội dung:</strong> [Tên khách hàng] + [Sân số] + [Khung giờ chơi] + [Ngày]</li>
            <br>
            <li><strong>Ví dụ:</strong> <em style="color: red;">Trần Nguyên Vũ + Sân 5 + 17h-18h + Ngày 30/12</em></li>  
        </ul>
        <div class="btn-container">
        <a href="danhsachdatsan.php" class="btn btn-success mt-4 d-block w-25 mx-auto"> Quay lại</a>
            </div>
    </div>
</body>
</html>
