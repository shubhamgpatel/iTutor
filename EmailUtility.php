<?php
/* Developer : Priyanka Khadilkar
  * This file is email utility. which is used for all common function for sending email.
  *
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "vendor/autoload.php";

class EmailUtility
{
    //function to send an email
    public static function SendEmail($to_address, $to_name,
                                     $subject, $body, $is_body_html = false)
    {
        $mail = new PHPMailer;
        $mail->isSMTP();
        //$mail->SMTPDebug = 2;
        $send_using_config = 1; // For local set it to 1
        switch ($send_using_config):
            case 1:
                echo "smtp";
                var_dump($is_body_html);
                $mail->Host = 'smtp.gmail.com';              // Set SMTP server
                $mail->SMTPSecure = 'tls';                   // Set encryption type
                $mail->Port = 587;                           // Set TCP port
                $mail->SMTPAuth = true;                      // Enable SMTP authentication
                break;
            case 2:
                # Host amnd Port info obtained from:
                #   Godaddy > cPanel Home > Email > cPanel Email > Mail Configuration > "Secure SSL/TLS Settings" > Outgoing Server
                $mail->Host = 'p3plcpnl0908.prod.phx3.secureserver.net';
                $mail->Port = 465;
                $mail->SMTPSecure = 'ssl';
                $mail->SMTPAuth = FALSE;

                break;
        endswitch;

        //set the smtp options
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
                'allow_self_signed' => TRUE
            )
        );
        $mail->Username = ConstantStr::EmailUSerName;
        $mail->Password = ConstantStr::EmailPassword;

        // Set From address, To address, subject, and body
        $mail->setFrom(ConstantStr::EmailUSerName, 'iTutor');
        $mail->addAddress($to_address, $to_name);
        $mail->Subject = $subject;
        $mail->AltBody = strip_tags($body);   // Body without HTML
        $mail->Body = $body;
        if ($is_body_html) {
            $mail->isHTML(true);              // Enable HTML
        }

        if (!$mail->send()) {
            return false;
            //throw new Exception('Error sending email: ' .
            // htmlspecialchars($mail->ErrorInfo));
        } else {
            return true;
        }
    }

    //Email template for the forgot password email
    public static function ForgotPasswordTemplate($firstname, $link)
    {
        $emailtemplate = "<div><b> Hi " . $firstname . ",</b></div><p> You recently requested to reset your password for your iTutor Account.Please Click the below link to reset it.</p>" .
            "<div><a href='" . $link . "'>" . $link . "</a></div><br/><br/><div>Thanks,</div><div>The iTutor Team</div>";

        return $emailtemplate;

    }

    //Email template for the job applicant.
    public static function JobApplicationTemplate($firstname, $message)
    {
        $emailtemplate = "<div><b> Hi " . $firstname . ",</b></div><p>" . $message . "</p><br/><br/><div>Thanks,</div><div>The iTutor Team</div>";

        return $emailtemplate;

    }
    public static function NewUserPasswordResetTemplate($firstname,$emailmsg)
    {
        $emailtemplate = "<div><b> Hi " . $firstname . ",</b></div><p>Your 
        registration has been succesfully completed. Below is the link
        to set your password.</p><p>".$emailmsg."</p><br/><br/><div>Thanks,</div><div>The iTutor Team</div>";

        return $emailtemplate;

    }

    //Email template for thanking users
    public static function ThankUserTemplate($firstname)
    {
        $emailtemplate = "<div
        ><b> Hi " . $firstname . ",</b></div><p>Thank you for contacting us. We will reach out to you soon.</p><br/><br/><div>Thanks,</div><div>The iTutor Team</div>";
        return $emailtemplate;
    }

}