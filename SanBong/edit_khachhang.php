<?php
    include 'config.php';
    include 'header_admin.php';

    // Xử lý nút "Sửa"
    if(isset($_POST['suakh'])) {
        $id = key($_POST['suakh']);
        header("Location: sua_khachhang.php?id=" . $id);
        exit;
    }

    // Xử lý nút "Xóa"
   
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM khachhang WHERE MaKH = $id";

        if (mysqli_query($conn, $sql)) {
            echo "<script>
                    alert('Khách hàng đã được xóa!');
                    window.location.href='khachhang_admin.php';
                </script>";
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    } else {
        echo "Thiếu tham số ID.";
    }   
    
    // Xử lý nút "Thêm mới"
    if(isset($_POST['themmoi'])) {
        header("Location: them_khachhang.php");
        exit;
    }
?>
