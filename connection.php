<?php

$bdservername = "localhost";
$dbusername = "root";
$dbname = "webdatabase";
$dbpassword = "";
$conn = mysqli_connect("$bdservername" ,"$dbusername","$dbpassword" ,"$dbname") or die ('unable to connect:'.mysqli_error()); 
?>