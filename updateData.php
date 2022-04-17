<?php
include 'conn.php';
$id = $_POST['id'];
$is_selesai = $_POST['is_selesai'];
$sql = "UPDATE nasabah SET is_selesai='$is_selesai' WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
    mysqli_close($conn);
?>