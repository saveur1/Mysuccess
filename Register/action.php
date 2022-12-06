<?php
require_once("../admin/configuration/connection.php");
if(isset($_POST['submit']))
{
	if($_POST['submit']=="Add Class")
	{
	$class_name=$_POST['class_name'];
	$block_name=$_POST['block_name'];
	if($class_name !="" && $block_name !="")
	{
		$sql="INSERT INTO classes(class_name,block_name)VALUE(:class_name,:block_name)";
		$stmt=$con->prepare($sql);
		$output=$stmt->execute(array(
		             ":class_name" => $class_name,
		             ":block_name" => $block_name
		             ));
		if($output) {
		echo "<script>
		if(alert('DATA INSERTED SUCCESSFULLY'))
		{
			".header("Refresh:0.1;url=classes.php")."
		}
		</script>";
	  }
	}
    }
if($_POST['submit']=="Add Subject")
{
	$subject_name=$_POST['subject_name'];
	$marks=$_POST['marks'];
	if( $subject_name !="" && $marks !="")
	{
		$sql="INSERT INTO subjects(subject_name,marks)VALUE('$subject_name',$marks)";
		$stmt=$con->prepare($sql);
		if($stmt->execute())
		{
		echo "<script>
		if(alert('DATA INSERTED SUCCESSFULLY'))
		{
			".header("Refresh:0.1;url=subjects.php")."
		}
		</script>";
	  }
	}
}
  if($_POST['submit']=="Add Student")
  {
    	$image="";
    $dateofbirth             =$_POST['dateofbirth'];
	   $student_firstname       =$_POST['student_firstname'];
	   $student_lastname        =$_POST['student_lastname'];
	   $student_id              =$_POST['student_id'];
    $address                 =$_POST['address'];
	   $guardianidnumber        =$_POST['guardianidnumber'];
    $fatherorguardian_name   =$_POST['fatherorguardian_name'];
	   $phone_number            =$_POST['phone_number'];
    $admission_date          =$_POST['admission_date'];
    $born_at                 =$_POST['born_at'];
	   $class_id                =$_POST['class_id'];
    if(!empty($_FILES['image']['name'])) {
      $image_folder="images";
      $file_array=explode(".",$_FILES['image']['name']);
      $file_extension=strtolower($file_array[1]);
      $allowed_extension=array("jpg","png","jpeg","gif");
      if(in_array($file_extension,$allowed_extension))
      {
      	$image = $image_folder."/".basename($_FILES['image']['name']);
      	move_uploaded_file($_FILES['image']['tmp_name'],$image);
      }
      else {
        echo "<script>
		if(alert('IMAGE OF JPG, PNG, JPEG, GIF ARE ONLY EXTENSION ALLOWED'))
		{
			".header("Refresh:0.1;url=student.php")."
		}
		</script>";
      }
    }
	if( $student_firstname !="" && $student_lastname !="" && $class_id !="" && $address !="")
	{
		$sql = " INSERT INTO
        tbl_student(
        student_firstname,student_lastname,dateofbirth,student_ID,address,guardianidnumber,fatherorguardian_name,phone_number,admission_date,image,class_id,born_at
        )
        VALUES(
        '$student_firstname','$student_lastname','$dateofbirth','$student_id','$address','$guardianidnumber','$fatherorguardian_name','$phone_number','$admission_date','$image',$class_id,'$born_at'
        )";
  $stmt=$con->prepare($sql);
		if($stmt->execute())
   {
		echo "<script>
		if(alert('DATA INSERTED SUCCESSFULLY'))
		{
			".header("Refresh:0.1;url=student.php")."
		}
		</script>";
	    }
	 }
    else {
      echo "script>
		if(alert('Fill in data please'))
		{
			".header("Refresh:0.1;url=student.php")."
		}
		</script>";
    }
  }
  if($_POST['submit']=="Add Teacher")
  {
 $teacher_firstname       =$_POST['teacher_firstname'];
 $teacher_lastname        =$_POST['teacher_lastname'];
 $dateofbirth             =$_POST['dateofbirth'];
	$qualification           =$_POST['qualification'];
	$experience              =$_POST['experience'];
	$phone_number            =$_POST['phone_number'];
	$email_id                =$_POST['email_id'];
	$address                 =$_POST['address'];
 $joiningdate             =$_POST['joiningdate'];
 $teacher_image="";
    if(!empty($_FILES['teacher_image']['name'])) {
      $image_folder="images";
      $file_array=explode(".",$_FILES['teacher_image']['name']);
      $file_extension=strtolower($file_array[1]);
      $allowed_extension=array("jpg","png","jpeg","gif");
      if(in_array($file_extension,$allowed_extension))
      {
      	$teacher_image = $image_folder."/".basename($_FILES['teacher_image']['name']);
      	move_uploaded_file($_FILES['teacher_image']['tmp_name'],$teacher_image);
      }
      else
      {
        echo "<script>
		           if(alert('IMAGE OF JPG, PNG, JPEG, GIF ARE ONLY EXTENSION ALLOWED'))
		           {
			          ".header("Refresh:0.1;url=teacher.php")."
		           }
		          </script>";
      }
    }
	if( $teacher_firstname !="" && $teacher_lastname != "" && $email_id !="" && $address !="")
	{
		$sql = "INSERT INTO
        tbl_teacher(
        teacher_firstname,teacher_lastname,dateofbirth,qualification,experience,phone_number,email_id,address,joining_date,teacher_image
        )
        VALUES(
        '$teacher_firstname','$teacher_lastname','$dateofbirth','$qualification',$experience,'$phone_number','$email_id','$address','$joiningdate','$teacher_image'
        )";
		 $stmt=$con->prepare($sql);
   if($stmt->execute())
   {
		echo "<script>
		if(alert('DATA INSERTED SUCCESSFULLY'))
		{
			".header("Refresh:0.1;url=teacher.php")."
		}
		</script>";
	    }
	    
	 }
    else {
      echo "script>
		if(alert('Fill in data please'))
		{
			".header("Refresh:0.1;url=teacher.php")."
		}
		</script>";
    }
  }
  if($_POST['submit']=="Update Teacher")
  {
  	$sql="UPDATE tbl_teacher SET
  	     teacher_firstname='".$_POST['teacher_firstname']."',
  	     teacher_lastname='".$_POST['teacher_lastname']."',
  	     dateofbirth='".$_POST['dateofbirth']."',
  	     address='".$_POST['address']."',
  	     qualification='".$_POST['qualification']."',
  	     experience=".$_POST['experience'].",
  	     phone_number='".$_POST['phone_number']."',
  	     joining_date='".$_POST['joiningdate']."',
  	     email_id='".$_POST['email_id']."'
  	     WHERE teacher_id=".$_POST['hidden_teacher_id']."";
  	 $stmt=$con->prepare($sql);
   if($stmt->execute())
  	 {
  	 	header("Location:teacher.php?updated");
  	 }
  }
  if($_POST['submit']=="Update Student")
  {
  	$sql="UPDATE tbl_student SET
  	     student_firstname='".$_POST['student_firstname']."',
  	     student_lastname='".$_POST['student_lastname']."',
  	     dateofbirth='".$_POST['dateofbirth']."',
  	     student_ID='".$_POST['student_id']."',
  	     address='".$_POST['address']."',
  	     guardianidnumber='".$_POST['guardianidnumber']."',
  	     fatherorguardian_name='".$_POST['fatherorguardian_name']."',
  	     phone_number='".$_POST['phone_number']."',
  	     admission_date='".$_POST['admission_date']."',
  	     class_id=".$_POST['class_id'].",
  	     born_at='".$_POST['born_at']."'
  	     WHERE reg_no=".$_POST['hidden_stud_id']."";
   	$stmt=$con->prepare($sql);
   if($stmt->execute())
  	 {
  	 	header("Location:student.php?updated");
  	 }
  }
  if($_POST['submit']=="Update Subject")
  {
  	$sql="UPDATE subjects SET
  	     subject_name='".$_POST['subject_name']."',
  	     marks=".$_POST['marks']."
  	     WHERE subject_id=".$_POST['hidden_subject_id']."";
  	 $stmt=$con->prepare($sql);
   if($stmt->execute())
  	 {
  	 	header("Location:subjects.php?updated");
  	 }
  }
  if($_POST['submit']=="Update Class")
  {
  	$sql="UPDATE classes SET
  	     class_name='".$_POST['class_name']."',
  	     block_name='".$_POST['block_name']."'
  	     WHERE class_id=".$_POST['hidden_class_id']."";
  	 $stmt=$con->prepare($sql);
   if($stmt->execute())
  	 {
  	 	header("Location:classes.php?updated");
  	 }
  }
}

