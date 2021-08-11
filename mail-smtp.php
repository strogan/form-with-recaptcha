<?php 

use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

 $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
 
 $form_subject = trim($_POST["form_subject"]);
 
 foreach ( $_POST as $key => $value ) {
		if ( $value != "" && $key != "project_name" && $key != "admin_email" && $key != "form_subject" && $key != "recaptcha_response" && $key != "cookie" && $key != "loadgmttime" && $key != "dformat") {
			$message .= "
			" . ( ($c = !$c) ? '<tr>':'<tr style="background-color: #f8f8f8;">' ) . "
				<td style='padding: 10px; border: #e9e9e9 1px solid;'><b>$key</b></td>
				<td style='padding: 10px; border: #e9e9e9 1px solid;'>$value</td>
			</tr>
			";
		}
	}
	
	
	$message = "<table style='width: 100%;'>$message</table>";

 
 
 try {
        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = '333';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = '111';                 // SMTP username
        $mail->Password = '222';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                           // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('from@domain.com');
        $mail->addAddress('admin@domain.com');     // Add a recipient



        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $form_subject;
        $mail->Body    = $message;

        $mail->send();
        echo 'Message has been sent';
        //header('Location: http://www.example.com/contact.php');
        exit();
    } catch (Exception $e) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
    ?>
