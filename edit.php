<?php
include_once("db.php");

$firstName = mysqli_real_escape_string($conn, strip_tags(trim($_POST['fname'])));
$lastName = mysqli_real_escape_string($conn, strip_tags(trim($_POST['lname'])));
$email = mysqli_real_escape_string($conn, strip_tags(trim($_POST['email'])));
$id = mysqli_real_escape_string($conn, strip_tags(trim($_POST['id'])));
if(is_numeric($id)) {
    
    $sql = "UPDATE customers SET first_name = ?,
        last_name = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $firstName, $lastName, $email, $id);

    if($stmt->execute()) {
        echo "ok";
    } else {
        echo "fail";
    }
}