<?php
include 'koneksi.php';

if (isset($_GET['username'])) {
  $username = $_GET['username'];

  // Query untuk mendapatkan data nasabah berdasarkan NIN
  $query = "SELECT * FROM nasabah WHERE username='$username'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
    $nama = $row['nama'];
    $alamat = $row['alamat'];
    $telepon = $row['telepon'];
    $email = $row['email'];
    $password = $row['password'];
    $saldo = $row['saldo'];
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
  <title>Data Nasabah</title>
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

    table {
      width: 100%;
    }

    table td {
      padding: 10px 0;
    }

    table td input[type="text"] {
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

          </div>
      </nav>
    </div>
    <div id="layoutSidenav_content">
      <main>
        <div class="container-fluid px-4">
          <h1 class="mt-4">Data Nasabah</h1>

          <!-- DataTales Example -->
          <div class="card-body">
            <form action="edit_nasabah.php" method="POST">
              <table>
                <tr>
                  <td>Username :</td>
                  <td><input type="text" name="username" value="<?php echo $username; ?>" /></td>
                </tr>
                <tr>
                  <td>Nama :</td>
                  <td><input type="text" name="nama" value="<?php echo $nama; ?>" /></td>
                </tr>
                <tr>
                  <td>Alamat :</td>
                  <td><input type="text" name="alamat" value="<?php echo $alamat; ?>" /></td>
                </tr>
                <tr>
                  <td>No Telepon :</td>
                  <td><input type="text" name="telepon" value="<?php echo $telepon; ?>" /></td>
                </tr>
                <tr>
                  <td>Email :</td>
                  <td><input type="text" name="email" value="<?php echo $email; ?>" /></td>
                </tr>
                <tr>
                  <td>Password :</td>
                  <td><input type="text" name="password" value="<?php echo $password; ?>" /></td>
                </tr>
                <tr>
                  <td>Saldo :</td>
                  <td><input type="text" name="saldo" value="<?php echo $saldo; ?>" /></td>
                </tr>
              </table>
              <div>
                <button type="submit" name="submit" class="btn btn-success">Update</button>
              </div>
            </form>
          </div>
        </div>
      </main>
    </div>
  </div>
</body>

</html>