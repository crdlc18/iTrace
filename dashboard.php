<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
    <div class="dashCon">
        <div class="row">

            <!---navigation-->
            <div class="col">
                  <div id="nav">
                    <include src="assets/nav.html"></include>
                  </div>
            </div>

            <!---dashboard section-->
            <div class="col">
                <h2>Dashboard</h2>
                <h3>Welcome back, Admin! </h3>
                <h5><?php echo"{$_SESSION['CurrAdminName']}"?></h5>
                
                <div class="row">
                    <div class="col" id=StudCountCon>
                        <h5>iTrace Students:</h5>
                        <p>
                            <?php
                            $query = mysqli_query($conn, "SELECT COUNT(*) AS stud FROM user_T WHERE uRole ='Student'") or die ($conn->error);
                            $data=mysqli_fetch_assoc($query);
                            echo "{$data['stud']}";
                            ?>
                        </p>
                    </div>

                    <div class="col">
                        <h5>iTrace Faculty Members:</h5>
                            <p>
                                <?php
                                $query = mysqli_query($conn, "SELECT COUNT(*) AS faculty FROM user_T WHERE uRole ='Faculty'") or die ($conn->error);
                                $data=mysqli_fetch_assoc($query);
                                echo "{$data['faculty']}";
                                ?>
                            </p>
                    </div>

                    <div class="col">
                        <h5>Suspected Cases:</h5>
                            <p>
                                <?php
                                $query = mysqli_query($conn, "SELECT COUNT(*) AS cases FROM user_T WHERE covidStat ='1'") or die ($conn->error);
                                $data=mysqli_fetch_assoc($query);
                                echo "{$data['cases']}";
                                ?>
                            </p>
                    </div>

                    <div class="col">
                        <h5>Devices:</h5>
                            <p>
                                <?php
                                $query = mysqli_query($conn, "SELECT COUNT(*) AS devices FROM Dev_T") or die ($conn->error);
                                $data=mysqli_fetch_assoc($query);
                                echo "{$data['devices']}";
                                ?>
                            </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</body>
</html>