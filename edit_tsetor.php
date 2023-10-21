<?php
include 'koneksi.php';


if (isset($_POST['submit'])) {
  $ID_setor = $_POST['ID_setor'];
  $tanggal = $_POST['tanggal'];
  $username = $_POST["username"];
  $ID_sampah = $_POST['ID_sampah'];
  $berat = $_POST['berat'];
  $saldopendapatan = $_POST['saldopendapatan'];
  $admin = $_POST['admin'];



  // Query untuk update data setor
  $query_sql = "UPDATE t_setor SET ID_setor='$ID_setor', tanggal='$tanggal', username='$username', ID_sampah='$ID_sampah', berat='$berat', saldopendapatan='$saldopendapatan', admin='$admin' WHERE ID_setor='$ID_setor'";


  if (mysqli_query($conn, $query_sql)) {
    header("Location: tsetor.php");
    exit();
  } else {
    echo "Edit Gagal : " . mysqli_error($conn);
    exit;
  }
}
