<?php
include 'config.php';
$email = $_SESSION['email'];

if (isset($_POST['submit-tt'])) {
    $ten = mysqli_real_escape_string($conn, $_POST['ten']);
    $sdt = mysqli_real_escape_string($conn, $_POST['sdt']);

    if (!preg_match('/^\d{10}$/', $sdt)) {
        echo "<script>alert('Số điện thoại không hợp lệ. Vui lòng nhập 10 chữ số!');window.history.back();</script>";
        exit;
    }
    // Cập nhật thông tin người dùng vào bảng `khachhang`
    $sql = "UPDATE khachhang
            SET TenKH = '$ten', SoDT = '$sdt'
            WHERE Email = '$email'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>alert('Cập nhật thông tin thành công!');window.history.back();</script>";
    } else {
        echo "<script>alert('Cập nhật thông tin thất bại!');window.history.back();</script>";
    }
}

if(isset($_POST['submit-pass'])) {
    header('location: doimk.php');
}

mysqli_close($conn);
?>

 <!-- done --> 