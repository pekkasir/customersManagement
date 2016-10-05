<?php
include_once("db.php");

$sql = "SELECT * FROM customers";

$result = $conn->query($sql);

if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "
            <tr>
                <td>$row[id]</td>
                <td>$row[first_name]</td>
                <td>$row[last_name]</td>
                <td>$row[email]</td>
                <td>
                
                    <button class='btn btn-success btn-sm' id='$row[id]'
                    data-toggle='modal' data-target='#editCustomer$row[id]'>Edit</button>
                    
                    <button class='btn btn-danger btn-sm' id='$row[id]' 
                    onclick=deleteCustomer($row[id]);>Delete</button>
                    
                     
                    <div class='modal' id='editCustomer$row[id]'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <button class='close' data-dismiss='modal'>x</button><h3>Edit Customer</h3>
                                </div>
                                <div class='modal-body'>
                                    <form id='editForm' onsubmit='return editCustomer($row[id])'>
                                        <div class='form-group'>
                                            <label for='edit_firstName'>First Name:</label>
                                            <input type='text'' id='edit_firstName$row[id]' name='edit_firstName' class='form-control' value='$row[first_name]'>
                                        </div>
                                        <div class='form-group'>
                                            <label for='edit_lastName'>Last Name:</label>
                                            <input type='text' id='edit_lastName$row[id]' name='edit_lastName' class='form-control' value='$row[last_name]'>
                                        </div>
                                        <div class='form-group'>
                                            <label for='edit_email'>Email:</label>
                                            <input type='text' id='edit_email$row[id]' name='edit_email' class='form-control' value='$row[email]'>
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
}

