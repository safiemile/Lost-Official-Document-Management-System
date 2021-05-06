
<?php
include_once 'connection.php';
?>
<?php
if(isset($_POST['sc']) )
{

   $name = $_POST['un'];
   $sql = "SELECT * FROM document WHERE id_doc = '$name'";
  $result = mysqli_query($conn , $sql);
   
while($test = mysqli_fetch_array($result))
{
	$i=$test['id_doc'];
	header("location: Resultant.php");
	exit;

}

	echo "<script type='text/javascript'> alert('no result found');</script>";
}
mysqli_close($conn);
?>
<html>
<head>
<title>Lost Official Documents Management System</title>
<style type="text/css">
}
table,tr,td{
border-collapse:collapse;
border-style:insert;
}
tr#r2{
height:5%;
}
table{
margin-right:auto;
margin-left:auto;
height:100%;
width:100%;
}
td#r3c1{
}
td#r3c2{
width:33%;
}
td#r3c3{
width:33%;
}
tr#r4{
height:5%;
}

body{
background-image:url(backimage.jpg);
background-attachment:scroll;
background-repeat:repeat;
color:black;
}
div.overlay{
width:45%;
margin-left:28%;
background-color:black;
font-weight:bold;
opacity:.6;
color:white;
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
<script>
            function send() {
                var genders = document.getElementsByName("pw");
				var number = document.getElementById("un11").value;
                if (genders[0].checked == true) 
				
				{
				         if((!isNaN(number) && number.length == 16))
				        {
                        window.location= "Resultant.php";
                         } 
				          else
						{
						
							alert("please Provide Valid number ");
						
						}
				}
				else if (genders[1].checked == true)
				{
                     if((!isNaN(number) && number.length == 16))
				        {
                         window.location= "Resultant.php";
                         } 
				          else
						{
						
							alert("please Provide Valid number ");
						
						}
                }
				else if (genders[2].checked == true)
				{
                     if((isNaN(number) || number.length == 7))
				        {
                         window.location= "Resultant.php";
                         } 
				          else
						{
						
							alert("please Provide Valid number ");
						
						}
                }
				else if (genders[3].checked == true)
				{
                        if(number.length == 13)
				        {
                         window.location= "Resultant.php";
                         } 
				          else
						{
						
							alert("please Provide Valid number ");
						
						}
                }
				else if (genders[4].checked == true)
				{
                        if((isNaN(number) || number.length == 9))
				        {
                         window.location= "Resultant.php";
                         } 
				          else
						{
						
							alert("please Provide Valid number ");
						
						}
                }
				else 
				{
                                        var msg = '<span style="color:red;">You must select Type of Document and Its Number First!</span><br /><br />';
                    document.getElementById('msg').innerHTML = msg;
                    return false;
                }
                return true;
                }

            function reset_msg()
			   {
                document.getElementById('msg').innerHTML = '';
               }
        </script>

</head>
<body>
<table>
        <tr id="r2">
<td calspan="6">      <ul class="menu">
<li class="menu"><a class="title">LOST OFFICIAL DOCUMENTS MANAGEMENT SYSTEM </a> </li>
<li class="menu"><a class="active" href="Home.php">HOME</a></li>
<li class="menu"><a href="About.php">ABOUT</a> </li>
<li class="menu"><a href="help.php">HELP</a> </li>
<li class="menu"><a href="mailto:safiemile4@gmail.com">CONTACT US</a> </li>
<li class="menu"><a href="faq.php">FAQ</a></li>
<li class="menu"><a href="login.php">LOGIN</a></li>
          </ul></td>
          </tr>

          <tr id="r3"> 
                                   <td  id="r3c1" colspan="6"> 
								   <div class="overlay">
								   
<p style="margin-left:30%"> <b>This WebApplication Will Helps You To Find Your Lost Official Documents Such As Flows:</p></b>
 <ul style="margin-left:45%">
<li>National Identity Card</li>
<li>Driving Licence</li>
<li>Passport</li>
<li>School Certificate</li>
<li>Others</li>

  </ul>

  <form action="Resultant.php" method="post">
<p><center><b>Find Your Lost Document Here :</b></center></p>
 <span style="margin-left:2%">Official Document N<sup>0</sup></span><center><input type="text"  id="un11" name="un" style="border-radius:20px"/></center><br/>
 <span style="margin-left:2%">Choose Type of  Official Document</span><br/><br/>
<span style="margin-left:2%"><input type="radio" name="pw" value="m"onclick="reset_msg();"/>National Identity Card<br/></span>
<span style="margin-left:2%"><input type="radio" name="pw" value="f"onclick="reset_msg();"/>Driving Licence <br/></span>
<span style="margin-left:2%"><input type="radio" name="pw" value="p"onclick="reset_msg();"/>Passport <br/></span>
<span style="margin-left:2%"><input type="radio" name="pw" value="h" onclick="reset_msg();"/>High School Certificate <br/></span>
<span style="margin-left:2%"><input type="radio" name="pw" value="u"onclick="reset_msg();"/>University Certificate <br/></span>
<div id="msg"></div>
<center><input type="submit"  onclick="return send();" value="Search" name="sc"style="border-radius:20px;background-color:blue ; font-size:22px;font-weight:bold;" /></a></center><br/>

</form>
</div>
                                   </td>
           </tr>

         

</table>
</body>
</html>