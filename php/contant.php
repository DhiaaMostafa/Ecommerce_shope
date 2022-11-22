
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
  $user = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
  $mail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $subjectmail = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
  $msg  = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
  

  $formErrors = array();
  if (strlen($user) <= 3) {
      $formErrors[] = 'Username Must Be Larger Than <strong>3</strong> Characters';
  }
  if (strlen($msg) < 10) {
      $formErrors[] = 'Message Can\'t Be Less Than <strong>10</strong> Characters'; 
  }
  

  $headers = 'From: ' . $mail . '\r\n';
  $myEmail = 'dhiaamostafe717@gmail.com';
  $subject = 'Contact Form';
  
  if (empty($formErrors)) {
      mail($myEmail, $subject, $msg, $headers);
      $user = '';
      $mail = '';
      $subjectmail = '';
      $msg = '';
     // $success = 'We Have Recieved Your Message';
      
  }
  
}




