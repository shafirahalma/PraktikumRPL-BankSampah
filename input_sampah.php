<?php
require 'koneksi.php';
$ID_sampah = $_POST["ID_sampah"];
$jenis = $_POST["jenis"];
$satuan = $_POST["satuan"];
$harga = $_POST["harga"];

$query_sql = "INSERT INTO sampah (ID_sampah, jenis, satuan, harga)
              VALUES ('$ID_sampah', '$jenis', '$satuan', '$harga')";

if(mysqli_query($conn, $query_sql)){
  header("Location: data_sampah.php");
} else {
  echo "Pendaftaran Gagal : " . mysqli_error($conn);
}
?>