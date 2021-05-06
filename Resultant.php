<?php
include_once 'connection.php';
$n = $_POST['un'];
$sql = "SELECT * FROM document WHERE id_doc= '$n'";
$result = mysqli_query($conn, $sql);
$test= mysqli_num_rows($result);
if($test == 0)
{
	
	echo "<script type='text/javascript'>
	if(confirm('Sorry No Result Found Try Again, please  Navigate back'))
	{
		window.location = 'Home.php';
	}
	else
	{
		window.location = 'Home.php';
	}
	</script>";
exit;
header("location: Home.php");	
}
else{
	echo "<script type='text/javascript'>alert('Great Your Document is  Found ');</script>";
}
?>
<html>
<head>
<title>Lost Official Documents</title>
<style type="text/css">
body{
background-image:url(backimage.jpg);
background-attachment:scroll;
background-repeat:repeat;
color:black;
}
tr#r1{
height:30%;
}
tr#r2{
height:5%
}
td#r2c1,td#r2c2,td#r2c3,td#r2c4,td#r2c5,td#r2c5,td#r2c6{
                                          width:15%;
background:pink;
                                                }
table,tr{
border:2px solid;
}
table{
margin-right:auto;
margin-left:auto;
margin-top:5%;
height:90%;
width:50%;
}

tr#r4{
height:5%;
}
table{
background-color:white;
color:black;
}
table,tr#r1{

border-radius:25px;
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
li a.title:hover{
background-color:#333333;

}
li a.active:hover{
background-color:#4CAF50;

}

</style>
</head>
<body>
 <ul class="menu">
<li class="menu"><a class="title">LOST OFFICIAL DOCUMENTS MANAGEMENT SYSTEM </a> </li>
<li class="menu"><a href="Home.php">HOME</a></li>
<li class="menu"><a href="About.php">ABOUT</a> </li>
<li class="menu"><a href="help.php">HELP</a> </li>
<li class="menu"><a href="mailto:safiemile4@gmail.com">CONTACT US</a></li>
<li class="menu"><a href="faq.php">FAQ</a></li>
<li class="menu"><a href="login.php">LOGIN</a></li>
<li class="menu"><a class="active" >  YOUR DOCUMENT IS FOUND</a> </li>
          </ul>
<table>ult
                <tr id="r3"> 
                                   <td  id="r3c1" colspan="6"> 
<p style="margin-left:10%">The Document with the following details:<br/>
<?php
while($row = mysqli_fetch_array($result))
{
?>
Image:<center><img src="data:image/jpg;base64,'.base64_encode($row['image'].'" width="50%" height="50%"/></center><br/>
Document type:<center><input type ="text" value = "<?php echo $row ['type']; ?>"/></center><br/>
Document Number:<center><input type ="text" value = "<?php echo $row ['id_doc']; ?>"/></center><br/><br/>
<b>Its Current Location Where you Can find it:</b><br/><br/>
District:<center><input type ="text" value = "<?php echo $row ['district']; ?>"/></center><br/>
Sector:<center><input type ="text" value = "<?php echo $row ['sector']; ?>"/></center><br/>
Cell:<center><input type ="text" value = "<?php echo $row ['cell']; ?>"/></center><br/>

Contact of Cell Learder:<center><input type ="text" value = "<?php echo $row ['phone']; ?>"/></center><br/><br/>
<?php	
}

?>


<i>Thank for Using our Web Application <br/>
 </form>
 <p>






                                   </td>
                      
           </tr>

          <tr  id="r4"height="5%">
                                  <td  id="r3c1"colspan="6"> 
<center><a href="terms.html">Terms And Conditions|</a>
<a href="poly.html">Privacy policy</a><br/>
 Copyright-2019@Nid</center>     
                                  </td>
          </tr>

</table>
</body>
</html>