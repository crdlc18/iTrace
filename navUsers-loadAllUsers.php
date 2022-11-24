<!---------- LOAD THIS ACTION/TABLE IF ACTION IS TO DISPLAY ALL USERS (ADDED OR NOT) (MAIN MANAGE USERS PAGE)------>

<div class="table-responsive">
<table id="devicesTbl">
    <thead> 
        <th>RFID_no</th>
        <th>First Name</th> 
        <th>Middle Name</th> 
        <th>Last Name</th> 
        <th>Gender</th>
        <th>User Role</th>
        <th>User ID</th>
        <th>Department</th>
        <th>Email</th>
        <th>Contact Number</th>
        <th>Address</th>
    </thead>
    <tbody>
        <tr>
            <?php
            
            require("db_con/connection.php"); 


                if (isset($_POST['name'])) { // if loading all users table is based on the search field
                    $searchName = $_POST['name']; //store the name to be searched
                    $query=mysqli_query($conn, "SELECT * FROM user_T WHERE fName LIKE '%$searchName%' OR
                                                mName LIKE '%$searchName%' OR sName LIKE '%$searchName%'
                                                ORDER BY RFID_no DESC") or die ($conn->error);
                }
                else{ 
                    $query=mysqli_query($conn, "SELECT * FROM user_T ORDER BY RFID_no DESC") or die ($conn->error);
                }
                
                
                if(mysqli_num_rows($query)>0){
                    
                    while($attrib=mysqli_fetch_assoc($query)){ 
                                                
                        echo"<tr>";
                        echo"<td>";
                            if($attrib['isSelected'] ==1){
                                //highlight row selected
                                echo "<span><i class='glyphicon glyphicon-ok' title='The selected UID'></i></span>";
                            }

                            $RFID_no= $attrib['RFID_no'];

                            echo"<form method='post' action=''>
                                        <button type='button' class='selectedBtn' id='{$RFID_no}'title ='select this UID'> $RFID_no </button>
                                    </form>";
                            echo"<td>";
                            echo"<td>{$attrib['fName']}</td>
                                <td>{$attrib['mName']}</td>
                                <td>{$attrib['sName']}</td>
                                <td>{$attrib['gender']}</td>
                                <td>{$attrib['userRole']}</td>
                                <td>{$attrib['roleID']}</td>
                                <td>{$attrib['dept']}</td>
                                <td>{$attrib['email']}</td>
                                <td>{$attrib['contactNo']}</td>
                                <td>{$attrib['address']}</td>
                                ";
                        echo"</tr>";            
                    } 
                }
                else{
                    echo "<tr><td> No User. </td></tr>";
                }
            ?>
        </tr>
    </tbody>
    </table>
</div>