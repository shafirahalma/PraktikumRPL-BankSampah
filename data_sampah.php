<?php
session_start();
include "koneksi.php";
?>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Data Sampah</title>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

</head>

<body class="sb-nav-fixed">
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3">Welcome <?php echo $_SESSION['username']; ?></a>
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
          <h1 class="mt-4">Data Sampah</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <a href="input_sampah.html">
                <button type="button" class="btn btn-success">Insert Data</button>
              </a>
              <div class="card-body">
                <div class="table-responsive">
                  <!-- ... kode sebelumnya ... -->
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>ID Sampah</th>
                        <th>Jenis Sampah</th>
                        <th>Satuan</th>
                        <th>Harga(Rp)</th>
                        <th>Kelola</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $tampil = mysqli_query($conn, "select * from sampah");
                      $ID_sampah = 1;
                      while ($hasil = mysqli_fetch_array($tampil)) {
                      ?>
                        <tr>
                          <td><?php echo $ID_sampah++;?></td>
                          <td><?php echo $hasil['jenis']; ?></td>
                          <td><?php echo $hasil['satuan']; ?></td>
                          <td><?php echo $hasil['harga']; ?></td>
                          <td>
                            <a href="form_edit_sampah.php?ID_sampah=<?php echo $hasil['ID_sampah'] ?>">
                              <button type="button" class="btn btn-warning">Edit</button>
                            </a>
                            <a href="deldatasampah.php?ID_sampah=<?php echo $hasil['ID_sampah'] ?>">
                              <button type="button" class="btn btn-danger">Delete</button>
                            </a>
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