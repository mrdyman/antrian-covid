<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;

$nomorAntrian = $_POST['no_antrian'];
$to = $_POST['to'];

$mail = new PHPMailer;

$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = 'mail.mrdyman.com';
$mail->Port = 26;
$mail->SMTPAuth = true;
$mail->Username = 'macca@mrdyman.com';
$mail->Password = 'didimaman123';
$mail->setFrom('macca@mrdyman.com', 'Macca Technologies');
// $mail->addAddress($_POST['email'], $_POST['nama']);
// $mail->addAddress('andimardimansaputra@gmail.com', 'dyman');
$mail->addAddress($to, '');
$mail->addReplyTo('macca@mrdyman.com', 'Macca Technologies');
$mail->Subject = 'Nomor Antrian Nasabah';
// $mail->msgHTML(file_get_contents('nomor_antrian.html'), __DIR__);
$mail->Body = 'Hi, berikut nomor antrian kamu. silahkan scan saat kamu datang ke BANK Macca';
$mail->addAttachment('generated-qr-code/qr-code-'.$nomorAntrian.'.pdf');
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    return false;
} else {
    echo 'The email message was sent.';
    return true;
}
?>