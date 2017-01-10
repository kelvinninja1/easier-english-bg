<?php

$email_to = "kaloyan.kosev@easierenglish.bg, kristiana.yakimova@easierenglish.bg, stoyan.panayotov@easierenglish.bg";
$email_subject = "Изпратена молба за урок през EasierEnglish.BG";

extract($_POST);

$email_message = <<<EOT
Молба, изпратена през формата "Молба за урок" на EasierEnglish.BG

Име: $request_contact_name
E-mail: $request_contact_email

Съобщение: $request_message
EOT;

// create email headers
$headers = 'From: '.$request_contact_email."\r\n".
'Reply-To: '.$request_contact_email."\r\n" .
'X-Mailer: PHP/' . phpversion();

if( $request_contact_email != "" && $request_message != "" ) {
	@mail($email_to, $email_subject, $email_message, $headers);
} else {
	header('Location: http://easierenglish.bg/404.php');
	exit;
}