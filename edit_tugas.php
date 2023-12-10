<?php
// include database connection file
require 'koneksi.php';
include_once("koneksi.php");

// Check if form is submitted for task update, then redirect to homepage after update
if (isset($_POST['update'])) {
  $id_tugas = $_POST['id_tugas'];
  $nama_tugas = $_POST['nama_tugas'];
  $deadline = $_POST['deadline'];
  $kode_mk = $_POST['kode_mk'];

  // update task data
  $result = mysqli_query($conn, "UPDATE tugas SET nama_tugas='$nama_tugas', deadline='$deadline', kode_mk='$kode_mk' WHERE id_tugas='$id_tugas'");

  // Redirect to homepage to display updated task in list
  header("Location: tugas.php");
}
?>
<?php
// Display selected task data based on id
// Getting id from URL
$id_tugas = $_GET['id_tugas'];

// Fetch task data based on id
$result = mysqli_query($conn, "SELECT * FROM tugas WHERE id_tugas='$id_tugas'");

while ($data = mysqli_fetch_array($result)) {
  $nama_tugas = $data['nama_tugas'];
  $deadline = $data['deadline'];
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
  <title>Edit Tugas</title>
</head>

<body>

  <div class="container">
    <center>
      <h3>Silahkan Masukkan Data</h3>
      <form action="edit_tugas.php" method="post" name="form1">
        <table width="50%" border="0">
          <tr>
            <td>ID Tugas</td>
            <td><input type="text" name="id_tugas" value=<?php echo $id_tugas; ?> readonly></td>
          </tr>
          <tr>
            <td>Nama Tugas</td>
            <td><input type="text" name="nama_tugas" value=<?php echo $nama_tugas; ?>></td>
          </tr>
          <tr>
            <td>Deadline</td>
            <td><input type="datetime-local" name="deadline" value=<?php echo date('Y-m-d\TH:i', strtotime($deadline)); ?>></td>
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
      <a href="tugas.php" class="btn btn-primary btn-lg" tabindex="-1" role="button" aria-disabled="true">Kembali</a>

    </center>

  </div>

</body>

</html>
