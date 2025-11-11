<?php
session_start(); 
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    echo "not_logged_in";
    exit();
}

if (!isset($_POST['event_id'])) {
    echo "missing_event";
    exit();
}

$user_id = $_SESSION['user_id'];
$event_id = $_POST['event_id'];

$stmt_check = $conn->prepare("SELECT * FROM registrations WHERE user_id = ? AND event_id = ?");
$stmt_check->bind_param("ii", $user_id, $event_id); 
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
    // User is already registered
    echo "already_registered";
} else {
    // User is not registered, so insert them
    $stmt = $conn->prepare("INSERT INTO registrations (user_id, event_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $event_id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error: " . $stmt->error;
    }
    $stmt->close();
}
$stmt_check->close();
$conn->close();
?>