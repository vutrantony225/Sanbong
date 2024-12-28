<?php
    include 'config.php';
    include 'header_admin.php';

    // Xử lý nút "Sửa"
    if(isset($_POST['suatt'])) {
        $id = key($_POST['suatt']);
        header("Location: chinhtrangthai.php?id=" . $id);
        exit;
    }

    
?>
