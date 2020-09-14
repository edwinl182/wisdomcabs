<?php

// Define some constants
define( "RECIPIENT_NAME", "wisdom cabs" );
define( "RECIPIENT_EMAIL", "reservations@wisdomcabs.com");

// Read the form values
$success = false;

$name = $_POST['name'];
$contact_no = $_POST['phone'];
$vehicle_type = $_POST['vehicle_type'];
$req_date = $_POST['date'];
$report_address = $_POST['address'];
$senderEmail = $_POST['email'];

$mail_subject = 'A Booking request send by ' . $name;
$mail_subject_user = 'Booking Request Information for ' . $name;

$message_content = file_get_contents('./booking_template.html');
$template_keys = array('%name%','%phone%','%vtype%','%reqdate%','%address%');
$replace_with = array($name,$contact_no,$vehicle_type,$req_date,$report_address);

$message_content = str_replace($template_keys,$replace_with,$message_content);

$body = $message_content;


// If all values exist, send the email
if ( $name && $senderEmail && $body) {
  $recipient = RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
  $headers = "From: " . $name . " <" . $senderEmail . ">";
  $success = mail( $recipient, $mail_subject, $body, $headers );


  // another confirmation email for user 
  // $headers_user = "From: " . RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
  // mail($senderEmail, $mail_subject_user, $body, $headers_user );
  if($success == true) {
    echo "<p class='success'>Thanks for contacting us. We will contact you ASAP!</p>";
  } else {
    echo "<p class='success'>An Error occured, Please try again later</p>";
  }
}

?>