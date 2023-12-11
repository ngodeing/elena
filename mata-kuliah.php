<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mata Kuliah Detail</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>

<body class="bg-gray-200 p-0 m-0 flex items-center justify-center flex-col">
    <?php
    require 'koneksi.php';

    // Periksa apakah parameter kode_mk ada dalam URL
    if (isset($_GET['kode_mk'])) {
        $kode_mk = $_GET['kode_mk'];
        $NIM = isset($_GET['NIM']) ? $_GET['NIM'] : '';
        // Ambil data mata kuliah berdasarkan kode_mk
        $query_mata_kuliah = "SELECT * FROM mata_kuliah WHERE kode_mk = '$kode_mk'";
        $result_mata_kuliah = mysqli_query($conn, $query_mata_kuliah);

        // Periksa apakah mata kuliah dengan kode_mk tersebut ada
        if (mysqli_num_rows($result_mata_kuliah) > 0) {
            $data_mata_kuliah = mysqli_fetch_assoc($result_mata_kuliah);
            $namaMahasiswa = isset($_GET['nama_user']) ? $_GET['nama_user'] : 'Nama User';
    ?>
            <div class="p-3 bg-slate-700 text-slate-100 text-2xl flex w-full justify-between">
                <h2 class="font-bold text-start ml-3">Learning Management System</h2>
                <div class="flex items-center text-end">
                    <i class="bi bi-person me-2 mb-2"></i>
                    <h2 class="font-bold text-sm me-3"><?php echo $namaMahasiswa; ?></h2>
                </div>
            </div>

            <div class="matakuliah pt-10 flex justify-center flex-col">
                <h1 class="text-2xl font-bold text-center mb-10"><?php echo $data_mata_kuliah['nama_mk']; ?></h1>

                <?php
                // Ambil data materi pembelajaran berdasarkan kode_mk
                $query_materi = "SELECT * FROM materi_pembelajaran WHERE kode_mk = '$kode_mk'";
                $result_materi = mysqli_query($conn, $query_materi);
                ?>
                <div class="m-4">
                    <h2 class="text-2xl font-bold mb-3">Materi Pembelajaran</h2>
                    <table class="min-w-full bg-white border border-gray-300 text-center">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border">Nama Materi</th>
                                <th class="py-2 px-4 border">File Materi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($data_materi = mysqli_fetch_assoc($result_materi)) {
                                echo "<tr>";
                                echo "<td class='py-2 px-4 border'>" . $data_materi['nama_materi'] . "</td>";
                                echo "<td class='py-2 px-4 border'>" . $data_materi['file_materi'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <?php
                // Ambil data tugas berdasarkan kode_mk
                $query_tugas = "SELECT * FROM tugas WHERE kode_mk = '$kode_mk'";
                $result_tugas = mysqli_query($conn, $query_tugas);
                ?>
                <div class="m-4">
                    <h2 class="text-2xl font-bold mb-3">Tugas</h2>
                    <table class="min-w-full bg-white border border-gray-300 text-center">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border">Nama Tugas</th>
                                <th class="py-2 px-4 border">Deadline</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($data_tugas = mysqli_fetch_assoc($result_tugas)) {
                                echo "<tr>";
                                echo "<td class='py-2 px-4 border'>" . $data_tugas['nama_tugas'] . "</td>";
                                echo "<td class='py-2 px-4 border'>" . $data_tugas['deadline'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <?php
// Ambil data tugas berdasarkan kode_mk
$query_mtugas = "SELECT * FROM mengerjakan_tugas WHERE kode_mk = '$kode_mk'";
$result_mtugas = mysqli_query($conn, $query_mtugas);
?>
<div class="m-4">
    <h2 class="text-2xl font-bold mb-5">Tugas Dikerjakan<a href="create_mtugas.php?kode_mk=<?php echo $kode_mk; ?>&NIM=<?php echo urlencode($NIM); ?>" class="bg-green-600 p-3 text-white rounded-lg my-5 ml-5 text-sm" tabindex="-1" role="button" aria-disabled="true">Upload Tugas</a>
</h2>
    
    <table class="min-w-full bg-white border border-gray-300 text-center mt-5">
        <thead>
            <tr>
                <th class="py-2 px-4 border">Nama Tugas</th>
                <th class="py-2 px-4 border">File Tugas</th>
                <th class="py-2 px-4 border">Status Tugas</th>
                <th class="py-2 px-4 border">Nilai Tugas</th>
                <th class="py-2 px-4 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
            while ($data_tugas = mysqli_fetch_assoc($result_mtugas)) {
                // Fetching nama_tugas based on id_tugas
                $id_tugas = $data_tugas['id_tugas'];
                $id_uptugas = $data_tugas['id_uptugas'];
                $query_nama_tugas = "SELECT nama_tugas FROM tugas WHERE id_tugas = '$id_tugas'";
                $result_nama_tugas = mysqli_query($conn, $query_nama_tugas);

                // Check if the query was successful
                if ($result_nama_tugas && $row_nama_tugas = mysqli_fetch_assoc($result_nama_tugas)) {
                    $nama_tugas = $row_nama_tugas['nama_tugas'];
                } else {
                    $nama_tugas = "Nama Tugas Not Found";
                }

                echo "<tr>";
                echo "<td class='py-2 px-4 border'>" . $nama_tugas . "</td>";
                echo "<td class='py-2 px-4 border'>" . $data_tugas['file_tugas'] . "</td>";
                echo "<td class='py-2 px-4 border'>" . $data_tugas['status_tugas'] . "</td>";
                echo "<td class='py-2 px-4 border'>" . $data_tugas['nilai_tugas'] . "</td>";
                echo "<td>
                <a href='delete_mtugas.php?id_uptugas=$id_uptugas&kode_mk=" . urlencode($kode_mk) . "&NIM=" . urlencode($NIM) . "' class='btn bg-red-600 text-white p-2 text-xs m-2 rounded-lg btn-sm' style='font-weight: 600;'>Hapus</a>
                    </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>



                <?php
                // Ambil data quiz berdasarkan kode_mk
                $query_quiz = "SELECT * FROM quiz WHERE kode_mk = '$kode_mk'";
                $result_quiz = mysqli_query($conn, $query_quiz);
                ?>
                <div class="m-4">
                    <h2 class="text-2xl font-bold mb-3">Quiz</h2>
                    <table class="min-w-full bg-white border border-gray-300 text-center">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border">Nama Quiz</th>
                                <th class="py-2 px-4 border">Deadline</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($data_quiz = mysqli_fetch_assoc($result_quiz)) {
                                echo "<tr>";
                                echo "<td class='py-2 px-4 border'>" . $data_quiz['nama_quiz'] . "</td>";
                                echo "<td class='py-2 px-4 border'>" . $data_quiz['deadline'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <?php
// Ambil data quiz berdasarkan kode_mk
$query_mquiz = "SELECT * FROM mengerjakan_quiz WHERE kode_mk = '$kode_mk'";
$result_mquiz = mysqli_query($conn, $query_mquiz);
?>
<div class="m-4">
    <h2 class="text-2xl font-bold mb-5">Quiz Dikerjakan<a href="create_mquiz.php?kode_mk=<?php echo $kode_mk; ?>&NIM=<?php echo urlencode($NIM); ?>" class="bg-green-600 p-3 text-white rounded-lg my-5 ml-5 text-sm" tabindex="-1" role="button" aria-disabled="true">Upload quiz</a>
</h2>
    
    <table class="min-w-full bg-white border border-gray-300 text-center mt-5">
        <thead>
            <tr>
                <th class="py-2 px-4 border">Nama quiz</th>
                <th class="py-2 px-4 border">Score quiz</th>
                <th class="py-2 px-4 border">Status quiz</th>
                <th class="py-2 px-4 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
            while ($data_quiz = mysqli_fetch_assoc($result_mquiz)) {
                // Fetching nama_quiz based on id_quiz
                $id_quiz = $data_quiz['id_quiz'];
                $id_upquiz = $data_quiz['id_upquiz'];
                $query_nama_quiz = "SELECT nama_quiz FROM quiz WHERE id_quiz = '$id_quiz'";
                $result_nama_quiz = mysqli_query($conn, $query_nama_quiz);

                // Check if the query was successful
                if ($result_nama_quiz && $row_nama_quiz = mysqli_fetch_assoc($result_nama_quiz)) {
                    $nama_quiz = $row_nama_quiz['nama_quiz'];
                } else {
                    $nama_quiz = "Nama quiz Not Found";
                }

                echo "<tr>";
                echo "<td class='py-2 px-4 border'>" . $nama_quiz . "</td>";
                echo "<td class='py-2 px-4 border'>" . $data_quiz['skor_quiz'] . "</td>";
                echo "<td class='py-2 px-4 border'>" . $data_quiz['status_quiz'] . "</td>";
                echo "<td>
                <a href='delete_mquiz.php?id_upquiz=$id_upquiz&kode_mk=" . urlencode($kode_mk) . "&NIM=" . urlencode($NIM) . "' class='btn bg-red-600 text-white p-2 text-xs m-2 rounded-lg btn-sm' style='font-weight: 600;'>Hapus</a>
                    </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
    <?php
        } else {
            // Tampilkan pesan jika mata kuliah tidak ditemukan
            echo "<div class='text-center p-3 text-white bg-danger'>";
            echo "<h2 class='font-bold'>Mata Kuliah Tidak Ditemukan</h2>";
            echo "</div>";
        }
    } else {
        // Tampilkan pesan jika parameter kode_mk tidak ada dalam URL
        echo "<div class='text-center p-3 text-white bg-danger'>";
        echo "<h2 class='font-bold'>Kode Mata Kuliah Tidak Ditemukan</h2>";
        echo "</div>";
    }
    ?>
</body>

</html>
