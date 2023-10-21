<?php
require 'koneksi.php';
$username = $_POST["username"];
$nama = $_POST["nama"];
$alamat = $_POST["alamat"];
$telepon = $_POST["telepon"];
$email = $_POST["email"];
$saldo = 0;
$password = $_POST["password"];

$query_sql = "INSERT INTO nasabah (username, nama, alamat, telepon, email, saldo, password)
              VALUES ('$username', '$nama', '$alamat', '$telepon', '$email','$saldo', '$password')";

if(mysqli_query($conn, $query_sql)){
  header("Location: dashboard.php");
} else {
  echo "Pendaftaran Gagal : " . mysqli_error($conn);
}
