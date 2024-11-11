<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../phpmailer/PHPMailer.php';
require __DIR__ . '/../phpmailer/SMTP.php';
require __DIR__ . '/../phpmailer/Exception.php';

class PHP_Email_Form {
  public $to;
  public $from_name;
  public $from_email;
  public $subject;
  public $messages = [];
  public $smtp = [
    'host' => 'alustudent.com',
    'username' => 'j.chukwuony',
    'password' => 'pass',
    'port' => '587'
  ];

  public function add_message($content, $label = '') {
    $this->messages[] = $label . ': ' . $content;
  }

  public function send() {
    $mail = new PHPMailer(true);
    try {
      $mail->isSMTP();
      $mail->Host = $this->smtp['host'];
      $mail->SMTPAuth = true;
      $mail->Username = $this->smtp['username'];
      $mail->Password = $this->smtp['password'];
      $mail->SMTPSecure = 'tls';
      $mail->Port = $this->smtp['port'];

      $mail->setFrom($this->from_email, $this->from_name);
      $mail->addAddress($this->to);
      $mail->Subject = $this->subject;
      $mail->Body = implode("\n", $this->messages);

      $mail->send();
      return 'Message sent successfully!';
    } catch (Exception $e) {
      return 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    }
  }
}
?>