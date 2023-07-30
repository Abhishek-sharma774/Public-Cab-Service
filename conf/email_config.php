<?php 
use PHPMailer\PHPMailer\PHPMailer;


function email($email,$status,$body)
{
                        
                  require_once "PHPMailer/PHPMailer.php";
                  require_once "PHPMailer/SMTP.php";
                  require_once "PHPMailer/Exception.php";


                  $mail = new PHPMailer();

                   $mail->CharSet =  "utf-8";
                   
                  $mail->IsSMTP();
                  // enable SMTP authentication
                  $mail->SMTPAuth = true;   
                  // email username
                  $mail->Username = "interns@jsisoftwaresolutions.in";
                  // email password
                  $mail->Password = "Deepak@2913";

                  $mail->SMTPSecure = "ssl";  
                  // sets email as the SMTP server
                  $mail->Host = "mail.jsisoftwaresolutions.in";
                  // set the SMTP port for the email server
                  $mail->Port = "465";

                  $mail->From='interns@jsisoftwaresolutions.in';

                  $mail->IsHTML(true);

                  $mail->FromName='Lift UP';

                  $mail->AddAddress($email);

                  $mail->Subject  =  'Lift Up Ride Status: '.$status;

                  $mail->IsHTML(true);

                  $mail->Body    = $body;

                  $mail->send();

}

?>