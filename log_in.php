<?php
$user='root';
$pw='';
$db='435proj';
$connect = new mysqli('127.0.0.1',$user,$pw,$db) or die("Error");

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST") 
{
      // username and password sent from form 
      $username = mysqli_real_escape_string($connect,$_POST['username']);
      $password = mysqli_real_escape_string($connect,$_POST['password']); 
      $result = mysqli_query($connect, "select username,password from account where username='$username' and password='$password'");
      $num_rows = mysqli_num_rows($result);
      if ($num_rows==1) 
      {
   			   $_SESSION['user_id'] = $username;
                header('Location:http://localhost/photos-viewer/albums.html');	  } 
	  else 
	  {
   			 echo "no account with that username password combo";
		}
}







?>

<html>
   
   <head>
      <title>Login Page</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  :</label><input type = "text" name = "password" class = "box" /><br/><br />
                  <input type = "submit" value = " Submit "/><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $connect->error; ?></div>
					
            </div>
				
         </div>
			
      </div>

   </body>
</html>
