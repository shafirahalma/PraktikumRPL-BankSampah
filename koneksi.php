<?php
$host = "localhost"; // untuk host
$username = "root"; // untuk username
$password = ""; // untuk password
$database = "bs"; //untuk nama database

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Koneksi Gagal : " . mysqli_connect_error());
}
// }else{
//     echo "Koneksi Berhasil";
// }