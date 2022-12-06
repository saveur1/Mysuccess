<?php
session_start();
require("include/database.php");
 if(isset($_POST['login']))
 {
    $email=$_POST["email"];
    $password=$_POST["password"];
    $sql="SELECT * FROM tbl_user WHERE user_email='$email' AND user_password='$password'";
    $result=mysqli_query($con,$sql);
    $arr=array();
    if(mysqli_fetch_array($result) != $arr)
    {
    	$_SESSION["email"]=$_POST['email'];
    	$_SESSION["password"]=$_POST['password'];
    	echo "
              <script> window.location='index.php';</script>
    	";
    }
   else {
     echo "<script>
		if(alert('wrong input credentials'))
		{
			".header("Refresh:0.1;url=login.php")."
		}
		</script>";
   }

 }
?>