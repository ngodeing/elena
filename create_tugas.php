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
      <form action="create_tugas.php" method="post" name="form1">
        <table width="50%" border="0">
          <tr>
            <td>Nama Tugas</td>
            <td><input type="text" name="nama_tugas" required></td>
          </tr>
          <tr>
            <td>Deadline</td>
            <td><input type="datetime-local" name="deadline" required></td>
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
          <td></td>
          <td><input class="btn btn-success" type="submit" name="Submit" value="Tambah Data"></td>
          </tr>
        </table>
      </form>

      <?php

      // Check If form submitted, insert form data into users table.
      if (isset($_POST['Submit'])) {
        $nama = $_POST['nama_tugas'];
        $deadline = $_POST['deadline'];
        $kode_mk = $_POST['kode_mk'];



        // include database connection file
        require 'koneksi.php';

        // Insert user data into table
        $result = mysqli_query($conn, "INSERT INTO tugas(nama_tugas,deadline, kode_mk) VALUES('$nama', '$deadline', '$kode_mk')");

        // Show message when user added
        echo "Data berhasil ditambahkan  <a class='btn btn-primary' href='tugas.php'>Lihat Data</a>";
      }
      ?>
      <br>
      <a href="tugas.php" class="btn btn-primary btn-lg " tabindex="-1" role="button" aria-disabled="true">Kembali</a>

    </center>

  </div>

</body>

</html>