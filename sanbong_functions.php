<?php
function deleteSanBong(mysqli $conn, int $id): bool
{
    $sql = "DELETE FROM sanbong WHERE ID = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        return false; // Chuẩn bị câu lệnh thất bại
    }

    $stmt->bind_param("i", $id);
    return $stmt->execute();
}
?>
