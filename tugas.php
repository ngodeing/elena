<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Praktikum 6</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <center>
            <h2 class="mt-4">Daftar Tugas</h2>
        </center>
        <a href="create_tugas.php" class="btn btn-success btn-lg my-3" tabindex="-1" role="button" aria-disabled="true">Tambah Data</a>
        <table class="table table-hover-dark table-bordered text-center">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">ID Tugas</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Deadline</th>
                    <th scope="col">Mata kuliah</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require 'koneksi.php';
                $hasil = mysqli_query($conn, "SELECT * FROM tugas")
                ?>
                <?php
                $no = 1;
                while ($data = mysqli_fetch_array($hasil)) {
                    echo "<tr>";
                    echo "<th>" . $no . "</th>";
                    echo "<td>" . $data['id_tugas'] . "</td>";
                    echo "<td>" . $data['nama_tugas'] . "</td>";
                    echo "<td>" . $data['deadline'] . "</td>";
                    echo "<td>" . $data['kode_mk'] . "</td>";
                    echo "<td>
            <a href='edit_tugas.php?id_tugas=$data[id_tugas]' class='btn btn-warning btn-sm' style='font-weight: 600;'>Edit</a>|
            <a href='delete_tugas.php?id_tugas=$data[id_tugas] ' class='btn btn-danger btn-sm' style='font-weight: 600;'>Delete</a>
            </td>";
                    echo "</tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
        <center>
            <h2 class="my-5">Pengumpulan Tugas</h2>
        </center>
        <table class="table table-hover-dark table-bordered text-center mb-5">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">NIM</th>
                    <th scope="col">Nama Tugas</th>
                    <th scope="col">File Tugas</th>
                    <th scope="col">Status Tugas</th>
                    <th scope="col">Mata Kuliah</th>
                    <th scope="col">Nilai Tugas</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            require 'koneksi.php';
            $hasil = mysqli_query($conn, "SELECT * FROM mengerjakan_tugas");
            ?>

            <?php
            $no = 1;
            while ($data = mysqli_fetch_array($hasil)) {
                $id_tugas = $data['id_tugas'];

                // Fetching nama_tugas based on id_tugas
                $query_nama_tugas = "SELECT nama_tugas FROM tugas WHERE id_tugas = '$id_tugas'";
                $result_nama_tugas = mysqli_query($conn, $query_nama_tugas);

                // Check if the query was successful
                if ($result_nama_tugas && $row_nama_tugas = mysqli_fetch_assoc($result_nama_tugas)) {
                    $nama_tugas = $row_nama_tugas['nama_tugas'];
                } else {
                    $nama_tugas = "Nama Tugas Not Found";
                }

                echo "<tr>";
                echo "<th>" . $no . "</th>";
                echo "<td>" . $data['NIM'] . "</td>";
                echo "<td>" . $nama_tugas . "</td>";
                echo "<td>" . $data['file_tugas'] . "</td>";
                echo "<td>" . $data['status_tugas'] . "</td>";
                echo "<td>" . $data['kode_mk'] . "</td>";
                echo "<td>" . $data['nilai_tugas'] . "</td>";
                echo "<td>
                    <a href='edit_nilai.php?id_tugas=$id_tugas' class='btn btn-warning btn-sm' style='font-weight: 600;'>Edit Nilai</a>
                    </td>";
                echo "</tr>";
                $no++;
            }
            ?>

            </tbody>
        </table>
        
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</body>

</html>