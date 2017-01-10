<?php

$email_to = "kaloyan.kosev@easierenglish.bg, kristiana.yakimova@easierenglish.bg, stoyan.panayotov@easierenglish.bg";
$email_subject = "Съобщение от контактната форма на EasierEnglish.BG";

extract($_POST);

$email_message = <<<EOT
Съобщение, изпратено през контактната форма на EasierEnglish.BG

Име: $contact_name
E-mail: $contact_email
Относно: $contact_subject

Съобщение: $contact_message
EOT;

// create email headers
$headers = 'From: '.$contact_email."\r\n".
'Reply-To: '.$contact_email."\r\n" .
'X-Mailer: PHP/' . phpversion();

if( $contact_email != "" && $contact_message != "" ) {
	@mail($email_to, $email_subject, $email_message, $headers);
} else {
	header('Location: http://easierenglish.bg/404.php');
	exit;
}