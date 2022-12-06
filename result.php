<?php
session_start();
 include("include/header.php");
 ?>
<div class="dynamic_report">
    <div id="dynamic_table">
    </div>
</div>
<?php include("include/footer.php"); ?>
<script type="text/JavaScript">
$(document).ready(function(){
    //function get_data() {
  if("<?php echo $_SESSION['class_name']; ?>" == "")
  {
    location.href="<?php echo $base_url; ?>";
  }
   $.ajax({
      url:'result_action.php',
      method:'POST',
      dataType:"text",
      data:{"done":1},
      success:function(data)
       {
       	$('#dynamic_table').html(data);
       }
   });
  });
</script>
</body>
</html>