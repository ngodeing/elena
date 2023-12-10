<?php
// include database connection file
include_once("koneksi.php");

// Get id from URL to delete that user
$id_tugas = $_GET['id_tugas'];

// Delete user row from table based on given id
$result = mysqli_query($conn, "DELETE FROM tugas WHERE id_tugas='$id_tugas'");

// After delete redirect to Home, so that latest user list will be displayed.
header("Location:tugas.php");