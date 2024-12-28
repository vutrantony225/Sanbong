<?php
function filterSanBong(mysqli $conn, $loaiSan = '', $itemPerPage = 4, $currentPage = 1) {
    $offset = ($currentPage - 1) * $itemPerPage;

    // Xây dựng điều kiện lọc loại sân
    $whereClause = "";
    if (!empty($loaiSan)) {
        $whereClause = "WHERE LoaiSan = '$loaiSan'";
    }

    // Truy vấn dữ liệu sân bóng
    $query = "SELECT * FROM `sanbong` $whereClause ORDER BY `ID` ASC LIMIT $itemPerPage OFFSET $offset";
    $result = mysqli_query($conn, $query);

    return $result;
}
