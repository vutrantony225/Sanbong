<?php
    include 'config.php';
    include 'header_admin.php';

    // Xử lý nút "Sửa"
    if(isset($_POST['suasb'])) {
        $id = key($_POST['suasb']);
        header("Location: sua_san.php?id=" . $id);
        exit;
    }

    // Xử lý nút "Xóa"
   
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM sanbong WHERE ID = $id";

        if (mysqli_query($conn, $sql)) {
            echo "<script>
                    alert('Sân bóng đã được xóa!');
                    window.location.href='sanbong_admin.php';
                </script>";
        } else {
            echo "Lỗi: " . mysqli_error($conn);
        }
    } else {
        echo "Thiếu tham số ID.";
    }
    
    // Xử lý nút "Thêm mới"
    if(isset($_POST['themmoi'])) {
        header("Location: them_sanbong.php");
        exit;
    }
?>
