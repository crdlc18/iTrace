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
                    <form action="" method="post">
                        <h5>Update Your Account Information</h5><br>
                        <label>Admin Name: </label><br>
                        <input type="text" id="adminName"><br>
                        <label>Admin E-mail: </label><br>
                        <input type="text" id="adminEmail"><br>
                        <h6>---------Password Settings-----------</h6><br>
                        <label>Current Password: </label><br>
                        <input type="password" id="currPass"><br>
                        <label>New Password: </label><br>
                        <input type="password" id="newPass"><br>
                        <label>Confirm Password: </label><br>
                        <input type="password" id="conPass"><br>
                        <button id="saveChangesBtn"> Save Changes </button>
                        <button id="cancelChangesBtn"> Cancel </button>
                    </form>
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

    $(document).ready(function(){
        jQuery.ajax({
            url: "getAdminData.php", 
            dataType:"json",
            success:function(data){
                currentPass=data[0].currPass;
                $('#adminName').val(data[0].name);
                $('#adminEmail').val(data[0].email);
            } 
        });
    });

    $("#saveChangesBtn").on('click', function(){
        newName=$('#adminName').val();
        newEmail=$('#adminEmail').val();
        currPass=$('#currPass').val();
        newPass=$('#newPass').val();
        conPass=$('#conPass').val();
        
       if(!newName){
            $('#modal .modal-title').html("..Oooppss");
            $('#modal .modal-body').html("Name cannot be blank.");
            $('#modal').modal('show');
       }
       else if(!newEmail){
            $('#modal .modal-title').html("..Oooppss");
            $('#modal .modal-body').html("E-mail address cannot be blank.");
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
                    $('#confirmChangesModal').modal('show');
                }
       }
       else{
             $('#confirmChangesModal').modal('show');
       }
    });

    function saveChanges(){
        $.ajax({
            url: "saveChanges.php", 
            data:{newName:newName, newEmail:newEmail, newPass:newPass},
            type: "post",
            success:function(data){
                $('#confirmChangesModal').modal('hide');
                $('#modal .modal-title').html("Success!");
                $('#modal .modal-body').html("Your Account has been updated.");  
                $('#modal').modal('show');
                
            } 
        });
    }

    $("#addAdminBtn").on('click', function(){
        $('#addAdminForm').modal('show');
    });

    function addAdmin(){
        var adminFname = $('#adFname').val() ;
        var adminMname = $('#adMname').val();
        var adminLname = $('#adLname').val();
        var adminName = adminFname + "  " + adminMname+ "  "+ adminLname;
        var adminPass= $('#adPass').val();
        var adminEmail=$('#adEmail').val();
        var val = /^[A-Za-z\s]*$/;

        if (!adminFname||!adminMname||!adminLname||!adminPass||!adminEmail){
            $('#modal .modal-title').html("..Oooppss");
            $('#modal .modal-body').html("Information must be completed.");
            $('#modal').modal('show');
        }
        else{

            if(!val.test(adminFname)|| !val.test(adminLname) ||!val.test(adminMname)){
                console.log(1);
                $('#modal .modal-title').html("..Oooppss");
                $('#modal .modal-body').html("Name must only contain alphabet characters");
                $('#modal').modal('show');
            }
            else{
                jQuery.ajax({
                    url: "addAdmin.php", 
                    data:{adminName:adminName, adminEmail:adminEmail, adminPass:adminPass},
                    type: "post",
                    dataType:"text",
                    success:function(data){

                        if(data==='registered'){
                            $('#modal .modal-title').html("..Oopps");
                            $('#modal .modal-body').html("Email address is already registered.");  
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
