<?php

// Define some constants
define( "RECIPIENT_NAME", "Wisdom Cabs" );
define( "RECIPIENT_EMAIL", "reservations@wisdomcabs.com");

// Read the form values
$success = false;
$name = isset( $_POST['name'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['name'] ) : "";
$senderEmail = isset( $_POST['email'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['email'] ) : "";
$subject = isset( $_POST['subject'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['subject'] ) : "";
$message = isset( $_POST['message'] ) ? preg_replace( "/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['message'] ) : "";
$contact_no = isset($_POST['phone']);


$mail_subject = 'A contact request send by' . $name;

// $body = 'Name: '. $name . "\r\n";
// $body .= 'Email: '. $senderEmail . "\r\n";
// $body .= 'Subject: '. $subject . "\r\n";
// $body .= 'Message: '. "\r\n" . $message;
$message_content = file_get_contents('./contact_template.html');
$template_keys = array('%name%','%phone%','%message%');
$replace_with = array($name,$contact_no,$message);

$message_content = str_replace($template_keys,$replace_with,$message_content);

$body = $message_content;

// If all values exist, send the email
if ( $name && $senderEmail && $message ) {
  $recipient = RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
  $headers = "From: " . $name . " <" . $senderEmail . ">";  
  $success = mail( $recipient, $mail_subject, $body, $headers );
  echo "<p class='success'>Thanks for contacting us. We will contact you ASAP!</p>";
}

?>