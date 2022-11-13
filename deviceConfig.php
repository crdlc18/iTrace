<?php 
    require("db_con/connection.php");


    if (isset($_POST['dev_add'])) {

        $roomID = $_POST['dev_room'];
        $dept = $_POST['dev_dep'];
    
        if (empty($roomID)) {
            echo 0 ;
        }
        elseif (empty($dept)) {
            echo 1 ;
        }
        else{

            //check if room number exists
            $sql = "SELECT * FROM dev_T WHERE RoomID=?";
            $result = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($result, $sql)) {
                echo 'SQL Error';
                
            }
            else{
                mysqli_stmt_bind_param($result, "s", $roomID);
                mysqli_stmt_execute($result);
                $resultl = mysqli_stmt_get_result($result);

                if (mysqli_num_rows($resultl) > 0){
                    echo 2 ;
                }   
                else{
                    $sql = "INSERT INTO dev_T (RoomID, Dept) VALUES(?, ?)";
                    $result = mysqli_stmt_init($conn);
                    if ( !mysqli_stmt_prepare($result, $sql)){
                        echo 'SQL Error';
                    }
                    else{
                        mysqli_stmt_bind_param($result, "ss", $roomID, $dept);
                        mysqli_stmt_execute($result);
                        mysqli_stmt_close($result); 
            	        mysqli_close($conn);
                        echo 3;
                    }
                }
            }
        }
    }
    elseif (isset($_POST['dev_del'])) { 
    
        $dev_del = $_POST['deleteRoomID']; 
    
        $sql = "DELETE FROM dev_T WHERE RoomID=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'SQL Error';
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $dev_del);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt); 
            mysqli_close($conn);
            echo 1;
            
        }
    }

    elseif (isset($_POST['dev_mode_set'])) { 
    
        $dev_mode = $_POST['dev_mode']; 
        $dev_id = $_POST['dev_id'];
        
        $sql = "UPDATE dev_T SET DevMode=? WHERE RoomID=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo 'SQL Error';
        }
        else{
            mysqli_stmt_bind_param($stmt, "is", $dev_mode, $dev_id);
            mysqli_stmt_execute($stmt);
            echo 1;
        }
    }
    
    
?>