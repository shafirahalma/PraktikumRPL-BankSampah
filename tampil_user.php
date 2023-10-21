<?php
session_start();

// Periksa apakah pengguna telah login
if(isset($_SESSION['username'])){

require 'koneksi.php';
  
  // Mendapatkan data pengguna yang login dari database
  $username = $_SESSION['username'];
  $query_sql = "SELECT * FROM nasabah WHERE username = '$username'";
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) {
    // Tampilkan data pengguna yang login
    while($row = $result->fetch_assoc()) {
      echo "Username: " . $row['username'] . "<br>";
      echo "Nama: " . $row['nama'] . "<br>";
      echo "Email: " . $row['email'] . "<br>";
      // Tambahkan kolom lain yang ingin ditampilkan
    }
  } else {
    echo "Data pengguna tidak ditemukan.";
  }
  
  // Tutup koneksi database
  $conn->close();
} else {
  echo "Pengguna belum login.";
}
?>
?>