<?php

include("koneksi.php");
$ID_setor = $_GET['ID_setor'];

mysqli_query($conn, "DELETE FROM t_setor where ID_setor = '$ID_setor'");

header("location: tsetor.php");

?>