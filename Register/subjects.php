<?php
   require_once("../admin/configuration/connection.php");
?>
 <?php include("include/header.html"); ?>
 <h3 id="table_title" style="color:white;position:relative;left:30%;top:70%">SUBJECTS TABLE</h3>
   <div id="content">
     <div class="sub_container">
    <div class="content_header">
          <form action="" class="search-bar" id="search_form" onsubmit="event.preventDefault();live_search_submit_subject();"> 
	           <input type="search" name="search_box" id="search_box" onkeydown="live_subject_search(this)" onkeyup="live_subject_search(this)" pattern=".*\S.*" required class="form-control" > 
	           <button class="btn btn-default" id="search" type="submit"><img src="images/search.png" width="40" style="position:relative;top:-14px;left:-25px"></button>
	        </form>
	        <button type="button" class="btn btn-primary" onclick="return add_more()" value="Add Subject" id="add_more">Add Subject</button>
    </div>
    <div id="edit_id" class="add_subject">
    <h1 id="form_title">ADD SUBJECT</h1>
     <form method="POST" action="action.php" id="addingForm">
        <label for="subject_name">subject name:</label>
        <input type="text" id="subject_name" name="subject_name" class="input_box new_input"><br>
        <label for="marks">maximum marks:</label>
        <input type="number" id="marks" name="marks"class="input_box new_input"><br>
        <input type="submit"name="submit" value="Add Subject" id="submit_data">
        <input type="hidden" name="hidden_subject_id" id="hidden_subject_id" />
  </form>
   </div>
        <div id="display_table">
      <?php 
      if(isset($_GET['updated']))
      {
         echo <<< END
         <div class="card mb-2 bg-success" style="width:95%" id="disappear_msg">
         <div class="card-body">
         <p style="color:#ff1;">SUBJECT IS UPDATED SUCCESSFULLY</p>
         </div>
         </div>
         END;
      }
      ?>
    <div id="subject_table">
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
     $total_rows = totalInTable($con,'subjects');
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
         <button type="button" class="page-link text-primary pages" onclick="pagination_data_subject(this)" data-id1="$limit_start" data-id2="$number_of_data">$page_count</button>
         </li>
         END;
       }
     }else {
         echo <<< END
         <li class="page-item">
         <button class="page-link text-primary pages" onclick="pagination_data_subject(this)" data-id1="$limit_start" data-id2="$number_of_data">$page_count</button>
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