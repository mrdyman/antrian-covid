<?php 

include 'conn.php';

require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;

$notif_count = [];

$count = $_POST['antrian'];

$incoming_count = $_POST['incoming_count'];
$incomingQuery = "INSERT INTO notifikasi (count_data) VALUES ('$incoming_count')";
if (mysqli_query($conn, $incomingQuery)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $incomingQuery . "<br>" . mysqli_error($conn);
}

$query_notif = "SELECT count_data FROM notifikasi";
$result_notif = $conn->query($query_notif);
if ($result_notif && $result_notif->num_rows > 0) {
    // output data of each row
    while($row = $result_notif->fetch_assoc()) {
      array_push($notif_count, $row['count_data']);
    }
  } else {
    echo "0 results";
}

if($notif_count[count($notif_count)-1] > $notif_count[count($notif_count)-2]){
  echo 'send email';
  sendNotif();
} else {
    echo 'keep waiting. current data is ::: '. $notif_count[count($notif_count)-1]. $notif_count[count($notif_count)-2];
}
function sendNotif(){
    global $count, $conn;
    // Get $count data from db
    // check if data > 10 (push 1 by one)
    if($count == 10){
        $sql = "SELECT * FROM nasabah WHERE is_selesai = 0 ORDER BY nomor_antrian ASC LIMIT $count";
    } else if($count > 10) {
        $sql = "SELECT * FROM nasabah WHERE is_selesai = 0 ORDER BY nomor_antrian ASC LIMIT 1";
    }
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
        $mail->addAttachment('generated-qr-code/qr-code-nasabah-'.'0'.$nomorAntrian.'.png');
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
    }
?>