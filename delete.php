<?php
$id = $_GET['i'];
include_once'connection.php';
$q = "delete from document where id_doc = '$id'";
mysqli_query($conn, $q);
header("location: database.php");

?>