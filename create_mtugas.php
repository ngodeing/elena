<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <title>Tambah Tugas</title>
</head>

<body>
  <div class="container">
    <center>
      <h3>Silahkan Masukkan Data</h3>
      <form action="create_mtugas.php" method="post" name="form1">
      <input type="hidden" name="NIM" value="<?php echo isset($_GET['NIM']) ? $_GET['NIM'] : ''; ?>">

<input type="hidden" name="kode_mk" value="<?php echo isset($_GET['kode_mk']) ? $_GET['kode_mk'] : ''; ?>">

      <input type="hidden" name="status_tugas" value='Submitted'>
      <input type="hidden" name="nilai_tugas" value='Not Graded'>
        <table width="50%" border="0">
        <tr>
            <td>Pilih Tugas</td>
            <td><select name="id_tugas">
      <?php
        // Sambungkan ke database dan ambil opsi dari tabel mata_kuliah
        require 'koneksi.php';
        // Periksa koneksi
        if ($conn->connect_error) {
          die("Koneksi gagal: " . $conn->connect_error);
        }
        $kode_mk = isset($_GET['kode_mk']) ? $_GET['kode_mk'] : '';

        // Query untuk mengambil opsi dari tabel mata_kuliah
        $query = "SELECT id_tugas, nama_tugas FROM tugas WHERE kode_mk = '$kode_mk'";
        $result = $conn->query($query);

        // Periksa apakah query berhasil
        if ($result) {
          // Tampilkan opsi dalam elemen <select>
          while ($row = $result->fetch_assoc()) {
            echo "<option value=\"" . $row['id_tugas'] . "\">" . $row['nama_tugas'] . "</option>";
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
            <td>File Tugas</td>
            <td><input type="text" name="file_tugas" required></td>
          </tr>
    </select></td>
          </tr>
          <td></td>
          <td><input class="btn btn-success" type="submit" name="Submit" value="Tambah Data"></td>
          </tr>
        </table>
      </form>

      <?php
$NIM = isset($_GET['NIM']) ? $_GET['NIM'] : '';
$kode_mk = isset($_GET['kode_mk']) ? $_GET['kode_mk'] : '';
      // Check If form submitted, insert form data into users table.
      if (isset($_POST['Submit'])) {
        $NIM = $_POST['NIM'];
        $id_tugas = $_POST['id_tugas'];
        $file_tugas = $_POST['file_tugas'];
        $status_tugas = $_POST['status_tugas'];
        $kode_mk = $_POST['kode_mk'];
        $nilai_tugas = $_POST['nilai_tugas'];



        // include database connection file
        require 'koneksi.php';

        // Insert user data into table
        $result = mysqli_query($conn, "INSERT INTO mengerjakan_tugas(id_tugas,NIM,file_tugas,status_tugas,nilai_tugas, kode_mk) VALUES('$id_tugas','$NIM', '$file_tugas','$status_tugas','$nilai_tugas','$kode_mk')");

        // Show message when user added
        echo "Data berhasil ditambahkan <a class='btn btn-primary' href='mata-kuliah.php?NIM=" . urlencode($NIM) . "&kode_mk=" . urlencode($kode_mk) . "'>Lihat Data</a>";

      }
      echo "<br><a href='mata-kuliah.php?NIM=" . urlencode($NIM) . "&kode_mk=" . urlencode($kode_mk) . "' class='btn btn-primary btn-lg' tabindex='-1' role='button' aria-disabled='true'>Kembali</a>";
      ?>

    </center>

  </div>

</body>

</html>