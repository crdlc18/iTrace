<?php

// for testing lang ito will delete 
/*$ch = curl_init();
$parameters = array(
    'apikey' => '3a8fefb43ad7950021bbfd144b70f41c', //Your API KEY
    'number' => '+639959006390',
    'message' => 'I just sent my first message with Semaphore',
    'sendername' => 'SEMAPHORE'
);
curl_setopt( $ch, CURLOPT_URL,'https://semaphore.co/api/v4/messages' );
curl_setopt( $ch, CURLOPT_POST, 1 );

//Send the parameters set above with the request
curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

// Receive response from server
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
$output = curl_exec( $ch );
curl_close ($ch);

//Show the server response
echo $output;*/



date_default_timezone_set('Asia/Manila');
$CurDate = date("Y-m-d");
require("db_con/connection.php");

//-----------------------WORKING NA

/*if(isset($_POST['sendSMS'])){
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

    //identify close contacts
     $closeContactsNo=array();
     $sql2 = "SELECT * FROM user_t UT JOIN attendlog_hist AH ON
             UT.RFID_no=AH.RFID_no  WHERE covidStat=2 AND attendDate=?";
     $result2 = mysqli_stmt_init($conn);
     if (!mysqli_stmt_prepare($result2, $sql2)) {
         
         echo $conn->error;
         exit();
     }
     else{
        
         mysqli_stmt_bind_param($result2, "s", $CurDate);
         mysqli_stmt_execute($result2); 
 
         $res2 = mysqli_stmt_get_result($result2);
         
         if (mysqli_num_rows($res2) > 0){
             while ($item = mysqli_fetch_assoc($res2)){
                  $closeContactsNo[]= $item['contactNo'];
             }
         }
         else{
             echo "No close contacts found.";
         }
     }

     if(!empty($suspectNo)){
      
       $numbers= implode('', $suspectNo);
       $arr = str_split($numbers, '13');
       $suspects=implode(',', $arr);
      
       $parameters = array (
            'apikey' => '3a8fefb43ad7950021bbfd144b70f41c', //Your API KEY
            'number' => $suspects, 
            'message'=> 'The PUP admin has recognized you as a COVID suspect. You are advised
                          to undergo self-quarantine. Please reach out to the PUP Medical Office
                          for further advisories.',
            'sendername'=> 'SEMAPHORE'
       );
    

        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL,'https://api.semaphore.co/api/v4/messages' );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        
        //Send the parameters set above with the request
        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
        
        // Receive response from server
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        //show server response
        $output = curl_exec( $ch );
      
        if(curl_errno($ch)){
            $error_msg=curl_error($ch);
            print_r($error_msg);
        }
        else{
             // echo $output; //if success
            echo 1;
        }
        curl_close ($ch);
        exit; 
    }


   if(!empty($closeContactsNo)){
      
       $numbers= implode('', $closeContactsNo);
       $arr = str_split($numbers, '13');
       $closeContacts=implode(',', $arr);
      
       $parameters = array (
            'apikey' => '3a8fefb43ad7950021bbfd144b70f41c', //Your API KEY
            'number' => $closeContacts, 
            'message'=> 'The PUP admin has identified you as a close contact of a COVID suspect. You are advised to undergo self-quarantine. Please reach out to the PUP Medical Office for further advisories.',
            'sendername'=> 'SEMAPHORE'
       );
    
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL,'https://api.semaphore.co/api/v4/messages' );
        curl_setopt( $ch, CURLOPT_POST, 1 );
        
        //Send the parameters set above with the request
        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
        
        // Receive response from server
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        //show server response
        $output = curl_exec( $ch );
       
        if(curl_errno($ch)){
            $error_msg=curl_error($ch);
            print_r($error_msg);
        }
        else{
            // echo $output; //if success
            echo 1;
        }
        curl_close ($ch);
        exit; 
    }
}*/
   
?>