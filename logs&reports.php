<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logs and Reports </title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://unpkg.com/htmlincludejs"></script>
    
</head>
<?php 
   require("db_con/connection.php");
    if (!isset($_SESSION['CurrAdminName'])) {
    header("location: adminLogIn.html");
   }
?>

<body>
    <div>
        <div class="row">
            <!---navigation-->
            <div class="col">
                  <div  id="nav">
                    <include src="assets/nav.html"></include>
                  </div>
            </div>
            
            <!--logs & reports panel -->
            <div class="col">
                <h5> Logs and Reports</h5>

                <!---Logs & reports table-->
                <div class="row">
                    <div id ="tableLog">
                    </div>
                </div>
                
                <!---buttons---->
                <div class="row">
                    <button type="button" id="viewSuspectBtn"> View Suspected Cases</button>
                </div>
            </div>


            <div class="col">
                <h5>Search Filter</h5>
                 <form action="" method="post">
                    <div class="row" id=dateFilter>
                        <h6>Filter By Date:</h6>
                        <label>Select from this date: 
                            <input type="date" name="startDate" id="startDate"> 
                        </label>
                        <label>To end of this date: 
                            <input type="date" name="endDate" id="endDate"> 
                        </label>
                    </div>
                    <div class="row" id=timeFilter>
                        <h6>Filter By: 
                          <input type="radio" id="radio-one" name="timeRadio" class="timeRadio" value="timeInRadio" checked/>
                          <label for="radio-one">Time-in</label>
                          <input type="radio" id="radio-two" name="timeRadio" class="timeRadio" value="timeOutRadio" />
                          <label for="radio-two">Time-out</label>
                        </h6>

                        <label>Select from this time: 
                            <input type="time" name="startTime" id="startTime"> 
                        </label>
                        <label>To end of this time: 
                            <input type="time" name="endTime" id="endTime"> 
                        </label>
                    </div>

                    <div class="row" id="deptFilter">
                        <label>Filter by Department: <br>
                            <select class="deptSel" name="deptSel" id="deptSel">
                                <option value="allDept">All Department</option>
                                <?php
                                    $sql = "SELECT DISTINCT Dept FROM dev_T";
                                    $result = mysqli_stmt_init($conn);
                                    if (!mysqli_stmt_prepare($result, $sql)) {
                                        echo 'SQL Error';
                                    } 
                                    else{
                                        mysqli_stmt_execute($result);
                                        $resultl = mysqli_stmt_get_result($result);
                                        while ($row = mysqli_fetch_assoc($resultl)){
                                ?>
                                        <option value="<?php echo $row['Dept'];?>"><?php echo $row['Dept']; ?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </label>
                    </div>
                    
                    <div class="row" id="userFilter">
                        <label>Filter by User: <br>
                            <select class="userSel" name="userSel" id="userSel">
                                <option value="allUser">All Users</option>
                                <?php
                                    $sql = "SELECT DISTINCT userRole FROM user_T";
                                    $result = mysqli_stmt_init($conn);
                                    if (!mysqli_stmt_prepare($result, $sql)) {
                                        echo 'SQL Error';
                                    } 
                                    else{
                                        mysqli_stmt_execute($result);
                                        $resultl = mysqli_stmt_get_result($result);
                                        while ($row = mysqli_fetch_assoc($resultl)){
                                ?>
                                        <option value="<?php echo $row['userRole'];?>"><?php echo $row['userRole']; ?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </label>
                        <label>Enter the User's Name:
                            <input type="text" name="searchName" id="searchName">
                        </label>
                    </div>

                    <div class="row">
                        <label>Search by Room ID:
                            <input type="text" name="searchRoom" id="searchRoom">
                        </label>
                    </div>

                    <div class="row">
                        <button type="button" id="filterBtn" class="btn btn-success">FILTER</button>
                        <button type="reset" id="resetBtn" class="btn btn-success" onClick="window.location.reload()">RESET FILTER</button>
                    </div>
                 </form>
            </div>
        </div>
    </div>


    <include src = "assets/viewSuspectedModal.html"></include>

</body>
</html>

<script>
    /*------------- load-------------*/
    $(document).ready(function(){
        jQuery.ajax({
          url: "loadLog.php",
          type: 'POST',
          data: {select_date: 1},
          }).done(function(data) {
        
            $('#tableLog').html(data);
          });

    });



    
/*---------------------Logs and reports page action ----------*/
$(document).ready(function(){
    /*-------------------load with search filter-----------*/
    $(document).on('click', '#filterBtn',function(){

       
        var startDate=$('#startDate').val();
        var endDate=$('#endDate').val();
        var time_option=$('.timeRadio:checked').val();
        var startTime=$('#startTime').val();
        var endTime=$('#startTime').val();
        var userSel=$('#userSel option:selected').val();
        var deptSel=$('#deptSel option:selected').val();
        var roomID=$('#searchRoom').val();
        var searchName=$('#searchName').val();
      
        jQuery.ajax({
            url:'loadLog.php',
            type:'POST',
            data:{loadlog:1, startDate:startDate, endDate:endDate,
                 time_option:time_option,startTime:startTime, endTime:endTime, 
                 userSel:userSel, deptSel:deptSel, 
                 roomID:roomID, 
                 searchName:searchName,
                select_date:0},
            success:function(response){
                jQuery.ajax({
                    url:'loadLog.php',
                    type:'POST',
                    data:{startDate:startDate, endDate:endDate,  
                        time_option:time_option, startTime:startTime, endTime:endTime, 
                        userSel:userSel, deptSel:deptSel,
                        roomID:roomID, 
                        searchName:searchName,
                        select_date:0}, 
                    
                }).done(function(data){
                   
                    $('#tableLog').html(data);
                });
            }
        });
    });

    //------------------------ VIEW CASES BUTTON---------------------------------
    $(document).on('click', '#viewSuspectBtn',function(){
       
        jQuery.ajax({
            url:'suspectedCasesConfig.php',
        }).done(function(data){

            jQuery.ajax({
                url:'loadSuspectedCases.php',
                data: {viewstat:1},
            }).done(function(res){
                $('#viewSuspectedModal .modal-body').html(res);
                $('#viewSuspectedModal').modal('show');
            });
        });
    });

});

// for sending sms 
/*function notifySuspects(){
    jQuery.ajax({
        url:'sendSMS.php',
        type:'POST',
        data:{sendSMS:1},
        success:function(response){
            $('#modal .modal-title').html("Success");
            $('#modal .modal-body').html("Message sent");
            $('#modal').modal('show');
        }
    });
}*/

</script>