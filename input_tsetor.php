<?php
require 'koneksi.php';
$ID_setor = $_POST["ID_setor"];
$tanggal = $_POST["tanggal"];
$username = $_POST["username"];
$ID_sampah = $_POST["ID_sampah"];
$berat = $_POST["berat"];
$saldopendapatan = $_POST["saldopendapatan"];
$admin = $_POST["admin"];

$query_sql = "INSERT INTO t_setor (ID_setor, tanggal, username, ID_sampah, berat, saldopendapatan, admin)
              VALUES ('$ID_setor', '$tanggal', '$username', '$ID_sampah', '$berat', '$saldopendapatan', '$admin')";

if (mysqli_query($conn, $query_sql)) {
  // Mendapatkan saldo nasabah sebelumnya
  $saldo_sebelumnya_query = "SELECT saldo FROM nasabah WHERE username = '$username'";
  $saldo_sebelumnya_result = mysqli_query($conn, $saldo_sebelumnya_query);
  $saldo_sebelumnya = mysqli_fetch_assoc($saldo_sebelumnya_result)["saldo"];

  // Menghitung saldo baru
  $saldo_baru = $saldo_sebelumnya + $saldopendapatan;

  // Update saldo nasabah
  $update_saldo_query = "UPDATE nasabah SET saldo = '$saldo_baru' WHERE username = '$username'";
  mysqli_query($conn, $update_saldo_query);

  header("Location: tsetor.php");
} else {
  echo "Pendaftaran Gagal : " . mysqli_error($conn);
}
