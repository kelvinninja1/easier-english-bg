<?php

$email_to = "kaloyan.kosev@easierenglish.bg, kristiana.yakimova@easierenglish.bg, stoyan.panayotov@easierenglish.bg";
$email_subject = "Искам да стана учител в EasierEnglish.BG";

extract($_POST);

$email_message = <<<EOT
Заявка, изпратена през формата "Стани учител" на EasierEnglish.BG

Име: $teacher_name
LinkedIn профил: $teacher_linkedin
Телефон: $teacher_phone
E-mail: $teacher_email

Съобщение: $teacher_message
EOT;

// create email headers
$headers = 'From: '.$teacher_email."\r\n".
'Reply-To: '.$teacher_email."\r\n" .
'X-Mailer: PHP/' . phpversion();

if( $teacher_email != "" && $teacher_message != "" ) {
	@mail($email_to, $email_subject, $email_message, $headers);
} else {
	header('Location: http://easierenglish.bg/404.php');
	exit;
}