<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="description" content="student examination result" />
<meta name="viewport"content="width=device-width,initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible"content="IE=edge" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css">
<!--import google icons-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet"href="../css/bootstrap.min.css">
<link rel="stylesheet"href="configuration/admin.css">
<title>Mysuccess</title>
</head>
<body>
<?php include("configuration/header.php"); ?>
<div class='container'>
  <div class="card mt-2">
     <div class="card-body">
        <h5 class="card-title text-muted">WHAT USER DO YOU WANT TO CREATE</h5>
        <div class="radio-check">
           <input type="radio" name="user" value="register" id="register_radio">
           <label for="register_radio">Register</label>
        </div>
        <div class="radio-check">
           <input type="radio" name="user" value="teacher" id="teacher_radio">
           <label for="teacher_radio">Teacher</label>
        </div>
       <button type="button" class="btn btn-sm btn-info" id="redirect_user">create</button>
     </div>
  </div>
 </div>
  <script type="text/javascript" src="../include/jquery-3.5.0.min.js"></script>
  <script type="text/javascript" src="../js/bootstrap.min.js"></script>
  <script src="configuration/script.js" type="text/javascript"></script>
  <script type="text/javascript">
  jQuery(document).ready(function() {
     jQuery("#redirect_user").click(function() {
        var selected_user=$("input[name=user]:checked").val();
        if(selected_user=="teacher")
        {
           location.href="teacher.php";
        }else if(selected_user=="register")
        {
           location.href="register.php";
        }
     });
  });
  </script>
</body>
</html>