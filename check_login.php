<?php
include("admin/configuration/connection.php");
$error=0;
$login_email="";
$login_password="";
$error_email="";
$error_password="";
$output="";
/*if(isset($_POST['login']))
{*/

  if(empty($_POST['login_email']))
  {
    $error_email="Email is required";
    $error++;
   }
  else
  {
    $login_email=$_POST['login_email'];
    if(!filter_var($login_email,FILTER_VALIDATE_EMAIL))
    {
        $error_email="invalid Email address";
        $error++;
    }
  }
  if(empty($_POST['login_password']))
  {
      $error_password="Password is required";
      $error++;
  }
  else
  {
      $login_password=$_POST['login_password'];
  }
  if($error > 0)
  {
   $output =array(
   "error"           =>   true,
   "error_email"     => $error_email,
   "error_password"  => $error_password
   );
  }
  else
  {
    $sql="SELECT * FROM login WHERE email=:email;";
    $stmt=$con->prepare($sql);
    $stmt->bindparam(":email",$login_email);
    $stmt->execute();
    $total_rows=$stmt->rowCount();
    if($total_rows > 0)
    {
      $result=$stmt->fetchAll();
      foreach($result as $row)
      {
        if($row['password'] == $login_password)
        {
          $output = array(
          "success"  => true
          );
        }
        else
        {
          $output =array(
           "error"        => true,
           "error_password"  => "Password Don't Match"
           );
        }
      }
    }
    else
    {
      $output =array(
        "error"        => true,
        "error_email"  => "Email Don't Match"
      );
    }
  }
  echo json_encode($output);
//}
?>