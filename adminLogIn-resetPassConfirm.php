<?php
require ("db_con/connection.php");
if (isset($_POST['uMail']) || ($_POST['password']) || ($_POST['confirmPassword'])){
    $email = $_POST['uMail'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if (empty($password) || empty($confirmPassword)){
        echo 'empty';
    }
    else{
        if ($password == $confirmPassword){
            $delete_token = mysqli_query($conn,"DELETE FROM forget_t WHERE uMail = '$email'");
            $update_password = mysqli_query($conn,"UPDATE admin_t SET adminPassword = '$password' WHERE adminEmail = '$email'");
            
            echo 'success';
        }
        else{
            echo 'unmatched';
        }
    }
}
$conn->close();
?>