if(isset($_POST['delete_stud_id']))
{
   $sql="DELETE FROM tbl_student WHERE reg_no=".$_POST['delete_stud_id']."";
   $stmt=$con->prepare($sql);
   if($stmt->execute()){
     header("Location:student.php");
   }
}
if(isset($_POST['delete_teacher_id']))
{
   $sql="DELETE FROM tbl_teacher WHERE teacher_id=".$_POST['delete_teacher_id']."";
   $stmt=$con->prepare($sql);
   if($stmt->execute()) {
     header("Location:teacher.php");
   }
}
if(isset($_POST['delete_subject_id']))
{
   $sql="DELETE FROM subjects WHERE subject_id=".$_POST['delete_subject_id']."";
   $stmt=$con->prepare($sql);
   if($stmt->execute()) {
     header("Location:subjects.php");
   }
}
if(isset($_POST['delete_class_id']))
{
   $sql="DELETE FROM classes WHERE class_id=".$_POST['delete_class_id']."";
   $stmt=$con->prepare($sql);
   if	($stmt->execute()) {
     header("Location:classes.php");
   }
}
if(isset($_POST['update_stud_id']))
{
   $output=array();
   $sql="SELECT * FROM tbl_student WHERE reg_no=".$_POST['update_stud_id']."";
   $stmt=$con->prepare($sql);
   $stmt->execute();
   $result=$stmt->fetchAll();
   foreach($result as $row)
   {
   	$output=array(
   	 "student_id"             => $row['student_ID'],
    "image"                  => $row['image'],
    "dateofbirth"            => $row['dateofbirth'],
	   "student_firstname"      => $row['student_firstname'],
	   "student_lastname"       => $row['student_lastname'],
    "address"                => $row['address'],
	   "guardianidnumber"       => $row['guardianidnumber'],
    "fatherorguardian_name"  => $row['fatherorguardian_name'],
	   "phone_number"           => $row['phone_number'],
    "admission_date"         => $row['admission_date'],
	   "class_id"               => $row['class_id'],
	   "born_at"                => $row['born_at']
   	);
   }
   echo json_encode($output);
}
if(isset($_POST['update_teacher_id']))
{
   $output=array();
   $sql="SELECT * FROM tbl_teacher WHERE teacher_id=".$_POST['update_teacher_id']."";
   $stmt=$con->prepare($sql);
   $stmt->execute();
   $result=$stmt->fetchAll();
   foreach($result as $row)
   {
    $output=array(
     "dateofbirth"            => $row['dateofbirth'],
     "teacher_firstname"      => $row['teacher_firstname'],
     "teacher_lastname"       => $row['teacher_lastname'],
     "address"                => $row['address'],
     "qualification"          => $row['qualification'],
     "experience"             => $row['experience'],
     "phone_number"           => $row['phone_number'],
     "joining_date"           => $row['joining_date'],
     "email_id"               => $row['email_id'],
     "teacher_image"          => $row['teacher_image'],
    );
   }
   echo json_encode($output);
}
if(isset($_POST['update_subject_id']))
{
   $output=array();
   $sql="SELECT * FROM subjects WHERE subject_id=".$_POST['update_subject_id']."";
   $stmt=$con->prepare($sql);
   $stmt->execute();
   $result=$stmt->fetchAll();
   foreach($result as $row)
   {
    $output=array(
     "subject_name"            => $row['subject_name'],
     "marks"                   => $row['marks']
     );
   }
   echo json_encode($output);
}
if(isset($_POST['update_class_id']))
{
   $output=array();
   $sql="SELECT * FROM classes WHERE class_id=".$_POST['update_class_id']."";
   $stmt=$con->prepare($sql);
   $stmt->execute();
   $result=$stmt->fetchAll();
   foreach($result as $row)
   {
    $output=array(
     "class_name"            => $row['class_name'],
     "block_name"            => $row['block_name']
     );
   }
   echo json_encode($output);
}
if(isset($_POST['get_all_students']))
{
	 $sql="SELECT st.reg_no,class_name,student_firstname,student_lastname,image FROM tbl_student st,classes cl
         WHERE st.class_id=cl.class_id";
  if(isset($_POST['search_value']))
  {
  	$sql.=" AND st.student_firstname LIKE '%".$_POST['search_value']."%'
  	        OR st.student_lastname LIKE '%".$_POST['search_value']."%'";
  }
  $sql.=" ORDER BY reg_no DESC";
  if(isset($_POST["pagination"]))
  {
    $sql.=" LIMIT ".$_POST['limit_start'].", ".$_POST['number_of_data']."";
  }
  $stmt=$con->prepare($sql);
  $stmt->execute();
  $num_rows=$stmt->rowCount();
  $result=$stmt->fetchAll();
  $output="";
	 $output="<table border='1'cellspacing='5'cellpadding='15' style='width:95%'>
    <tr>
        <th>Image</th>
        <th>Reg NO.</th>
        <th>Names</th>
        <th>class</th>
        <th>View</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>";
  if($num_rows > 0)
  {
      foreach($result as $row)
      {
      $output.="
        <tr>
        <td><img src='".$row['image']."'width='30'height='30'/></td>
        <td>".$row['reg_no']."</td>
        <td>".$row['student_firstname']." ".$row['student_lastname']."</td>
        <td>".$row['class_name']."</td>
        <td><img src='images/view.png' width='42' height='28' class='view'></td>
        <td><img src='images/edit.png' width='28' height='42' class='edit' onclick='update_student(this);' id='".$row['reg_no']."'></td>
        <td><img src='images/delete.png' width='29' height='39' class='delete' onclick='delete_student(this); return false;' id='".$row['reg_no']."'></td>
       </tr>";
      }
   }else {
    $output.="<tr>
              <td colspan='6' class='text-center'><h3>NO DATA FOUND</h3></td>
              </tr>";
   }
    $output.="</table><br>";
    echo $output;
}
if(isset($_POST['get_all_teachers']))
{
   $sql="SELECT * FROM tbl_teacher";
  if(isset($_POST['search_value']))
  {
    $sql.=" WHERE teacher_name LIKE '%".$_POST['search_value']."%'";
  }
  $sql.=" ORDER BY teacher_id DESC";
  if(isset($_POST["pagination"]))
  {
    $sql.=" LIMIT ".$_POST['limit_start'].", ".$_POST['number_of_data']."";
  }
  $stmt=$con->prepare($sql);
  $stmt->execute();
  $num_rows=$stmt->rowCount();
  $result=$stmt->fetchAll();
  $output="";
   $output="<table border='1' cellspacing='5' cellpadding='15' style='width:95%'>
    <tr>
        <th>image</th>
        <th>teacher_Id</th>
        <th>Names</th>
        <th>View</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>";
  if($num_rows > 0)
  {
      foreach($result as $row)
      {
      $output.="
      <tr>
        <td><img src='".$row['teacher_image']."' width='31' height='41'></td>
        <td>".$row['teacher_id']."</td>
        <td>".$row['teacher_firstname']." ".$row['teacher_lastname']."</td>
        <td><img src='images/view.png' width='42' height='28' class='view'></td>
        <td><img src='images/edit.png' width='28' height='42' class='edit' onclick='update_teacher(this)' id='".$row['teacher_id']."'></td>
        <td><img src='images/delete.png' width='29' height='39' class='delete' onclick='delete_teacher(this); return false;' id='".$row['teacher_id']."'></td>
      </tr>";
       }
    }else {
    $output.="<tr>
              <td colspan='6' class='text-center'><h3>NO DATA FOUND</h3></td>
              </tr>";
   }
    $output.="</table><br>";
    echo $output;
}
if(isset($_POST['get_all_subjects']))
{
   $sql="SELECT * FROM subjects";
  if(isset($_POST['search_value']))
  {
    $sql.=" WHERE subject_name LIKE '%".$_POST['search_value']."%'";
  }
  $sql.=" ORDER BY subject_id DESC";
  if(isset($_POST["pagination"]))
  {
    $sql.=" LIMIT ".$_POST['limit_start'].", ".$_POST['number_of_data']."";
  }
  $stmt=$con->prepare($sql);
  $stmt->execute();
  $num_rows=$stmt->rowCount();
  $result=$stmt->fetchAll();
  $output="";
  $output="<table border='1' cellpadding='15' style='width:95%'>
    <tr>
        <th>sub_id</th>
        <th>Subjects name</th>
        <th>Marks</th>
        <th>View</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>";
  if($num_rows > 0) {
      foreach($result as $row)
      {
      $output.="
        <tr>
        <td>".$row['subject_id']."</td>
        <td>".$row['subject_name']."</td>
        <td>".$row['marks']."</td>
        <td><img src='images/view.png' width='42' height='28' class='view'></td>
        <td><img src='images/edit.png' width='28' height='42' class='edit' onclick='update_subject(this)' id='".$row['subject_id']."'></td>
        <td><img src='images/delete.png' width='29' height='39' class='delete' onclick='delete_subject(this); return false;' id='".$row['subject_id']."'></td>
        </tr>";
      }
   }else {
    $output.="<tr>
              <td colspan='6' class='text-center'><h3>NO DATA FOUND</h3></td>
              </tr>";
   }
     $output.="</table><br>";
     echo $output;
   }

