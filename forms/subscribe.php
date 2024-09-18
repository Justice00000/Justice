<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /**
    * Requires the "PHP Email Form" library
    * The "PHP Email Form" library is available only in the pro version of the template
    * The library should be uploaded to: vendor/php-email-form/php-email-form.php
    * For more info and help: https://bootstrapmade.com/php-email-form/
    */

    // Replace contact@example.com with your real receiving email address
    $receiving_email_address = 'j.chukwuony@alustudent.com';

    if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
      include( $php_email_form );
    } else {
      die( 'Unable to load the "PHP Email Form" Library!');
    }

    $contact = new PHP_Email_Form;
    $contact->ajax = true;
    
    $contact->to = $receiving_email_address;
    $contact->from_name = $_POST['name'] ?? 'Subscriber';
    $contact->from_email = $_POST['email'];
    $contact->subject = 'Newsletter Subscription';

    // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
    /*
    $contact->smtp = array(
      'host' => 'alustudent.com',
      'username' => 'j.chukwuony',
      'password' => 'pass',
      'port' => '587'
    );
    */

    $contact->add_message( $_POST['email'], 'Email');

    echo $contact->send();
  } else {
    http_response_code(405);
    echo "Method Not Allowed";
  }
?>