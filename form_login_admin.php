<?php
// Mulai sesi
session_start();

// Cek apakah pengguna sudah melakukan submit form login
if (isset($_POST['username'])) {
  // Mendapatkan nilai username dan password dari form login
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Lakukan validasi login (misalnya, dengan memeriksa username dan password di database)
  // ...

  // Jika login berhasil
  if ($login_success) {
    // Simpan informasi pengguna ke dalam sesi
    $_SESSION['username'] = $username;

    // Redirect ke halaman setelah login sukses
    header("Location: dashboard.php");
    exit();
  } else {
    // Redirect kembali ke halaman login dengan pesan error
    header("Location: login.php?error=1");
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
  <title>Login Admin</title>
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<style>
  h2 {
    background-color: black;
    color: white;
    font-family: sans-serif;
    text-align: center;
    width: 45%;
    margin: auto;
    padding: 20px;
  }

  body {
    background-image: url("assets/img/hutan.jpg");
    background-repeat: no-repeat;
    background-size: cover;
  }

  .card-header {
    text-align: center;
    padding: 20px;
  }

  .btn-input {
    display: block;
    width: 100%;
    padding: 0.75rem;
    font-size: 1rem;
    font-weight: bold;
    color: #fff;
    background-color: #4e73df;
    border: none;
    border-radius: 0.25rem;
    transition: background-color 0.3s;
    margin-bottom: 10px;
  }

  .btn-input:hover {
    background-color: #2653d4;
  }

  .card-body {
    text-align: center;
    padding: 20px;
  }

  .box-input {
    margin-bottom: 10px;
  }

  .box-input input {
    display: block;
    width: 100%;
    padding: 0.75rem;
    font-size: 1rem;
    border-radius: 0.25rem;
    border: 1px solid #ced4da;
  }
</style>

<body class="bg-primary">
  <div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
      <main>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-5">
              <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                  <h3 class="text-center font-weight-light my-4">Login</h3>
                </div>
                <div class="card-body">
                  <form action="login_admin.php" method="POST">
                    <div class="box-input">
                      <input type="text" name="username" placeholder="Username" required="required">
                    </div>
                    <div class="box-input">
                      <input type="password" name="password" placeholder="Password" required="required">
                    </div>
                    <button type="submit" name="login" class="btn-input">Login</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>

    <!-- Footer -->
    <footer class="footer bg-black text-white mt-5">
      <section id="projects">
        <div class="container">
          <div class="row text-center">
            <div class="col">
              <h2>Contact Us</h2>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <i class="fa fa-map-marker ms-3"></i>
              <p><span class="ms-3">UIN Malang</span> Jl. Gajayana No.10</p>
            </div>
            <div class="col-md-4">
              <i class="fa fa-phone ms-3"></i>
              <p><a class="ms-3" href="sms:(+62)81805285406">(+62)818 0528 5406</a></p>
              <p><a class="ms-3" href="sms:(+62)85648183191">(+62)856 4818 3191</a></p>
            </div>
            <div class="col-md-4">
              <i class="fa fa-envelope ms-3"></i>
              <p><a class="ms-3" href="mailto:arnesputri89909@gmail.com">arnesputri899@gmail.com</a></p>
              <p><a class="ms-3" href="mailto:halmahera_shafira@gmail.com">halmahera_shafira@gmail.com</a></p>
            </div>
          </div>
      </section>
    </footer>
    <!-- Akhir Footer -->
</body>

</html>