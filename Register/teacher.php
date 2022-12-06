<?php
session_start();
  if(!isset($_SESSION["email"]) && !isset($_SESSION["password"]))
  {
    //header("Location:login.php");
  }
  include("../admin/configuration/connection.php");
?>
 <?php include("include/header.html"); ?>
 <h3 id="table_title" style="color:white;position:relative;left:30%;top:70%">TEACHER TABLE</h3>
   <div id="content">
    <div class="sub_container">
        <div class="content_header">
            	  <form action="" class="search-bar" id="search_form" onsubmit="event.preventDefault();live_search_submit_teacher();"> 
	                <input type="search" name="search" pattern=".*\S.*" required class="form-control" onkeydown="live_teacher_search(this)" onkeyup="live_teacher_search(this)" id="search_box"> 
	                <button class="btn btn-default" id="search" type="submit"><img src="images/search.png" width="40" style="position:relative;top:-14px;left:-25px"></button>
	             </form>
	             <button type="button" class="btn btn-primary" onclick="return add_more()" value="Add Teacher" id="add_more">Add Teacher</button>
        </div>
      <div id="edit_id">
        <h1 id="form_title">ADD TEACHER</h1>
        <form method="POST" action="action.php" enctype="multipart/form-data" id="addingForm">
        <label for="teacher_firstname">First name:</label>
        <input type="text" id="teacher_firstname" name="teacher_firstname" class="form-control new_input"><br>
        <label for="teacher_lastname">Last name:</label>
        <input type="text" id="teacher_lastname" name="teacher_lastname"class="form-control new_input"><br>
        <label for="dateofbirth">Date of Birth:</label>
        <input type="Date" id="dateofbirth" name="dateofbirth" class="form-control new_input"><br>
        <label for="qualification">Qualification:</label>
        <input type="text" id="qualification" name="qualification"class="form-control new_input"><br>
        <label for="experience">Experience:</label>
        <input type="Number" id="experience" name="experience"class="form-control new_input"><br>
        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number"class="form-control new_input"><br>
        <label for="email_id">teacher Email:</label>
        <input type="email" id="email_id" name="email_id"class="form-control new_input"><br>
        <label for="address">Address:</label>
        <input type="text" id="address" name="address"class="form-control new_input"><br>
        <label for="joiningdate">Joining Date:</label>
        <input type="Date" id="joiningdate" name="joiningdate"class="form-control new_input"><br>
        <label for="teacher_image">choose Image</label>
        <input type="file" name="teacher_image" id="teacher_image">
        <input type="submit"name="submit" value="Add Teacher" id="submit_data"><br>
        <input type="hidden" name="hidden_teacher_id" id="hidden_teacher_id" />
       </form>
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
     <!--<li class="page-item">
        <select size='20' class="form-control">
           <option value="10">10</option>
           <option value="20">20</option>
        </select>
     </li>-->
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
   <script type="text/javascript" src="js/student.js"></script>
</body>
</html>