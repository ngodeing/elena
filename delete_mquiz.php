<?php
// include database connection file
include_once("koneksi.php");
$NIM = isset($_GET['NIM']) ? $_GET['NIM'] : '';
$kode_mk = isset($_GET['kode_mk']) ? $_GET['kode_mk'] : '';
// Get id from URL to delete that user
$id_upquiz = $_GET['id_upquiz'];

// Delete user row from table based on given id
$result = mysqli_query($conn, "DELETE FROM mengerjakan_quiz WHERE id_upquiz='$id_upquiz'");

// After delete redirect to Home, so that latest user list will be displayed.
header("Location:mata-kuliah.php?kode_mk=$kode_mk&NIM=$NIM");