<?php
include 'koneksi.php';

if (isset($_GET['ID_sampah'])) {
  $ID_sampah = $_GET['ID_sampah'];

  // Query untuk mendapatkan data sampah berdasarkan ID_sampah
  $query = "SELECT * FROM sampah WHERE ID_sampah='$ID_sampah'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $jenis = $row['jenis'];
    $satuan = $row['satuan'];
    $harga = $row['harga'];
  } else {
    echo "No data found.";
    exit();
  }
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
  <title>Data Sampah</title>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
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
          <h1 class="mt-4">Data Sampah</h1>

          <!-- DataTales Example -->
          <div class="card-body">
            <form action="edit_sampah.php" method="POST">

              <div class="form-group">
                <label for="ID_sampah">ID Sampah</label>
                <input type="text" class="form-control" id="ID_sampah" name="ID_sampah" value="<?php echo $ID_sampah; ?>" readonly>
              </div>

              <div class="form-group">
                <label for="jenis">Jenis Sampah</label>
                <input type="text" class="form-control" id="jenis" name="jenis" value="<?php echo $jenis; ?>">
              </div>

              <div class="form-group">
                <label for="satuan">Satuan</label>
                <input type="text" class="form-control" id="satuan" name="satuan" value="<?php echo $satuan; ?>">
              </div>

              <div class="form-group">
                <label for="harga">Harga (Rp)</label>
                <input type="text" class="form-control" id="harga" name="harga" value="<?php echo $harga; ?>">
              </div>

              <div class="form-group">
                <button type="submit" name="submit" value="Update" class="btn btn-success">Update</button>
              </div>
            </form>
          </div>

      </main>

    </div>
  </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>