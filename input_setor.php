<?php

session_start();
include "koneksi.php";

// Mendapatkan data username dari tabel nasabah
$username_query = "SELECT username FROM nasabah";
$username_result = $conn->query($username_query);

// Mendapatkan data ID_sampah dari tabel sampah
$ID_sampah_query = "SELECT ID_sampah, harga FROM sampah";
$ID_sampah_result = $conn->query($ID_sampah_query);

// Mendapatkan data admin dari tabel admin
$admin_query = "SELECT username FROM admin";
$admin_result = $conn->query($admin_query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Transaksi Setor</title>
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

    .box-input label {
      display: block;
      margin-bottom: 6px;
      font-weight: 600;
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
          </div>
      </nav>
    </div>
    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid px-4">
          <h1 class="mt-4">Data Transaksi Penyetoran</h1>

          <!-- DataTales Example -->
          <div class="card-body">
            <form action="input_tsetor.php" method="POST">
              <div class="box-input">
                <label for="ID_setor">ID Penyetoran</label>
                <input type="text" id="ID_setor" name="ID_setor" />
              </div>
              <div class="box-input">
                <label for="tanggal">Tanggal Penyetoran</label>
                <input type="date" id="tanggal" name="tanggal" />
              </div>
              <div class="box-input">
                <label for="username">Username</label>
                <div class="input-group">
                  <select id="username" name="username" class="form-select">
                    <?php
                    if ($username_result->num_rows > 0) {
                      while ($row = $username_result->fetch_assoc()) {
                        echo "<option value='" . $row["username"] . "'>" . $row["username"] . "</option>";
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="box-input">
                <label for="ID_sampah">ID Sampah</label>
                <div class="input-group">
                  <select id="ID_sampah" name="ID_sampah" class="form-select">
                    <?php
                    if ($ID_sampah_result->num_rows > 0) {
                      while ($row = $ID_sampah_result->fetch_assoc()) {
                        echo "<option value='" . $row["ID_sampah"] . "' data-harga='" . $row["harga"] . "'>" . $row["ID_sampah"] . "</option>";
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="box-input">
                <label for="berat">Berat</label>
                <input type="text" id="berat" name="berat" oninput="calculatePrice()" />
              </div>
              <div class="box-input">
                <label for="saldopendapatan">Saldo Pendapatan (Rp)</label>
                <input type="text" id="saldopendapatan" name="saldopendapatan" readonly />
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

              <div>
                <button type="submit" name="register" class="btn btn-success">Insert</button>
              </div>
            </form>
          </div>
        </div>
      </main>
    </div>
  </div>
  <script>
    function calculatePrice() {
      var ID_sampah = document.getElementById("ID_sampah").value;
      var berat = document.getElementById("berat").value;

      // Mendapatkan harga dari opsi yang dipilih
      var harga = document.querySelector(`#ID_sampah option[value="${ID_sampah}"]`).getAttribute("data-harga");

      // Menghitung saldopendapatan total
      var saldopendapatan = harga * berat;

      // Mengisi nilai saldopendapatan pada input
      document.getElementById("saldopendapatan").value = saldopendapatan;
    }
  </script>
</body>

</html>