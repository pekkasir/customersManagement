<?php
include_once("db.php");

if(isset($_GET['id'])) {
    $sql = "DELETE FROM customers WHERE id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $_GET['id']);
    if($stmt->execute()) {
        echo "ok";
    } else {
        echo "fail";
    }
    $stmt->close();
}

