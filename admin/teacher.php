<?php require("configuration/connection.php"); ?>
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
<style type="text/css">
.search_card {
	background-color:#f1f1f1;
	margin-bottom: 10px;
	display:flex;
}
.search_card button[type=button]{
	display:block;
	margin-top: 7px;
	margin-right: 1px;
	cursor:pointer;
}
.search_card input[type=search]{
	margin-top: 7px;
}
.search_card form {
	display:flex;
}
.search_card button[type=submit]{
	display:block;
	margin-top: 5px;
	margin-right:20%;
	cursor:pointer;
	position:relative;
	left:5px;
	top:4px;
	width:17px;
	height:16px;
}
</style>
</head>
<body>
<?php include("configuration/header.php"); ?>
<div class="container">
    <div class="sub-container">
        <div class="card mt-2" style="background-color:#f1f1f1;">
           <div class="card-body search_card">
            	  <form action="" class="search-bar" id="search_form" onsubmit="event.preventDefault();live_search_submit_teacher();">
	                <input type="search" name="search" pattern=".*\S.*" required class="form-control" onkeydown="live_teacher_search(this)" onkeyup="live_teacher_search(this)" id="search_box">
	                <button class="btn btn-default" id="search" type="submit"><img src="../Register/images/search.png" width="45" style="position:relative;top:-14px;left:-25px"></button>
	             </form>
	             <button type="button" class="btn btn-primary" onclick="return add_more()" value="Add Teacher" id="add_more">Add Teacher</button>
	          </div>
        </div>
      <div id="edit_id">
      <div class="card mt-1 mb-1">
        <h5 class="card-header">ADD TEACHER</h5>
        <div class="card-body">
        <form method="POST" action="action.php" enctype="multipart/form-data" id="addingForm">
        <div class="form-group">
           <label class="text-muted" for="teacher_firstname">First name<span class="text-danger">*</span></label>
           <input type="text" id="teacher_firstname" name="teacher_firstname" class="form-control">
           <span id="error_firstname" class="text-danger"></span>
        </div>
        <div class="form-group">
           <label class="text-muted" for="teacher_lastname">Last name<span class="text-danger">*</span></label>
           <input type="text" id="teacher_lastname" name="teacher_lastname"class="form-control">
           <span id="error_lastname" class="text-danger"></span>
        </div>
        <div class="form-group">
           <label class="text-muted" for="dateofbirth">Date of Birth<span class="text-danger">*</span></label>
           <input type="Date" id="dateofbirth" name="dateofbirth" class="form-control">
           <span id="error_dateofbirth" class="text-danger"></span>
        </div>
        <div class="form-group">
           <label class="text-muted" for="qualification">Qualification<span class="text-danger">*</span></label>
           <input type="text" id="qualification" name="qualification"class="form-control">
           <span id="error_qualification" class="text-danger"></span>
        </div>
        <div class="form-group">
           <label class="text-muted" for="experience">Experience<span class="text-danger">*</span></label>
           <input type="Number" id="experience" name="experience"class="form-control">
           <span id="error_experience" class="text-danger"></span>
        </div>
        <div class="form-group">
           <label class="text-muted" for="phone_number">Phone Number<span class="text-danger">*</span></label>
           <input type="text" id="phone_number" name="phone_number"class="form-control">
           <span id="error_phone_number" class="text-danger"></span>
        </div>
        <div class="form-group">
           <label class="text-muted" for="email_id">teacher Email<span class="text-danger">*</span></label>
           <input type="email" id="email_id" name="email_id"class="form-control">
           <span id="error_email" class="text-danger"></span>
        </div>
        <div class="form-group">
           <label class="text-muted" for="address">Address:</label>
           <input type="text" id="address" name="address"class="form-control">
           <span id="error_address" class="text-danger"></span>
        </div>
        <div class="form-group">
           <label class="text-muted" for="joiningdate">Joining Date<span class="text-danger">*</span></label>
           <input type="Date" id="joiningdate" name="joiningdate"class="form-control">
           <span id="error_joiningdate" class="text-danger"></span>
        </div>
        <div class="form-group">
           <label class="text-muted" for="teacher_image">choose Image</label><br>
           <input type="file" name="teacher_image" id="teacher_image">
           <span id="error_teacher_image" class="text-danger"></span>
        </div>
        <input type="submit"name="submit" value="Add Teacher" id="submit_data" class="btn btn-sm btn-primary">
        <input type="hidden" name="hidden_teacher_id" id="hidden_teacher_id" />
       </form>
       </div>
     </div>
   </div>
   <div id="display_table">
       <?php
      if(isset($_GET['updated']))
      {
         echo <<< END
         <div class="card mb-2 bg-success" style="width:95%" id="disappear_msg">
         <div class="card-body">
         <p style="color:#ff1">TEACHER IS UPDATED SUCCESSFULLY</p>
         </div>
         </div>
         END;
      }
      ?>
     <div id="teacher_table">
     </div>
    <nav aria-label="Page navigation" class="ml-4">
     <ul class="pagination justify-content-center">
	 <?php
     $total_rows = totalInTable($con,'tbl_teacher');
     $number_of_data=3;
     $limit_start=0;
     $page_count=0;
     if($total_rows >  $number_of_data)
     {
       for($limit_start=0;$limit_start<$total_rows;$limit_start+= $number_of_data)
       {
       	$page_count++;
         echo <<< END
         <li class="page-item">
         <button type="button" class="page-link text-primary pages" onclick="pagination_data_teacher(this)" data-id1="$limit_start" data-id2="$number_of_data">$page_count</button>
         </li>
         END;
       }
     }else {
         echo <<< END
         <li class="page-item">
         <button class="page-link text-primary pages" onclick="pagination_data_teacher(this)" data-id1="$limit_start" data-id2="$number_of_data">$page_count</button>
         </li>
         END;
       }
    ?>
      </ul>
    </nav>
 </div>
</div>
</div>
<script type="text/javascript" src="../include/jquery-3.5.0.min.js"></script>
  <script type="text/javascript" src="../js/bootstrap.min.js"></script>
  <script src="configuration/script.js" type="text/javascript"></script>
  <script type="text/javascript">
  jQuery(document).ready(function() {

  });
  </script>
</body>
</html>