<?php
  require("db_con/connection.php");  
  date_default_timezone_set('Asia/Manila');
  $CurDate = date("Y-m-d");
  $CurTime = date("H:i:s");     

  //get data from the device
  if(isset($_GET['rfid_no'])&& isset($_GET['room_id']) && isset($_GET['temp'])){
    $RFID_no = $_GET['rfid_no'];
    $RoomID = $_GET['room_id'];
    $temp = $_GET['temp'];

    $sql = "SELECT * FROM dev_t WHERE  roomID = ?";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) { 
        echo "SQL_Error_Select_device";
        exit(); //Failed connection
    }
    else{ //Success connection
        mysqli_stmt_bind_param($result, "s", $RoomID);
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        //device exists
        if ($row = mysqli_fetch_assoc($resultl)){
            $devMode = $row['deviceMode'];

            //ATTENDANCE mode
            if ($devMode == 1){
                //check if rfid_no exists
                $sql = "SELECT * FROM user_t WHERE RFIDno =?";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_Select_card";
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($result, "s", $RFID_no);
                    mysqli_stmt_execute($result);
                    $resultl = mysqli_stmt_get_result($result);
                    if ($row = mysqli_fetch_assoc($resultl)){
                        //detected card is registered/added 
                        if($row['cardAdd']==1){
                            //if($row['roomID']==$RoomID || $row['roomID'] == 0){

                                //concatenate the user's full name 
                                $name = $row['uFN']." ".$row['uMN']. " " .$row['uLN'];
                                $count = $row['count'];    

                                //select the attendance log record of the user (scanned rfid)
                                $sql = "SELECT * FROM logs_t WHERE RFIDno=? AND logDate=? AND cardOut=0";
                                $result = mysqli_stmt_init($conn);
                                if (!mysqli_stmt_prepare($result, $sql)) {
                                    echo "SQL_Error_Select_logs";
                                    exit();
                                }
                                else{
                                    mysqli_stmt_bind_param($result, "ss", $RFID_no, $CurDate);
                                    mysqli_stmt_execute($result);
                                    $resultl = mysqli_stmt_get_result($result);

                                    /*----------------- TEMPERATURE CHECKING -----------------------*/
                                    $attempt=0;
                                    if($temp>= 37.8){

                                    }

                                    //if no record found, log as time-in
                                    if (!$row = mysqli_fetch_assoc($resultl)){

                                        //-------------------------INSERT ATTENDANCE LOG (TIME-IN)-------------------//
                                        $timeOut="00:00:00";
                                        $sql = "INSERT INTO logs_t(count, roomID, RFIDno, fullName,  timeIn, tempIn, timeOut, logDate) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
                                        $result = mysqli_stmt_init($conn);
                                        if (!mysqli_stmt_prepare($result, $sql)) {
                                            echo "SQL_Error_Select_login1";
                                            exit();
                                        }
                                        else{
                                            $timeout = "00:00:00";
                                            mysqli_stmt_bind_param($result, "isssssss", $count, $RoomID, $RFID_no, $name,  $CurTime, $temp, $timeout, $CurDate);
                                            mysqli_stmt_execute($result);

                                            echo "{$name} is logged in";
                                            exit();
                                        }
                                    }
                                    else{
                                        /*----------------------- INSERT ATTENDANCE LOG (AS TIME_OUT)-------------------*/
                                        $sql="UPDATE logs_t SET  timeOut=?, tempOut =?, cardOut=1 WHERE RFIDno=? AND logDate=? AND cardOut=0";
                                        $result = mysqli_stmt_init($conn);
                                        if (!mysqli_stmt_prepare($result, $sql)) {
                                            echo "SQL_Error_insert_logout1";
                                            exit();
                                        }
                                        else{
                                            mysqli_stmt_bind_param($result, "ssss",  $CurTime, $temp, $RFID_no, $CurDate);
                                            mysqli_stmt_execute($result);

                                            echo "{$name} is logged out";
                                            exit();
                                        }
                                    }
                                }
                            //}
                            /*else {
                                echo "Not Allowed";
                                exit();
                            }*/
                        }
                        else if ($row['cardAdd'] == 0){
                            echo "user not registerd!";
                            exit();
                        }
                    }
                    else{
                        echo "RFID number not found!";
                        exit();
                    }
                }
            }
            // ENROLLMENT mode
            else if ($devMode == 0) {
            
                $sql = "SELECT * FROM user_t WHERE RFIDno=?";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_Select_card";
                    exit();
                }
                else{
                    mysqli_stmt_bind_param($result, "s", $RFID_no);
                    mysqli_stmt_execute($result);
                    $resultl = mysqli_stmt_get_result($result);
                    //The Card is available
                    if ($row = mysqli_fetch_assoc($resultl)){

                        //update the selected user
                        $sql = "SELECT isSelected FROM user_t WHERE isSelected=1";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo "SQL_Error_Select";
                            exit();
                        }
                        else{
                            mysqli_stmt_execute($result);
                            $resultl = mysqli_stmt_get_result($result);
                            
                            if ($row = mysqli_fetch_assoc($resultl)) {
                                $sql="UPDATE user_t SET isSelected=0";
                                $result = mysqli_stmt_init($conn);
                                if (!mysqli_stmt_prepare($result, $sql)) {
                                    echo "SQL_Error_insert";
                                    exit();
                                }
                                else{
                                    mysqli_stmt_execute($result);

                                    $sql="UPDATE user_t SET isSelected=1 WHERE RFIDno=?";
                                    $result = mysqli_stmt_init($conn);
                                    if (!mysqli_stmt_prepare($result, $sql)) {
                                        echo "SQL_Error_insert_An_available_card";
                                        exit();
                                    }
                                    else{
                                        mysqli_stmt_bind_param($result, "s", $RFID_no);
                                        mysqli_stmt_execute($result);

                                        echo "available";
                                        exit();
                                    }
                                }
                            }
                            else{
                                $sql="UPDATE user_t SET isSelected=1 WHERE RFIDno=?";
                                $result = mysqli_stmt_init($conn);
                                if (!mysqli_stmt_prepare($result, $sql)) {
                                    echo "SQL_Error_insert_An_available_card";
                                    exit();
                                }
                                else{
                                    mysqli_stmt_bind_param($result, "s", $RFID_no);
                                    mysqli_stmt_execute($result);

                                    echo "available";
                                    exit();
                                }
                            }
                        }
                    }
                    //The Card is new
                    else{
                        $sql="UPDATE user_t SET isSelected=0";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo "SQL_Error_insert";
                            exit();
                        }
                        else{
                            mysqli_stmt_execute($result);
                            $sql = "INSERT INTO user_t (RFIDno, regDate, isSelected) VALUES (?, ?, 1)";
                            $result = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($result, $sql)) {
                                echo "SQL_Error_Select_add";
                                exit();
                            }
                            else{

                                mysqli_stmt_bind_param($result, "ss", $RFID_no,  $CurDate);
                                mysqli_stmt_execute($result);

                                echo "succesful";
                                exit();
                            }
                        }
                    }
                }    
            }

        }
        else{
            echo "Invalid Device";
        }
    }
  }

?>