<?php
require 'koneksi.php';
$ID_tarik = $_POST["ID_tarik"];
$tanggal = $_POST["tanggal"];
$username = $_POST["username"];
$saldoawal = $_POST["saldoawal"];
$jumlah = $_POST["jumlah"];
$sisa = $_POST["sisa"];
$admin = $_POST["admin"];

// Mendapatkan saldo terkini dari tabel nasabah
$query_saldo = "SELECT saldo FROM nasabah WHERE username = '$username'";
$result_saldo = mysqli_query($conn, $query_saldo);
$row_saldo = mysqli_fetch_assoc($result_saldo);
$saldo_terkini = $row_saldo['saldo'];

// Memperbarui saldo nasabah setelah penarikan
$saldo_baru = $saldo_terkini - $jumlah;

// Mengupdate saldo pada tabel nasabah
$query_update_saldo = "UPDATE nasabah SET saldo = '$saldo_baru' WHERE username = '$username'";
mysqli_query($conn, $query_update_saldo);

// Memasukkan data penarikan ke dalam tabel t_tarik
$query_sql = "INSERT INTO t_tarik (ID_tarik, tanggal, username, saldoawal, jumlah, sisa, admin)
              VALUES ('$ID_tarik', '$tanggal', '$username', '$saldoawal', '$jumlah', '$sisa', '$admin')";

if (mysqli_query($conn, $query_sql)) {
  header("Location: ttarik.php");
} else {
  echo "Pendaftaran Gagal : " . mysqli_error($conn);
}
