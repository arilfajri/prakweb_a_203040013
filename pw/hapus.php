<?php
function koneksi()
{
  $conn = mysqli_connect("localhost", "root", "");
  mysqli_select_db($conn, "prakweb_a_203040013_pw");
  return $conn;
}

// function untuk melakukan query dan memasukannya kedalaam array
function query($sql)
{
  $conn = koneksi();
  $result = mysqli_query($conn, "$sql");
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

$id = $_GET["id"];
// menambah fungsi hapus
function hapus($id)
{
  $conn = koneksi();

  // menghapus gambar di folder img
  $buku = query("SELECT * FROM buku WHERE id = $id")[0];
  if ($buku['gambar'] != 'akun.png') {
    unlink('img/' . $buku['gambar']);
  }

  mysqli_query($conn, "DELETE FROM buku where id = $id") or die(mysqli_error($conn));

  return mysqli_affected_rows($conn);
}

if (hapus($id) > 0) {
  echo "
            <script>
                alert('data berhasil dihapuss!');
                document.location.href = 'index.php';
            </script>
        ";
} else {
  echo "
            <script>
                alert('data gagal ditambahkann!');
                document.location.href = 'index.php';
            </script>
        ";
}
