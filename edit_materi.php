<?php
// include database connection file
require 'koneksi.php';
include_once("koneksi.php");

// Check if form is submitted for task update, then redirect to homepage after update
if (isset($_POST['update'])) {
  $id_materi = $_POST['id_materi'];
  $nama_materi = $_POST['nama_materi'];
  $file_materi = $_POST['file_materi'];
  $kode_mk = $_POST['kode_mk'];

  // update task data
  $result = mysqli_query($conn, "UPDATE materi_pembelajaran SET nama_materi='$nama_materi', file_materi='$file_materi', kode_mk='$kode_mk' WHERE id_materi='$id_materi'");

  // Redirect to homepage to display updated task in list
  header("Location: materi.php");
}
?>
<?php
// Display selected task data based on id
// Getting id from URL
$id_materi = $_GET['id_materi'];

// Fetch task data based on id
$result = mysqli_query($conn, "SELECT * FROM materi_pembelajaran WHERE id_materi='$id_materi'");

while ($data = mysqli_fetch_array($result)) {
  $nama_materi = $data['nama_materi'];
  $file_materi = $data['file_materi'];
  $kode_mk = $data['kode_mk'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <title>Edit materi</title>
</head>

<body>

  <div class="container">
    <center>
      <h3>Silahkan Masukkan Data</h3>
      <form action="edit_materi.php" method="post" name="form1">
        <table width="50%" border="0">
          <tr>
            <td>ID materi</td>
            <td><input type="text" name="id_materi" value=<?php echo $id_materi; ?> readonly></td>
          </tr>
          <tr>
            <td>Nama materi</td>
            <td><input type="text" name="nama_materi" value=<?php echo $nama_materi; ?>></td>
          </tr>
          <tr>
            <td>file_materi</td>
            <td><input type="text" name="file_materi" value=<?php echo $file_materi; ?>></td>
          </tr>
          <tr>
            <td>Kode MK</td>
            <td><input type="text" name="kode_mk" value=<?php echo $kode_mk; ?>></td>
          </tr>
          <tr>
            <td></td>
            <td><input class="btn btn-success" type="submit" name="update" value="Update Data"></td>
          </tr>
        </table>
      </form>

      <br>
      <a href="materi.php" class="btn btn-primary btn-lg" tabindex="-1" role="button" aria-disabled="true">Kembali</a>

    </center>

  </div>

</body>

</html>
