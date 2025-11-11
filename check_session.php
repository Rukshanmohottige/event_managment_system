<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION['user_id']) && isset($_SESSION['name'])) {
    // User is logged in
    echo json_encode([
        'loggedIn' => true,
        'name' => $_SESSION['name'],
        'user_id' => $_SESSION['user_id']
    ]);
} else {
    // User is not logged in
    echo json_encode(['loggedIn' => false]);
}
?>