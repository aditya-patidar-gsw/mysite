<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';  // Adjust the path if necessary

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Create an instance of PHPMailer
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                      // Send using SMTP
        $mail->Host = 'smtp.gmail.com';                        // Set the SMTP server to Gmail
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'preetpatidar115@gmail.com';             // Your Gmail address
        $mail->Password = '@Preetpatidar09';              // Your Gmail password (use app password if 2FA is enabled)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;    // Enable TLS encryption
        $mail->Port = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('preetpaatidar115@gmail.com');      // Add your recipient email here

        // Content
        $mail->isHTML(false);                                  // Set email format to plain text
        $mail->Subject = "New message from $name";
        $mail->Body    = "Name: $name\nEmail: $email\n\nMessage:\n$message";

        $mail->send();
        echo "<div class='message'>Thank you for contacting us! We will get back to you soon.</div>";
    } catch (Exception $e) {
        echo "<div class='error'>Message could not be sent. Mailer Error: {$mail->ErrorInfo}</div>";
    }
} else {
    echo "<div class='error'>Invalid request method.</div>";
}
?>
