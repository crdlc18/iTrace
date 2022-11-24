<?php 
    require("db_con/connection.php");

    if(isset($_POST['dev_up'])){
            echo '<div class="table-responsive">
                <table id="devicesTbl">
                    <thead> 
                        <th>roomID</th>
                        <th>Device Mode</th>
                        <th>Device Configuration</th>
                    </thead>
                    <tbody>
                        <tr>';
                            
                            // require("db_con/connection.php");       
                                $query=mysqli_query($conn, "SELECT * FROM dev_T") or die ($conn->error);

                                if(mysqli_num_rows($query)>0){
                                    echo '<form action="" method="POST" enctype="multipart/form-data">';
                                    while($row=mysqli_fetch_assoc($query)){ 
                                                                
                                    echo"<tr>";

                                        $radio1 = ($row["deviceMode"] == 0) ? "checked" : "" ;
                                        $radio2 = ($row["deviceMode"] == 1) ? "checked" : "" ;

                                        $de_mode = '<div class="mode_select">
                                        <input type="radio" id="'.$row["roomID"].'-one" name="'.$row["roomID"].'" class="mode_sel" data-id="'.$row["roomID"].'" value="0" '.$radio1.'/>
                                            <label for="'.$row["roomID"].'-one">Enrollment</label>
                                        <input type="radio" id="'.$row["roomID"].'-two" name="'.$row["roomID"].'" class="mode_sel" data-id="'.$row["roomID"].'" value="1" '.$radio2.'/>
                                            <label for="'.$row["roomID"].'-two">Attendance</label>
                                        </div>';

                                        echo'<td>'.$row['roomID'].'</td>
                                            <td>'.$de_mode.'</td>
                                            <td><button type="button" class="dev_del btn btn-danger" id="del_'.$row["roomID"].'" data-id="'.$row["roomID"].'" 
                                                title="Delete this device"><span class="glyphicon glyphicon-trash"></span></button>
                                            </td>';
                                    echo"</tr>";
                                                    
                                    } 
                                    echo '</form>';
                                }
                                else{
                                    echo "<tr><td> No devices. </td></tr>";
                                }
                            
            echo        "</tr>
                    </tbody>
                </table>
            </div>";
    }

    if (isset($_POST['dev_add'])) {

        $roomID = $_POST['dev_room'];
    
        if (empty($roomID)) {
            echo 0 ;
        }
        else{

            //check if room number exists
            $sql = "SELECT * FROM dev_T WHERE roomID=?";
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
                    $sql = "INSERT INTO dev_T (roomID) VALUES(?)";
                    $result = mysqli_stmt_init($conn);
                    if ( !mysqli_stmt_prepare($result, $sql)){
                        echo 'SQL Error';
                    }
                    else{
                        mysqli_stmt_bind_param($result, "s", $roomID);
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
    
        $sql = "DELETE FROM dev_T WHERE roomID=?";
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
        
        $sql = "UPDATE dev_T SET deviceMode=? WHERE roomID=?";
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