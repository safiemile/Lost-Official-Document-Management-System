<?php
include_once 'connection.php';
if(isset($_POST["submit"] 
{
	
$sql = "INSERT INTO students (firstname,lastname,dob,sex,contact,disitrict,sector,cell,password,id_cell)
VALUES ('".$_POST["fn"]."','".$_POST["ln"]."','".$_POST["db"]."'".$_POST["sx"]."'".$_POST["phn"]."'".$_POST["dis"]."'".$_POST["sct"]."''".$_POST["cl"]."''".$_POST["npw"]."''".$_POST["cell-code"]."');
}
?>