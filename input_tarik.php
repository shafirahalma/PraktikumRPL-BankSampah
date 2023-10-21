<?php

session_start();
include "koneksi.php";

// Mendapatkan data admin dari tabel admin
$admin_query = "SELECT username FROM admin";
$admin_result = $conn->query($admin_query);

// Mendapatkan data ID_sampah dari tabel sampah
$ID_username_query = "SELECT username,saldo FROM nasabah";
$ID_username_result = $conn->query($ID_username_query);

// Mendapatkan saldo nasabah dari tabel nasabah
$saldo_query = "SELECT saldo FROM nasabah WHERE username='$username'";
$saldo_result = $conn->query($saldo_query);

if ($saldo_result->num_rows > 0) {
  $saldo_row = $saldo_result->fetch_assoc();
  $saldo = $saldo_row["saldo"];
} else {
  $saldo = 0;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Transaksi Tarik</title>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <style>
    body {
      background-color: #f8f9fa;
    }

    .card-body {
      margin-top: 20px;
      background-color: #fff;
      padding: 30px;
      border-radius: 6px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .box-input {
      margin-bottom: 20px;
    }

    .box-input input[type="text"],
    .box-input input[type="date"] {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 16px;
    }

    .btn-success {
      background-color: #28a745;
      border-color: #28a745;
    }

    .btn-success:hover {
      background-color: #218838;
      border-color: #1e7e34;
    }
  </style>
</head>

<body class="sb-nav-fixed">
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="login_admin.php">Welcome Admin</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar-->
  </nav>
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
          <div class="nav">
            <a class="nav-link" href="dashboard.php">
              <div class="sb-nav-link-icon"><i class="fas fa-user-alt"></i></div>
              Data Nasabah
            </a>
            <a class="nav-link" href="data_sampah.php">
              <div class="sb-nav-link-icon"><i class="fas fa-trash-alt"></i></div>
              Data Sampah
            </a>
            <a class="nav-link" href="tsetor.php">
              <div class="sb-nav-link-icon"><i class="fas fa-handshake-alt"></i></div>
              Transaksi Setor
            </a>
            <a class="nav-link" href="ttarik.php">
              <div class="sb-nav-link-icon"><i class="fas fa-handshake-alt"></i></div>
              Transaksi Tarik
            </a>
            <a class="nav-link" href="index.html">
              <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
              Logout
            </a>
      </nav>
    </div>
    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid px-4">
          <h1 class="mt-4">Data Transaksi Penarikan</h1>

          <!-- DataTales Example -->
          <div class="card-body">
            <form action="input_penarikan.php" method="POST">
              <div class="box-input mb-3">
                <label for="ID_tarik">ID Penarikan</label>
                <input type="text" id="ID_tarik" name="ID_tarik" />
              </div>
              <div class="box-input mb-3">
                <label for="tanggal">Tanggal Penarikan</label>
                <input type="date" id="tanggal" name="tanggal" />
              </div>
              <div class="box-input">
                <label for="username">Username</label>
                <div class="input-group">
                  <select id="username" name="username" class="form-select" onchange="updateSaldoAwal()">
                    <?php
                    if ($ID_username_result->num_rows > 0) {
                      while ($row = $ID_username_result->fetch_assoc()) {
                        echo "<option value='" . $row["username"] . "' data-harga='" . $row["saldo"] . "'>" . $row["username"] . "</option>";
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="box-input mb-3">
              <label for="saldoawal">Saldo Awal</label>
              <input type="text" id="saldoawal" name="saldoawal" value="<?php echo $saldo; ?>" readonly />
            </div>
              <div class="box-input mb-3">
                <label for="jumlah">Jumlah Penarikan</label>
                <input type="text" id="jumlah" name="jumlah" oninput="updateSisaSaldo()" />
              </div>
              <div class="box-input mb-3">
                <label for="sisa">Sisa Saldo</label>
                <input type="text" id="sisa" name="sisa" readonly />
              </div>
              <div class="box-input">
                <label for="admin">Nama Admin</label>
                <div class="input-group">
                  <select id="admin" name="admin" class="form-select">
                    <?php
                    if ($admin_result->num_rows > 0) {
                      while ($row = $admin_result->fetch_assoc()) {
                        echo "<option value='" . $row["username"] . "'>" . $row["username"] . "</option>";
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
              <button type="submit" name="register" class="btn btn-success">Insert</button>
            </form>

          </div>

      </main>

    </div>
  </div>
  <script>
    function updateSaldoAwal() {
      var selectedOption = document.getElementById("username").value;
      var saldoAwal = document.querySelector(`#username option[value="${selectedOption}"]`).getAttribute("data-harga");
      document.getElementById("saldoawal").value = saldoAwal;
    }
    function updateSisaSaldo() {

      var username = document.getElementById("username").value;
      var jumlah = parseInt(document.getElementById("jumlah").value);

      // Mendapatkan harga dari opsi yang dipilih
      var saldo = document.querySelector(`#username option[value="${username}"]`).getAttribute("data-harga");


      var sisa = saldo - jumlah;
      document.getElementById("sisa").value = sisa;
    }
  </script>
</body>

</html>