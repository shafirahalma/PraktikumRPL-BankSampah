<?php
include 'koneksi.php';

$ID_setor = "";
$tanggal = "";
$username = "";
$ID_sampah = "";
$berat = "";
$saldopendapatan = "";
$admin = "";

if (isset($_GET['id'])) {
  $ID_setor = $_GET['id'];

  // Query untuk mendapatkan data penyetoran berdasarkan ID_setor
  $query = "SELECT * FROM t_setor WHERE ID_setor='$ID_setor'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $ID_setor = $row['ID_setor'];
    $tanggal = $row['tanggal'];
    $username = $row['username'];
    $ID_sampah = $row['ID_sampah'];
    $berat = $row['berat'];
    $saldopendapatan = $row['saldopendapatan'];
    $admin = $row['admin'];
  } else {
    echo "No data found.";
    exit;
  }
}

// Query untuk mendapatkan data nasabah
$query_nasabah = "SELECT * FROM nasabah";
$result_nasabah = mysqli_query($conn, $query_nasabah);

// Query untuk mendapatkan data sampah
$query_sampah = "SELECT * FROM sampah";
$result_sampah = mysqli_query($conn, $query_sampah);

// Query untuk mendapatkan daftar admin
$query_admin = "SELECT * FROM admin";
$result_admin = mysqli_query($conn, $query_admin);
?>
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
          <h1 class="mt-4">Transaksi Setor</h1>

          <!-- DataTales Example -->
          <div class="card-body">
            <form action="edit_tsetor.php" method="POST">
              <table>
                <tr>
                  <td>ID Penyetoran :</td>
                  <td><input type="text" name="ID_setor" value="<?php echo $ID_setor; ?>" readonly /></td>
                </tr>
                <tr>
                  <td>Tanggal Penyetoran:</td>
                  <td><input type="date" name="tanggal" value="<?php echo $tanggal; ?>" /></td>
                </tr>
                <tr>
                  <td>Username:</td>
                  <td>
                    <div class="input-group">
                      <select class="form-select" name="username">
                        <?php
                        // Menampilkan pilihan username dari database
                        while ($row_nasabah = mysqli_fetch_assoc($result_nasabah)) {
                          $selected_username = ($row_nasabah['username'] == $username) ? 'selected' : '';
                          echo "<option value='" . $row_nasabah['username'] . "' $selected_username>" . $row_nasabah['username'] . "</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </td>
                </tr>

                <tr>
                  <td>ID Sampah:</td>
                  <td>
                    <div class="input-group">
                      <select class="form-select" name="ID_sampah" id="ID_sampah" onchange="calculatePrice()">
                        <?php
                        // Menampilkan pilihan ID_sampah dari database
                        while ($row_sampah = mysqli_fetch_assoc($result_sampah)) {
                          $selected_ID_sampah = ($row_sampah['ID_sampah'] == $ID_sampah) ? 'selected' : '';
                          echo "<option value='" . $row_sampah['ID_sampah'] . "' $selected_ID_sampah data-harga='" . $row_sampah['harga'] . "'>" . $row_sampah['ID_sampah'] . "</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </td>
                </tr>

                <tr>
                  <td>Berat :</td>
                  <td><input type="text" name="berat" id="berat" value="<?php echo $berat; ?>" oninput="calculatePrice()" /></td>
                </tr>
                <tr>
                  <td>Saldo Pendapatan :</td>
                  <td><input type="text" name="saldopendapatan" id="saldopendapatan" value="<?php echo $saldopendapatan; ?>" readonly /></td>
                </tr>
                <tr>
                  <td>Admin:</td>
                  <td>
                    <div class="input-group">
                      <select class="form-select" name="admin">
                        <?php
                        // Menampilkan opsi admin
                        while ($row_admin = mysqli_fetch_assoc($result_admin)) {
                          $selected_admin = ($row_admin['username'] == $admin) ? 'selected' : '';
                          echo "<option value='" . $row_admin['username'] . "' $selected_admin>" . $row_admin['username'] . "</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </td>
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