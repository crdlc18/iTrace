<?php

    ob_start();
    require("db_con/connection.php");

    // get current admin information
    if (isset($_POST['getAdminData'])){

        $query = mysqli_query($conn, "SELECT * FROM admin_T WHERE adminNo={$_SESSION['adminID']}")or die($conn->error);
    
        $content=mysqli_fetch_assoc($query);
    
        $name=$content['adminFullName'];
        $currPass=$content['passwrd'];
        $email=$content['adminEmail'];
                                
        $return_arr[]=["name"=>$name, "currPass" =>$currPass, "email"=>$email];
    
        ob_end_clean();
        echo json_encode($return_arr);

    }

    // update current admin information
    if (isset($_POST['saveChanges'])){

        $newEmail=$_POST['newEmail'];
        $newName=$_POST['newName'];
        $newPass=$_POST['newPass'];

        if(empty($newPass)){

            mysqli_query($conn, "UPDATE admin_T SET adminFullName = '$newName', adminEmail='$newEmail' 
                        WHERE adminNo={$_SESSION['adminID']}") or die($conn->error);
        }
        else{

            mysqli_query($conn, "UPDATE admin_T SET adminFullName = '$newName', adminEmail='$newEmail', passwrd='$newPass' 
            WHERE adminNo={$_SESSION['adminID']}") or die($conn->error);
        }

        $conn->close();
    }

    //add new admin info
    if(isset($_POST['addAdmin'])){
        $adminEmail=$_POST['adminEmail'];
        $adminName=$_POST['adminName'];
        $adminPass=$_POST['adminPass'];


        $query = mysqli_query($conn, "SELECT * FROM admin_T WHERE adminEmail = '$adminEmail'") or die($conn->error);

            if(mysqli_affected_rows($conn)>0){ 
                echo "registered";
                    
            }
            else{
                
                mysqli_query($conn, "INSERT INTO admin_T (adminFullName, adminEmail, passwrd) VALUES ('$adminName', '$adminEmail', '$adminPass')");
                echo "success";
            }
        $conn->close();
    }

   
?>