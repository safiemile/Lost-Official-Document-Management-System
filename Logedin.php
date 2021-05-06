<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location:login.php");
    exit;
}
include_once"connection.php";
$image = $doctype = $docnumber = $district = $sector = $cell = $contact = "";
$image_err = $doctype_err = $docnumber_err = $district_err = $sector_err = $cell_err = $contact_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$doctype = $_POST["dtp"];
	$image =addslashes(file_get_contents($_FILES['image']['tmp_name']));	

     if(empty(trim($_POST["dn"])))
	 {
        $docnumber_err = "Please enter a document number.";
    } else{
        $sql = "SELECT id_doc FROM document WHERE id_doc = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_docnumber);
            $param_docnumber = trim($_POST["dn"]);
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $docnumber_err = "This document  is already uploaded.";
                } else{
                    $docnumber= trim($_POST["dn"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    // Validate district
    if(empty(trim($_POST["ds"])))
	{
        $district_err= "Please enter District in capital letter.";     
    
    } else{
        $district = trim($_POST["ds"]);
    }
    
    // Validate sector
   if(empty(trim($_POST["sct"])))
	{
        $sector_err= "Please enter sector in capital letter.";     
    
    } else{
        $sector = trim($_POST["sct"]);
    }
	 // Validate cell
   if(empty(trim($_POST["cl"])))
	{
        $cell_err= "Please enter cell in capital letter.";     
    
    } else{
        $cell = trim($_POST["cl"]);
    }
	 // Validate phone
   if(empty(trim($_POST["phn"])))
	{
        $contact_err= "Please enter phone number.";     
    
    }
	 elseif(strlen(trim($_POST["phn"])) < 6)
	 {
        $contact_err = "Phone Number must have atleast 10 Digits.";
	 }
	else{
        $contact = trim($_POST["phn"]);
   }
        // Check input errors before inserting in database
    if(empty($image_err) && empty($doctype_err) && empty($docnumber_err) && empty($district_err) && empty($sector_err_err) && empty($cell_err) && empty($contact_err))
	 {
        $sql = "INSERT INTO document(id_doc, type, district, sector, cell, phone, image) VALUES (?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
         
            mysqli_stmt_bind_param($stmt, "sssssss", $param_docnumber, $param_doctype, $param_district, $param_sector, $param_cell, $param_contact, $param_image);
  
            
			 $param_image = $image;
			  $param_doctype = $doctype;
			  $param_docnumber = $docnumber; 
			  $param_district = $district;
			  $param_sector = $sector;
			  $param_cell = $cell;
			  $param_contact = $contact;
            
            if(mysqli_stmt_execute($stmt))
			{
                echo "<script type='text/javascript'>alert('Your Document Details Uplaoded successfully')</script>";
			}
			else
			{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        
        mysqli_stmt_close($stmt);
    }
}
    
   
    mysqli_close($conn);
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
       <script>
var loadfile = function (event)
{
var image=document.getElementById('output');
image.src = URL.createObjectURL(event.target.files[0]);
}
function show ()
{
	 document.getElementById("r3c3").style.display = '';
   
}
function hide()
{
 document.getElementById("r3c3").style.display = 'none';
}

        </script>
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
								   <center ><span style="margin-top:20%;"><h1>Fill The Information Required Bellow:</h1></span></center>
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
			<center><div class="form-group <?php echo (!empty($image_err)) ? 'has-error' : ''; ?>">
                <label>Choose Image</label>
              <input type="file" name="image" id="image" />
                <br/><span class="help-block"style="color:red;"><?php echo $image_err; ?></span>
            </div></center>
			<br/><center><div class="form-group <?php echo (!empty($doctype_err)) ? 'has-error' : ''; ?>">
                <label>Document Type</label>
                <select name="dtp">
				<option value="National Identity Card">National Identity Card</option>
				<option value="Passport">Passport</option>
				<option value="Driving Licence">Driving Licence</option>
				<option value="High School Certificate">High School Certificate</option>
				<option value="Other">Other</option>
				</select>
				
                <br/><span class="help-block"style="color:red;"><?php echo $doctype_err; ?></span>
            </div></center>
           <br/><center><div class="form-group <?php echo (!empty($docnumber_err)) ? 'has-error' : ''; ?>">
                <label>document number</label>
                <input type="text" name="dn" class="form-control" value="<?php echo $docnumber; ?>">
                <br/><span class="help-block"style="color:red;"><?php echo $docnumber_err; ?></span>
            </div> </center>   
            <br/><center><div class="form-group <?php echo (!empty($district_err)) ? 'has-error' : ''; ?>">
                <label>District</label>
                <input type="text" name="ds" class="form-control" value="<?php echo $district; ?>">
                <br/><span class="help-block"style="color:red;"><?php echo $district_err; ?></span>
            </div></center>
						<br/><center><div class="form-group <?php echo (!empty($sector_err)) ? 'has-error' : ''; ?>">
                <label>Sector</label>
                <input type="text" name="sct" class="form-control" value="<?php echo $sector; ?>">
                <br/><span class="help-block"style="color:red;"><?php echo $sector_err; ?></span>
            </div></center>
			            
			<br/><center><div class="form-group <?php echo (!empty($cell_err)) ? 'has-error' : ''; ?>">
                <label>Cell</label>
                <input type="text" name="cl" class="form-control" value="<?php echo $cell; ?>">
                <br/><span class="help-block"style="color:red;"><?php echo $cell_err; ?></span>
            </div></center>
						<br/><center><div class="form-group <?php echo (!empty($contact_err)) ? 'has-error' : ''; ?>">
                <label>Your Phone Number</label>
                <input type="text" name="phn" class="form-control" value="<?php echo $contact; ?>">
                <br/><span class="help-block" style="color:red;"><?php echo $contact_err; ?></span>
            </div></center>
			
            <br/><center><div class="form-group">
                <input type="submit" class="btn btn-primary" name="submit"value="Submit" style="color:white; background-color:blue;"/>
                <input type="reset" class="btn btn-default" value="Reset"/>
            
			<br/><br/><br/><br/>
       &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="database.php"><input type="button"value="retrive database"style="color:white; background-color:blue;"/></a>
        </form></div></center>
       </td>

                                   <td  id="r3c3"colspan="3"> 

                                   </td>
           </tr>

      

</table>
</body>
</html>
 </script>  