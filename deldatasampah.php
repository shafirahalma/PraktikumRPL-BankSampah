<?php

include("koneksi.php");
$ID_sampah = $_GET['ID_sampah'];

mysqli_query($conn, "DELETE FROM sampah where ID_sampah = '$ID_sampah'");

header("location: data_sampah.php");

?>