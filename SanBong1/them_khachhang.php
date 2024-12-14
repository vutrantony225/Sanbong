<!DOCTYPE>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thêm Khách Hàng</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
		body {
			font-family: 'Poppins', sans-serif;
			background: #125c0b;
		}
		.add {
			margin-top: 20px!important;
			width: 500px;
			background: #f1f1f1;
			margin: 100px auto;
			padding: 20px 30px;
			border-radius: 5px;
			box-shadow: 0px 0px 5px 0px hsl(128, 80%, 49%);
		}
		.add h1 {
			text-align: center;
			margin-bottom: 30px;
			color: #1ae034;
		}
		.add form {
			display: flex;
			flex-direction: column;
		}
		.add form label {
			font-weight: bold;
			font-size: 16px;
			color: #555;
			margin-bottom: 10px;
			display: flex;
			align-items: center;
		}

		.add form input[type="text"], .add form input[type="password"], .add form input[type="file"] {
			padding: 10px;
			margin-bottom: 20px;
			border-radius: 5px;
			border: none;
			background: #f9f9f9;
		}
		.add form input[type="submit"] {
			background: #125c0b;
			color: #fff;
			border: none;
			border-radius: 5px;
			padding: 10px;
			font-size: 18px;
			cursor: pointer;
		}
	</style>
</head>
<body>
    <?php
    include 'config.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $sdt = $_POST['sdt'];
        $username = $_POST['username'];
        $password = $_POST['password'];
		$rpassword = $_POST['rpassword'];

		// Kiểm tra tài khoản hoặc email đã tồn tại
		$check = "SELECT * FROM taikhoan WHERE Email = '$email' OR TenTk = '$username'";
		$result_check = mysqli_query($conn, $check);

		if (mysqli_num_rows($result_check) > 0) {
			echo "<script>
					alert('Email hoặc tên đăng nhập đã tồn tại!');
					window.history.back();
					</script>";
		} else if ($password === $rpassword) {

			// Thêm tài khoản vào bảng `taikhoan`
			$sql = "INSERT INTO taikhoan (TenTK, MatKhau, Email, Quyen) VALUES ('$username', '$password', '$email', 0)";
			$query = mysqli_query($conn, $sql);

			// Thêm khách hàng vào bảng `khachhang`
			$sql1 = "INSERT INTO khachhang (TenKH, Email, SoDT) VALUES ('$fullname', '$email', '$sdt')";
			$result = mysqli_query($conn, $sql1);

			if ($query && $result) {
				echo "<script>
					alert('Thêm khách hàng thành công!');
					window.location.href='khachhang_admin.php';
				</script>";
			} else {
				echo "Lỗi: " . mysqli_error($conn);
			}
		} else {
			echo "<script>
				alert('Mật khẩu nhập lại không đúng!');
				window.history.back();
			</script>";
		}
    }
    ?>

    <div class="add">
        <h1>Nhập thông tin khách hàng</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
			<label for="fullname">Tên Khách Hàng:</label>
			<input type="text" name="fullname" id="fullname" required>

			<label for="username">Tài Khoản:</label>
			<input type="text" name="username" id="username" required>

			<label for="password">Mật Khẩu:</label>
			<input type="password" name="password" id="password" required>

			<label for="rpassword">Nhập lại mật khẩu:</label>
			<input type="password" name="rpassword" id="rpassword" required>

			<label for="email">Email:</label>
			<input type="text" name="email" id="email" required>

			<label for="sdt">Số Điện Thoại:</label>
			<input type="text" name="sdt" id="sdt" required>

			<br><input type="submit" value="Thêm">
        </form>
    </div>
</body>
</html>
