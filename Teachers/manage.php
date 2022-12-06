<?php
if(!isset($_GET['class_id']) && !isset($_GET['subject_id']))
{
   header("Location:index.php");
}
 include "../admin/configuration/connection.php";
 include "include/header.html";
 ?>
 <div class="container">
   <div class="card mt-1 mb-1">
     <div class="card-body p-2">
       <a href="index.php" class="card-link mr-1"><?php echo getOneDataInTable($con,'classes','class_id','class_name',$_GET['class_id']); ?></a>/
       <a href="#" class="ml-1" id="stay_in_page"><?php echo getOneDataInTable($con,'subjects','subject_id','subject_name',$_GET['subject_id']); ?></a>
     </div>
   </div>
   <div id="Main_table">
   <div class="card mt-1 mb-1 text-right">
     <div class="card-body p-2">
       <a href="#" class="card-link mr-1 btn btn-sm btn-warning" id="add_test_marks">Add Test-Marks</a>
       <a href="#" class="card-link ml-1 btn btn-sm btn-success" id="add_exam_marks">Add Exam-Marks</a>
     </div>
   </div>
   <div class="table-responsive">
     <div id="display_table">
     </div>
   </div>
   </div>
   <div id="add_marks">
    <div class="card mt-2">
       <div class="card-header" id="ctitle">
        Test Marks
       </div>
       <div class="card-body">
          <div id="insert_table">
          </div>
       </div>
    </div>
   </div>
 </div>
 <script type="text/javascript">
 $(document).ready(function() {
    $("#add_marks").hide();
    function getTableData()
    {
       $.ajax({
          url:"action.php",
          method:"POST",
          dataType:"text",
          data:{
                action:"SELECT",
                class_id:<?php echo $_GET['class_id'] ?? 0; ?>,
                subject_id:<?php echo $_GET['subject_id'] ?? 0; ?>
               },
          success:function(data) {
             $('#display_table').html(data);
          }
       });
    }
    getTableData();
 $(document).on("click","#btn_open_nav",function() {
      $('.collapse').slideToggle();
  });
   $("#add_test_marks").click(function(event) {
      event.preventDefault();
      $.ajax({
         url:"action.php",
         method:"POST",
         dataType:"text",
         data:{
            action:"ADD TEST MARKS",
            class_id:<?php echo $_GET['class_id'] ?? 0; ?>,
            subject_id:<?php echo $_GET['subject_id'] ?? 0; ?>
         },
         success:function(data)
         {
            $("#Main_table").hide();
            $("#insert_table").html(data);
            $('#ctitle').html("Test Marks /"+<?php echo getOneDataInTable($con,'subjects','subject_id','marks',$_GET['subject_id']); ?>);
            $("#add_marks").show();
         }
      });
     });
      $(document).on("click",".back_display",function() {
         $("#Main_table").show();
         $("#add_marks").hide();
      });
      $(document).on("submit","#add_test_form",function(event) {
         event.preventDefault();
         if(<?php echo isThereTestMarks($con,$_GET['class_id'],$_GET['subject_id']); ?>)
         {
         var formElement=[];
         formElement=$(this).serializeArray();
         $.ajax({
            url:"action.php",
            method:"POST",
            dataType:"text",
            data:{
                 action:"INSERT TEST",
                 formElement,
                 subject_id:<?php echo $_GET['subject_id']; ?>
                 },
            success:function(data) {
               alert(data);
               getTableData();
               $(".back_display").click();
            }
         });
         }else {
            $("#insert_test").attr("disabled","disabled");
         }
      });
    $(document).on("click","#add_exam_marks",function(event) {
      event.preventDefault();
      $.ajax({
         url:"action.php",
         method:"POST",
         dataType:"text",
         data:{
            action:"ADD EXAM MARKS",
            class_id:<?php echo $_GET['class_id'] ?? 0; ?>,
            subject_id:<?php echo $_GET['subject_id'] ?? 0; ?>
         },
         success:function(data)
         {
            $("#Main_table").hide();
            $("#insert_table").html(data);
            $('#ctitle').html("Exam Marks /"+<?php echo getOneDataInTable($con,'subjects','subject_id','marks',$_GET['subject_id']); ?>);
            $("#add_marks").show();
         }
      });
    });
    $("#stay_in_page").click(function(event) {
      event.preventDefault();
      $("#Main_table").show();
      $("#add_marks").hide();
    });
    $(document).on("submit","#add_exam_form",function(event) {
         event.preventDefault();
         var count=1;
         if(count == <?php echo isThereExamMarks($con,$_GET['class_id'],$_GET['subject_id']); ?>)
         {
         var formElement=[];
         formElement=$(this).serializeArray();
         $.ajax({
            url:"action.php",
            method:"POST",
            data:{
                 action:"INSERT EXAM",
                 formElement,
                 subject_id:<?php echo $_GET['subject_id']; ?>
                 },
            success:function(data) {
               alert(data);
               getTableData();
               $(".back_display").click();
            }
         });
         }else {
            $("#insert_exam").attr("disabled","disabled");
         }
      });
      $(document).on('click','.edit_marks',function() {
         var reg_no=$(this).attr("id");
         var subject_id=<?php echo $_GET['subject_id']; ?>;
         $.ajax({
            url:"action.php",
            method:"POST",
            data:{
                 action:"UPDATE DATA",
                 reg_no:reg_no,
                 subject_id:subject_id
                 },
            success:function(data) {
               $("#Main_table").hide();
               $("#insert_table").html(data);
               $('#ctitle').html("Update Marks /"+<?php echo getOneDataInTable($con,'subjects','subject_id','marks',$_GET['subject_id']); ?>);
               $("#add_marks").show();
            }
         });
      });
      $(document).on("click",".update_stud",function() {
         var test_mark=$(".test_mark").val();
         var exam_mark=$(".exam_mark").val();
         var stud_regno=$(this).attr("id");
         $.ajax({
            url:"action.php",
            method:"POST",
            data:{
                  action:"UPDATE STUDENT DATA",
                  test_mark:test_mark,
                  exam_mark:exam_mark,
                  reg_no:stud_regno,
                  subject_id:<?php echo $_GET['subject_id']; ?>
                 },
            success:function(data) {
                alert(data);
                getTableData();
                $(".back_display").click();
            }
         });
      });
   });
 </script>
 </body>
 </html>