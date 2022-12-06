<?php
include("../admin/configuration/connection.php");

include("include/header.html");
?>
<div class="container">
<?php
 foreach(getClassPerTeacher($con,5) as $row)
 {
  echo'<div class="card mt-3 mb-1">
     <h5 class="card-header bg-light">
      '.$row['class_name'].'
     </h5>
     <div class="card-body mb-1 pb-1">
        <h6 class="card-title text-muted">Choose subject to Manage..</h6>
     </div>
     <ul class="list-group list-group-flush">';
       foreach(getSubjects($con,5,$row['class_id']) as $subject)
       {
         echo '<li class="list-group-item"><a href="#" class="manage_subject" class="card-link" data-id1="'.$row['class_id'].'" data-id2="'.$subject['subject_id'].'">'.$subject['subject_name'].'</a></li>';
       }
     echo '</ul>
  </div>';
  }
  ?>
  <div class="modal" id="class_manager" role="dialog">
          <div class="modal-dialog modal-dialog-centered" role="document">
             <div class="modal-content">
                <div class="modal-body">
                <h5 class="card-text">Choose Subject To Manage:</h5>
                <div id="modal_subject">
                </div>
              </div>
           </div>
      </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
   $(document).on("click","#btn_open_nav",function() {
      $('.collapse').slideToggle();
   });
   $(".manage_subject").click(function(event) {
      event.preventDefault();
      var class_id=$(this).attr('data-id1');
      var subject_id=$(this).attr('data-id2');
      window.location.href="manage.php?subject_id="+subject_id+"&class_id="+class_id+"";
   });
});
</script>