<?php

    ob_start();
    require("db_con/connection.php");

    // get current admin information
    if (isset($_POST['getAdminData'])){

        $query = mysqli_query($conn, "SELECT * FROM admin_T WHERE adminNo={$_SESSION['adminID']}")or die($conn->error);
    
        $content=mysqli_fetch_assoc($query);
    
        $name=$content['adminFullName'];
        $currPass=$content['adminPassword'];
        $email=$content['adminEmail'];
        $adminContactNo=substr($content['adminContactNo'],4);
                                
        $return_arr[]=["name"=>$name, "currPass" =>$currPass, "uMail"=>$email, 'adminNo'=>$adminContactNo];
    
        ob_end_clean();
        echo json_encode($return_arr);

    }

    // update current admin information
    if (isset($_POST['saveChanges'])){

        $newEmail=$_POST['newEmail'];
        $newName=$_POST['newName'];
        $newPass=$_POST['newPass'];
        $newNum = '+639'.$_POST['newNumber'];

        $flag=checkAvailability($newEmail,$newNum,$conn);

       if($flag==0){
            if(empty($newPass)){

                mysqli_query($conn, "UPDATE admin_T SET adminFullName = '$newName', adminEmail='$newEmail', adminContactNo='$newNum'
                            WHERE adminNo={$_SESSION['adminID']}") or die($conn->error);
                echo "success";
            }
            else{
    
                mysqli_query($conn, "UPDATE admin_T SET adminFullName = '$newName', adminEmail='$newEmail', adminContactNo='$newNum', adminPassword='$newPass' 
                WHERE adminNo={$_SESSION['adminID']}") or die($conn->error);
                echo "success";
            }
        }
        else if($flag==1){
            echo "registeredEm";

        }
        else if ($flag==2){
            echo "registeredNum";
        }

        $conn->close();
    }

    //add new admin info
    if(isset($_POST['addAdmin'])){
        $adminEmail=$_POST['adminEmail'];
        $adminName=$_POST['adminName'];
        $adminPass=$_POST['adminPass'];
        $adminContactNo = '+639'.$_POST['adminContactNo'];
        
        $flag=checkAvailability($adminEmail,$adminContactNo, $conn);
       

        if($flag==0){
            mysqli_query($conn, "INSERT INTO admin_T (adminFullName, adminEmail, adminContactNo, adminPassword) 
                            VALUES ('$adminName', '$adminEmail','$adminContactNo', '$adminPass')");
            echo "success";
        }
        else if($flag==1){
            echo "registeredEm";

        }
        else if ($flag==2){
            echo "registeredNum";
        }

        $conn->close();
    }

    function checkAvailability($adEmail, $adNum, $conn){

        $query1 = mysqli_query($conn, "SELECT * FROM admin_T WHERE adminEmail = '{$adEmail}' AND NOT adminNo={$_SESSION['adminID']}" ) or die($conn->error);

        if(mysqli_affected_rows($conn)>0){ 
            return 1;
        }

        $query2 = mysqli_query($conn, "SELECT * FROM admin_T WHERE adminContactNo = '{$adNum}' AND NOT adminNo={$_SESSION['adminID']}") or die($conn->error);

        if(mysqli_affected_rows($conn)>0){ 
            return 2;
        }
        
        return 0;
    }
?>