<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
  $ID_tarik = $_GET['id'];

  $query = "SELECT * FROM t_tarik WHERE ID_tarik = '$ID_tarik'";
  $result = mysqli_query($conn, $query);

  // Mengecek apakah data ditemukan
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $ID_tarik = $row['ID_tarik'];
    $tanggal = $row['tanggal'];
    $username = $row['username'];
    $saldoawal = $row['saldoawal'];
    $jumlah_tarik = $row['jumlah'];
    $sisa_saldo = $row['sisa'];
    $admin = $row['admin'];

    // Mengambil daftar username dan saldo dari database
    $queryUsername = "SELECT username, saldo FROM nasabah";
    $resultUsername = mysqli_query($conn, $queryUsername);

    // Mengambil daftar admin dari database
    $queryAdmin = "SELECT username FROM admin";
    $resultAdmin = mysqli_query($conn, $queryAdmin);
  } else {
    echo "Data not found.";
    exit;
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
  <title>Transaksi Tarik</title>
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
            <a class="nav-link" href="logouadmin.php">
              <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
              Logout
            </a>
          </div>
        </div>
      </nav>
    </div>
    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid px-4">
          <h1 class="mt-4">Edit Transaksi Tarik</h1>
          <div class="card mb-4">
            <div class="card-body">
              <form method="post" action="edit_ttarik.php">
                <div class="form-group">
                  <label for="ID_tarik">ID Tarik</label>
                  <input type="text" class="form-control" id="ID_tarik" name="ID_tarik" value="<?php echo $ID_tarik; ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="tanggal">Tanggal</label>
                  <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $tanggal; ?>">
                </div>
                <div class="form-group">
                  <label for="username">Username</label>
                  <select class="form-control" id="username" name="username" onchange="updateSaldoAwal(); updateSisaSaldo();">
                    <?php while ($rowUsername = mysqli_fetch_assoc($resultUsername)) { ?>
                      <option value="<?php echo $rowUsername['username']; ?>" data-saldo="<?php echo $rowUsername['saldo']; ?>" <?php if ($rowUsername['username'] == $username) echo 'selected'; ?>><?php echo $rowUsername['username']; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="saldoawal">Saldo Awal</label>
                  <input type="text" class="form-control" id="saldoawal" name="saldoawal" value="<?php echo $saldoawal; ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="jumlah">Jumlah Tarik</label>
                  <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?php echo $jumlah_tarik; ?>" oninput="updateSisaSaldo()">
                </div>
                <div class="form-group">
                  <label for="sisa">Sisa Saldo</label>
                  <input type="text" class="form-control" id="sisa" name="sisa" value="<?php echo $sisa_saldo; ?>" readonly>
                </div>
                <div class="form-group">
                  <label for="admin">Nama Admin</label>
                  <select class="form-control" id="admin" name="admin">
                    <?php while ($rowAdmin = mysqli_fetch_assoc($resultAdmin)) { ?>
                      <option value="<?php echo $rowAdmin['username']; ?>" <?php if ($rowAdmin['username'] == $admin) echo 'selected'; ?>><?php echo $rowAdmin['username']; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <button type="submit" name="submit" value="Update" class="btn btn-success">Update</button>
              </form>
            </div>
          </div>
        </div>
      </main>
      <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
        </div>
      </footer>
    </div>
  </div>
  <script>
    function updateSaldoAwal() {
      var selectedOption = document.getElementById("username").value;
      var saldoAwal = document.querySelector(`#username option[value="${selectedOption}"]`).getAttribute("data-saldo");
      document.getElementById("saldoawal").value = saldoAwal;
    }
    function updateSisaSaldo() {

      var username = document.getElementById("username").value;
      var jumlah = parseInt(document.getElementById("jumlah").value);

      // Mendapatkan saldo dari opsi yang dipilih
      var saldo = parseInt(document.querySelector(`#username option[value="${username}"]`).getAttribute("data-saldo"));

      var sisa = saldo - jumlah;
      document.getElementById("sisa").value = sisa;
    }
  </script>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/simple-datatables.min.js"></script>
  <script src="js/datatables-simple-demo.js"></script>
</body>

</html>
