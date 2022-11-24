<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devices </title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://unpkg.com/htmlincludejs"></script>
 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.js"></script>
</head>
<?php 
   require("db_con/connection.php");
    if (!isset($_SESSION['CurrAdminName'])) {
    header("location: adminLogIn.html");
   }
?>

<body>

    <div class="devCon">
        <div class="row">

            <!---navigation-->
            <div class="col">
                  <div  id="nav">
                    <include src="assets/nav.html"></include>
                  </div>
            </div>

            <div class="col">
                <!--Currentt devices-->
                <h5>List of Devices</h5>
                
                <div class="row">
                    <div id ="tableSummary">
                    </div>
                </div>
                <div class="row">
                    <button type="button" id="addDeviceBtn" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addDeviceForm"  >ADD DEVICE</button>
                </div>
            </div>

        </div>
    </div>

</body>
<!--- Pop up for add new device-->
<div class="modal fade" id="addDeviceForm" tabindex="-1" style="z-index:1051" role="dialog" aria-labelledby="addDeviceModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">New Device Information</h5>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="post" enctype="multipart/form-data">
            <label>Room Number <input type="text" name="adRoomID "id="adRoomID"></label>
        </div>
        <div class="modal-footer">
          <button type="button" id="add_dev"class="btn btn-success">ADD</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCEL</button>
        </form>
        </div>
      </div>
    </div>
</div>

 <!-- Warning Modal-->
 <include src = "assets/warningModal.html"></include>

</html>
<script>

    /*---------first load-----------------------*/
    $(document).ready(function(){
		    jQuery.ajax({
		      	url: "navDevices-config.php",
		      	type: 'POST',
		      	data: {dev_up:1}
	      	}).done(function(data) {
	  			$('#tableSummary').html(data);
    	});
	});


  
    /*---------------------Load Devices Page with Modification ----------*/
    $(document).ready(function(){

        /*-------- Add device----------------------*/
        $(document).on('click', '#add_dev', function(){
            var dev_room= $('#adRoomID').val();
        

            jQuery.ajax({
                    url:'navDevices-config.php',
                    data: {dev_add:1, dev_room:dev_room},
                    type:'post',
                    success: function(data){
                        if(data==0 ){
                            $('#modal .modal-title').html("..Ooppss");
                            $('#modal .modal-body').html("Please input the room number.");
                            $('#modal').modal('show');
                        }
                        else if (data==2) {
                            $('#modal .modal-title').html("Room number already exists");
                            $('#modal .modal-body').html("Please input unique room number.");
                            $('#modal').modal('show');
                        }
                        else if (data==3){
                        
                            $('#adRoomID').val('');
                            $('#addDeviceForm').modal('hide');
                            jQuery.ajax({
                                url: "navDevices-config.php",
                                type: 'POST',
                                data: {dev_up:1}
                                }).done(function(data) {
                                $('#tableSummary').html(data);
                            });
                        }
                        else{
                            $('#tableSummary').html(data);
                        }
                    }
            });
        });

        /*--------------------------Delete Device-----------------------*/
        $(document).on('click', '.dev_del', function(){
            var el = this;
            var deleteRoomID = $(this).data('id');
            

            bootbox.confirm("Do you really want to delete this Device?", function(result) {
                if(result){
                        // AJAX Request
                        jQuery.ajax({
                            url: 'navDevices-config.php',
                            type: 'POST',
                            data: {dev_del: 1, deleteRoomID: deleteRoomID },
                            success: function(response){
                                // Removing row from HTML Table
                                if(response == 1){
                                    $(el).closest('tr').css('background','#d9534f');
                                    $(el).closest('tr').fadeOut(800,function(){
                                        $(this).remove();
                                    });
                                    
                                    jQuery.ajax({
                                        url: "navDevices-config.php",
                                        type: 'POST',
                                        data: {dev_up:1},
                                        }).done(function(data) {
                                        $('#tableSummary').html(data);
                                    });
                                }
                                else{
                                    bootbox.alert('Device not deleted.');
                                }
                            }
                        });
                    }
                    else{
                        jQuery.ajax({
                            url: "navDevices-config.php",
                            type: 'POST',
                            data: {dev_up:1},
                            }).done(function(data) {
                            $('#tableSummary').html(data);
                        });
                }
                
            });
        });

        /*-----------------------Device Mode Selection-----------------------*/
        $(document).on('click', '.mode_sel', function(){
            var el = this;
            var dev_mode = $(this).attr("value");
            var dev_id = $(this).data('id');

            bootbox.confirm("Do you really want to change this Device Mode?", function(result) {
                if(result){
                    // AJAX Request
                    jQuery.ajax({
                    url: 'navDevices-config.php',
                    type: 'POST',
                    data: { dev_mode_set: 1, dev_mode: dev_mode, dev_id: dev_id},
                    success: function(response){
                            if(response == 1){
                                $(el).closest('tr').css('background','#5cb85c');
                                $(el).closest('tr').fadeOut(800,function(){
                                    $(this).show();
                                });

                                jQuery.ajax({
                                    url: "navDevices-config.php",
                                    type: 'POST',
                                    data: {dev_up:1}
                                    }).done(function(data) {
                                    $('#tableSummary').html(data);
                                });
                            }
                            else{
                                bootbox.alert('Device mode not changed.');
                            }
                        }
                    });
                }
                else{
                    jQuery.ajax({
                        url: "navDevices-config.php",
                        type: 'POST',
                        data: {dev_up: 1},
                        }).done(function(data) {
                        $('#tableSummary').html(data);
                    });
                }
            });
        });
    }); 
</script>


