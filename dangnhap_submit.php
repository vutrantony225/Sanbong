<?php
// Kết nối đến cơ sở dữ liệu
include 'config.php';

if (isset($_POST['submit'])) {
    // Lấy dữ liệu từ form đăng nhập và tránh SQL Injection
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    
    // Truy vấn lấy thông tin tài khoản dựa trên tên đăng nhập
    $sql = "SELECT * FROM taikhoan WHERE TenTK = '$username'";
    $result = mysqli_query($conn, $sql);

    // Kiểm tra nếu tài khoản tồn tại
    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        
        // So sánh mật khẩu nhập vào với mật khẩu trong cơ sở dữ liệu
        if ($password == $data['MatKhau']) {
            // Lưu thông tin vào session
            $_SESSION['id'] = $data['ID'];
            $_SESSION['user'] = $data;
            $_SESSION['login_user'] = $username;
            $_SESSION['email'] = $data['Email'];
            $_SESSION['quyen'] = $data['Quyen'];
            
            // Kiểm tra quyền và chuyển hướng
            if ($data['Quyen'] == 0) {
                // Quyền là 0: chuyển hướng đến sanbong.php
                header('Location: sanbong.php');
                exit();
            } elseif ($data['Quyen'] == 1) {
                // Quyền là 1: chuyển hướng đến home.php
                header('Location: trangchu.php');
                exit();
            }
        } else {
            // Sai mật khẩu
            echo "<script>
                alert('Sai mật khẩu!');
                window.history.back();
            </script>";
        }
    } else {
        // Tên đăng nhập không tồn tại
        echo "<script>
            alert('Tên đăng nhập không tồn tại!');
            window.history.back();
        </script>";
    }
    mysqli_close($conn);
}
?>
