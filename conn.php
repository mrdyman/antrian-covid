<?php 
// php connection to mysql database
$host = "localhost";
$user = "root";
$pass = "";
$db = "antrian_covid";
//connect to database
$conn = mysqli_connect($host, $user, $pass, $db);
//check connection
if(mysqli_connect_errno()){
    echo 'Gagal melakukan koneksi ke Database : '.mysqli_connect_error();
}
?>