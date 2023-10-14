<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor\autoload.php';
function sendEmail()
{
    $mail = new PHPMailer(TRUE);

    try {
        $mail->setFrom('rubenlawkwang11@gmail.com', 'Rubs');
        $mail->addAddress($_POST["txtemail"], 'Username');

        $mail->Subject = 'Welcome to Slow And Furious';
        $mail->isHTML(TRUE);
        $mail->Body = '<html>Your account has been activated, you may now join the Slow and Furious. Click on the link to <strong><a href="http://localhost/slowandfutious/client/login.php">login</a></strong>.</html>';
        $mail->AltBody = 'In case the HTML does not work.';

        $fn = $_FILES['mprofile']['name'];
        $mail->addAttachment("../upload" . DIRECTORY_SEPARATOR. $fn);

        // SMTP parameters
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = TRUE;
        $mail->SMTPSecure = 'tls';
        $mail->Username = 'rubenlawkwang11@gmail.com';
        $mail->Password = 'dtivbkkyiljjcsgj';
        $mail->Port = 587;

        // Add the following SMTP options
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ),
        );

        $retval = $mail->send();
        if ($retval == true) {
            $_SESSION['successmsg'] = "Register Successful....";
        } else {
            $_SESSION['errormsg'] = "Email could not be sent...";
        }
    } catch (Exception $e) {
        echo $e->errorMessage();
    } catch (\Exception $e) {
        echo $e->getMessage();
    }


    
}