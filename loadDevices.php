
<div class="table-responsive">
    <table id="devicesTbl">
        <thead> 
            <th>RoomID</th>
            <th>Department</th>
            <th>Device Mode</th>
            <th>Device Configuration</th>
        </thead>
        <tbody>
            <tr>
                <?php
                    require("db_con/connection.php");       
                    $query=mysqli_query($conn, "SELECT * FROM dev_T") or die ($conn->error);

                    if(mysqli_num_rows($query)>0){
                        echo '<form action="" method="POST" enctype="multipart/form-data">';
                        while($row=mysqli_fetch_assoc($query)){ 
                                                    
                        echo"<tr>";

                            $radio1 = ($row["DevMode"] == 0) ? "checked" : "" ;
                            $radio2 = ($row["DevMode"] == 1) ? "checked" : "" ;

                            $de_mode = '<div class="mode_select">
                            <input type="radio" id="'.$row["RoomID"].'-one" name="'.$row["RoomID"].'" class="mode_sel" data-id="'.$row["RoomID"].'" value="0" '.$radio1.'/>
                                <label for="'.$row["RoomID"].'-one">Enrollment</label>
                            <input type="radio" id="'.$row["RoomID"].'-two" name="'.$row["RoomID"].'" class="mode_sel" data-id="'.$row["RoomID"].'" value="1" '.$radio2.'/>
                                <label for="'.$row["RoomID"].'-two">Attendance</label>
                            </div>';

                            echo'<td>'.$row['RoomID'].'</td>
                                <td>'.$row['Dept'].'</td>
                                <td>'.$de_mode.'</td>
                                <td><button type="button" class="dev_del btn btn-danger" id="del_'.$row["RoomID"].'" data-id="'.$row["RoomID"].'" 
                                    title="Delete this device"><span class="glyphicon glyphicon-trash"></span></button>
                                </td>';
                        echo"</tr>";
                                        
                        } 
                        echo '</form>';
                    }
                    else{
                        echo "<tr><td> No devices. </td></tr>";
                    }
                ?>
            </tr>
        </tbody>
    </table>
</div>
 