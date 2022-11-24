<?php 

   /// ------------------------------------TO BE CHECKED--------------------------------------------------//
    require("db_con/connection.php");

    date_default_timezone_set('Asia/Manila');
    $CurDate = date("Y-m-d");

if(isset($_POST['viewstat'])){
        // identify suspect/s
        $sql1 = "SELECT * FROM logs_t WHERE (tempIn>=37.85 OR tempOut>=37.85) AND logDate=?";
        $result1 = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($result1, $sql1)) {
            
            echo "SQL_Error_Find_Suspect" .$conn->error;
            exit();
        }
        else{
           
            mysqli_stmt_bind_param($result1, "s", $CurDate);
            mysqli_stmt_execute($result1); 

            $res1 = mysqli_stmt_get_result($result1);
            if (mysqli_num_rows($res1) > 0){

                while ($row = mysqli_fetch_assoc($res1)){
                    $suspect = $row['RFIDno'];

                    //for testing only , delete if final
                    //echo"<br> Suspect: $suspect <br>";
                   
                    
                    //update covid status of the suspect/s
                   $sql2="UPDATE user_t SET covidStat=1 WHERE RFIDno = ?";
                    $result2 = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($result2, $sql2)) {
                        echo "SQL_Error_Update_CovidStat" .$conn->error;
                        exit();
                    }
                    else{
                        mysqli_stmt_bind_param($result2, "s", $suspect);

                        mysqli_stmt_execute($result2);

                         //get the date 2 days prior to suspects' identification
                        $date=date_create("$CurDate");
                        date_sub($date,date_interval_create_from_date_string("40 days"));
                        $startDate= date_format($date,"Y-m-d");
                    
                        //get the rooms where the suspect/s entered from 2 days prior to their identification
                        $sql3 = "SELECT roomID, timeIn, timeOut FROM logs_t ATT JOIN user_t UT 
                        ON ATT.RFIDno = UT.RFIDno WHERE ATT.RFIDno=? AND logDate BETWEEN ? AND ?";


                        $result3 = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result3, $sql3)) {
                            echo "SQL_Error_Affected_Rooms" .$conn->error;
                            exit();
                        }
                        else{
                            mysqli_stmt_bind_param($result3, "sss", $suspect, $startDate, $CurDate);
                            mysqli_stmt_execute($result3); 
                            $res3 = mysqli_stmt_get_result($result3);

                            if (mysqli_num_rows($res3) > 0){

                                while ($item = mysqli_fetch_assoc($res3)){
                                    //for testing only , delete if final
                                    // echo "<br> Affected Room/s <br> {$item['roomID']} , {$item['timeIn']} , {$item['timeOut']}<br>";
                                    
                                     $room = $item['roomID'];
                                     $in = $item['timeIn'];
                                     $out = $item['timeOut'];
                                     // select records on the same room within the suspect's time duration of occupancy (>=15 mins exposure)
                                    $sql4 = "SELECT ATT.RFIDno, roomID, timeIn, timeOut FROM logs_t ATT JOIN user_t UT ON ATT.RFIDno = UT.RFIDno
                                              WHERE covidStat!=1 AND roomID =? 
                                              AND logDate BETWEEN ? AND ? 
                                              AND timeIn>=? AND timeOut= ?";
     
                                    $result4 = mysqli_stmt_init($conn);
                                    if (!mysqli_stmt_prepare($result4, $sql4)) {
                                         echo "SQL_Error_Close_Contact" .$conn->error;
                                         exit();
                                    }
                                    else{
                                         mysqli_stmt_bind_param($result4, "sssss", $room , $startDate, 
                                                                 $CurDate, $in, $out);
                                         mysqli_stmt_execute($result4);
                                         $res4 = mysqli_stmt_get_result($result4);

                                        if (mysqli_num_rows($res4) > 0){
                                            while ($data = mysqli_fetch_assoc($res4)){
                                                $closeContact=$data['RFIDno'];

                                                  //for testing only , delete if final
                                               // echo "<br> Close Contact/s <br> {$data['RFIDno']}, {$data['roomID']} , 
                                                       // {$data['timeIn']} , {$data['timeOut']} <br>";


                                                 //update covid status of the close contacts
                                                $sql5="UPDATE user_t SET covidStat=2 WHERE RFIDno = ?";
                                                $result5 = mysqli_stmt_init($conn);

                                                if (!mysqli_stmt_prepare($result5, $sql5)) {
                                                    echo "SQL_Error_Update_CovidStat" .$conn->error;
                                                    exit();
                                                }
                                                else{
                                                    mysqli_stmt_bind_param($result5, "s", $closeContact);
                                                    mysqli_stmt_execute($result5);
                                                    mysqli_stmt_close($result5); 
            	                                    mysqli_close($conn);
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            else{
                echo '0';
            }
        }
}
    
?>