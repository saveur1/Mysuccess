<?php
include("admin/configuration/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="description" content="student examination result" />
<meta name="viewport"content="width=device-width,initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible"content="IE=edge" />
<script src="js/sweetalert2.min.js"></script>
<link rel='stylesheet' href='css/sweetalert2.min.css'>
<link rel="stylesheet"href="css/bootstrap.min.css">
<link rel="stylesheet"href="include/css/mycss.css"media="screen,projection">
<title>Mysuccess Login</title>
  <style>
    body {
      font-family:sans-serif;
    }

    a:hover {

      color:teal;
      /*border-bottom:3px solid teal;*/
      padding:10px;
    }
    .active a:link {
      padding:10px;
      border-bottom:3px solid teal;
    }
    a:active {
      /*border-bottom:3px solid teal;*/
    }

    .nav li {
      display:inline-block;
    }

  </style>
</head>
<body style="background:#f2f2f2">
<div class="container"id="login_box">
    <div id="mytab">
        <div align="center" id="image-logo">
           <img src="admin/configuration/logo.png"style="width:100px;height:70px;"class="img-responsive">
        </div>
        <div align="center"class="m-5">
          <button type="button"id="login_with_fb"class="btn btn-primary form-control">Signin With Facebook</button>
          <br />
          <br />
          <button type="button"id="login_with_twitter"class="btn btn-info form-control">Signin With Twitter</button>
          <br />
          <br />
          <button type="button"id="login_with_google"class="btn btn-danger form-control">Signin With Google+</button>
      </div>
    </div>
  <div class="card" id="login-form">
    <div class="card-content">
      <div class="card-body" style="padding-bottom:0px">
        <div align="center"id="logo">
           <img src="admin/configuration/logo.png"style="width:100px;height:70px;"class="img-responsive">
        </div>
  <br />
  <div id="login">
  <div class="text-center">
  <h4 class="text-black">Login to Your Account</h4>
    <p>
      Dont have Account?<span class="text-primary"id="open_signup">Sign up Free!</span>
    </p>
  </div>
  <form method="POST"id="login_form">
    <div class="input-control">
      <label for="login_email"class="text-muted">Email</label>
      <input type="email"name="login_email"id="login_email"class="form-control">
    </div>
     <div class="input-control" style="position:relative">
       <div id="show_hide">
       <span id="show"class="text-primary"><img src="img/no-eye.png"></span>
       </div>
      <label for="login_password"class="text-muted">Password</label>
      <input type="password"name="login_password"id="login_password"class="form-control">
    </div>
    <div class="input-control text-muted"style="margin-top:4px;margin-bottom:4px">
      <input type="checkbox"name="remember_me"id="remember_me" style="background:white"/><span>Remember me</span>
    </div>
    <div class="button"align="center">
      <input type="submit"name="login"id="login"class="btn btn-primary form-control"value="Login with Email">
    </div>
    <br />
    <p class="text-primary text-center"id="forgot">Forgot password?</p>
  </form>
</div>

   <div id="signup"style="padding-top:0px;display:none">
  <div class="text-center">
  <h5 class="text-black">Sign Up For Free!</h5>
  </div>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>"method="POST">
    <div class="input-control">
      <label for="signup_email"class="text-muted">Email</label>
      <input type="email"name="signup_email"id="signup_email"class="form-control"required>
    </div>
    <div class="input-control">
      <label for="full_name"class="text-muted">Full Name</label>
      <input type="text"name="fullname"id="fullname"class="form-control"required>
    </div>
     <div class="input-control">
      <label for="signup_password"class="text-muted">Password</label>
      <input type="password"name="signup_password"id="signup_password"class="form-control"required>
    </div>
    <p style="font-size:11px;margin-top:5px"class="text-center">
      I agree the <span class="text-primary">Privacy policy </span>and<span class="text-primary"> Terms of Services</span>
    </p>
    <div class="button"style="margin-top:3px">
   <center><input type="submit"name="signup"id="signup"class="btn btn-primary form-control"value="SignUp with Email"></center>
    </div>
        <p class="text-primary text-center mt-1" id="already">Already Have Account!</p>
      </form>
        </div>
 <div id="forgot_password"style="max-width:250px;display:none">
  <div class="text-center">
  <h4 class="text-black">RECOVER YOUR PASSWORD</h4>
  <p> Fill in your E-mail address below and we will send you E-mail with further Instruction</p>
  </div>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>"method="POST">
    <div class="input-control">
      <label for="signup_email"class="text-muted">Email</label>
      <input type="email"name="signup_email"id="signup_email"class="form-control"required>
    </div>
    <div class="button"style="margin-top:7px">
   <center><input type="submit"name="signup"id="signup"class="btn btn-primary form-control"value="Recover Your Password"></center>
    </div>
        <p class="text-primary text-center mt-1" id="no-already">Already Have Account!</p>
        <p class="text-primary text-center mt-1" id="no-account">Dont Have Any Account!</p>
      </form>
   </div>

      </div>
    </div>
  </div>
  </div>
  <div id="frame">
  </div>
<div class="message">
  <p>

  </p>
  <button type="button"class="btn btn-sm"id="close"style="background:teal;color:white;width:60px">
    OK
  </button>
</div>
<div id="load">
    <h5>
      Loading...
  </h5>
</div>
<!--compiled script-->
<script type="text/javascript" src="include/jquery-3.5.0.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script>
  $(document).ready(function(){
    $("#open_signup").click(function() {
      $("#login").hide(1000);
      $("#signup").show(1000);
      $("#forgot_password").hide(1000);
    });
    $("#already").click(function() {
      $("#signup").hide(1000);
      $("#login").show(1000);
      $("#forgot_password").hide(1000);
    });
    $("#no-already").click(function() {
      $("#forgot_password").hide(1000);
      $("#signup").hide(1000);
      $("#login").show(1000);
    });
    $("#forgot").click(function() {
      $("#signup").hide(1000);
      $("#login").hide(1000);
      $("#forgot_password").show(1000);
    });
    $("#no-account").click(function() {
      $("#signup").show(1000);
      $("#login").hide(1000);
      $("#forgot_password").hide(1000);
    });
    $("#show").click(function() {
      var pass=$("#login_password").attr("type");
      if(pass == 'password')
      {
      $("#login_password").attr("type","text");
        $("#show img").attr("src","img/eye.png");
      }
      else
      {
      $("#login_password").attr("type","password");
        $("#show img").attr("src","img/no-eye.png");
      }
    });
    $("#logo img").click(function() {
     location.href="http://localhost:8080/Mysuccess";
    });
    $("#login_form").on("submit",function(event) {
      event.preventDefault();
      $.ajax({
        url:"check_login.php",
        method:"POST",
        dataType:"json",
        data:$(this).serialize(),
        beforeSend:function() {
          $("#load").fadeIn();
        },
        success:function(data) {
        $("#load").fadeOut();
          if(data.success)
          {
            location.href="<?php echo $base_url; ?>admin";
          }
          if(data.error) {
            if(data.error_email) {
              $(".message p").text(data.error_email);
              $("#frame").fadeIn(1000);
              $(".message").fadeIn(1000);
            }
            else
            {
              if(data.error_password)
              {
                $(".message p").text(data.error_password);
                $("#frame").fadeIn(1000);
                $(".message").fadeIn(1000);
              }
            }
          }
        }
      });
    });
    $("#close").click(function() {
      $(".message").fadeOut();
      $("#frame").fadeOut();
    });
    $("#frame").click(function() {
      $(this).fadeOut();
      $(".message").fadeOut();
    });
  });
  </script>
</body>
</html>