<?php
include("../admin/configuration/connection.php");
if(isset($_POST['action']))
{
   if($_POST['action']=='SELECT')
   {
      $output="
      <table class='table table-bordered'>
      <tr>
      <th>Reg No</th>
      <th>Student Name</th>
      <th>Test Marks /".getOneDataInTable($con,'subjects','subject_id','marks',$_POST['subject_id'])."</th>
      <th>Exam Marks /".getOneDataInTable($con,'subjects','subject_id','marks',$_POST['subject_id'])."</th>
      <th>Edit</th>
      </tr>";
      $total_student=count(getAllStudentInClass($con,$_POST['class_id']));
      $student=getAllStudentInClass($con,$_POST['class_id']);
      for($i=0;$i<$total_student;$i++)
      {
         $test_mark=getTestMarks($con,$_POST['subject_id'],$student[$i]['reg_no']);
         $exam_mark=getExamMarks($con,$_POST['subject_id'],$student[$i]['reg_no']);
         $output.="
            <tr>
            <td>".$student[$i]['reg_no']."</td>
            <td>".$student[$i]['student_firstname']." ".$student[$i]['student_lastname']."</td>
            <td>".($test_mark ?? 0 )."</td>
            <td>".($exam_mark ?? 0 )."</td>
            <td><button type='button' class='btn btn-sm btn-primary edit_marks' id='".$student[$i]['reg_no']."'>Edit</button>
            </tr>";

      }
      $output.="</table>";
      echo $output;
   }
   /*if($_POST['action'] == 'LOAD MODAL')
   {
      $output='';
      foreach(getSubjects($con,$_POST['teacher_id'],$_POST['class_id']) as $subject)
      {
         $output.='
           <div class="form-check">
               <input class="form-check-input subject_modal" type="radio" name="subject" id="'.$subject['subject_id'].'">
               <label class="form-check-label" for="'.$subject['subject_id'].'">'.$subject['subject_name'].'</label>
           </div>';
      }
      $output.='
          <button type="submit" value="Manage" class="btn btn-success mt-5 text-right" id="manage_btn" data-id="'.$_POST['class_id'].'">Manage</button>';
         echo $output;
   }*/
   if($_POST['action']=='ADD TEST MARKS')
   {
      $output="
      <form method='POST' name='add_test_form' id='add_test_form'>
      <table class='table table-bordered'>
      <tr>
      <th>Reg No</th>
      <th>Student Name</th>
      <th>Test Marks</th>
      </tr>";
      $total_student=count(getAllStudentInClass($con,$_POST['class_id']));
      $student=getAllStudentInClass($con,$_POST['class_id']);
      $count=0;
      for($i=0;$i<$total_student;$i++)
      {
         $test_mark=getTestMarks($con,$_POST['subject_id'],$student[$i]['reg_no']);
         if($test_mark ==0)
         {
         $output.="
            <tr>
            <td>".$student[$i]['reg_no']."</td>
            <td>".$student[$i]['student_firstname']." ".$student[$i]['student_lastname']."</td>
            <td><input type='number' class='form-control' name='".$student[$i]['reg_no']."' id='".$student[$i]['reg_no']."'></td>
            </tr>";
          $count++;
         }

      }
      if($count==0) {
       $output.="
       <tr>
       <td colspan='3' class='text-danger text-center'>All Student In this Class Has Test Marks</td>
       </tr>
       ";
      }
      $output.="</table>
      <button type='submit' class='btn btn-sm btn-info' name='insert_test' id='insert_test'>INSERT</button>
      <button type='button' class='btn btn-sm btn-danger back_display'>Back</button>
      </form>
      ";
      echo $output;
   }
   if($_POST['action'] =='INSERT TEST')
   {
     $output='';
     for($i=0 ; $i<count($_POST['formElement']); $i++)
     {
        if($_POST['formElement'][$i]['value'])
        {
        $sql="INSERT 
              INTO test_marks(test_id,marks,subject_id,reg_no)
              VALUES(NULL,:marks,:subject_id,:reg_no);";
        $stmt=$con->prepare($sql);
        $output=$stmt->execute(array(
            ":marks"      => $_POST['formElement'][$i]['value'],
            ":subject_id" => $_POST['subject_id'],
            ":reg_no"     => $_POST['formElement'][$i]['name']
        ));
        }
     }
     if($output)
     {
        echo "data Inserted successfully";
     }else {
        echo "By default Mark is Zero";
     }
   }
   if($_POST['action']=='ADD EXAM MARKS')
   {
      $output="
      <form method='POST' name='add_exam_form' id='add_exam_form'>
      <table class='table table-bordered'>
      <tr>
      <th>Reg No</th>
      <th>Student Name</th>
      <th>Exam Marks</th>
      </tr>";
      $total_student=count(getAllStudentInClass($con,$_POST['class_id']));
      $student=getAllStudentInClass($con,$_POST['class_id']);
      $count=0;
      for($i=0;$i<$total_student;$i++)
      {
         $exam_mark=getExamMarks($con,$_POST['subject_id'],$student[$i]['reg_no']);
         if($exam_mark ==0)
         {
         $output.="
            <tr>
            <td>".$student[$i]['reg_no']."</td>
            <td>".$student[$i]['student_firstname']." ".$student[$i]['student_lastname']."</td>
            <td><input type='number' class='form-control' name='".$student[$i]['reg_no']."' id='".$student[$i]['reg_no']."'></td>
            </tr>";
          $count++;
         }

      }
       if($count==0) {
       $output.="
       <tr>
       <td colspan='3' class='text-danger text-center'>All Student In this Class Has Exam Marks</td>
       </tr>
       ";
      }
      $output.="</table>
      <button type='submit' class='btn btn-sm btn-success' name='insert_exam' id='insert_exam'>INSERT EXAM</button>
      <button type='button' class='btn btn-sm btn-danger back_display'>Back</button>
      </form>
      ";
      echo $output;
   }
   if($_POST['action'] =='INSERT EXAM')
   {
     $output='';
     for($i=0 ; $i<count($_POST['formElement']); $i++)
     {
        if($_POST['formElement'][$i]['value'])
        {
        $sql="INSERT
              INTO exam_marks(exam_id,marks,subject_id,reg_no)
              VALUES(NULL,:marks,:subject_id,:reg_no);";
        $stmt=$con->prepare($sql);
        $output=$stmt->execute(array(
            ":marks"      => $_POST['formElement'][$i]['value'],
            ":subject_id" => $_POST['subject_id'],
            ":reg_no"     => $_POST['formElement'][$i]['name']
        ));
        }
      }
      if($output) {
         echo "Data inserted successfully";
      }else {
         echo "By Default Marks is Zero";
      }
    }
    if($_POST['action'] == 'UPDATE DATA')
    {
       $condition1=getTestMarks($con,$_POST['subject_id'],$_POST['reg_no']);
       $output='<table class="table table-borderess">';
       if($condition1) {
        $output .='
          <tr>
          <td colspan="2" class="text-center text-muted">Test Marks</td>
          </tr>
          <tr>
          <td>'.getOneDataInTable($con,'tbl_student','reg_no','student_firstname',$_POST['reg_no']).' '.getOneDataInTable($con,'tbl_student','reg_no','student_lastname',$_POST['reg_no']).'</td>
          <td><input type="number" class="form-control test_mark" value="'.getTestMarks($con,$_POST['subject_id'],$_POST['reg_no']).'"></td>
          </tr>';
       } else {
          $output.="
          <tr>
          <td colspan='2' class='text-center text-danger'>Insert Test Marks of this student In order to Edit It.</td>
          </tr>
          ";
       }
       $condition2=getTestMarks($con,$_POST['subject_id'],$_POST['reg_no']);
       if($condition2) {
         $output .='<tr>
          <td colspan="2" class="text-center text-muted">Exam Marks</td>
          </tr>
          <tr>
          <td>'.getOneDataInTable($con,'tbl_student','reg_no','student_firstname',$_POST['reg_no']).' '.getOneDataInTable($con,'tbl_student','reg_no','student_lastname',$_POST['reg_no']).'</td>
          <td><input type="number" class="form-control exam_mark" value="'.getExamMarks($con,$_POST['subject_id'],$_POST['reg_no']).'"></td>
          </tr>';
       }else {
          $output.="
          <tr>
          <td colspan='2' class='text-center text-danger'>Insert Exam Marks of this student In order to Edit It.</td>
          </tr>
          ";
       }
       $output.='
         </table>';
         if($condition1 || $conition2) {
          $output.='
            <input type="submit" class="btn btn-sm btn-warning update_stud" value="Update Marks" id="'.$_POST['reg_no'].'">
         ';
         }
        $output.='
         <button type="button" class="btn btn-sm btn-danger back_display">Back</button>
       ';
       echo $output;
    }
    if($_POST['action'] =='UPDATE STUDENT DATA')
    {
       $sql="UPDATE test_marks
             SET marks=".($_POST['test_mark'] ?? 0)." 
             WHERE reg_no=".$_POST['reg_no']." AND subject_id=".$_POST['subject_id'].";";
       $sql.="UPDATE exam_marks
             SET marks=".($_POST['exam_mark'] ?? 0)." 
             WHERE reg_no=".$_POST['reg_no']." AND subject_id=".$_POST['subject_id'].";";
       $stmt=$con->prepare($sql);
       $output=$stmt->execute();
       if($output)
       {
          echo "Data updated successfully";
       }
    }
}
?>