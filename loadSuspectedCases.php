<div style="overflow: scroll;">
                <table class="table table-bordered" >
                    <thead>
                        <th scope="col">RFID_no</th>
                        <th scope="col">Full Name</th> 
                        <th scope="col">Status</th>
                        <th scope="col">Gender</th>
                        <th scope="col">User Role</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Department</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col">Address</th>
                    </thead>
                    <tbody>
                        <tr>
                          <?php
                            require("db_con/connection.php");       
                            $arr = ["RFID_no", "fName", "mName", "sName", "gender", "userRole",
                                    "roleID","Dept", "email", "contactNo", "address"];
                        
                            $query = mysqli_query($conn,"SELECT DISTINCT * FROM user_T WHERE covidStat IN (1,2)") or die($conn->error);

                            if(mysqli_num_rows($query)>0){
                              while($content=mysqli_fetch_assoc($query)){ 
                                $name= $content['fname']."  ".$content["mname"]."  ".$content["sname"];
                                echo"<tr scope='row'>";
                                    echo"<td>$content['RFID_no']</td>";
                                    echo"<td>$name</td>";
                                    echo"<td>($content['covidStat'] == '1') ? 'Suspect' : 'Close Contact';</td>";
                                    echo"<td>$content['gender']</td>";
                                    echo"<td>$content['userRole']</td>";
                                    echo"<td>$content['roleID']</td>";
                                    echo"<td>$content['dept']</td>";
                                    echo"<td>$content['email']</td>";
                                    echo"<td>$content['contactNo']</td>";
                                    echo"<td>$content['address']</td>";
                                echo"</tr>";
                              } 
                            }
                            else{
                              echo "<tr><td> No record found. </td></tr>";
                            }
                            $conn->close();
                        ?>
                      </tr>
                    </tbody>
                </table>
</div>