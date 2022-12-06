<?php
class testing {
    public $name;
    public $salary;
    public $age;
    function  __construct($name,$salary,$age)
    {
        $this->$name=$name;
        $this->$salary=$salary;
        $this->$age=$age;
    }
    function getData()
    {
       echo "MY NAME IS:".$this->$name."<br>";
       echo "MY NAME IS:".$this->$salary."<br>";
       echo "MY NAME IS:".$this->$age."<br>";
    }
}

























$test=new testing("BIKORIMANA",23787.0,21);
//$test->getData();
 $msg="welcome message";
 $age=78;
 /*if($age <34) {
    echo "I'm ".$name." and my age is :".$age."<br>";
  } else{
    $i=0;
    while($i<10) {
    echo("I'M OVER AGE THOUGH ".($i+1)."<br>");
    $i++;
    }
  }*/
 $var=$age < 34 ?  $age :  $msg;
 echo $var;
?>
<html>
    <head>
        <title> LEARNING PHP</title>
        <!--<link rel="stylesheet" href="student.css">-->
    </head>
    <body>
 <h2 class="titles">FORM INFO</h2>
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
  <span id="msg"> </span>
  <?php
  require("include/database.php");
  // if(isset($_POST['login']))
  // {
  //   echo "<h1>LOGIN INFO</h1>";
  //   $email=$_POST["email"];
  //   $password=$_POST["password"];
  //   echo "<h3>your email is:".$email."</h3>";
  //   echo "<h3>your password is:".$password."</h3>";
  // }
  $message="";
  if(isset($_POST['signup']))
  {
    $email=$_POST["email"];
    $names=$_POST["names"];
    $password=$_POST["password"];
    $system_user=$_POST["user"];
    $sql="INSERT INTO tbl_user(user_password,user_name,user_email,user_role)VALUES('$password','$names','$email','$system_user')";
     $result=mysqli_query($con,$sql);
     if($result) {
      $message="data inserted successfully";
     }
     else {
      $message="some thing went wrong".mysqli_error($con);
     }
     echo $message;
  }
  $output="";
  $sql="SELECT * FROM tbl_user ORDER BY user_id DESC";
  $result=mysqli_query($con,$sql);
  $output="
   <table border>
     <tr>
         <th>user_id</th>
         <th>user_name</th>
         <th>user_email</th>
         <th>user_password</th>
         <th>delete</th>
     </tr>
  ";
  while($row=mysqli_fetch_assoc($result))
  {
    $output.="<tr>
          <td>".$row['user_id']."</td>
          <td>".$row['user_name']."</td>
          <td>".$row['user_email']."</td>
          <td>".$row['user_password']."</td>
          <td><a href='all_action.php?id=".$row['user_id']."'>delete</a></td>
          </tr>
          ";
  }
  $output.="</table>";
  echo $output;
    if(isset($_GET["id"]))
     {
     $id=$_GET['id'];
     $sql="DELETE FROM tbl_user WHERE user_id=$id";
     if(mysqli_query($con,$sql))
     {
        echo "data deleted successfully <a href='testing.php'>Back home</a>";
     }
 }
   ?>
  </div>
    </body>
</html>