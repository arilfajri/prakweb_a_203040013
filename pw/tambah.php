<?php
function koneksi()
{
  $conn = mysqli_connect("localhost", "root", "");
  mysqli_select_db($conn, "prakweb_a_203040013_pw");
  return $conn;
}

// function upload
function upload()
{
  $nama_file = $_FILES['gambar']['name'];
  $tipe_file = $_FILES['gambar']['type'];
  $ukuran_file = $_FILES['gambar']['size'];
  $error = $_FILES['gambar']['error'];
  $tmp_file = $_FILES['gambar']['tmp_name'];

  // ketika tidak ada gambar yang dipilih
  if ($error == 4) {
    // echo "<script>
    //       alert('pilih gambar terlebih dahulu');
    //       </script>";
    return 'akun.png';
  }
  // cek ekstensi file
  $daftar_gambar = ['jpg', 'jpeg', 'png'];
  $ekstensi_file = explode('.', $nama_file);
  $ekstensi_file = strtolower(end($ekstensi_file));
  if (!in_array($ekstensi_file, $daftar_gambar)) {
    echo "<script>
          alert('yang anda pilih bukan gambar');
          </script>";
    return false;
  }

  // cek type file
  if ($tipe_file != 'image/jpeg' && $tipe_file != 'image/png') {
    echo "<script>
          alert('yang anda pilih bukan gambarr');
          </script>";
    return false;
  }

  // cek ukuran file
  // maks 5 mb
  if ($ukuran_file > 5000000) {
    echo "<script>
          alert('ukuran terlalu besarr');
          </script>";
    return false;
  }

  // lolos pengecekan
  // siap uploaad file
  // generate nama file baru
  $nama_file_baru = uniqid();
  $nama_file_baru .= '.';
  $nama_file_baru .= $ekstensi_file;
  move_uploaded_file($tmp_file, 'img/' . $nama_file_baru);
  return $nama_file_baru;
}

// menambahkan fungsi tambah
function tambah($data)
{
  // ambil data dari tiap elemen dalam form
  $conn = koneksi();

  $nama = htmlspecialchars($data["nama"]);
  $gambar = htmlspecialchars($data["gambar"]);
  $penulis = htmlspecialchars($data["penulis"]);
  // $poster = htmlspecialchars($data["poster"]);
  // upload gambar
  $gambar = upload();
  if (!$gambar) {
    return false;
  }

  // query insert data
  $query = "INSERT INTO buku
                VALUES
                ('', '$nama', '$gambar', '$penulis')";
  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}


// cek apakah tombol sudah ditekan atau belum
if (isset($_POST["tambah"])) {
  // cek apakah data berhasil di tambahkan atau tidak
  if (tambah($_POST) > 0) {
    echo "
            <script>
                alert('data berhasil ditambahkan')
                document.location.href = 'index.php';
            </script>
        ";
  } else {
    echo "
    <script>
        alert('data gagal ditambahkan')
        document.location.href = 'index.php';
    </script>
";
  }
}
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

  <!-- icon -->
  <link rel="shortcut icon" href="../asset/img/icon.png" type="image/png">

  <!-- css -->
  <link rel="stylesheet" href="style.css">

  <title>Tambah Data</title>
</head>

<body>
  <!-- tambah -->
  <div class="container vh-100">
    <div class="row justify-content-center h-100 pt-3">
      <div class="card my-auto">
        <div class="card-header text-center text-white">
          <h2>Tambah Data</h2>
          <hr class="text-white">
        </div>
        <div class="card-body text-white">
          <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="nama">Nama Buku : </label>
              <input type="text" class="form-control" name="nama" id="nama" required>
            </div>
            <div class="form-group">
              <label for="gambar">Gambar : </label>
              <input type="file" class="gambar form-control" name="gambar" id="gambar" onchange="previewImage()">
            </div>
            <div class="form-group text-center mt-2">
              <img src="img/akun.png" alt="" width="120" class="img-preview">
            </div>
            <div class="form-group">
              <label for="penulis">Penulis : </label>
              <input type="text" class="form-control" name="penulis" id="penulis" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-2" name="tambah">Tambah Data</button>
            <a href="index.php" class="btn btn-danger w-100 mt-2">Kembali</a>
          </form>
        </div>
        <div class="card-footer text-center text-white">
          <small>&copy; Areel</small>
        </div>
      </div>
    </div>
  </div>
  <!-- tambah -->

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