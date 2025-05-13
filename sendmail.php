<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    header('HTTP/1.1 403 Forbidden');
    echo json_encode(['success' => false, 'message' => 'Invalid CSRF token']);
    exit;
}

$email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
if (!$email) {
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['success' => false, 'message' => 'Invalid email']);
    exit;
}

$mail = new PHPMailer(true);

try {
    // Server-Einstellungen
    $mail->isSMTP();
    $mail->Host = 'server22.martin-schenk.es';
    $mail->SMTPAuth = true;
    $mail->Username = 'info@martin-schenk.es';
    $mail->Password = '$ip326A2vdf@h7&8'; // Dein Passwort
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    // E-Mail an dich (Martin)
    $mail->setFrom('info@martin-schenk.es', 'MindBeamer Demo Request');
    $mail->addAddress('ms@martin-schenk.es');
    $mail->addReplyTo($email);
    $mail->isHTML(true);
    $mail->Subject = 'MindBeamer.io Demo Request';
    $mail->Body = "<h2>New MindBeamer.io Demo Request</h2><p><strong>Email:</strong> $email</p><p>The user has requested a personal demo of MindBeamer.io.</p><p>Please reach out to schedule a video call.</p>";
    $mail->AltBody = "New MindBeamer.io Demo Request\n\nEmail: $email\n\nThe user has requested a personal demo. Please reach out to schedule a video call.";
    $mail->send();

    // Auto-Reply an den Nutzer
    $mail->clearAddresses();
    $mail->addAddress($email);
    $mail->Subject = 'Thanks for Your MindBeamer Demo Request';
    $mail->Body = '<h2>Thank You!</h2><p>Martin will contact you soon to schedule your MindBeamer demo. Looking forward to showing you how it can save you time!</p>';
    $mail->AltBody = "Thank You!\n\nMartin will contact you soon to schedule your MindBeamer demo.";
    $mail->send();

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Failed to send email: ' . $mail->ErrorInfo]);
}
?>