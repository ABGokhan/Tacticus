<?php 

if(isset($_POST['submit'])) {
  $mailto = "abgokhan@tacticus.digital";  //My email address
  //getting customer data
  $name = $_POST['nameInput']; //getting customer name
  $fromEmail = $_POST['emailInput']; //getting customer email
  $subject = $_POST['subjectInput']; //getting subject line from client
  $subject2 = "Confirmation: Message was submitted successfully | tacticus.digital"; // For customer confirmation
  
  //Email body I will receive
  $message = "Cleint Name: " . $name . "\n"
  . "Client Message: " . "\n" . $_POST['messageInput'];
  
  //Message for client confirmation
  $message2 = "Dear" . $name . "\n"
  . "Thank you for contacting us. We will get back to you shortly!" . "\n\n"
  . "You submitted the following message: " . "\n" . $_POST['messageInput'] . "\n\n"
  . "Regards," . "\n" . "- HMA WebDesign";
  
  //Email headers
  $headers = "From: " . $fromEmail; // Client email, I will receive
  $headers2 = "From: " . $mailto; // This will receive client
  
  //PHP mailer function
  
  $result1 = mail($mailto, $subject, $message, $headers); // This email sent to My address
  $result2 = mail($fromEmail, $subject2, $message2, $headers2); //This confirmation email to client
  
  //Checking if Mails sent successfully
  
  if ($result1 && $result2) {

    $success = "Your Message was sent Successfully!";

} else {
    
    $failed = "Sorry! Message was not sent, Try again Later.";
}
  
}

?>