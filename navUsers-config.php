<?php

    require("db_con/connection.php");

    if (isset($_POST['add_user'])) {
         //user info
         $fname = $_POST['fname'];
         $mname = $_POST['mname'];
         $lname  = $_POST['lname'];
         $email = $_POST['uMail'];
         $contactNo = '+639'.$_POST['uContactNo'];
         $address = $_POST['uAddress'];
         //additional info
         $gender = $_POST['uGender'];
         $userRole = $_POST['uRole'];
         $dept = $_POST['uDept'];
         $userID= $_POST['userID'];

         $count= $_POST['count'];

          //check if there are any selected user
        $sql = "SELECT cardAdd FROM user_t WHERE count=?";
        $result = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($result, $sql)) {
            echo "SQL_Error";
            exit();
        }
        else{
            mysqli_stmt_bind_param($result, "i", $count);
            mysqli_stmt_execute($result);
        
            $resultl = mysqli_stmt_get_result($result);
            if ($row = mysqli_fetch_assoc($resultl)) {

                if(!($row['cardAdd']==1)){
                    //check if there are any user with same user ID 
                    $sql = "SELECT cardAdd FROM user_t WHERE uID=? AND count NOT LIKE ?";
                    $result = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($result, $sql)) {
                        echo "SQL_Error";
                        exit();
                    }
                    else{
                        mysqli_stmt_bind_param($result, "si", $userID, $count);
                        mysqli_stmt_execute($result);
                        $resultl = mysqli_stmt_get_result($result);
                        if (!$row = mysqli_fetch_assoc($resultl)) {

                            $sql="UPDATE user_t SET uFN=?, uMN=?, uLN=?, uGender=?, uRole=?,
                             uID=?, uDept=?, uMail=?, uContactNo=?, uAddress=?, regDate=CURDATE(),
                             cardAdd=1 WHERE count=?";
                            $result = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($result, $sql)) {
                                echo "SQL_Error_select_Fingerprint";
                                exit();
                            }
                            else{
                                mysqli_stmt_bind_param($result, "ssssssssssi", $fname,  $mname, $lname, $gender, $userRole, $userID,
                                                        $dept, $email, $contactNo, $address, $count);
                         
                                mysqli_stmt_execute($result);
                                echo 1;
                                exit();
                            }

                        }
                        else{
                            echo "Input Student/Faculty ID is already taken!";
                            exit();
                        }
                    }
                }
                else{
                    echo "User already exists";
                    exit();
                }
            }
            else{
                echo "There's no selected Card!";
                exit();
            }
        }
    }

// Update an existing user 
if (isset($_POST['update_user'])) {

    //user info
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname  = $_POST['lname'];
    $email = $_POST['uMail'];
    $contactNo = '+639'.$_POST['uContactNo'];
    $address = $_POST['uAddress'];
    //additional info
    $gender = $_POST['uGender'];
    $userRole = $_POST['uRole'];
    $dept = $_POST['uDept'];
    $userID= $_POST['userID'];

    $count= $_POST['count'];

    //check if there's any selected user
    $sql = "SELECT cardAdd FROM user_t WHERE count=?";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
      echo "SQL_Error";
      exit();
    }
    else{
        mysqli_stmt_bind_param($result, "i", $count);
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        if ($row = mysqli_fetch_assoc($resultl)) {

            if ($row['cardAdd'] == 0) {
                echo "User is not yet registered. Please Add the user first!";
                exit();
            }
            else{
                 //check if there's already a user with same user (role) ID
                 $sql = "SELECT cardAdd FROM user_t WHERE uID=? AND count NOT LIKE ?";
                 $result = mysqli_stmt_init($conn);
                 if (!mysqli_stmt_prepare($result, $sql)) {
                     echo "SQL_Error";
                     exit();
                 }
                 else{
                    mysqli_stmt_bind_param($result, "si", $roleID, $count);
                    mysqli_stmt_execute($result);
                    $resultl = mysqli_stmt_get_result($result);
                    if (!$row = mysqli_fetch_assoc($resultl)) {
                       
                        $sql="UPDATE user_t SET uFN=?, uMN=?, uLN=?, uGender=?, uRole=?,
                         uID=?, uDept=?, uMail=?, uContactNo=?, uAddress=?, regDate=CURDATE(),
                         cardAdd=1 WHERE count=?";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo "SQL_Error_select_Fingerprint";
                            exit();
                        }
                        else{
                            mysqli_stmt_bind_param($result, "ssssssssssi", $fname,  $mname, $lname, $gender, $userRole, $userID, $dept, $email, $contactNo, $address, $count);
                     
                            mysqli_stmt_execute($result);
                            echo 1;
                            exit();
                        }
                    }
                    else {
                        echo "The serial number is already taken!";
                        exit();
                    }
                 }
            }
                
        }
        else {
            echo "There's no selected User to be updated!";
            exit();
        }
    }
}
// delete user 
 if (isset($_POST['delete'])) {

    $count = $_POST['count'];

    if (empty($user_id)) {
        echo "There no selected user to remove";
        exit();
    } else {
        $sql = "DELETE FROM user_t WHERE count=?";
        $result = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($result, $sql)) {
            echo "SQL_Error_delete";
            exit();
        }
        else{
            mysqli_stmt_bind_param($result, "i", $count);
            mysqli_stmt_execute($result);
            echo 1;
            exit();
        }
    }
}
// select 
if (isset($_GET['select'])) {

    $RFID_no = $_GET['RFIDno'];

    $sql = "SELECT * FROM user_t WHERE RFIDno=?";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo "SQL_Error_Select";
        exit();
    }
    else{
        mysqli_stmt_bind_param($result, "s", $RFID_no);
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
       
        header('Content-Type: application/json');
        $data = array();
        if ($row = mysqli_fetch_assoc($resultl)) {
            foreach ($resultl as $row) {
                $data[] = $row;
            }
        }
        $resultl->close();
        $conn->close();
        print json_encode($data);
    } 
}


//----------- CHECKING EMAIL AND CONTACT INFORMATION AVAILABILITY WHEN USER INFOR IS TO BE ADDED/UPDATED --------------//

 if (isset($_POST['checkEmail'])){  
    $email = $_POST['uMail'];
    $count = $_POST['count'];
   

        $query = mysqli_query($conn,"SELECT * FROM user_t WHERE uMail='$email' AND NOT count='$count'") or die($conn->error);
        if(mysqli_num_rows($query)>0) {
            echo "invalid";
        }else{
            echo "valid";  
    }
 }

 if (isset($_POST['checkContact'])){
    $contactNo = "+639".$_POST['uContactNo'];
    echo"$contactNo";

    $query = mysqli_query($conn,"SELECT * FROM user_t WHERE uContactNo='$contactNo' AND NOT count='$count'") or die($conn->error);

    if(mysqli_num_rows($query)>0) {
        echo "invalid";
    
    }else{
        echo "valid";
    
    }
 }
?>