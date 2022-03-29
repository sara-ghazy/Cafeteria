<?php

namespace CAFETERIA\MODELS;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class EmailModel extends Model 
{


   public static function sendEmail($email){
      
         $mail = new PHPMailer();
         $mail->SMTPDebug = 2;
         $mail->CharSet = 'UTF-8';
         $mail->Encoding = 'base64';
         //$mail->isSMTP();
         $mail->Mailer = "smtp";
         $mail->Host = 'smtp.gmail.com';
         $mail->Port       = 465;
         $mail->SMTPSecure = 'ssl';
         $mail->SMTPAuth   = true;
         $mail->Username = 'saraghazy434@gmail.com';
         $mail->Password = '';
   
        $mail->setFrom('saraghazy434@gmail.com', 'sara');
        $mail->addAddress($email);     

        $mail->isHTML(true);                                 
        $mail->Subject = 'Reset Password';
        $mail->Body    = "<h3> Hello </h3> , <br> new password is 3333";

        if($mail->send())
        {
            return true;
            
        }else
        {

            return false;
            
        }
       

}

}



?>