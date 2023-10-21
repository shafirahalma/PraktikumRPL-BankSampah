<?php
include 'koneksi.php';

if (isset($_POST['submit'])) {
  $ID_tarik = $_POST['ID_tarik'];
  $tanggal = $_POST['tanggal'];
  $username = $_POST['username'];
  $saldoawal = $_POST['saldoawal'];
  $jumlah_tarik = $_POST['jumlah'];
  $sisa_saldo = $_POST['sisa'];
  $admin = $_POST['admin'];

  $query = "UPDATE t_tarik SET tanggal = '$tanggal', username = '$username', saldoawal = '$saldoawal',  jumlah = '$jumlah_tarik', sisa = '$sisa_saldo', admin = '$admin' WHERE ID_tarik = '$ID_tarik'";
  $result = mysqli_query($conn, $query);

  if ($result) {
    // Jika pembaruan berhasil, redirect kembali ke halaman ttarik.php
    header('Location: ttarik.php');
    exit();
  } else {
    echo "Failed to update data.";
    exit;
  }
}
