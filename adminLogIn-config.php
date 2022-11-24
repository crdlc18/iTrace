<?php

  require("db_con/connection.php");
   
  $token='';

  if(isset($_POST['login'])){

    $pass=$_POST['pass'];
    $email=$_POST['un'];
    
    //queries the database if input uMail exists
    $query = mysqli_query($conn, "SELECT * FROM admin_T WHERE adminEmail = '$email'") or die($conn->error);
  

    if(mysqli_affected_rows($conn)>0){ 

        $item=mysqli_fetch_array($query);
        $passwrd=$item['adminPassword'];
        $email=$item['adminEmail'];
        $_SESSION['CurrAdminName'] = $item['adminFullName'];
        $_SESSION['adminID']= $item['adminNo'];
      
       
      if($pass==$passwrd){
        echo "matched";
        
      }
      else{
        echo "notMatched";
      }
         
    }
    else{
      echo "noRec";  
    }
  }

  //working but to be finalized by isabel

  /*if(isset($_POST['forgetPass'])){
    $adminEmail=$_POST['adminEmail'];
    $query = mysqli_query($conn, "SELECT * FROM admin_T WHERE adminEmail = '$adminEmail'") or die($conn->error);

    if (empty($adminEmail)){
      echo 'empty';
    }
    else{
      if(mysqli_affected_rows($conn)>0){ 
        global $token = uniqid(md5(time()));
        $insert_token = mysqli_query($conn,"INSERT INTO forget_t(uMail,token) VALUES ('$adminEmail', '$token')");
        echo 'registered';
      }
     
      else {
        echo 'unregistered';
      }
    }
  }

  if(isset($_POST['sendEmail'])){

    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'mailer/vendor/autoload.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    //uMail
    $adminEmail = $_POST['adminEmail'];

    //url
    $reset_url = "localhost/iTrace/resetPassword.php?token=$token";


    try {
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->SMTPSecure = 'tls';                                  //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->Username   = 'ellatilo1218@gmail.com';               //SMTP username
        $mail->Password   = 'aoiaxtywrqetdcjp';                     //SMTP password

        //Recipients
        $mail->setFrom('ellatilo1218@gmail.com', 'PUP iTrace');
        $mail->addAddress($adminEmail, $adminEmail);                //Add a recipient

        //Content
        $mail->isHTML(true);                                        //Set uMail format to HTML
        $mail->Subject = 'Reset Password';
        $mail->Body    = '<a href="'.$reset_url.'"> Click here </a> to reset your password.';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
  }*/
  
  $conn->close();

?>