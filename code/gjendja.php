<?php
include 'db.php';

$sql = "SELECT * FROM bins";
$result = $conn->query($sql);

$bins = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $bins[] = $row;
    }
}

echo json_encode($bins);
?>
