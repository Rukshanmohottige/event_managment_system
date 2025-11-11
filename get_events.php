<?php
include 'db_connect.php';

$sql = "SELECT id, title, event_date, place FROM events ORDER BY event_date";
$result = $conn->query($sql);

$events = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}

header('Content-Type: application/json');

echo json_encode($events);

$conn->close();
?>