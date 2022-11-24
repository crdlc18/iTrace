<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://unpkg.com/htmlincludejs"></script>
</head>
<body>
    <?php
    require('db_con/connection.php');
    if(isset($_GET['token'])){
        $token = $_GET['token'];
        $get_token = mysqli_query($conn,"SELECT * FROM forget_t WHERE token = '$token'") or die($conn->error);
        if($admin_email = mysqli_fetch_assoc($get_token)){ 
            $admin_email = $admin_email["uMail"];
        }
        else{
            echo 'This reset password link has expired.';
        }
    }
    $conn->close();
    ?>

    <div class="form">
        <form autocomplete="off" id="ResetPasswordForm">
            <label> RESET PASSWORD </label><br>
                <label> Email: 
                    <input type="text" id="InputEmail" value="<?php echo $admin_email;?>"></label><br>
                <label> Password: 
                    <input type="password" id="InputPass"> </label><br>
                <label> Confirm Password 
                    <input type="password" id="ConfirmPass"> </label><br>
        

            <button type="submit" id="ResetBtn">Reset Password</button>
            <button type="button" id="CancelBtn">Cancel</button>
        </form>
    </div>
    
    <!--Modal-->
    <include src = "assets/warningModal.html"></include>
    <include src = "assets/forgetPassModal.html"></include>
    
</body> 
</html>

<script>
    $("#ResetBtn").on('click', function(){
        var uMail = $("#InputEmail").val();
        var password = $("#InputPass").val();
        var confirmPassword = $("#ConfirmPass").val();
    
        $.ajax({
            url: 'adminLogIn-resetPassConfirm.php',
            type: 'post',
            data:{uMail:uMail,password:password,confirmPassword:confirmPassword},
            dataType: "text",
            success:function(data){
                if(data.trim()==='success'){
                    alert('Password changed successfully!');
                    window.location.href = "adminLogin.html";
                }
                else if(data.trim()==='unmatched'){
                    alert('Passwords do not match! Please try again.');
                }
                else if(data.trim()==='empty'){
                    alert('Fields cannot be empty!');
                }
            }
        });
    });

    $("#CancelBtn").on('click', function(){
        window.location.href = "adminLogIn.html";
    }); 
</script>