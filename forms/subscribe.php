<?php
  $receiving_email_address = 'site@takecontrolsoft.eu';

  if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
    include( $php_email_form );
  } else {
    die( 'Unable to load the "PHP Email Form" Library!');
  }

  $contact = new PHP_Email_Form;
  $contact->ajax = true;
  
  $contact->to = $receiving_email_address;
  $contact->from_name = $_POST['email'];
  $contact->from_email = $_POST['email'];
  $contact->subject = "Newsletter subscription";

  $configs = include('../config.php');

  $contact->smtp = $configs;
  
  $string='[ ';
  foreach($_SERVER as $key=>$val)
  {
    $strval = '';
    if (is_array($val)) {
      $strval = implode($val);
    } else {
      $strval = $val;
    }
    $string.=$key.':'.$strval.",\n";
  }
  
  $string.=']';

  $contact->add_message( $_POST['email'], 'From');
  $contact->add_message( $_POST['email'], 'Email');
  $contact->add_message( $string , 'Message', 10);

  echo $contact->send();
?>
