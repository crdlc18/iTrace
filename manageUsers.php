<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://unpkg.com/htmlincludejs"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.js"></script>
</head>
<?php 
    
   require("db_con/connection.php");
    if (!isset($_SESSION['CurrAdminName'])) {
    header("location: adminLogIn.html");
   }
?>
<body>
    <div>
        <div class="row">

            <!---navigation-->
            <div class="col">
                  <div  id="nav">
                    <include src="assets/nav.html"></include>
                  </div>
            </div>

            <div class="col">

                 <!---Search User---->
                <div>
                    <form id='searchForm'>
                        <input type="text" name='name' id='name' placeholder="Enter name to be searched...">
                        <button type='button' id= 'searchUserBtn' name = 'searchUserBtn'>Search</button>
                    </form>
                </div>
                
                

                <h3>Manage Users</h3>
                <div id="manageUserTbl">
                </div>
            </div>

            <div class="col-md-3">
                <div id="userInfo">
                    <form id ='userInfoField' method="post" action="">
                        <fieldset>
                            <legend>User Information</legend>
                            <input type="hidden" name="count" id="count">
                            <input type="text" name="fname" id="fname" placeholder="First Name..."><br>
                            <input type="text" name="mname" id="mname" placeholder="Middle Name..."><br>
                            <input type="text" name="lname" id="lname" placeholder="Surname..."><br>
                            <input type="text" name="userEmail" id="userEmail" placeholder="Email..."><br>
                            <input type="text" name="contactNo" id="contactNo" placeholder="Contact Number..."><br>
                            <input type="text" name="address" id="address" placeholder="Address..."><br>
                        </fieldset>
                        <fieldset>
                            <legend>Additional Information</legend>
                            <input type="radio" name="gender" class="gender" value="Female" checked="checked">Female
	          	            <input type="radio" name="gender" class="gender" value="Male" >Male
                            <br>
                            <label> User Role:
                                <select class="roleSel" name="roleSel" id="roleSel">
                                    <option value='0'>Select Role...</option>
                                    <option value='Student'>Student</option>
                                    <option value='Faculty'>Faculty</option>
                                </select>
                            </label><br>
                            <label> Student/Faculty ID:
                                <input type="text" name="roleID" id="roleID">
                            </label>
                            <label> Department:
                                <select class="userDept" name="userDept" id="userDept">
                                    <option value='0'>Select Department...</option>
                                    <option value='Information Technology'>Information Technology</option>
                                    <option value='Computer Science'>Computer Science</option>
                                </select>
                            </label>
                        </fieldset>
                            <button type="button" name="user_add" id="user_add">Add User</button>
                            <button type="button" name="user_upd" id="user_upd">Update User</button>
                            <button type="button" name="user_rem" id="user_rem">Remove User</button>
                            <button type="button" name="view_user" id="view_user">View User</button>
                    </form>
                </div>
            </div>
        </div>     
    </div>
</body>
 <!-- Warning/Alert Modal-->
 <include src = "assets/warningModal.html"></include>
 <include src = "assets/viewAdminModal.html"></include>
</html>

<script>
     /*---------------------load-----------------------*/
	  $(document).ready(function(){
	  	  jQuery.ajax({
	        url: "loadManageUsers.php"
	        }).done(function(data) {
	        $('#manageUserTbl').html(data); 
	      });
	    setInterval(function(){
	      jQuery.ajax({
	        url: "loadManageUsers.php"
	        }).done(function(data) {
	        $('#manageUserTbl').html(data);
	      });
	    },5000);
	  });



      /*--------------------manage users page with applied action-----------------*/
