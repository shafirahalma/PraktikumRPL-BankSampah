<?php
    session_start();
    unset($_SESSION["nasabah"]);
    session_destroy();
    header("Location: index.php");
?>