<?php
// include database connection file
require 'koneksi.php';
include_once("koneksi.php");

// Check if form is submitted for task update, then redirect to homepage after update
if (isset($_POST['update'])) {
  $id_quiz = $_POST['id_quiz'];
  $nama_quiz = $_POST['nama_quiz'];
  $deadline = $_POST['deadline'];
  $kode_mk = $_POST['kode_mk'];

  // update task data
  $result = mysqli_query($conn, "UPDATE quiz SET nama_quiz='$nama_quiz', deadline='$deadline', kode_mk='$kode_mk' WHERE id_quiz='$id_quiz'");

  // Redirect to homepage to display updated task in list
  header("Location: quiz.php");
}
?>
<?php
// Display selected task data based on id
// Getting id from URL
$id_quiz = $_GET['id_quiz'];

// Fetch task data based on id
$result = mysqli_query($conn, "SELECT * FROM quiz WHERE id_quiz='$id_quiz'");

while ($data = mysqli_fetch_array($result)) {
  $nama_quiz = $data['nama_quiz'];
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
  <title>Edit quiz</title>
</head>

<body>

  <div class="container">
    <center>
      <h3>Silahkan Masukkan Data</h3>
      <form action="edit_quiz.php" method="post" name="form1">
        <table width="50%" border="0">
          <tr>
            <td>ID quiz</td>
            <td><input type="text" name="id_quiz" value=<?php echo $id_quiz; ?> readonly></td>
          </tr>
          <tr>
            <td>Nama quiz</td>
            <td><input type="text" name="nama_quiz" value=<?php echo $nama_quiz; ?>></td>
          </tr>
          <tr>
            <td>Deadline</td>
            <td><input type="datetime-local" name="deadline" value=<?php echo date('Y-m-d\TH:i', strtotime($deadline)); ?>></td>
          </tr>
          <tr>
            <td>Kode MK</td>
            <td><select name="kode_mk">
      <?php
        // Sambungkan ke database dan ambil opsi dari tabel mata_kuliah
        require 'koneksi.php';

        // Periksa koneksi
        if ($conn->connect_error) {
          die("Koneksi gagal: " . $conn->connect_error);
        }

        // Query untuk mengambil opsi dari tabel mata_kuliah
        $query = "SELECT kode_mk, nama_mk FROM mata_kuliah";
        $result = $conn->query($query);

        // Periksa apakah query berhasil
        if ($result) {
          // Tampilkan opsi dalam elemen <select>
          while ($row = $result->fetch_assoc()) {
            echo "<option value=\"" . $row['kode_mk'] . "\">" . $row['nama_mk'] . "</option>";
          }

          // Bebaskan hasil query
          $result->free_result();
        } else {
          echo "Query error: " . $conn->error;
        }

        // Tutup koneksi
        $conn->close();
      ?>
    </select></td>
          </tr>
          <tr>
            <td></td>
            <td><input class="btn btn-success" type="submit" name="update" value="Update Data"></td>
          </tr>
        </table>
      </form>

      <br>
      <a href="quiz.php" class="btn btn-primary btn-lg" tabindex="-1" role="button" aria-disabled="true">Kembali</a>

    </center>

  </div>

</body>

</html>
