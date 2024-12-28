<?php
    include 'config.php';

    if (isset($_SESSION['login_user'])) {
        $username = $_SESSION['login_user'];

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $checkQuery = "SELECT * FROM sanyeuthich WHERE IDSan = '$id' AND TenTK = '$username'";
            $checkResult = mysqli_query($conn, $checkQuery);

            if (mysqli_num_rows($checkResult) > 0) {
                echo "<script>
                        alert('Sân bóng đã có trong danh sách yêu thích!');
                        window.location.href='sanbong.php';
                    </script>";
            } else {
                $insertQuery = "INSERT INTO sanyeuthich (IDSan, TenTK) VALUES ('$id' ,'$username')";

                if (mysqli_query($conn, $insertQuery)) {
                    echo "<script>
                            alert('Đã thêm vào danh sách yêu thích!');
                            window.location.href='sanbong.php';
                        </script>";
                } else {
                    echo "Lỗi: " . mysqli_error($conn);
                }
            }
        } else {
            echo "Thiếu tham số ID.";
        }
    }
?>