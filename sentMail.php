<?php 
ini_set("include_path", '/home/suigener/php:' . ini_get("include_path") );
include('Mail.php');
require_once './vendor/autoload.php';

$from = "info@tacticus.digital"; //getting customer email
$to = $_POST['email'] ;  //My email address
$subject = $_POST['subject']; //getting subject line from client
$name = $_POST['name']; //getting customer name

$headers = ['From' => $from,'To' => $to, 'Subject' => $subject];

// include text and HTML versions
$text = 'Hi there, we are happy to confirm your request. Please check the ebook in the attachment.';
$html = 'Hi there, we are happy to <br>confirm your booking.</br> Please check the ebook in the attachment.';

//add  attachment
$file = '/documents/ebook.pdf';

$mime = new Mail_mime();
$mime->setTXTBody($text);
$mime->setHTMLBody($html);
$mime->addAttachment($file, 'text/plain');

$body = $mime->get();
$headers = $mime->headers($headers);

//STMP Setttings
$host = 'ssl://mail.tacticus.digital';
$username = 'info@tacticus.digital'; // username from email provider
$password = 'B4400.879g'; // password for the email
$port = '465';

$smtp = Mail::factory('smtp', [
  'host' => $host,
  'auth' => true,
  'username' => $username,
  'password' => $password,
  'port' => $port
]);

$mail = $smtp->send($to, $headers, $body);

if (PEAR::isError($mail)) {
    echo('<p>' . $mail->getMessage() . '</p>');
} else {
    echo('<p>Message successfully sent!</p>');
}

?>