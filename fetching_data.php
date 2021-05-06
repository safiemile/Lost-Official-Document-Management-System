<?php
include_once 'connection.php';
?>

<html>
<head>
</head>
<body>
<?php
 
     
        
         $sql = 'SELECT * FROM user;';
         $result = mysqli_query($conn, $sql);

         if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
               echo $row["id_cell"]. " ".$row["firstname"]. " ".$row["lastname"]. " ".$row["sex"]. "<br>";
            }
         } else {
            echo "0 results";
         }
         mysqli_close($conn);
      ?>
</body>
</html>
