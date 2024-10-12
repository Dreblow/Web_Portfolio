<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Update these paths to reflect the actual location of PHPMailer
require '/var/www/html/global/PHPMailer-master/src/Exception.php';
require '/var/www/html/global/PHPMailer-master/src/PHPMailer.php';
require '/var/www/html/global/PHPMailer-master/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;           // Enable SMTP authentication
    $mail->Username = 'derek.dreblow@gmail.com'; // Your Gmail address
    $mail->Password = 'SECRET';  // Your Gmail password (or App Password)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `PHPMailer::ENCRYPTION_SMTPS` for SSL
    $mail->Port = 587;                // TCP port to connect to

    // Set email fields
    $mail->setFrom($_POST['email'], $_POST['name']);
    $mail->addAddress('Derek.Dreblow@gmail.com');  // Add a recipient

    // Content
    $mail->isHTML(false);  // Set email format to plain text
    $mail->Subject = 'Dreblow Designs New contact message from ' . $_POST['name'];
    $mail->Body    = "Name: " . $_POST['name'] . "\nEmail: " . $_POST['email'] . "\n\nMessage:\n" . $_POST['message'];

    $mail->send();
    
    // Return a response for AJAX
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>