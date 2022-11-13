<?php

    require("db_con/connection.php");

    if (isset($_POST['add_user'])) {
         //user info
         $fname = $_POST['fname'];
         $mname = $_POST['mname'];
         $lname  = $_POST['lname'];
         $email = $_POST['email'];
         $contactNo = '+639'.$_POST['contactNo'];
         $address = $_POST['address'];
         //additional info
         $gender = $_POST['gender'];
         $userRole = $_POST['userRole'];
         $dept = $_POST['dept'];
         $userID= $_POST['userID'];

         $count= $_POST['count'];

          //check if there are any selected user
        $sql = "SELECT addCard FROM user_t WHERE count=?";
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

                if(!($row['addCard']==1)){
                    //check if there are any user with same user ID 
                    $sql = "SELECT addCard FROM user_t WHERE roleID=? AND count NOT LIKE ?";
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

                            $sql="UPDATE user_t SET fName=?, mName=?, sName=?, gender=?, userRole=?,
                             roleID=?, dept=?, email=?, contactNo=?, address=?, regDate=CURDATE(),
                             addCard=1 WHERE count=?";
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
    $email = $_POST['email'];
    $contactNo = '+639'.$_POST['contactNo'];
    $address = $_POST['address'];
    //additional info
    $gender = $_POST['gender'];
    $userRole = $_POST['userRole'];
    $dept = $_POST['dept'];
    $userID= $_POST['userID'];

    $count= $_POST['count'];

    //check if there's any selected user
    $sql = "SELECT addCard FROM user_t WHERE count=?";
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

            if ($row['addCard'] == 0) {
                echo "User is not yet registered. Please Add the user first!";
                exit();
            }
            else{
                 //check if there's already a user with same user (role) ID
                 $sql = "SELECT addCard FROM user_t WHERE roleID=? AND count NOT LIKE ?";
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
                       
                        $sql="UPDATE user_t SET fName=?, mName=?, sName=?, gender=?, userRole=?,
                         roleID=?, dept=?, email=?, contactNo=?, address=?, regDate=CURDATE(),
                         addCard=1 WHERE count=?";
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

    $RFID_no = $_GET['RFID_no'];

    $sql = "SELECT * FROM user_t WHERE RFID_no=?";
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

 
?>