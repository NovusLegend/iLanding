<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  // Replace contact@example.com with your real receiving email address
  $receiving_email_address = 'jeremiahmugabi95@gmail.com';

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  
  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['name'];
  $contact->from_email = $_POST['email'];
  $contact->subject = $_POST['subject'];

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  /*
  $contact->smtp = array(
    'host' => 'example.com',
    'username' => 'example',
    'password' => 'pass',
    'port' => '587'
  );
  */

  $contact->add_message( $_POST['name'], 'From');
  $contact->add_message( $_POST['email'], 'Email');
  $contact->add_message( $_POST['message'], 'Message', 10);
  $contact->cc = array('jeremiahmugabi95@gmail.com', 'ccreceiver2@example.com');
  $contact->bcc = array('bccreceiver1@example.com', 'bccreceiver2@example.com');
  echo $contact->send();
?>
<?php
    $error = "";
    $success = "";

    if(filter_has_var(INPUT_POST, 'submit')) {
         
        if(!$_POST['name']) {
            $error .= "Name is missing <br>";
          
        }
        if(!$_POST['email']) {
            $error .= "Email is missing <br>";
           
        } elseif ($_POST['email']){
            if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
                $error.= "Email address is invalid<br>";
            }
        }
        if(!$_POST['phone']) {
            $error .= "Phone Number is missing <br>";
        } elseif ($_POST['email']){
            if(filter_var($_POST['phone'], FILTER_VALIDATE_INT) === false) {
                $error.= "Phone Number is invalid<br>";
            }
        }
        if(!$_POST['message']) {
            $error .= "Message is missing <br>";
        }         
        if($error!="") {
            $error = '<div class="alert alert-danger" role="alert"> <p><strong>Please enter missing detai(s):</strong></p>'. $error.'</div>';
         } else {
            $emailTo = "youremail@yourdomain.com";
            $subject = "Message from Customer";
            $content .= "Customer Name: ". $_POST['name']."\n"."\n";
            $content .= "Phone Number: ". $_POST['phone']."\n"."\n";
            $content .= "Email Address: ". $_POST['email']."\n"."\n";
            $content .= $_POST['message']."\n"."\n";
            $headers = "From: ".$_POST['email'];

            if(mail($emailTo, $subject, $content, $headers)){
                $success = '<div class="alert alert-success" role="alert"> Thank you for contacting us. We have received your email. We will get in touch at soonest possbile time. </div>';
            } else {

                $error .= '<div class="alert alert-danger" role="alert"> <p><strong>Email Failed. Please try again later. </strong></p></div>';
            }

         }

    }

?>
