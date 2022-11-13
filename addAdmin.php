<?php

   require("db_con/connection.php");

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

?>