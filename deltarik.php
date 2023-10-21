<?php

include("koneksi.php");
$ID_tarik = $_GET['ID_tarik'];

mysqli_query($conn, "DELETE FROM t_tarik where ID_tarik = '$ID_tarik'");

header("location: ttarik.php");

?>