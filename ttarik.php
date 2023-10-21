<?php

session_start();
include "koneksi.php";

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if (!isset($_SESSION['username'])) {
  die("Anda belum login");
}

$username = $_SESSION['username'];
$sql = "SELECT * from t_tarik where username='$username'";
$query = $conn->query($sql);
$data = $query->fetch_array();
?>

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
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="sb-nav-fixed">
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="login_admin.php">Welcome <?php echo $username; ?></a>
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
        </div>
        <!-- <div class="sb-sidenav-footer">
          <div class="small">Logged in as:</div>
          Administrator
        </div> -->
      </nav>
    </div>
    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid px-4">
          <h1 class="mt-4">Transaksi Tarik</h1>
          <!-- <ol class="breadcrumb mb-4"> -->
          <!-- <li class="breadcrumb-item"><a href="login_admin.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Transaksi Tarik</li> -->
          </ol>
          <div class="card mb-4">
            <!-- <div class="card-header">
              <i class="fas fa-table me-1"></i>
              Data Transaksi Tarik
            </div> -->
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <a href="input_tarik.php">
                  <button type="button" class="btn btn-success">Insert Data</button>
                </a>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="datatablesSimple">
                      <thead>
                        <tr>
                          <th>ID Penarikan</th>
                          <th>Tanggal Penarikan</th>
                          <th>Username</th>
                          <th>Saldo Awal</th>
                          <th>Jumlah Penarikan</th>
                          <th>Sisa Saldo</th>
                          <th>Nama Admin</th>
                          <th>Kelola</th>
                        </tr>
                      </thead>
                      <?php
                      $tampil = mysqli_query($conn, "select * from t_tarik");
                      $ID_tarik = 1;
                      while ($hasil = mysqli_fetch_array($tampil)) {
                      ?>
                        <tr>
                          <td><?php echo $hasil['ID_tarik']; ?></td>
                          <td><?php echo $hasil['tanggal']; ?></td>
                          <td><?php echo $hasil['username']; ?></td>
                          <td><?php echo $hasil['saldoawal']; ?></td>
                          <td><?php echo $hasil['jumlah']; ?></td>
                          <td><?php echo $hasil['sisa']; ?></td>
                          <td><?php echo $hasil['admin']; ?></td>
                          <td>
                            <a href="form_edit_ttarik.php?id=<?php echo $hasil['ID_tarik']; ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                            <a href="deltarik.php?ID_tarik=<?php echo $hasil['ID_tarik']; ?>"><button type="button" class="btn btn-danger">Delete</button></a>
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
      <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
          <!-- <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Designed by <a href="https://www.linkedin.com/in/achmad-romadoni-98a32017a/" target="_blank">Achmad Romadoni</a></div>
          </div> -->
        </div>
      </footer>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/simple-datatables.min.js"></script>
  <script src="js/datatables-simple-demo.js"></script>
</body>