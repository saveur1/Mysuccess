<?php
session_start();
  if(!isset($_SESSION["email"]) && !isset($_SESSION["password"]))
  {
    //header("Location:login.php");
  }
   require_once("../admin/configuration/connection.php");
?>
 <?php include("include/header.html"); ?>
 <h3 id="table_title" style="color:white;position:relative;left:30%;top:70%">CLASSES TABLE</h3>
   <div id="content">
     <div class="sub_container">
        <div class="content_header">
            	  <form action="" class="search-bar" onsubmit="event.preventDefault();live_search_submit_class();"> 
	                <input type="search" name="search_box" id="search_box" onkeydown="live_class_search(this)" onkeyup="live_class_search(this)" pattern=".*\S.*" required class="form-control" > 
	                <button class="btn btn-default" id="search" type="submit"><img src="images/search.png" width="40" style="position:relative;top:-14px;left:-25px"></button>
	             </form>
	             <button type="button" class="btn btn-primary" onclick="return add_more()" value="Add Class" id="add_more">Add Class</button>
        </div>
      <div id="edit_id">
    <h1 id="form_title">ADD CLASS</h1>
     <form method="POST" action="action.php" id="addingForm">
        <label for="class_name">class name:</label>
        <input type="text" id="class_name" name="class_name" class="input_box new_input"></br>
        <label for="class_name">Block Name:</label>
        <input type="text" id="block_name" name="block_name" class="input_box new_input"></br>
        <input type="submit"name="submit" value="Add Class" id="submit_data">
        <input type="hidden" name="hidden_class_id" id="hidden_class_id" />
        <br><br>
  </form>
   </div>
      <div id="display_table">
      <?php 
      if(isset($_GET['updated']))
      {
         echo <<< END
         <div class="card mb-2 bg-success" style="width:95%" id="disappear_msg">
         <div class="card-body">
         <p style="color:white">CLASS IS UPDATED SUCCESSFULLY</p>
         </div>
         </div>
         END;
      }
      ?>
       <div class="modal" id="class_viewer" role="dialog">
          <div class="modal-dialog modal-dialog-centered" role="document">
             <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title text-primary">CLASSES INFO</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="border:none;width:50px"> <span aria-hidden="true" class="text-primary">&times</span></button>
                </div>
                <div class="modal-body">
                  <p>Class id:<span id="view_class_id" class="text-primary"></span></p>
                  <p>Class Name:<span id="view_class_name" class="text-primary"></span></p>
                  <p>and class block:<span id="view_class_block" class="text-primary"></span></p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
              </div>
           </div>
      </div>
     <div id="class_table">
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
     $total_rows = totalInTable($con,'classes');
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
         <button type="button" class="page-link text-primary pages" onclick="pagination_data_class(this)" data-id1="$limit_start" data-id2="$number_of_data">$page_count</button>
         </li>
         END;
       }
     }else {
         echo <<< END
         <li class="page-item">
         <button class="page-link text-primary pages" onclick="pagination_data_class(this)" data-id1="$limit_start" data-id2="$number_of_data">$page_count</button>
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