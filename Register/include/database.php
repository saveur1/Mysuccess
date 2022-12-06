<?php
define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PASSWORD","");
define("DB","student_management");
$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB);
function fetchOption($con)
{
	$output="";
	$sql="SELECT * FROM classes";
	$result=mysqli_query($con,$sql);
	while($row=mysqli_fetch_array($result))
	{
		$output.="<option value='".$row['class_id']."'>".$row['class_name']."</option>";
	}
  return $output;
}
function getTotalData($connection)
{
	$output="";
	$query="SELECT COUNT(*) as total_rows 
	        FROM tbl_student
	        INNER JOIN classes
	        ON tbl_student.class_id=classes.class_id";
	$result=mysqli_query($connection,$query);
	while($row=mysqli_fetch_array($result))
	{
        $output=$row["total_rows"];
	}
	return $output;
}
?>