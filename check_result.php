<?php
session_start();
include("admin/configuration/connection.php");

 if(isset($_POST['action']))
 {
   $output='';
   if($_POST['action']=='fetch')
   {
     $student_level='';
     $input=0;
     $error_student_level='';
     $error_input='';
     $error=0;
     if(empty($_POST['student_level']))
     {
       $error_student_level="Select level please";
       $error++;
     }
     else
     {
       if(empty($_POST['input']))
       {
         $error_input="Enter student id please";
         $error++;
       }
       else
       {
         $student_level=$_POST["student_level"];
         $input=$_POST["input"];
       }
     }
     if($error > 0) {
       $output=array(
       "error"               => true,
       "error_student_level" => $error_student_level,
       "error_input"         => $error_input
       );
     }
     else
     {
     	$sql="SELECT student_firstname,student_lastname,born_at,ts.reg_no,subject_name,subj.marks,avg(tm.marks) as test_mark,avg(em.marks) as exam_mark,class_name
            FROM tbl_student ts,classes cl,subjects subj,subject_classes sc,test_marks tm,exam_marks em
            WHERE ts.class_id=cl.class_id AND cl.class_id=sc.class_id AND sc.subject_id=subj.subject_id AND ts.reg_no=tm.reg_no AND ts.reg_no=em.reg_no AND tm.subject_id=subj.subject_id AND subj.subject_id=em.subject_id AND ts.reg_no=:reg_no AND cl.class_name=:class
            GROUP BY subj.subject_id";
       $stmt=$con->prepare($sql);
       $stmt->bindparam(":reg_no",$input);
       $stmt->bindparam(":class",$student_level);
       $stmt->execute();
       $total_row=$stmt->rowCount();
         if($total_row > 0)
         {
           $result=$stmt->fetchAll();
            foreach($result as $row)
            {
             $output=array(
             "success"    => true,
             );
              $_SESSION['reg_number']=$row['reg_no'];
              $_SESSION['class_name']=$row['class_name'];
            }

         }
         else
         {
           $output=array(
           "error"               => true,
           "error_student_level" => "Data Not Found",
           );
         }
     }
   }
   echo json_encode($output);
 }
?>