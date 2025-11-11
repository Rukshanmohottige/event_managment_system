<?php
session_start(); 
include 'db_connect.php';

if (isset($_POST['email'], $_POST['password'])) {
    
    $email = $_POST['email'];
    $password_from_user = $_POST['password']; 

    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $password_from_db = $row['password']; 
  
        if ($password_from_user === $password_from_db) {
            
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['name'] = $row['name'];

            echo "success";
        } else {
            echo "invalid";
        }
    } else {
        echo "notfound";
    }
    $stmt->close();
} else {
    echo "missing_fields";
}
$conn->close();
?>