<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendMailVerify($usermail, $token) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Configure seu servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'luizroberto44630@gmail.com'; // Seu email
        $mail->Password = 'hqviojfoguowikia'; // Sua senha de email
        $mail->Port = 465; // Porta padrão para SSL
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Usar SSL

        $mail->setFrom('no-reply@alcateia.com', 'Alcateia Network');
        $mail->addAddress($usermail);
        $mail->isHTML(true);
        $mail->Subject = 'Verifique seu email';
        $mail->Body = 'Clique no link para verificar seu email: <a href="http://localhost/b7web/MailVerify/config/verifyMail.php?token=' . $token . '">Verificar Email</a>';
        $mail->send();
    } catch (Exception $e) {
        setFlash('mailError', "Erro ao enviar email: {$mail->ErrorInfo}");
    }
}
?>
