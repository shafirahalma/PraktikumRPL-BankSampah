<?php
session_start();
include "koneksi.php";
$username = $_POST['username'];
$password = $_POST['password'];
//$op = $_GET['op'];

//if($op=="in"){
//if{
    $sql="SELECT * from nasabah where username='$username' AND password='$password'";
    $query = $conn->query($sql);
    if(mysqli_num_rows($query)==1){
        $data = $query->fetch_array();
        $_SESSION['username'] = $data['username'];
        header("location:dashboard_nasabah.php");
    } else {
        die("Password yang 
        anda masukkan 
        salah. Silahkan 
        coba lagi <a href=\"javascript:history.back()\">
        kembali</a>");
    }
//} 
//else if($op=="out"){
//else if {
//    unset($_SESSION['NIN']);
//    unset($_SESSION['password']);
//    header("location:login.php");
//}
?>
