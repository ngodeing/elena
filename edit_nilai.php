<?php
// include database connection file
require 'koneksi.php';
include_once("koneksi.php");

// Check if form is submitted for task update, then redirect to homepage after update
if (isset($_POST['update'])) {
  $NIM = $_POST['NIM'];
  $id_tugas = $_POST['id_tugas'];
  $id_uptugas = $_POST['id_uptugas'];
  $file_tugas = $_POST['file_tugas'];
  $status_tugas = $_POST['status_tugas'];
  $kode_mk = $_POST['kode_mk'];
  $nilai_tugas = $_POST['nilai_tugas'];

  // update task data
  // update task data
$result = mysqli_query($conn, "UPDATE mengerjakan_tugas SET nilai_tugas='$nilai_tugas' WHERE id_uptugas='$id_uptugas'");

  // Redirect to homepage to display updated task in list
  header("Location: tugas.php");
}
?>
<?php
// Display selected task data based on id
// Getting id from URL
$id_tugas = $_GET['id_tugas'];

// Fetch task data based on id
$result = mysqli_query($conn, "SELECT * FROM mengerjakan_tugas WHERE id_tugas='$id_tugas'");

while ($data = mysqli_fetch_array($result)) {
    $NIM = $data['NIM'];
    $id_tugas = $data['id_tugas'];
    $id_uptugas = $data['id_uptugas'];
    $file_tugas = $data['file_tugas'];
    $status_tugas = $data['status_tugas'];
    $kode_mk = $data['kode_mk'];
    $nilai_tugas = $data['nilai_tugas'];
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
      <form action="edit_nilai.php" method="post" name="form1">
      <input type="hidden" name="NIM" value=<?php echo $NIM; ?>>
      <input type="hidden" name="id_tugas" value=<?php echo $id_tugas; ?>>
        <input type="hidden" name="id_uptugas" value=<?php echo $id_uptugas; ?>>
      <input type="hidden" name="file_tugas" value=<?php echo $file_tugas; ?>>
      <input type="hidden" name="status_tugas" value=<?php echo $status_tugas; ?>>
        <input type="hidden" name="kode_mk" value=<?php echo $kode_mk; ?>>
        <table width="50%" border="0">
          <tr>
            <td>Nilai Tugas</td>
            <td><input type="text" name="nilai_tugas" value=<?php echo $nilai_tugas; ?>></td>
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
