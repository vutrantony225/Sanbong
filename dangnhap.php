<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #125c0b;
            font-family: 'Poppins', sans-serif;
        }
        .login {
            background-color: #f1f1f1;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
            margin: 100px auto;
        }
        h1 {
            color: #003300;
        }
        .reg, .forgot-pass {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #003300;
            text-decoration: none;
        }
        .reg:hover, .forgot-pass:hover {
            text-decoration: underline;
        }
        .btn-custom {
            width: 100%;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login">
            <h1 class="text-center">Đăng Nhập</h1>
            <form action="dangnhap_submit.php" method="post">
                <div class="mb-3">
                    <label class="form-label" for="username">Tên đăng nhập</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password">Mật khẩu</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <button type="submit" name="submit" class="btn btn-success btn-custom">Đăng nhập</button>
                <a href="forgot_password.php" class="forgot-pass">Quên mật khẩu?</a>
                <a href="dangky.php" class="reg">Chưa có tài khoản? Đăng ký</a>
                <a href="sanbong.php" class="reg">Thoát</a>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
