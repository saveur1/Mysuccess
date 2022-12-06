<?php
session_start();
  if(!isset($_SESSION["email"]) && !isset($_SESSION["password"]))
  {
    //header("Location:login.php");
  }
   require("../admin/configuration/connection.php");
   ?>
 <?php include("include/header.html"); ?>
 <h3 id="table_title">STUDENT TABLE</h3>
   <div id="content">
     <div class="sub_container">
        <div class="content_header">
            	  <form method="POST" class="search-bar" id="search_form" onsubmit="event.preventDefault();live_search_submit_student(this)"> 
	                <input type="search" name="search_box" pattern=".*\S.*" required class="form-control" id="search_box" onkeydown="return live_student_search(this)" onkeyup="live_student_search(this)"> 
	                <button class="btn btn-default" type="submit" name="search" id="search" value="Search Student"><img src="images/search.png" width="40" style="position:relative;top:-14px;left:-25px"></button>
	             </form>
	             <button type="button" class="btn btn-primary" onclick="return add_more()" value="Add Student" id="add_more">Add Student</button>
        </div>
      <div id="edit_id" class="add_student">
       <h1 id="form_title">ADD STUDENT</h1>
       <form method="POST" action="action.php" enctype="multipart/form-data" id="addingForm">
        <label for="student_firstname">First name:</label>
        <input type="text" id="student_firstname" name="student_firstname"class="form-control new_input"><br>
        <label for="student_lastname">Last name:</label>
        <input type="text" id="student_lastname" name="student_lastname"class="form-control new_input"><br>
        <label for="dateofbirth">Date of Birth:</label>
        <input type="Date" id="dateofbirth" name="dateofbirth" class="form-control new_input"><br>
        <label for="stud_id">Student ID:</label>
        <input type="number" id="student_id" name="student_id" class="form-control new_input"><br>
        <label for="stud_id">student address:</label>
        <input type="text" id="address" name="address"class="form-control new_input"><br>
        <label for="guardianidnumber">Guardian ID number:</label>
        <input type="number" id="guardianidnumber" name="guardianidnumber"class="form-control new_input"><br>
        <label for="fatherorguardian_name">Father Or Guardian Name:</label>
        <input type="text" id="fatherorguardian_name" name="fatherorguardian_name" class="form-control new_input"><br>
        <label for="">Phone Number:</label>
        <input type="number" id="phone_number" name="phone_number" class="form-control new_input"><br>
        <label for="dateofbirth">Admission Date:</label>
        <input type="Date" id="admission_date" name="admission_date" class="form-control new_input"><br>
        <label for="class_id">student class:</label>
        <select name="class_id" id="class_id" class="form-control dropdown new_input">
          <?php echo fetchOption($con); ?>
        </select>
        <label for="born_at">Born at:</label>
        <input type="text" id="born_at" name="born_at" class="form-control new_input" placeholder="District"><br>
        <label for="image">student image:</label>
        <input type="file" id="image" name="image"><br>
        <input type="submit"name="submit" value="Add Student" id="submit_data">
        <br><br>
        <input type="hidden" name="hidden_stud_id" id="hidden_stud_id" />
  </form>
   </div>
      <div id="display_table">
      <?php 
      if(isset($_GET['updated']))
      {
         echo <<< END
         <div class="card mb-2 bg-success" style="width:95%" id="disappear_msg">
         <div class="card-body">
         <p style="color:#ff1;">STUDENT IS UPDATED SUCCESSFULLY</p>
         </div>
         </div>
         END;
      }
      ?>
    <div id="student_table">
    </div>
    <div class="container">
    <nav aria-label="Page navigation" class="ml-4">
     <ul class="pagination justify-content-center">
     <!--<li class="page-item">
        <select size='20' class="form-control">
           <option value="10">10</option>
           <option value="20">20</option>
        </select>
     </li>-->
	    <?php
     $total_rows = getTotalData($con);
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
         <button type="button" class="page-link text-primary pages" onclick="pagination_data_student(this)" data-id1="$limit_start" data-id2="$number_of_data">$page_count</button>
         </li>
         END;
       }
     }else {
         echo <<< END
         <li class="page-item">
         <button class="page-link text-primary pages" onclick="pagination_data_student(this)" data-id1="$limit_start" data-id2="$number_of_data">$page_count</button>
         </li>
         END;
       }
    ?>
      </ul> 
    </nav>
    </div>
   </div>
  </div>
</div>
<script type="text/javascript" src="js/student.js"></script>
</body>
</html>