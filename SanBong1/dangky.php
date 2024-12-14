<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Tài Khoản</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #125c0b;
        }
        .signup-div {
            padding: 20px;
            border: 5px inset coral;
            background-color: #ffffff;
            box-shadow: 0 5px 15px #111111;
            border-radius: 8px;
        }
        .form-label {
            font-size: 16px;
        }
        h1 {
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-custom {
            width: 100%; /* Cân đối giữa hai nút */
            margin-top: 10px;
        }
        .btn-full {
            width: 100%;
            margin-top: 10px;
        }

        @media (max-width: 767px) {
            .signup-div {
                max-width: 100%;
                padding: 15px;
            }
            .container {
                margin-top: 20px;
            }
            .btn-custom {
                width: 100%; /* Nút chiếm toàn bộ chiều rộng trên màn hình nhỏ */
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5 d-flex justify-content-center">
        <div class="signup-div col-12 col-md-8 col-lg-5 rounded">
            <h1>ĐĂNG KÝ TÀI KHOẢN</h1>
            <form action="dangky_submit.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Họ và Tên:</label>
                    <input type="text" class="form-control" name="fullname" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tên tài khoản:</label>
                    <input type="text" class="form-control" name="username" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Số điện thoại:</label>
                    <input type="text" class="form-control" name="sdt" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Mật khẩu:</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nhập lại mật khẩu:</label>
                    <input type="password" class="form-control" name="rpassword" required>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success btn-custom" name="submit">Đăng ký</button>
                    
                </div>
                <div class="text-center mt-3">
                    <a href="dangnhap.php" class="btn btn-secondary btn-full">Đã có tài khoản? Đăng nhập</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
