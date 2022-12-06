<?php
include("configuration/connection.php");
if(isset($_GET['no'])) {
 $id_to_delete=$_GET['no'];
$sql="DELETE FROM mysuccess_exam WHERE no=$id_to_delete LIMIT 1;";
$sql.="DELETE FROM mysuccess_test WHERE st_id=$id_to_delete LIMIT 1;";
  if($con->multi_query($sql)==true) {
    echo "<h1>data deleted successful</h1>";
    header("refresh:2;url=delete.php");
  }else {
    echo 'ERROR'.$con->error;
  }
}
?>