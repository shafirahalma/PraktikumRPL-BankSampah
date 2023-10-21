<?php

include("koneksi.php");
$username = $_GET['username'];

mysqli_query($conn, "DELETE FROM nasabah where username = '$username'");

header("location: dashboard.php");

?>