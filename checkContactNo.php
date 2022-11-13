<?php 
    require("db_con/connection.php");

    if(isset($_POST['contactNo'])){

        $contactNo = "+639".$_POST['contactNo'];
        echo"$contactNo";

        $query = mysqli_query($conn,"SELECT * FROM user_t WHERE contactNo='$contactNo'") or die($conn->error);

        if(mysqli_num_rows($query)>0) {
            echo "invalid";
        
        }else{
            echo "valid";
        
        }
    }
?>