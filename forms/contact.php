<?php
class PHP_Email_Form {
  public $to;
  public $from_name;
  public $from_email;
  public $subject;
  public $ajax;
  public $smtp;

  public function add_message($content, $label = '', $max_length = 0) {
      // Implementation of add_message method
  }

  public function send() {
      // Implementation of send method
  }
}
// Replace contact@example.com with your real receiving email address
$receiving_email_address = 'yalsammangpt@gmail.com';

if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
    include($php_email_form);
} else {
    die('Unable to load the "PHP Email Form" Library!');
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
    $subject = isset($_POST['subject']) ? htmlspecialchars(trim($_POST['subject'])) : '';
    $message = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message'])) : '';

    // Check if required fields are not empty
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        $contact = new PHP_Email_Form;
        $contact->ajax = true;

        $contact->to = $receiving_email_address;
        $contact->from_name = $name;
        $contact->from_email = $email;
        $contact->subject = $subject;

        // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
        /*
        $contact->smtp = array(
            'host' => 'example.com',
            'username' => 'example',
            'password' => 'pass',
            'port' => '587'
        );
        */

        $contact->add_message($name, 'From');
        $contact->add_message($email, 'Email');
        $contact->add_message($message, 'Message', 10);

        echo $contact->send();
    } else {
        echo 'Please fill all the required fields.';
    }
} else {
    echo 'Invalid request method.';
}
?>