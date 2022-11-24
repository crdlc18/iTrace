<?php
    require("db_con/connection.php");
?>

<div class="table-responsive">
    <table id="logSummary">
        <thead> 
            <th>roomID</th>
            <th>Full Name</th>
            <th>Time-in</th>
            <th>Temperature-In (Celsius)</th>
            <th>Time-out</th>
            <th>Temperature-Out (Celsius)</th>
            <th>Date</th>
        </thead>
        <tbody id="tableBody">
        <?php
            $startDate="";
            $endDate="";
            $startTime="";
            $endTime="";
            $userSel="";
           // $deptSel="";
            $roomID="";
            $searchName="";
            
            /*-------------------Search with filter---------------------------*/
            if (isset($_POST['loadlog'])) {
                //Start date filter
                if (!empty($_POST['startDate'])) {
                    $startDate = $_POST['startDate'];
                    $_SESSION['queryCondition'] = "logDate='".$startDate."'";
                }
                else{
                    $allDate=array();
                    $query=mysqli_query($conn, "SELECT DISTINCT logDate FROM logs_t") or die ($conn->error);
                    if(mysqli_num_rows($query)>0){

                        while($attrib=mysqli_fetch_assoc($query)){ 
                            array_push($allDate,$attrib['logDate']);
                        }

                        $_SESSION['queryCondition'] = 'logDate IN ("' . implode('","', $allDate) . '")';
                    }
                    
                }
                //End date filter
                if (!empty($_POST['endDate'])) {
                    $endDate = $_POST['endDate'];
                    $_SESSION['queryCondition'] = "logDate BETWEEN '".$startDate."' AND '".$endDate."'";
                }
                //Time-In filter
                if ($_POST['time_option'] == "timeInRadio") {
                    //Start time filter
                    if (!empty($_POST['startTime'])&& empty($_POST['endTime'])) {
                        $startTime = $_POST['startTime'];
                        $_SESSION['queryCondition'] .= " AND timeIn='".$startTime."'";
                    }
                    elseif (!empty($_POST['startTime'])&& !empty($_POST['endTime'])) {
                        $startTime = $_POST['startTime'];
                    }
                    //End time filter
                    if (!empty($_POST['endTime'])) {
                        $endTime = $_POST['endTime'];
                        $_SESSION['queryCondition'] .= " AND timeIn BETWEEN '".$startTime."' AND '".$endTime."'";
                    }
                }
                //Time-out filter 
                if ($_POST['time_option'] == "timeOutRadio") {
                    //Start time filter
                    if (!empty($_POST['startTime']) && empty($_POST['endTime'])) {
                        $startTime = $_POST['startTime'];
                        $_SESSION['queryCondition'] .= " AND timeOut='".$startTime."'";
                    }
                    elseif (!empty($_POST['startTime']) && !empty($_POST['endTime'])) {
                        $startTime = $_POST['startTime'];
                    }
                    //End time filter
                    if (!empty($_POST['endTime'])) {
                        $endTime = $_POST['endTime'];
                        $_SESSION['queryCondition'] .= " AND timeOut BETWEEN '".$startTime."' AND '".$endTime."'";
                    }
                }

                //Department filter
              /*  if ($_POST['deptSel'] != 'allDept') {
                    $deptSel = $_POST['deptSel'];
                    $_SESSION['queryCondition'] .= " AND uDept='".$deptSel."'";
                }*/

                //User Selection
                if ($_POST['userSel'] != 'allUser') {
                    $userSel = $_POST['userSel'];
                    $_SESSION['queryCondition'] .= " AND uRole='".$userSel."'";
                   
                }

                if(!empty($_POST['searchName'])){
                    $searchName = $_POST['searchName'];
                    $_SESSION['queryCondition'] .= " AND fullName LIKE fullName LIKE '%$searchName%'";
                }

                if(!empty($_POST['searchRoom'])){
                    $roomID = $_POST['searchName'];
                    $_SESSION['queryCondition'] .= " AND roomID ='$roomID'";
                }
            

            }

            /*------------------------- No search filter----------------------------------*/
            if ($_POST['select_date'] == 1) {
                $startDate = date("2022-11-22");
                $sql = "SELECT * FROM user_t UT join logs_t A on UT.RFIDno=A.RFIDno ORDER BY logID DESC";
                
            }
            else{
                $sql = "SELECT * FROM user_t UT join logs_t A on UT.RFIDno = A.RFIDno
                        WHERE ".$_SESSION['queryCondition']." ORDER BY logID DESC";
                
            }
            $result = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($result, $sql)) {
                echo '<p class="error">SQL Error</p>';
            }
            else{
                mysqli_stmt_execute($result);
                $resultl = mysqli_stmt_get_result($result);
                
                if (mysqli_num_rows($resultl) > 0){
                    while ($row = mysqli_fetch_assoc($resultl)){
                ?>
                        <tr>
                        <td><?php echo $row['roomID'];?></td>
                        <td><?php echo $row['fullName'];?></td>
                        <td><?php echo $row['timeIn'];?></td>
                        <td><?php echo $row['tempIn'];?></td>
                        <td><?php echo $row['timeOut'];?></td>
                        <td><?php echo $row['tempOut'];?></td>
                        <td><?php echo $row['logDate'];?></td>
                        </tr>
                <?php
                }
                }
                else{  ?>
                    <td>No Logs for today</td>
                    <?php
                }
            }              
      ?>
    </tbody>
  </table>
</div>
