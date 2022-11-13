<?php

   require("db_con/connection.php");

    $pass=$_POST['pass'];
    $email=$_POST['un'];
    
    //queries the database if input email exists
    $query = mysqli_query($conn, "SELECT * FROM admin_T WHERE adminEmail = '$email'") or die($conn->error);
  

    if(mysqli_affected_rows($conn)>0){ 

        $item=mysqli_fetch_array($query);
        $passwrd=$item['passwrd'];
        $email=$item['adminEmail'];
        $_SESSION['CurrAdminName'] = $item['adminFullName'];
        $_SESSION['adminID']= $item['adminNo'];
      
       
      if($pass==$passwrd){
        echo "matched";
        
      }
      else{
        echo "notMatched";
      }
         
    }
    else{
      echo "noRec";  
    }

    $conn->close();

?>