<?php

   require("db_con/connection.php");

   $newEmail=$_POST['newEmail'];
   $newName=$_POST['newName'];
   $newPass=$_POST['newPass'];

   $newEmail='admin@gmail.com';
   $newName='Admin';
   $newPass='4dMin';
   
   
   if(empty($newPass)){

        mysqli_query($conn, "UPDATE admin_T SET adminFullName = '$newName', adminEmail='$newEmail' 
                     WHERE adminNo={$_SESSION['adminID']}") or die($conn->error);
   }
   else{

        mysqli_query($conn, "UPDATE admin_T SET adminFullName = '$newName', adminEmail='$newEmail', passwrd='$newPass' 
         WHERE adminNo={$_SESSION['adminID']}") or die($conn->error);
          
   }
    
    $conn->close();

?>