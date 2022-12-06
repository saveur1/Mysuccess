<?php
$con=new PDO("mysql:host=localhost;dbname=mysuccess","root", "");

$base_url="http://localhost:8080/Mysuccess/";

function total_student($con) {
  $sql="SELECT student_firstname,student_lastname,born_at,ts.reg_no,subject_name,subj.marks,avg(tm.marks) as test_mark,avg(em.marks) as exam_mark,class_name
      FROM tbl_student ts,classes cl,subjects subj,subject_classes sc,test_marks tm,exam_marks em
      WHERE ts.class_id=cl.class_id AND cl.class_id=sc.class_id AND sc.subject_id=subj.subject_id AND ts.reg_no=tm.reg_no AND ts.reg_no=em.reg_no AND tm.subject_id=subj.subject_id AND subj.subject_id=em.subject_id
      GROUP BY ts.reg_no";
  $stmt=$con->prepare($sql);
  $stmt->execute();
  return $stmt->rowCount();
}
/*
function s4($con) {
  $sql="SELECT e.level FROM mysuccess_exam e ,mysuccess_test t WHERE e.id=t.id AND e.level='S4MCE'";
  $stmt=$con->prepare($sql);
  $stmt->execute();
  return $stmt->rowCount();
}
function s5($con) {
  $sql="SELECT e.level FROM mysuccess_exam e ,mysuccess_test t WHERE e.id=t.id AND e.level='S5MCE'";
  $stmt=$con->prepare($sql);
  $stmt->execute();
  return $stmt->rowCount();
}
function s6($con) {
  $sql="SELECT e.level FROM mysuccess_exam e ,mysuccess_test t WHERE e.id=t.id AND e.level='S6MCE'";
  $stmt=$con->prepare($sql);
  $stmt->execute();
  return $stmt->rowCount();
}*/
function get_rank($con,$reg_no,$class_name)
 {
   $sql="SELECT ts.reg_no,student_firstname,class_name,student_lastname,(avg(tm.marks+em.marks)/avg(2*subj.marks))*100 as percentage
         FROM tbl_student ts,classes cl,subjects subj,subject_classes sc,test_marks tm,exam_marks em
         WHERE ts.class_id=cl.class_id AND cl.class_id=sc.class_id AND sc.subject_id=subj.subject_id AND ts.reg_no=tm.reg_no AND ts.reg_no=em.reg_no AND tm.subject_id=subj.subject_id AND subj.subject_id=em.subject_id
         GROUP BY ts.reg_no ORDER BY percentage DESC";

   $stmt=$con->prepare($sql);
   $stmt->execute();
   $result=$stmt->fetchAll();
   $i=0;
   foreach($result as $row)
   {
     $i++;
     if($row['class_name']==$class_name && $row['reg_no']==$reg_no)
     {
       return $i;
     }
   }
 }
 function get_rank_subject($con,$reg_no,$class_name,$subject)
 {
 	   $sql="SELECT ts.reg_no,student_firstname,student_lastname,subject_name,sum(tm.marks+em.marks) as summation,class_name
         FROM tbl_student ts,classes cl,subjects subj,subject_classes sc,test_marks tm,exam_marks em
         WHERE ts.class_id=cl.class_id AND cl.class_id=sc.class_id AND sc.subject_id=subj.subject_id AND ts.reg_no=tm.reg_no AND ts.reg_no=em.reg_no AND tm.subject_id=subj.subject_id AND subj.subject_id=em.subject_id AND subj.subject_name=:subject
         GROUP BY ts.reg_no ORDER BY summation DESC";
    $stmt=$con->prepare($sql);
    $stmt->execute(array(":subject" => $subject));
    $result=$stmt->fetchAll();
    $i=0;
    foreach($result as $row)
    {
       $i++;
       if($row['class_name']==$_SESSION['class_name'] && $row['reg_no']==$_SESSION['reg_number'])
       {
          return $i;
       }
    }
 }
 function getTotalTest($connection,$reg_no,$class_name)
 {
				 $sql="SELECT sum(tm.marks) as test_mark
				      FROM tbl_student ts,classes cl,subjects subj,subject_classes sc,test_marks tm,exam_marks em
				      WHERE ts.class_id=cl.class_id AND cl.class_id=sc.class_id AND sc.subject_id=subj.subject_id AND ts.reg_no=tm.reg_no AND ts.reg_no=em.reg_no AND tm.subject_id=subj.subject_id AND subj.subject_id=em.subject_id AND ts.reg_no=:reg_no AND cl.class_name=:class
				      GROUP BY ts.reg_no";
				 $stmt=$connection->prepare($sql);
				 $data=array(
				   ":reg_no"  => $reg_no,
				   ":class"   => $class_name
				 );
				 $stmt->execute($data);
				 $result=$stmt->fetchAll();
				 foreach($result as $row)
				 {
				 	  return $row['test_mark'];
				 }
 }
 function getTotalExam($connection,$reg_no,$class_name)
 {
				 $sql="SELECT sum(em.marks) as exam_mark
				      FROM tbl_student ts,classes cl,subjects subj,subject_classes sc,test_marks tm,exam_marks em
				      WHERE ts.class_id=cl.class_id AND cl.class_id=sc.class_id AND sc.subject_id=subj.subject_id AND ts.reg_no=tm.reg_no AND ts.reg_no=em.reg_no AND tm.subject_id=subj.subject_id AND subj.subject_id=em.subject_id AND ts.reg_no=:reg_no AND cl.class_name=:class
				      GROUP BY ts.reg_no";
				 $stmt=$connection->prepare($sql);
				 $data=array(
				   ":reg_no"  => $reg_no,
				   ":class"   => $class_name
				 );
				 $stmt->execute($data);
				 $result=$stmt->fetchAll();
				 foreach($result as $row)
				 {
				 	  return $row['exam_mark'];
				 }
 }
 function getTotal($connection,$reg_no,$class_name)
 {
				 $sql="SELECT sum(subj.marks) as total_mark
				      FROM tbl_student ts,classes cl,subjects subj,subject_classes sc,test_marks tm,exam_marks em
				      WHERE ts.class_id=cl.class_id AND cl.class_id=sc.class_id AND sc.subject_id=subj.subject_id AND ts.reg_no=tm.reg_no AND ts.reg_no=em.reg_no AND tm.subject_id=subj.subject_id AND subj.subject_id=em.subject_id AND ts.reg_no=:reg_no AND cl.class_name=:class
				      GROUP BY ts.reg_no";
				 $stmt=$connection->prepare($sql);
				 $data=array(
				   ":reg_no"  => $reg_no,
				   ":class"   => $class_name
				 );
				 $stmt->execute($data);
				 $result=$stmt->fetchAll();
				 foreach($result as $row)
				 {
				 	  return $row['total_mark'];
				 }
 }
 function getAverage($connection,$reg_no,$class_name)
 {
				 $sql="SELECT (avg(tm.marks+em.marks)/avg(2*subj.marks))*100 as average_mark
				      FROM tbl_student ts,classes cl,subjects subj,subject_classes sc,test_marks tm,exam_marks em
				      WHERE ts.class_id=cl.class_id AND cl.class_id=sc.class_id AND sc.subject_id=subj.subject_id AND ts.reg_no=tm.reg_no AND ts.reg_no=em.reg_no AND tm.subject_id=subj.subject_id AND subj.subject_id=em.subject_id AND ts.reg_no=:reg_no AND cl.class_name=:class
				      GROUP BY ts.reg_no";
				 $stmt=$connection->prepare($sql);
				 $data=array(
				   ":reg_no"  => $reg_no,
				   ":class"   => $class_name
				 );
				 $stmt->execute($data);
				 $result=$stmt->fetchAll();
				 foreach($result as $row)
				 {
				 	  return $row['average_mark'];
				 }
 }
 function fetchOption($con)
{
				$output="";
				$sql="SELECT * FROM classes";
				$stmt=$con->prepare($sql);
				$stmt->execute();
				$result=$stmt->fetchAll();
				foreach($result as $row)
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
	$stmt=$connection->prepare($query);
	$stmt->execute();
	$result=$stmt->fetchAll();
	foreach($result as $row)
	{
        $output=$row["total_rows"];
	}
	return $output;
}
function totalInTable($conn,$table)
{
	$query="SELECT * FROM $table";
	$stmt=$conn->prepare($query);
	$stmt->execute();
	return $stmt->rowCount();
}
function getClassPerTeacher($conn,$teacherId)
{
   $sql="SELECT DISTINCT class_name,cl.class_id
         FROM tbl_teacher tt,classes cl,stud_subj_class ssc
         WHERE tt.teacher_id=ssc.teacher_id AND ssc.class_id=cl.class_id
         AND tt.teacher_id=:teacher_id";
   $stmt=$conn->prepare($sql);
   $stmt->execute(array(":teacher_id" => $teacherId));
   $result=$stmt->fetchAll();
   return $result;
}
function getSubjects($conn,$teacherId,$classId)
{
   $sql="SELECT sub.subject_id,subject_name 
         FROM tbl_teacher tt,subjects sub,classes cl,stud_subj_class ssc
         WHERE tt.teacher_id=ssc.teacher_id AND ssc.class_id=cl.class_id AND ssc.subject_id=sub.subject_id 
         AND tt.teacher_id=:teacher_id AND cl.class_id=:class_id";
   $stmt=$conn->prepare($sql);
   $stmt->execute(array(
         ":teacher_id"  => $teacherId,
         ":class_id"    => $classId
        ));
   $result=$stmt->fetchAll();
   return $result;
}
function getAllStudentInClass($conn,$classId)
{
   $sql="SELECT ts.reg_no,student_firstname,student_lastname
         FROM tbl_student ts INNER JOIN classes cl
         ON ts.class_id=cl.class_id
         WHERE cl.class_id=:class_id";
   $stmt=$conn->prepare($sql);
   $stmt->execute(array(":class_id" => $classId ));
   $result=$stmt->fetchAll();
   return $result;
}
function getTestMarks($conn,$subjectId,$reg_no)
{
   $sql="SELECT tm.marks as test_mark
         FROM tbl_student ts INNER JOIN test_marks tm INNER JOIN subjects sub
         ON ts.reg_no=tm.reg_no AND tm.subject_id=sub.subject_id
         WHERE sub.subject_id=:subject_id AND ts.reg_no=:reg_no";
   $stmt=$conn->prepare($sql);
   $stmt->execute(array(
                  ":subject_id" => $subjectId,
                  ":reg_no"     => $reg_no
                  ));
   $result=$stmt->fetchAll();
   foreach($result as $row)
   {
      return $row['test_mark'];
   }
}
function getExamMarks($conn,$subjectId,$reg_no)
{
   $sql="SELECT em.marks as exam_mark
         FROM tbl_student ts INNER JOIN exam_marks em INNER JOIN subjects sub
         ON ts.reg_no=em.reg_no AND em.subject_id=sub.subject_id
         WHERE sub.subject_id=:subject_id AND ts.reg_no=:reg_no";
   $stmt=$conn->prepare($sql);
   $stmt->execute(array(
                  ":subject_id" => $subjectId,
                  ":reg_no"     => $reg_no
                  ));
   $result=$stmt->fetchAll();
   foreach($result as $row)
   {
      return $row['exam_mark'];
   }
}
function getOneDataInTable($con,$table,$column,$output,$data)
{
   $sql="SELECT * 
         FROM $table 
         WHERE $column=$data";
   $stmt=$con->prepare($sql);
   $stmt->execute();
   $result=$stmt->fetchAll();
   foreach($result as $row)
   {
      return $row[$output];
   }
}
function isThereExamMarks($con,$class_id,$subject_id)
{
   $total_student=count(getAllStudentInClass($con,$class_id));
   $student=getAllStudentInClass($con,$class_id);
   $count=0;
   for($i=0;$i<$total_student;$i++)
   {
      $exam_mark=getExamMarks($con,$subject_id,$student[$i]['reg_no']);
      if($exam_mark =='')
      {
         $count++;
      }

   }
    if($count==0) {
       return 0;
    }else {
       return 1;
    }
}
function isThereTestMarks($con,$class_id,$subject_id)
{
   $total_student=count(getAllStudentInClass($con,$class_id));
   $student=getAllStudentInClass($con,$class_id);
   $count=0;
   for($i=0;$i<$total_student;$i++)
   {
      $test_mark=getTestMarks($con,$subject_id,$student[$i]['reg_no']);
      if($test_mark =='')
      {
         $count++;
      }

   }
    if($count==0) {
       return 0;
    }else {
       return 1;
    }
}
function filter_input($data)
{
   $data=htmlspecialchars($data);
   $data=stripslashes($data);
   $data=trim($data);
   return $data;
}

 ?>