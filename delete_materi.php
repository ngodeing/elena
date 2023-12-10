<?php
// include database connection file
include_once("koneksi.php");

// Get id from URL to delete that user
$id_materi = $_GET['id_materi'];

// Delete user row from table based on given id
$result = mysqli_query($conn, "DELETE FROM materi_pembelajaran WHERE id_materi='$id_materi'");

// After delete redirect to Home, so that latest user list will be displayed.
header("Location:materi.php");