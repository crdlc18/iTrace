
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Information</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://unpkg.com/htmlincludejs"></script>
</head>
<?php 
   require("db_con/connection.php");
    if (!isset($_SESSION['CurrAdminName'])) {
    header("location: adminLogIn.html");
   }
?>


<body>

    <div class="dashCon">
        <div class="row">

            <!---navigation-->
            <div class="col">
                  <div  id="nav">
                    <include src="assets/nav.html"></include>
                  </div>
            </div>

            <!---Admin Info Panel-->
            <div class="col">

                <div class="row">
                    <form method='post' action=''>
                        <h5>Update Your Account Information</h5><br>
                        <label>Admin Name: </label><br>
                        <input type="text" id="adminName"><br>
                        <label>Admin E-mail: </label><br>
                        <input type="text" id="adminEmail"><br>
                        <label>Admin Contact Number: </label><br>
                        <input type="text" id="adminContactNo"><br>

                        <h6>---------Password Settings-----------</h6><br>
                        <label>Current Password: </label><br>
                        <input type="password" id="currPass"><br>
                        <label>New Password: </label><br>
                        <input type="password" id="newPass"><br>
                        <label>Confirm Password: </label><br>
                        <input type="password" id="conPass"><br>
                    </form>

                    <div>
                        <button id="saveChangesBtn"> Save Changes </button>
                        <button id="cancelChangesBtn"> Cancel </button>
                    </div>
                </div>


                <div class="row">
                    <h5>---------------OR-------------------</h5>
                    <button id="addAdminBtn">Add another Admin</button>
                </div>
            </div>
        </div>
    </div>
</body>

    <!--Modals-->
    <include src = "assets/warningModal.html"></include>
    <include src = "assets/adminConfirmModal.html"></include>
    <include src = "assets/addAdminForm.html"></include>

</html>

