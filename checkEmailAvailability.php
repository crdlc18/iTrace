<?php 
    require("db_con/connection.php");

    if(isset($_POST['email'])){

        $email = $_POST['email'];

        $query = mysqli_query($conn,"SELECT * FROM user_t WHERE email='$email'") or die($conn->error);

        if(mysqli_num_rows($query)>0) {
            echo "invalid";
        
        }else{
            echo "valid";
        
        }
    }
?>