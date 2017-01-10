<?php

$email_to = "kaloyan.kosev@easierenglish.bg, kristiana.yakimova@easierenglish.bg, stoyan.panayotov@easierenglish.bg";
extract($_POST);

$email_subject = "Въпрос към урок: " . $topic;

$email_message = <<<EOT
Въпрос, изпратен през формата за въпроси на EasierEnglish.BG

Урок: $topic
Име: $contact_name
Град: $contact_city
Възраст: $contact_age
E-mail: $contact_email

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