$(document).ready(function(){

/*-----------------------Search User---------------------*/
$(document).on('click', '#searchUserBtn', function(){
    console.log(1);
    var name= $('#name').val();
    var strng = /^[A-Za-z\s]*$/;

    if(!name){
        $('#modal .modal-title').html("..Oopss");
        $('#modal .modal-body').html("Enter a name to be searched.");
        $('#modal').modal('show');
    }
    else {

        if(!strng.test(name)){
            $('#modal .modal-title').html("INVALID NAME");
            $('#modal .modal-body').html("Name must not contain a digit.");
            $('#modal').modal('show');
        }
        else{
            jQuery.ajax({
                url:'loadManageUsers.php',
                type:'POST',
                data:{name:name},
            }).done(function(data){
                $('#manageUserTbl').html(data);
            });
        }
    }
});

/*-----------------------Search User on type---------------------*/
$(document).on('keyup', '#name', function(){
    console.log(2);
    var name= $(this).val();
    var strng = /^[A-Za-z\s]*$/;


    if(!strng.test(name)){
            
        $(this).css("border", "2px solid red");
    
    }
    else{
        
        $(this).css("border", "");

            jQuery.ajax({
                url:'loadManageUsers.php',
                type:'POST',
                data:{name:name},
            }).done(function(data){
                $('#manageUserTbl').html(data);
            });

        clearInterval();
    }
    
});


/*--action for viewing users---*/
$(document).on('click', '#view_user', function(){
   
    jQuery.ajax({
        url:'loadUsers.php',
    }).done(function(data){
        $('#viewUserModal .modal-body').html(data);
        $('#viewUserModal').modal('show');
    });
});

/*------------action for add user----------*/

$(document).on('click', '#user_add', function(){

    //user info
    var fname = $('#fname').val();
    var mname = $('#mname').val();
    var lname  = $('#lname').val();
    var email = $('#userEmail').val();
    var contactNo = $('#contactNo').val();
    var address = $('#address').val();
    //additional info
    var gender = $(".gender:checked").val();
    var userRole = $('#roleSel option:selected').val();
    var dept = $('#userDept option:selected').val();
    var userID= $("#roleID").val();
    var count=$('#count').val();

    

    //check validity of inputs
    checkInput(fname, mname, lname, email, contactNo, address, gender,
                userRole, dept, userID);
    
    if (flag==0){
        bootbox.confirm("Do you really want to add this user?", function(result) {
            if (result){
                jQuery.ajax({
                    url:'manageUserConfig.php',
                    type:'POST',
                    data:{add_user:1, fname:fname, mname:mname, lname:lname,
                            email:email, contactNo:contactNo, address:address,
                            gender:gender, userRole:userRole, dept:dept, userID:userID, count:count},
                    success:function(response){
                        
                        if (response == 1) {
                            
                            $('#userInfoField').reset();
    
                            $('#modal .modal-title').html("Success!");
                            $('#modal .modal-body').html("User has been added.");
                            $('#modal').modal('show');
                        }
                        else{
                            $('#modal .modal-title').html("Oppss..!");
                            $('#modal .modal-body').html(response);
                            $('#modal').modal('show');
                        }
    
                        jQuery.ajax({
                            url:'loadMangeUsers.php',
                               
                        }).done(function(data){
                            $('#manageUserTbl').html(data);
                        });
                    }
                });
            }
        });
    }
    else if(flag==2){
        $('#modal .modal-title').html("INVALID EMAIL");
        $('#modal .modal-body').html("Email is already taken.");
        $('#modal').modal('show');
    }
    else if(flag==3){
        $('#modal .modal-title').html("INVALID CONTACT NUMBER");
        $('#modal .modal-body').html("Contact number already exists.");
        $('#modal').modal('show');
    }
});

//------------------------- ACTION FOR UPDATE USER-------------------------------//
$(document).on('click', '#user_upd', function(){

    //user info
    var fname = $('#fname').val();
    var mname = $('#mname').val();
    var lname  = $('#lname').val();
    var email = $('#userEmail').val();
    var contactNo = $('#contactNo').val();
    var address = $('#address').val();
    //additional info
    var gender = $(".gender:checked").val();
    var userRole = $('#roleSel option:selected').val();
    var dept = $('#userDept option:selected').val();
    var userID= $("#roleID").val();
    var count=$("#count").val();

     //check validity of inputs
     checkInput(fname, mname, lname, email, contactNo, address, gender,
        userRole, dept, userID);

    if(flag==0){
        bootbox.confirm("Save changes to user's info?", function(result) {
            if(result){

                    jQuery.ajax({
                        url:'manageUserConfig.php',
                        type:'POST',
                        data:{update_user:1, fname:fname, mname:mname, lname:lname,
                                email:email, contactNo:contactNo, address:address,
                                gender:gender, userRole:userRole, dept:dept, userID:userID, count:count},
                        success:function(response){
                            
                            if (response == 1) {
                                //reset form
                                $('#userInfoField')[0].reset();

                                $('#modal .modal-title').html("Success!");
                                $('#modal .modal-body').html("User has been Updated.");
                                $('#modal').modal('show');
                            }
                            else{
                                $('#modal .modal-title').html("Oppss..!");
                                $('#modal .modal-body').html(response);
                                $('#modal').modal('show');
                            }

                            jQuery.ajax({
                                url:'loadMangeUsers.php',
                        
                            }).done(function(data){
                                $('#manageUserTbl').html(data);
                            });
                        }
                    });
            }
        });
    }
    else if(flag==2){
        $('#modal .modal-title').html("INVALID EMAIL");
        $('#modal .modal-body').html("Email is already taken.");
        $('#modal').modal('show');
    }
    else if(flag==3){
        $('#modal .modal-title').html("INVALID CONTACT NUMBER");
        $('#modal .modal-body').html("Contact number already exists.");
        $('#modal').modal('show');
    }
});

  //------------------------- ACTION FOR DELETING USER-------------------------------//
  $(document).on('click', '#user_rem', function(){

    var count =$('#count').val();

    bootbox.confirm("Do you really want to delete this User?", function(result) {
        if(result){
            $.ajax({
                url: 'manageUserconfig.php',
                type: 'POST',
                data: {
                    'delete': 1,
                    'count': count,
                },
                success: function(response){

                    if (response == 1) {
                        
                        //reset form
                        $('#userInfoField')[0].reset();

                        $('#modal .modal-title').html("Success!");
                        $('#modal .modal-body').html("User has been deleted.");
                        $('#modal').modal('show');
                    }
                    else{
                        $('#modal .modal-title').html("Oppss..!");
                        $('#modal .modal-body').html(response);
                        $('#modal').modal('show');
                    }
                    
                    
                    jQuery.ajax({
                        url:'loadMangeUsers.php',
                    
                    }).done(function(data){
                        $('#manageUserTbl').html(data);
                    });
                }
            });
        }
    });
});

// ----------------- SELECT USER ----------------------------------------//
$(document).on('click', '.selectedBtn', function(){
    var el = this;
    var RFID_no = $(this).attr("id");
    $.ajax({
    url: 'manageUserConfig.php',
    type: 'GET',
    data: {select: 1, RFID_no: RFID_no},
    success: function(response){

        $(el).closest('tr').css('background','#70c276');

        $.ajax({
        url: "loadManageUsers.php"
        }).done(function(data) {
        $('#manage_users').html(data);
        });

        var count = {
            Count : []
        };
        var fName = {
            Fname : []
        };
        var mName = {
            Mname : []
        };
        var lName = {
            Lname : []
        };
        var user_gender = {
            User_gender : []
        };
        var userRole = {
            UserRole: []
        };
        var roleID = {
            RoleID : []
        };
        var userDept = {
            UserDept : []
        };
        var email = {
            Email : []
        };
        var contactNo = {
            ContactNo : []
        };
        var userAddress = {
            UserAddress : []
        };
        
        
        var len = response.length;

        for (var i = 0; i < len; i++) {
            fName.Fname.push(response[i].fName);
            mName.Mname.push(response[i].mName);
            lName.Lname.push(response[i].sName);
            user_gender.User_gender.push(response[i].gender);
            userRole.UserRole.push(response[i].userRole);
            roleID.RoleID.push(response[i].roleID);
            userDept.UserDept.push(response[i].dept);
            email.Email.push(response[i].email);
            num=response[i].contactNo.slice(4,13);
            contactNo.ContactNo.push(num);
            userAddress.UserAddress.push(response[i].address);
            count.Count.push(response[i].count);
        }

        
        if (userDept.UserDept == '') {
            userDept.UserDept = 0;
            
        }

        $('#count').val(count.Count);
        //user info
        $('#fname').val(fName.Fname);
        $('#mname').val( mName.Mname);
        $('#lname').val(lName.Lname);
        $('#userEmail').val(email.Email);
        $('#contactNo').val(contactNo.ContactNo);
        $('#address').val(userAddress.UserAddress);
        //additional info
        if (user_gender.User_gender == 'Female'){
            $("input[name='gender'][value='Female']").prop("checked", true);
        }
        else{
            $("input[name='gender'][value='Male']").prop("checked", true);
        }

       $('#roleSel').val(userRole.UserRole);
       $('#userDept').val(userDept.UserDept);
       $("#roleID").val(roleID.RoleID);
    },
    error : function(data) {
        console.log(data);
    }
    });
});


});


