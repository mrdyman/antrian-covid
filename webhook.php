<?php 

include 'conn.php';

require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;

// Get count to push
$count = 1;
// $count = $_POST['count'];

// Get $count data from db
$sql = "SELECT * FROM nasabah WHERE is_selesai = 0 ORDER BY nomor_antrian ASC LIMIT $count";
$result = $conn->query($sql);

$emailToPush = [];

if ($result && $result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      array_push($emailToPush, $row);
    }
  } else {
    echo "0 results";
  }

    // Push to email
    foreach($emailToPush as $email) {
        $to = $email['email'];
        $nomorAntrian = $email['nomor_antrian'];
        _sendEmail($to, $nomorAntrian);
    }


    function _sendEmail($to, $nomorAntrian) {
        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->SMTPDebug = 2;
        $mail->Host = 'mail.mrdyman.com';
        $mail->Port = 26;
        $mail->SMTPAuth = true;
        $mail->Username = 'macca@mrdyman.com';
        $mail->Password = 'didimaman123';
        $mail->setFrom('macca@mrdyman.com', 'Macca Technologies');
        $mail->addAddress($to, '');
        $mail->addReplyTo('macca@mrdyman.com', 'Macca Technologies');
        $mail->Subject = 'Nomor Antrian Nasabah BANK MACCA';
        $mail->Body = 'Hi, berikut nomor antrian kamu. silahkan scan saat kamu datang ke BANK Macca';
        $mail->addAttachment('generated-qr-code/qr-code-nasabah-'.$nomorAntrian.'.png');
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            return false;
        } else {
            echo 'The email message was sent.';
            updateData($nomorAntrian);
            return true;
        }
    }

    function updateData($nomorAntrian){
        global $conn;
        $sql = "UPDATE nasabah SET is_selesai = 1 WHERE nomor_antrian = $nomorAntrian";
        $result = $conn->query($sql);
        if($result){
            echo "Data updated";
        } else {
            echo "Error updating data";
        }
        $conn->close();
    }
?>