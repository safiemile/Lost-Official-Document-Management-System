<?php

include_once"connection.php";
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"])))
	{
        $username_err = "Please enter a username.";
    } else{
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = trim($_POST["username"]);
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
}
?>
<html>
<head>
<title>Lost Official Documents</title>
<style type="text/css">
body{
background-image:url(backimage.jpg);
background-attachment:fixed;
}
table,tr{
border-collapse:collapse;
border-style:insert;
}
tr#r1{
background-color:pink;

}
ul.menu{
list-style-type:none;
margin:0;
padding:0;
overflow:hidden;
background-color:#333333;
position:fixed;
top:0;
left:0;
width:100%;
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
</style>
</head>
<body>
<table border="0" width="100%" height="100%">
        <tr id="r1" height="5%" border="2">
<td calspan="6">      <ul class="menu">
<li class="menu"><a class="title">LOST OFFICIAL DOCUMENTS MANAGEMENT SYSTEM </a> </li>
<li class="menu"><a href="Home.php">HOME</a></li>
<li class="menu"><a href="About.php">ABOUT</a> </li>
<li class="menu"><a href="help.php">HELP</a> </li>
<li class="menu"><a href="mailto:safiemile4@gmail.com">CONTACT US</a></li>
<li class="menu"><a href="faq.php">FAQ</a></li>
<li class="menu"><a href="login.php">LOGIN</a></li>
<li class="menu"><a class="active" >CREATE YOUR NEW ACCOUNT</a> </li>
          </ul></td>
          </tr>

          <tr> 
                                   <td colspan="6"> 
<p style="color:white;"><b>This WebApplication Will Helps You To Find Your Lost Official Documents Such As Flows:</b></P> 
  <ul style="color:white;">
<li>National Identity Card</li>
<li>Driving Licence</li>
<li>Passport</li>
<li>School Certificate</li>
<li>Others</li>

  </ul>
<div style="background-color:white;color:balck;border-radius:25px;font-weight:bold;" width="30px"><p align="center"><u><b>Create New Account</u></b> <p>    
<center><div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>"><br/>
                <span class="help-block"style="color:red;"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>"><br/>
                <span class="help-block"style="color:red;"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>"><br/>
                <span class="help-block" style="color:red;"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit"style="background-color:blue; color:white"/>
                <input type="reset" class="btn btn-default" value="Reset"/>
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div> <center> 
</div>	
                                   </td>
                                    
           </tr>

          <tr height="5%">
                                  <td colspan="6"> 
<center><a href="terms.html">Terms And Conditions|</a>
<a href="poly.html">Privacy policy</a><br/>
 Copyright-2019@Nid</center>     
                                  </td>
          </tr>

</table>
</body>
</html>