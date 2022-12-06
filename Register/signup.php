<?php
  require("include/database.php");
  $message=0;
  if(isset($_POST['signup']))
  {
    $email=$_POST["email"];
    $names=$_POST["names"];
    $password=$_POST["password"];
    $system_user=$_POST["user"];
    $sql="INSERT INTO tbl_user(user_password,user_name,user_email,user_role)VALUES('$password','$names','$email','$system_user')";
     $result=mysqli_query($con,$sql);
     if($result) {
      $message=1;
     }
  }
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>SIGN UP PAGE</title>
    <link rel="stylesheet" href="css/student.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body id="login_page">
    <div id="signup">
       <h2 class="titles">SIGN UP PAGE</h2>
       <div class="error_message"><span id="msg">All fields are required</span><span id="cross">&times;</span></div>
       <form method="POST">
         <div class="table-row">
           <p>Names</p>
           <p><input type="text" name="names"></p>
         </div>
         <div class="table-row">
           <p>Email</p>
           <p><input type="email" name="email"></p>
         </div>
         <div class="table-row">
           <p>password</p>
           <p><input type="password" name="password"></p>
         </div>
         <div class="table-row">
           <p>Re-type password</p>
           <p><input type="password" name="re_password"></p>
         </div>
         <div class="table-row">
           <p>System users</p>
           <p>
           <select name="user">
              <option> -----select----</option>
              <option value="administrator">Administrator</option>
              <option value="register">Register</option>
           </select>
           </p>
         </div>
         <div class="table-row">
         <p></p>
         <p><input type="submit" name="signup" value="signup"></p>
         </div>
       </form>
         <span id="dont">Have an account <a href="login.php">Login</a></span>
    </div>
    <script type="text/javascript">
      var redirect=<?php echo $message; ?>;
      if(redirect==1)
      {
        window.location="login.php";
      }

    </script>
  </body>
</html>