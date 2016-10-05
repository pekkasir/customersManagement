<?php
include_once("db.php");

if(isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, strip_tags(trim($_GET['search'])));
    $search = $search . "%";
    $sql = "SELECT id, first_name, last_name, email FROM customers WHERE first_name LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $search);
    $stmt->bind_result($id, $fname, $lname, $email);
    if($stmt->execute()) {
        while($row = $stmt->fetch()) {
            echo "
            <tr>
                <td>$id</td>
                <td>$fname</td>
                <td>$lname</td>
                <td>$email</td>
                <td>
                
                    <button class='btn btn-success btn-sm' id='$id'
                    data-toggle='modal' data-target='#editCustomer$id'>Edit</button>
                    
                    <button class='btn btn-danger btn-sm' id='$id' 
                    onclick=deleteCustomer($id);>Delete</button>
                    
                     
                    <div class='modal' id='editCustomer$id'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <button class='close' data-dismiss='modal'>x</button><h3>Edit Customer</h3>
                                </div>
                                <div class='modal-body'>
                                    <form id='editForm' onsubmit='return editCustomer($id)'>
                                        <div class='form-group'>
                                            <label for='edit_firstName'>First Name:</label>
                                            <input type='text'' id='edit_firstName$id' name='edit_firstName' class='form-control' value='$fname'>
                                        </div>
                                        <div class='form-group'>
                                            <label for='edit_lastName'>Last Name:</label>
                                            <input type='text' id='edit_lastName$id' name='edit_lastName' class='form-control' value='$lname'>
                                        </div>
                                        <div class='form-group'>
                                            <label for='edit_email'>Email:</label>
                                            <input type='text' id='edit_email$id' name='edit_email' class='form-control' value='$email'>
                                        </div>
                                        <div class='form-group'>
                                            <button class='btn btn-primary pull-right btn-md' name='edit'>Save</button><br>   
                                        </div> 
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </td>
            </tr>
        ";   
        }
    } else {
        echo "None found!";
    }
}