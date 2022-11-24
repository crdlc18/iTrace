<?php
require ("db_con/connection.php");
if (isset($_POST['email']) || ($_POST['password']) || ($_POST['confirmPassword'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if (empty($password) || empty($confirmPassword)){
        echo 'empty';
    }
    else{
        if ($password == $confirmPassword){
            $update_password = mysqli_query($conn,"UPDATE admin_t SET passwrd = '$password' WHERE adminEmail = '$email'");
            $delete_token = mysqli_query($conn,"DELETE FROM forgot_pass WHERE adminEmail = '$email'");
            echo 'success';
        }
        else{
            echo 'unmatched';
        }
    }
}
$conn->close();
?>