if(isset($_POST['get_all_classes']))
{
   $sql="SELECT * FROM classes";
  if(isset($_POST['search_value']))
  {
    $sql.=" WHERE class_name LIKE '%".$_POST['search_value']."%' 
               OR block_name LIKE '%".$_POST['search_value']."%'";
  }
  $sql.=" ORDER BY class_id DESC";
  if(isset($_POST["pagination"]))
  {
    $sql.=" LIMIT ".$_POST['limit_start'].", ".$_POST['number_of_data']."";
  }
  $stmt=$con->prepare($sql);
  $stmt->execute();
  $num_rows=$stmt->rowCount();
  $result=$stmt->fetchAll();
  $output="";
  $output="
     <table border='1' cellspacing='5' cellpadding='15' style='width:95%'>
       <tr>
        <th>class Id</th>
        <th>class-Name</th>
        <th>View</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>";
  if($num_rows > 0) {
      foreach($result as $row)
      {
      $output.="<tr>
             <td>".$row['class_id']."</td>
             <td>".$row['class_name']."(".$row['block_name'].")"."</td>
             <td><img src='images/view.png' width='42' height='28' class='view_class' id='".$row['class_id']."'></td>
             <td><img src='images/edit.png' width='28' height='42' class='edit' onclick='update_class(this)' id='".$row['class_id']."'></td>
             <td><img src='images/delete.png' width='29' height='39' class='delete' onclick='delete_class(this); return false;' id='".$row['class_id']."'></td>
             <tr>";
      }
   }else {
    $output.="<tr>
              <td colspan='6' class='text-center'><h3>NO DATA FOUND</h3></td>
              </tr>";
   }
     $output.="</table><br>";
     echo $output;
}
?>