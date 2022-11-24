<div style="overflow: scroll;">
                
    <?php
      require("db_con/connection.php");       
      $arr = ["RFIDno", "uFN", "uMN", "uLN", "uGender", "uRole",
              "uID","uDept", "uMail", "uContactNo", "uAddress"];
  
      $query = mysqli_query($conn,"SELECT DISTINCT * FROM user_T WHERE covidStat IN (1,2)") or die($conn->error);

      if(mysqli_num_rows($query)>0){
        
        ?>

        <table class="table table-bordered" >
          <thead>
              <th scope="col">RFIDno</th>
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
                while($content=mysqli_fetch_assoc($query)){ 
                  $name=$content['uFN']."  ".$content["uMN"]."  ".$content["uLN"];
                  echo"<tr scope='row'>";
                      echo"<td>{$content['RFIDno']}</td>";
                      echo"<td>$name</td>";
                      echo"<td>";
                      echo ($content['covidStat'] == '1') ? 'Suspect' : 'Close Contact';
                      echo"</td>";
                      echo"<td>{$content['uGender']}</td>";
                      echo"<td>{$content['uRole']}</td>";
                      echo"<td>{$content['uID']}</td>";
                      echo"<td>{$content['uDept']}</td>";
                      echo"<td>{$content['uMail']}</td>";
                      echo"<td>{$content['uContactNo']}</td>";
                      echo"<td>{$content['uAddress']}</td>";
                  echo"</tr>";
                }
                ?>
            </tr>
          </tbody>
        </table>
       <?php
      }
      else{
        echo 0;
      }
      $conn->close();

      ?>              
</div>