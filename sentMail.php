<?php 
ini_set("include_path", '/home/suigener/php:' . ini_get("include_path") );
require_once "Mail.php";
require_once "Mail/mime.php";

$from = $_POST['email']; //getting customer email
$to = "abgokhan@tacticus.digital";  //My email address
$subject = $_POST['subject']; //getting subject line from client
$name = $_POST['name']; //getting customer name

$headers = ['From' => $from,'To' => $to, 'Subject' => $subject];

// include text and HTML versions
$text = $name . "<br>" . $_POST['message'];
$html = $name . "<br>" . $_POST['message'];

//add  attachment
// $file = '/documents/ebook.pdf';

$mime = new Mail_mime();
$mime->setTXTBody($text);
$mime->setHTMLBody($html);

// $mime->addAttachment($file, 'text/plain');

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
    $failed = '<p>' . $mail->getMessage() . '</p>';
} else {
    $success = "Your Message was sent Successfully!";
}

?>