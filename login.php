<?php
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: logedin.php");
  exit;
}
include_once 'connection.php';
$username = $password = "";
$username_err = $password_err = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    if(empty($username_err) && empty($password_err))
	{
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql))
		{
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;
            if(mysqli_stmt_execute($stmt))
			{
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                           
                            header("location: logedin.php");
                        } else{
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}
?> 
<html>
<head><title>login</title>
<style>
p#a1{
text-align:center;
font-size:20px;
text-decoration:underline;
}
p#a2,p#a3,p#a4,p#a5
                                               {
                                       margin-left:20%;
                                      margin-right:20%;
                                               }
span#b1,span#b2,span#b3,span#b4
                                                {
                                        margin-left:auto;
                                        margin-right:auto;

                                        text-align:center;
                                       color:red;
                                   text-decoration:underline;
                                    font-size:18px;
                                     font-family:bold;
                                               }
table#t2{
border:0px solid blue;
margin-bottom:0%;
margin-left:auto;
margin-right:auto;
width:100%;
}
body{
background-image:url(backimage.jpg);
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
h2{
background-color: #FEFFED;
padding: 30px 35px;
margin: -10px -50px;
text-align:center;
border-radius: 10px 10px 0 0;
color:black;
}
hr{
margin: 10px -50px;
border: 0;
border-top: 1px solid #ccc;
margin-bottom: 40px;
}
div.container{
width: 900px;
height: 610px;
margin-left:35%;
margin-right:20%;
margin-top:5%;
font-family: 'Raleway', sans-serif;
}
div.main{
width: 300px;
padding: 10px 50px 25px;
border: 2px solid gray;
border-radius: 10px;
font-family: raleway;
float:left;
margin-top:50px;
background-color:white;
}
input[type=text],input[type=password]{
width: 100%;
height: 40px;
padding: 5px;
margin-bottom: 25px;
margin-top: 5px;
border: 2px solid #ccc;
color: #4f4f4f;
font-size: 16px;
border-radius: 5px;
}
label{
color: #464646;
text-shadow: 0 1px 0 #fff;
font-size: 14px;
font-weight: bold;
}
center{
font-size:32px;
}
.note{
color:red;
}
.valid{
color:green;
}
.back{
text-decoration: none;
border: 1px solid rgb(0, 143, 255);
background-color: rgb(0, 214, 255);
padding: 3px 20px;
border-radius: 2px;
color: black;
}
input[type=button]{
font-size: 16px;
background: linear-gradient(#ffbc00 5%, #ffdd7f 100%);
border: 1px solid #e5a900;
color: #4E4D4B;
font-weight: bold;
cursor: pointer;
width: 100%;
border-radius: 5px;
padding: 10px 0;
outline:none;
}
input[type=button]:hover{
background: linear-gradient(#ffdd7f 5%, #ffbc00 100%);
}
</style>
</head>
<body>
<table id="t1">

        <tr id="r1">
<td calspan="6">      <ul class="menu">
<li class="menu"><a class="title">LOST OFFICIAL DOCUMENTS MANAGEMENT SYSTEM </a> </li>
<li class="menu"><a href="Home.php">HOME</a></li>
<li class="menu"><a href="About.php">ABOUT</a> </li>
<li class="menu"><a href="help.php">HELP</a> </li>
<li class="menu"><a href="mailto:safiemile4@gmail.com">CONTACT US</a></li>
<li class="menu"><a href="faq.php">FAQ</a></li>
<li class="menu"><a class="active"  href="login.php">LOGIN</a></li>
          </ul></td>
          </tr>
</table>
<div class="container" >
<div class="main">
 <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"style="color :red;"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block" style="color :red;"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login" style="color :white;background-color:blue;">
            </div>
            <p>Don't have an account? <a href="createaccount.php">Sign up now</a>.</p>
        </form>
</div>


</div>

<table  id="t2">
          <tr "height="5%">
                                  <td  id="r3c1"> 
<center><a href="terms.html">Terms And Conditions|</a>
<a href="poly.html">Privacy policy</a><br/>
&copy; Copyright-2019@Nid</center>     
                                  </td>
          </tr>
</table>
</body>
</html>