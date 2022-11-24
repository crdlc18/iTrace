
<!------------LOAD THIS TABLE IF ACTION IS VIEW ALL ADDED USERS (VIEW USERS MODAL)-------------------->

<div style="overflow: scroll;">
    <table class="table table-bordered" >
        <thead>
            <th scope="col">RFIDno</th>
            <th scope="col">First Name</th> 
            <th scope="col">Middle Name</th> 
            <th scope="col">Last Name</th> 
            <th scope="col">Gender</th>
            <th scope="col">User Role</th>
            <th scope="col"> User ID</th>
            <th scope="col">Department</th>
            <th scope="col">Email</th>
            <th scope="col">Contact Number</th>
            <th scope="col">Address</th>
            <th scope="col">Registration Date</th>
        </thead>
        <tbody>
            <tr>
              <?php
                require("db_con/connection.php");   
                $arr = ["RFIDno", "uFN", "uMN", "uLN", "uGender", "uRole",
                        "uID","uDept", "uMail", "uContactNo", "uAddress" ,"regDate"];
                $ctr=0;

                $query = mysqli_query($conn,"SELECT DISTINCT * FROM user_T WHERE cardAdd=1") or die($conn->error);

                if(mysqli_num_rows($query)>0){
                  while($content=mysqli_fetch_assoc($query)){ 
                    echo"<tr scope='row'>";

                    while ($ctr<12){
                      echo"<td>".$content[$arr[$ctr]]. "</td>";
                      $ctr++;
                    }
                    $ctr=0;  
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
  



            

