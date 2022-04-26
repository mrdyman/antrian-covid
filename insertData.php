<?php
include 'conn.php';

require_once('assets/phpqrcode/qrlib.php');

$nama = $_POST['nama'];
$email = $_POST['email'];
$is_selesai = $_POST['is_selesai'];

$sql = "INSERT INTO nasabah (nama, email, is_selesai) VALUES ('$nama', '$email', '$is_selesai')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
    _generateQRCode($conn->insert_id);
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);

function _generateQRCode($id){
    $path = 'generated-qr-code/';
    $file = $path.'qr-code-nasabah-'.'0'.$id.'.png';

    QRcode::png('0'.$id, $file, QR_ECLEVEL_L, 10);
}