<?php

// Define some constants
define( "RECIPIENT_NAME", "John Doe" );
define( "RECIPIENT_EMAIL", "mail@mail.com" );

// Read the form values
$success = false;

$name = isset( $_POST['name'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['name'] ) : "";
$senderEmail = isset( $_POST['email'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['email'] ) : "";
$phone = isset( $_POST['phone'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['phone'] ) : "";
$trip = isset( $_POST['trip'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['trip'] ) : "";
$vehicle = isset( $_POST['vehicle'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['vehicle'] ) : "";
$date = isset( $_POST['date'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['date'] ) : "";
$passenger = isset( $_POST['passenger'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['passenger'] ) : "";
$pickup = isset( $_POST['pickup'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['pickup'] ) : "";
$destination = isset( $_POST['destination'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['destination'] ) : "";
$message = isset( $_POST['message'] ) ? preg_replace( "/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['message'] ) : "";

// defining mail subject
$mail_subject = 'A Booking request send by ' . $name;
$mail_subject_user = 'Booking Request Information for ' . $name;


$body = 'Name: '. $name . "\r\n";
$body .= 'Email: '. $senderEmail . "\r\n";
$body .= 'Phone: '. $phone . "\r\n";
$body .= 'Trip: '. $trip . "\r\n";
$body .= 'Vehicle: '. $vehicle . "\r\n";
$body .= 'Date: '. $date . "\r\n";
$body .= 'Passenger: '. $passenger . "\r\n";
$body .= 'Pickup: '. "\r\n" . $pickup . "\r\n";
$body .= 'Destination: '. "\r\n" . $destination . "\r\n";
$body .= 'Message: '. "\r\n" . $message;



// If all values exist, send the email
if ( $name && $senderEmail && $message ) {
  $recipient = RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
  $headers = "From: " . $name . " <" . $senderEmail . ">";
  $success = mail( $recipient, $mail_subject, $body, $headers );


  // another confirmation email for user 
  $headers_user = "From: " . RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
  mail($senderEmail, $mail_subject_user, $body, $headers_user );

  echo "<p class='success'>Thanks for contacting us. We will contact you ASAP!</p>";
}

?>