<script>

    var currentPass='';
    var newName='';
    var newEmail='';
    var currPass='';
    var newPass='';
    var conPass='';
    var newNumber='';

    // load information of the current logged admin
    $(document).ready(function(){
        jQuery.ajax({
            url: "navAdmin-config.php", 
            data: {getAdminData:1},
            type: 'POST',
            dataType:"json",
            success:function(data){
                currentPass=data[0].currPass;
                $('#adminName').val(data[0].name);
                $('#adminEmail').val(data[0].uMail);
                $('#adminContactNo').val(data[0].adminNo);
            } 
        });
    });
  
    
    // update information of the current logged admin 
    $("#saveChangesBtn").on('click', function(){
        newName=$('#adminName').val();
        newEmail=$('#adminEmail').val();
        currPass=$('#currPass').val();
        newPass=$('#newPass').val();
        conPass=$('#conPass').val();
        newNumber= $('#adminContactNo').val();
       
       if(!newName){
            $('#modal .modal-title').html("..Oooppss");
            $('#modal .modal-body').html("Name cannot be blank.");
            $('#modal').modal('show');
       }
       else if(!newEmail){
            $('#modal .modal-title').html("..Oooppss");
            $('#modal .modal-body').html("E-mail uAddress cannot be blank.");
            $('#modal').modal('show');
       }
       else if(!newNumber){
            $('#modal .modal-title').html("..Oooppss");
            $('#modal .modal-body').html("Please provide your contact number");
            $('#modal').modal('show');
       }
       else if(!currPass && (newPass.length>0||conPass.length>0)){
            $('#modal .modal-title').html("INCOMPLETE DATA!");
            $('#modal .modal-body').html("Please complete the information for changing password.");
            $('#modal').modal('show');
       }
       else if(currPass.length>0 && (!newPass||!conPass)){
            $('#modal .modal-title').html("INCOMPLETE DATA!");
            $('#modal .modal-body').html("Please complete the information for changing password.");
            $('#modal').modal('show');
       }
       else if(currPass.length>0 && newPass.length>0 && conPass.length>0){
                if (currPass!=currentPass){
                    $('#modal .modal-title').html("..Oooppss");
                    $('#modal .modal-body').html("Wrong current password.");
                    $('#modal').modal('show');
                }
                else if (newPass!=conPass){
                    $('#modal .modal-title').html("..Oooppss");
                    $('#modal .modal-body').html("New password and confirm password do not match.");
                    $('#modal').modal('show');
                }
                else{
                   saveChanges();
                }
       }
       else{
                saveChanges();
       }
    });

    // function for saving the valid updated admin information
    function saveChanges(){
        
        $.ajax({
            url: "navAdmin-config.php", 
            data:{saveChanges:1, newName:newName, newEmail:newEmail, newPass:newPass, newNumber:newNumber},
            type: "post",
            success:function(data){
                console.log(data);
                if(data==='registeredEm'){
                    $('#modal .modal-title').html("..Oopps");
                    $('#modal .modal-body').html("Email address is already registered.");  
                    $('#modal').modal('show');
                }
                else if(data==='registeredNum'){
                    $('#modal .modal-title').html("..Oopps");
                    $('#modal .modal-body').html("Contact number is already registered.");  
                    $('#modal').modal('show');
                }
                else if(data==='success'){
                    $('#modal .modal-title').html("Success!");
                    $('#modal .modal-body').html("Your Account has been updated.");  
                    $('#modal').modal('show');
                }
                
            } 
        });
    }


    // show modal for adding new admin
    $("#addAdminBtn").on('click', function(){
        $('#addAdminForm').modal('show');
    });

    //function for adding new admin
    function addAdmin(){
        var adminFname = $('#adFname').val();
        var adminMname = $('#adMname').val();
        var adminLname = $('#adLname').val();
        var adminName = adminFname + "  " + adminMname+ "  "+ adminLname;
        var adminPass= $('#adPass').val();
        var adminEmail=$('#adEmail').val();
        var adminContactNo=$('#adContactNo').val();
        var stringCheck = /^[A-Za-z\s]*$/;
        var numCheck = /^[0-9]+$/; 

        if (!adminFname||!adminMname||!adminLname||!adminPass||!adminEmail||!adminContactNo){
            $('#modal .modal-title').html("..Oooppss");
            $('#modal .modal-body').html("Information must be completed.");
            $('#modal').modal('show');
        }
        else{

            if(!stringCheck.test(adminFname)|| !stringCheck.test(adminLname) ||!stringCheck.test(adminMname)){
                
                $('#modal .modal-title').html("..Oooppss");
                $('#modal .modal-body').html("Name must only contain alphabet characters");
                $('#modal').modal('show');
            }
            else if(!numCheck.test(adminContactNo)|| !adminContactNo.length==9){
                $('#modal .modal-title').html("..Oooppss");
                $('#modal .modal-body').html("Contact number should only contain 10 digits");
                $('#modal').modal('show');
            }
            else{

                //add the valid information of the new admin
                jQuery.ajax({
                    url: "navAdmin-config.php", 
                    data:{addAdmin:1, adminName:adminName, adminEmail:adminEmail, adminPass:adminPass, adminContactNo:adminContactNo},
                    type: "post",
                    dataType:"text",
                    success:function(data){
                        console.log(data);
                        if(data==='registeredEm'){
                            $('#modal .modal-title').html("..Oopps");
                            $('#modal .modal-body').html("Email address is already registered.");  
                            $('#modal').modal('show');
                        }
                        else if(data==='registeredNum'){
                            $('#modal .modal-title').html("..Oopps");
                            $('#modal .modal-body').html("Contact number is already registered.");  
                            $('#modal').modal('show');
                        }
                        else if(data==='success'){
                            $('#addAdminForm').modal('hide');
                            $('#modal .modal-title').html("Success!");
                            $('#modal .modal-body').html("New admin has been added.");  
                            $('#modal').modal('show');
                        }
                    } 
                });
            }
        }
    }

    $("#cancelChangesBtn").on('click', function(){
        window.location.href = "adminInfo.php";
    });

</script>
