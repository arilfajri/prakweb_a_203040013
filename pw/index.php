<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "prakweb_a_203040013_pw");

// ambil dari tabel film / query
$result = mysqli_query($conn, "SELECT * FROM buku");

// ubah data ke dalam array
// $row = mysqli_fetch_row($result); // array numerik
// $row = mysqli_fetch_assoc($result); // array associative
// $row = mysqli_fetch_array($result); // keduanya
$rows = [];
while ($row = mysqli_fetch_assoc($result)) {
  $rows[] = $row;
}
// tampung ke variabel buku
$buku = $rows;
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

  <!-- font -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">

  <!-- font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- icon -->
  <link rel="shortcut icon" href="../asset/img/icon.png" type="image/png">

  <title>Daftar Buku</title>
  <style>
    body {
      background-color: #0c111b;
      font-family: 'Poppins', sans-serif;
    }

    .navbar {
      background-color: #121926;
    }

    .nav-link {
      font-weight: 400;
    }

    nav {
      box-shadow: 0px 4px 6px -1px rgba(255, 255, 255, 0.3);
      z-index: 9999;
    }

    .add {
      margin-left: 5px;
    }

    .kembali {
      margin-left: 5px;
    }

    .navbar-brand h3 {
      font-family: 'Zen Dots';
      color: #ffffff;
      text-shadow: 0px 0px 10px rgb(0, 162, 255);

    }
  </style>
</head>

<body>
  <!-- navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">
        <h3>Areel</h3>
      </a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

      </div>
    </div>
  </nav>
  <!-- akhir -->

  <!-- admin -->
  <div class="container pt-5">
    <div class="row pt-5">
      <div class="col">
        <h2 class="pt text-white justify text-center">Daftar Buku</h2>
        <hr class="text-white">
      </div>
      <div class="add justify text-center">
        <a href="tambah.php" class="btn btn-primary">Tambah Data</a>
      </div>
    </div>
  </div>
  <!-- admin -->

  <div class="containere">
    <div class="float-md-start pt-3">
      <table class="table table-bordered border-light text-white align-middle justify text-center" style="background-color: #121926;">
        <thead>
          <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Gambar</th>
            <th>Penulis</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>

          <?php $i = 1; ?>
          <?php foreach ($buku as $row) : ?>
            <tr>
              <td><?= $i++; ?></td>
              <td><?= $row["nama"]; ?> </td>
              <td><img src="img/<?= $row["gambar"]; ?>" alt="" width="100"></td>
              <td><?= $row["penulis"]; ?></td>
              <td>
                <center>
                  <a href="ubah.php?id=<?= $row["id"]; ?>" onclick="return confirm('Ubah Data??')" class="btn btn-primary mt-4">Ubah</a>
                  <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Hapus Data??')" class="btn btn-danger mt-3">Hapus</a>
                </center>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
</body>

</html>