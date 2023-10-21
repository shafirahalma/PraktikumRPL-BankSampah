<?php
include 'koneksi.php';
$username = $_POST["username"];
$nama = $_POST["nama"];
$alamat = $_POST["alamat"];
$telepon = $_POST["telepon"];
$email = $_POST["email"];
$password = $_POST["password"];
$saldo = $_POST["saldo"];
$query_sql = "UPDATE nasabah SET username='$username', nama='$nama',alamat='$alamat',telepon='$telepon',email='$email', password='$password', saldo='$saldo' where username='$username'";

if (mysqli_query($conn, $query_sql)) {
  header("Location: dashboard.php");
} else {
  echo "Edit Gagal : " . mysqli_error($conn);
}
