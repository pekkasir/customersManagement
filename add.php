<?php
include_once('db.php');

if(isset($_GET['addCustomer'])) {
    if(!empty($_GET['fname']) && !empty($_GET['lname']) && !empty($_GET['email'])) {
        $firstName = $_GET['fname'];
        $lastName = $_GET['lname'];
        $email = $_GET['email'];
        $sql = "INSERT INTO customers(first_name, last_name, email)
                VALUES(?,?,?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $firstName, $lastName, $email);
        if($stmt->execute()) {
            echo "ok";
        } else {
            echo "fail";
        }
        $stmt->close();      
    }
}