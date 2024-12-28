<?php

interface DatabaseInterface
{
    public function prepare($query);
}

class Database implements DatabaseInterface
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function prepare($query)
    {
        return $this->connection->prepare($query);
    }
}

function deleteCustomer(DatabaseInterface $db, $id)
{
    $sql = "DELETE FROM khachhang WHERE MaKH = ?";
    $stmt = $db->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param("i", $id);

    return $stmt->execute();
}
?>
