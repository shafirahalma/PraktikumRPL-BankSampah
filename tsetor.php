<?php

session_start();
include "koneksi.php";

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if (!isset($_SESSION['username'])) {
  die("Anda belum login");
}

$username = $_SESSION['username'];
$sql = "SELECT * from t_setor where username='$username'";
$query = $conn->query($sql);
$data = $query->fetch_array();
?>

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

</head>

<body class="sb-nav-fixed">
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3">Welcome <?php echo $username; ?></a>
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
          <h1 class="mt-4">Transaksi Setor</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <a href="input_setor.php">
                <button type="button" class="btn btn-success">Insert Data</button>
              </a>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>ID Penyetoran</th>
                        <th>Tanggal Penyetoran</th>
                        <th>Username</th>
                        <th>ID Sampah</th>
                        <th>Berat(Kg)</th>
                        <th>Saldo Pendapatan(Rp)</th>
                        <th>Nama Admin</th>
                        <th>Kelola</th>
                      </tr>
                    </thead>
                    <?php
                    $tampil = mysqli_query($conn, "select * from t_setor");
                    $ID_setor = 1;
                    while ($hasil = mysqli_fetch_array($tampil)) {
                    ?>
                      <tr>
                        <td><?php echo $ID_setor++; ?></td>
                        <td><?php echo $hasil['tanggal']; ?></td>
                        <td><?php echo $hasil['username']; ?></td>
                        <td><?php echo $hasil['ID_sampah']; ?></td>
                        <td><?php echo $hasil['berat']; ?></td>
                        <td><?php echo $hasil['saldopendapatan']; ?></td>
                        <td><?php echo $hasil['admin']; ?></td>
                        <td>
                          <a href="form_edit_tsetor.php?id=<?php echo $hasil['ID_setor']; ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                          <a href="delsetor.php?ID_setor=<?php echo $hasil['ID_setor']; ?>"><button type="button" class="btn btn-danger">Delete</button></a>
                        </td>
                      </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
      </main>

    </div>
  </div>
</body>