<?php
header('Content-Type: application/json');

include_once('conexao.php');

function getImagePath($status) {
    switch ($status) {
        case 'running':
            return 'images/running.png';
        case 'stopped':
            return 'images/stopped.png';
        case 'maintenance':
            return 'images/maintenance.png';
        case 'inactive':
            return 'images/inactive.png';
        case 'overload':
            return 'images/overload.png';
        default:
            return 'images/unknown.png';
    }
}

$sql = "SELECT * FROM machines";
$result = $conn->query($sql);

$machines = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $row['image_path'] = getImagePath($row['status']);
        $machines[] = $row;
    }
}

$conn->close();

echo json_encode($machines);
?>