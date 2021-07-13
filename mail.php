<?php







$method = $_SERVER['REQUEST_METHOD'];

//Script Foreach 
// 2 SECRETCODE+ 1 form email
$c = true;
if ( $method === 'POST' ) {

	$project_name = trim($_POST["project_name"]);
	$admin_email  = trim($_POST["admin_email"]);
	$form_subject = trim($_POST["form_subject"]);
	
	
	$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
$recaptcha_secret = 'SECRETCODE'; // Insert your secret key here
$recaptcha_response = $_POST['recaptcha_response'];
 
// Make the POST request
$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);


$recaptcha = json_decode($recaptcha);
// Take action based on the score returned
if ($recaptcha->success == true && $recaptcha->score >= 0.5 && $recaptcha->action == 'contact') {
   // This is a human. Insert the message into database OR send a mail
   foreach ( $_POST as $key => $value ) {
		if ( $value != "" && $key != "project_name" && $key != "admin_email" && $key != "form_subject" && $key != "recaptcha_response" ) {
			$message .= "
			" . ( ($c = !$c) ? '<tr>':'<tr style="background-color: #f8f8f8;">' ) . "
				<td style='padding: 10px; border: #e9e9e9 1px solid;'><b>$key</b></td>
				<td style='padding: 10px; border: #e9e9e9 1px solid;'>$value</td>
			</tr>
			";
		}
	}

} else {
   // Score less than 0.5 indicates suspicious activity. Return an error
   $error_output = "Something went wrong. Please try again later2";
}
	

	
} else if ( $method === 'GET' ) {

	$project_name = trim($_GET["project_name"]);
	$admin_email  = trim($_GET["admin_email"]);
	$form_subject = trim($_GET["form_subject"]);
	
	
	
	
	$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
$recaptcha_secret = 'SECRETCODE'; // Insert your secret key here
$recaptcha_response = $_POST['recaptcha_response'];
 
// Make the POST request
$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);



$recaptcha = json_decode($recaptcha);
// Take action based on the score returned
if ($recaptcha->success == true && $recaptcha->score >= 0.5 && $recaptcha->action == 'contact') {
   	foreach ( $_GET as $key => $value ) {
		if ( $value != "" && $key != "project_name" && $key != "admin_email" && $key != "form_subject" ) {
			$message .= "
			" . ( ($c = !$c) ? '<tr>':'<tr style="background-color: #f8f8f8;">' ) . "
				<td style='padding: 10px; border: #e9e9e9 1px solid;'><b>$key</b></td>
				<td style='padding: 10px; border: #e9e9e9 1px solid;'>$value</td>
			</tr>
			";
		}
	}
	

	
	
} else {
   // Score less than 0.5 indicates suspicious activity. Return an error
   $error_output = "Something went wrong. Please try again later2";
}
	
	
	
}

$message = "<table style='width: 100%;'>$message</table>";

function adopt($text) {
	return '=?UTF-8?B?'.Base64_encode($text).'?=';
}

$headers = "MIME-Version: 1.0" . PHP_EOL .
"Content-Type: text/html; charset=utf-8" . PHP_EOL .
'From: '.adopt($project_name). "<admin@domain>" . PHP_EOL .
'Reply-To: '.$admin_email.'' . PHP_EOL;

mail($admin_email, adopt($form_subject), $message, $headers );