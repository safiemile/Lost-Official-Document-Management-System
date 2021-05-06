<?php

include_once 'connection.php';
$sql = "SELECT * FROM document";
$result = mysqli_query($conn, $sql);
?>
<html>
<head>
</head>
<body>
<?php
while($row = mysqli_fetch_array($result))
{
?>
		    echo $row['id_doc']." ".$row['type']." ".$row['phone'];
		 <input type="text"  value = "<?php echo $row['id_doc']; ?>"/>
<?php	
}
?>

</body>
</html>