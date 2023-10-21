<?php

session_start();
include "koneksi.php";

error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

if (!isset($_SESSION['username'])) {
  die("Anda belum login");
}

$username = $_SESSION['username'];
$sql = "SELECT * from admin where username='$username'";
$query = $conn->query($sql);
$data = $query->fetch_array();
?>


<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Data Nasabah</title>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

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

      </nav>
    </div>
    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid px-4">
          <h1 class="mt-4">Data Nasabah</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <a href="input_data_nasabah.html">
                <button type="button" class="btn btn-success">Insert Data</button>
              </a>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Saldo</th>
                        <th>Kelola</th>
                      </tr>
                    </thead>
                    <?php
                    $tampil = mysqli_query($conn, "select * from nasabah");
                    $No = 1;
                    while ($hasil = mysqli_fetch_array($tampil)) {
                    ?>
                      <tr>
                        <td><?php echo $No++; ?></td>
                        <td><?php echo $hasil['username']; ?></td>
                        <td><?php echo $hasil['nama']; ?></td>
                        <td><?php echo $hasil['alamat']; ?></td>
                        <td><?php echo $hasil['telepon']; ?></td>
                        <td><?php echo $hasil['email']; ?></td>
                        <td><?php echo $hasil['password']; ?></td>
                        <td><?php echo $hasil['saldo']; ?></td>
                        <td>
                          <a href="form_edit_nasabah.php?username=<?php echo $hasil['username'] ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                          <a href="delnasabah.php?username=<?php echo $hasil['username'] ?>"><button type="button" class="btn btn-danger">Delete</button></a>
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