// ----------------------------- INPUT VALIDATION---------------------------------------------------------------//

{
var flag=0;
}

$(document).on('keyup', '#userEmail', function(){
  var email= $(this).val();
//check if email is taken
jQuery.ajax({
   url:'checkEmailAvailability.php',
   type:'POST',
   data:{email:email},
   success:function(response){
       if(response=='invalid'){
           flag=2;
       }
       else if(response=='valid'){
           flag=0;
       }
     
   }
});
});

$(document).on('keyup', '#contactNo', function(){
var contactNo= $(this).val();
//check if contact number is taken
jQuery.ajax({
   url:'checkContactNo.php',
   type:'POST',
   data:{contactNo:contactNo},
   success:function(response){
       if(response=='invalid'){
           flag=3;
       }
       else if(response=='valid'){
           flag=0;
       }
   }
});

});

function checkInput(fname, mname, lname, email, contactNo, address, gender, userRole, dept, userID){

var strng = /^[A-Za-z\s]*$/;
var numCheck = /^[0-9]+$/; 

if(!fname && !mname && !lname && !email && !contactNo && !address && !userID){
    $('#modal .modal-title').html("..Oopss");
    $('#modal .modal-body').html("Please select a user.");
    $('#modal').modal('show');
    flag=1;
}
else if(!fname || !mname || !lname || !email || !contactNo||!address||!gender||!userID){
    
    $('#modal .modal-title').html("INCOMPLETE INPUT");
    $('#modal .modal-body').html("Please fill up all the fields.");
    $('#modal').modal('show');
    flag=1;
}
else if(userRole=='0'){
    $('#modal .modal-title').html("INVALID USER ROLE");
    $('#modal .modal-body').html("Please select a role .");
    $('#modal').modal('show');
    flag=1;
}
else if(dept=='0'){
    $('#modal .modal-title').html("INVALID DEPARTMENT");
    $('#modal .modal-body').html("Please select a department.");
    $('#modal').modal('show');
    flag=1;
}
else if(!strng.test(fname)|| !strng.test(fname)|| !strng.test(lname)){
    $('#modal .modal-title').html("INVALID NAME");
    $('#modal .modal-body').html("Names should only contain alphabet characters.");
    $('#modal').modal('show');
    flag=1;
}
else if (!numCheck.test(contactNo) || !contactNo.length==9){
    $('#modal .modal-title').html("INVALID CONTACT NUMBER");
    $('#modal .modal-body').html("Contact number should only contain 10 digits");
    $('#modal').modal('show');
    flag=1;
}
}
</script>