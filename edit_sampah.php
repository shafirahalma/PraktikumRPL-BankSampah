<?php
include 'koneksi.php';

$ID_sampah = $_POST['ID_sampah'];
$jenis = $_POST['jenis'];
$satuan = $_POST['satuan'];
$harga = $_POST['harga'];

// Query untuk update data sampah
$query_sql = "UPDATE sampah SET jenis='$jenis', satuan='$satuan', harga='$harga' WHERE ID_sampah='$ID_sampah'";

if (mysqli_query($conn, $query_sql)) {
  header("Location: data_sampah.php");
} else {
  echo "Edit Gagal : " . mysqli_error($conn);
}
