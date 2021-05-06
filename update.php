<?php
include_once'connection.php';
$i = $_GET['i'];

if(isset($_POST['up']))
{
	$image =addslashes(file_get_contents($_FILES['image']['tmp_name']));
	$docnumber = $_POST['id'];
	$doctype = $_POST['dtp'];
	$district = $_POST['ds'];
	$sector = $_POST['sct'];
	$cell = $_POST['cl'];
	$contact = $_POST['phn']; 
	
	$u ="update document set type= '$doctype',district= '$district',sector= '$sector',cell= '$cell',phone= '$contact' ,image= '$image', id_doc= '$docnumber' where id_doc= '$i'";
  mysqli_query($conn,$u);
  header("location: database.php");
}
?>
<html>
<head>
<title>Lost Official Documents</title>
<style type="text/css">
body{
background-Image:url(backimage.jpg);
}
table,tr{
border:2px solid;
}
table{
margin-right:auto;
margin-left:auto;
height:100%;
width:100%;
background-color:white;
}
td#r3c1{
width:50%;
}
td#r3c3{
width:50%;
}
tr#r4{
height:5%;
}
                                   p#aa1{margin-left:20%;
                                      margin-right:20%;
               border:2px solid blue;
border-style:ridge;
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
<body onload =" hide()">
<table>
        <tr id="r2">
<td calspan="6">      <ul class="menu">
<li class="menu"><a class="title">LOST  D MgnmSt SYSTEM </a> </li>
<li class="menu"><a href="Home.php">HOME</a></li>
<li class="menu"><a href="About.php">ABOUT</a> </li>
<li class="menu"><a href="help.php">HELP</a> </li>
<li class="menu"><a href="mailto:safiemile4@gmail.com">CONTACT US</a></li>
<li class="menu"><a href="faq.php">FAQ</a></li>
<li class="menu"><a href="login.php">LOGIN</a></li>
<li class="menu"><a class="active" >WELCOME!!</a> </li>
 <li class ="menu"> <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a></li>
 <li class =" menu" ><a href="logout.php" class="btn btn-danger">Sign Out</a></li>
          </ul></td>
          </tr>

          <tr id="r3"> 
                                   <td  id="r3c1" colspan="3">  
								   <center ><span style="margin-top:20%;"><h1>Change  The Information Required Bellow:</h1></span></center>
			<center>
			<form action=""method= "POST" enctype="multipart/form-data">
			<center><label>Document Number</label>
			<input type="text" name ="id" value="<?php echo $i;?>">
			<br/><br/>
			</center>
                <center><label>Choose Image</label>
              <input type="file" name="image" id="imagee" />
			  <br/><br/>
                
            </center>
			                <label>Document Type</label>
                <select name="dtp">
				<option value="National Identity Card">National Identity Card</option>
				<option value="Passport">Passport</option>
				<option value="Driving Licence">Driving Licence</option>
				<option value="High School Certificate">High School Certificate</option>
				<option value="Other">Other</option>
				</select><br/><br/>
				
               
            </center>       
				<center><label>District</label>
                <input type="text" name="ds" class="form-control" value="">
            </center><br/><br/>
						
                <center><label>Sector</label>
                <input type="text" name="sct" class="form-control" value="">
                <br/><br/>
            </center>
			            
			
                <center><label>Cell</label>
                <input type="text" name="cl" class="form-control" value="">
                 <br/><br/>
            </center>
						
               <center> <label>Your Phone Number</label>
                <input type="text" name="phn" class="form-control" value="">
                <br/><br/>
            </center>
			
            
                <center><input type="submit" class="btn btn-primary" name="up" value="UPDATE" style="color:white; background-color:blue;"/>
                <input type="reset" class="btn btn-default" value="Reset"/></center>
        
               </form></div></center>
       </td>

                                   <td  id="r3c3"colspan="3"> 

                                   </td>
           </tr>

      

</table>
</body>
</html>