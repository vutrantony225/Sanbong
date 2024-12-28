<?php
// Kết nối với cơ sở dữ liệu
include 'config.php';

if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $sdt = $_POST['sdt'];
    $password = $_POST['password'];
    $rpassword = $_POST['rpassword'];

    // Kiểm tra tài khoản hoặc email đã tồn tại
    $check = "SELECT * FROM taikhoan WHERE Email = '$email' OR TenTK = '$username'";
    $result_check = mysqli_query($conn, $check);

    if (mysqli_num_rows($result_check) > 0) {
        echo "<script>
                alert('Email hoặc tên đăng nhập đã tồn tại!');
                window.history.back();
              </script>";
    } else {
        if ($password === $rpassword) {

            // Bắt đầu giao dịch
            mysqli_begin_transaction($conn);

            try {
                // Thêm tài khoản vào bảng `taikhoan`
                $sql_tk = "INSERT INTO taikhoan (TenTK, MatKhau, Email, Quyen) VALUES ('$username', '$password', '$email', 0)";
                $query_tk = mysqli_query($conn, $sql_tk);

                // Lấy ID vừa thêm vào bảng `taikhoan`
                $taikhoan_id = mysqli_insert_id($conn);

                // Thêm thông tin khách hàng vào bảng `khachhang`
                $sql_kh = "INSERT INTO khachhang (MaKH, TenKH, Email, SoDT) VALUES ('$taikhoan_id', '$fullname', '$email', '$sdt')";
                $query_kh = mysqli_query($conn, $sql_kh);

                // Kiểm tra cả hai truy vấn
                if ($query_tk && $query_kh) {
                    // Hoàn thành giao dịch
                    mysqli_commit($conn);
                    echo "<script>
                            alert('Đăng ký thành công!');
                            window.location.href = 'dangnhap.php';
                          </script>";
                } else {
                    throw new Exception("Lỗi khi thêm tài khoản hoặc khách hàng.");
                }
            } catch (Exception $e) {
                // Hủy giao dịch nếu có lỗi
                mysqli_rollback($conn);
                echo "<script>
                        alert('Lỗi đăng ký: " . $e->getMessage() . "');
                        window.history.back();
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Mật khẩu nhập lại không đúng!');
                    window.history.back();
                  </script>";
        }
    }

    // Đóng kết nối
    mysqli_close($conn);
}
?>
