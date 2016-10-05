$(document).ready(function() {
    // SEARCH
    $('#search').keyup(function() {
        var search = $("#search").val();
        $.ajax({ 
            url: "search.php",
            type: "GET",
            data: {search:search},
            success: function(data) {
                //console.log(data);
                $('#customers').html(data);
            }
        });
    });
    $("#alertBox").hide();
    $('.closeAlert').click(function() {
        $('#alertBox').hide();  
    });
});
window.onload = listAll;

// LIST ALL CUSTOMERS
function listAll() {
    var xmlhttp = new XMLHttpRequest();
    
    xmlhttp.onreadystatechange = function() {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('customers').innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", 'listAll.php', true);
    xmlhttp.send();
}

// ADD A NEW CUSTOMER
function addCustomer() {
    var xmlhttp = new XMLHttpRequest();
    var firstName = document.getElementById('firstName').value; 
    var lastName = document.getElementById('lastName').value;
    var email = document.getElementById('email').value;
    var addForm = document.getElementById('addForm');
    var msg = document.getElementById('msg');
    
    xmlhttp.onreadystatechange = function() {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var res = xmlhttp.responseText;
            console.log(res);
            if(res == "ok") {
                $("#alertBox").removeClass("alert-danger").addClass("alert-success").show();
                msg.innerHTML = "Customer added succesfully!";
                listAll();
            } else {
                $("#alertBox").removeClass("alert-success").addClass("alert-danger").show();
                msg.innerHTML = "Customer not added!";
            }
        }
    }
    
    xmlhttp.open("GET", 'add.php?addCustomer=ok&fname=' + firstName +
                        '&lname=' + lastName + '&email=' +email , true); 
    xmlhttp.send();
    addForm.reset();
    $("#addCustomer").modal('hide');
    
    return false;
}

// DELETE A CUSTOMER
function deleteCustomer(id) {
    var xmlhttp = new XMLHttpRequest();
    //console.log("Delete customer: " + id);
    xmlhttp.onreadystatechange = function() {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var res = xmlhttp.responseText;
            console.log(res);
            if(res == "ok") {
                $("#alertBox").removeClass("alert-danger").addClass("alert-success").show();
                msg.innerHTML = "Customer deleted succesfully!";
                listAll();
            } else {
                $("#alertBox").removeClass("alert-success").addClass("alert-danger").show();
                msg.innerHTML = "Customer not deleted!";
            }     
        }
    }
    xmlhttp.open("GET", "delete.php?id=" +id, true);
    xmlhttp.send();
}

// EDIT A CUSTOMER
function editCustomer(id) {
    var xmlhttp = new XMLHttpRequest();
    var firstName = document.getElementById('edit_firstName' +id).value; 
    var lastName = document.getElementById('edit_lastName' + id).value;
    var email = document.getElementById('edit_email' + id).value;
    var addForm = document.getElementById('editForm');
    var msg = document.getElementById('msg');
    
    xmlhttp.onreadystatechange = function() {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var res = xmlhttp.responseText;
            console.log(res);
            if(res == "ok") {
                $("#alertBox").removeClass("alert-danger").addClass("alert-success").show();
                msg.innerHTML = "Customer updated succesfully!";
                listAll();
            } else {
                $("#alertBox").removeClass("alert-success").addClass("alert-danger").show();
                msg.innerHTML = "Customer not updated!";
            }        
        }
    }
    
    xmlhttp.open("POST", "edit.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("fname=" + firstName + "&lname=" + lastName + "&email=" + email + "&id=" + id);
    
    $('#editCustomer' + id).modal('hide');
    return false;
}