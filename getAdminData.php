<?php

    ob_start();
    require("db_con/connection.php");

    $query = mysqli_query($conn, "SELECT * FROM admin_T WHERE adminNo={$_SESSION['adminID']}")or die($conn->error);

    $content=mysqli_fetch_assoc($query);

    $name=$content['adminFullName'];
    $currPass=$content['passwrd'];
    $email=$content['adminEmail'];
                            
    $return_arr[]=["name"=>$name, "currPass" =>$currPass, "email"=>$email];

    ob_end_clean();
    echo json_encode($return_arr);
?>