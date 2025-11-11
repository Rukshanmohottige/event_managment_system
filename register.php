<?php
include 'db_connect.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['name'], $_POST['email'], $_POST['password'])) {
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password']; 

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    
    $stmt->bind_param("sss", $name, $email, $password); 

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error: " . $stmt->error;
    }
    
    $stmt->close();
    
} else {
    echo "missing_fields";
}
$conn->close();
?>