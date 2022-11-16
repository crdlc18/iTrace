<?php

date_default_timezone_set('Asia/Manila');
$CurDate = date("Y-m-d");
require("db_con/connection.php");

//if(isset($_POST['sendSMS'])){
    // identify suspect
    $suspectNo=array();
    $sql1 = "SELECT * FROM user_t UT JOIN attendlog_hist AH ON
            UT.RFID_no=AH.RFID_no  WHERE covidStat=1 AND attendDate=?";
    $result1 = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result1, $sql1)) {
        
        echo $conn->error;
        exit();
    }
    else{
       
        mysqli_stmt_bind_param($result1, "s", $CurDate);
        mysqli_stmt_execute($result1); 

        $res1 = mysqli_stmt_get_result($result1);
        
        if (mysqli_num_rows($res1) > 0){
           
            while ($item = mysqli_fetch_assoc($res1)){
                 $suspectNo[]= $item['contactNo'];
            }
        }
        else{
            echo "No suspects found.";
        }
    }

   /* //identify close contacts
     $closeContactsNo=array();
     $sql1 = "SELECT * FROM user_t UT JOIN attendlog_hist AH ON
             UT.RFID_no=AH.RFID_no  WHERE covidStat=2 AND attendDate=?";
     $result1 = mysqli_stmt_init($conn);
     if (!mysqli_stmt_prepare($result1, $sql1)) {
         
         echo $conn->error;
         exit();
     }
     else{
        
         mysqli_stmt_bind_param($result1, "s", $CurDate);
         mysqli_stmt_execute($result1); 
 
         $res1 = mysqli_stmt_get_result($result1);
         
         if (mysqli_num_rows($res1) > 0){
             $ch = curl_init();
 
             while ($item = mysqli_fetch_assoc($res1)){
                  $closeContactsNo[]= $item['contactNo'];
             }
         }
         else{
             echo "No close contacts found.";
         }
     }*/

     if(!empty($suspectNo)){

        

       $parameters = [
            'apikey' => '300d7ae7eac75ab9b1535a3d7842bef1', //Your API KEY
            'number' => [], 
            'message' => 'The PUP admin has recognized you as a COVID suspect. You are advised
                          to undergo self-quarantine. Please reach out to the PUP Medical Office
                          for further advisories.',
            'sendername' => 'SEMAPHORE'
       ];
    
        
        foreach($suspectNo as $recipient){
            $parameters['number'][]=['recipient'=>$recipient];
            
        }
    
        echo $parameters;
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL,'https://api.semaphore.co/api/v4/messages' );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        
        //Send the parameters set above with the request
        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
        
        // Receive response from server
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        //show server response
        $output = curl_exec( $ch );
        echo $output;
        if(curl_errno($ch)){
            $error_msg=curl_error($ch);
            print_r($error_msg);
        }
        curl_close ($ch);
        exit; 
    }
//}
   


/*$parameters = array(
    'apikey' => '1Kw5dWvvnPu2pv7abgxyfnLHWjZxGhnwrp', //Your API KEY
    'number' => '$recipient', 
    'message' => 'I just sent my first message with Semaphore',
    'sendername' => 'SEMAPHORE'
);
curl_setopt( $ch, CURLOPT_URL,'https://api.semaphore.co/api/v4/messages' );
curl_setopt( $ch, CURLOPT_POST, 1 );

//Send the parameters set above with the request
curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

// Receive response from server
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
//show server response
$output = curl_exec( $ch );
echo $output;
if(curl_errno($ch)){
    $error_msg=curl_error($ch);
    print_r($error_msg);
}
curl_close ($ch);
exit; */
?>