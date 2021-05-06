<html>
<head>
<title>Lost Official Documents</title>
<style type="text/css">
body{
background-Image:url(backimage.jpg);
}
table,tr{
	border:2px solid black;
}
table
{
	margin-top:5%;
width:100%;
background-color:white;

}
tr,th{
	height:5%;
}
th{
	border:3px solid red;
}

ul.menu{
list-style-type:none;
margin:0;
padding:0;
overflow:hidden;
background-color:#333333;
position:fixed;
top:0;
width:100%;
left:0;
}
li.menu{
float:left;
}
li.menu a{
display:block;
color:white;
text-align:center;
padding:14px 16px;
text-decoration:none;
}
li.menu a:hover{
background-color:red;

}
.active{
background-color:#4CAF50;
}
input{
background-color:white;
}
li a.title:hover{
background-color:#333333;

}
li a.active:hover{
background-color:#4CAF50;

}
</style>
</head>
<body >
              <ul class="menu">
<li class="menu"><a class="title">LOST OFFICIAL Docs   Mgmt SYSTEM </a> </li>
<li class="menu"><a href="Home.php">HOME</a></li>
<li class="menu"><a href="About.php">ABOUT</a> </li>
<li class="menu"><a href="help.php">HELP</a> </li>
<li class="menu"><a href="mailto:safiemile4@gmail.com">CONTACT US</a></li>
<li class="menu"><a href="faq.php">FAQ</a></li>
<li class="menu"><a href="login.php">LOGIN</a></li>
<li class="menu"><a class="active"  href="database.php">Database Recordes</a> </li>
 <li class ="menu"> <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a></li>
 <li class =" menu" ><a href="logout.php" class="btn btn-danger">Sign Out</a></li>
          </ul>
<table>
<th>Document Number</th>
<th>Document Type</th>
<th>District</th>
<th>Sector</th>
<th>Cell</th>
<th>Contact</th>
<th>Image</th>
<th>Option</th>


  
<?php
include_once 'connection.php';
$sql = "SELECT * FROM document ";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($result))
{
?>
<tr>
<td><?php echo $row ['id_doc']; ?></td> 
<td><?php echo $row ['type']; ?></td> 
<td><?php echo $row ['district']; ?></td> 
<td><?php echo $row ['sector']; ?></td> 
<td><?php echo $row ['cell']; ?></td> 
<td><?php echo $row ['phone']; ?></td> 
<td><img src="data:image/jpeg;base64,'.base64_encode($row['image'] ).'" height="20" width="20" class="img-thumnail" /></td> '
<td><center><a href="update.php?i=<?php echo $row['id_doc'];?>"/><input type="button" value="Update" style="background-color:blue;"/></a>&nbsp;  &nbsp; &nbsp; &nbsp;<a href="delete.php?i=<?php echo $row['id_doc'];?>"/><input type="button" value="Delete" style="background-color:red;"/></a></center></td>  
</tr>
<?php
}
?>
</table>  
</body>
</html>