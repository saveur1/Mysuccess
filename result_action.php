<?php
session_start();
include("admin/configuration/connection.php");
if(isset($_POST['done']))
{
	$output='';
 $sql="SELECT student_firstname,student_lastname,born_at,ts.reg_no,subject_name,subj.marks,avg(tm.marks) as test_mark,avg(em.marks) as exam_mark,class_name
      FROM tbl_student ts,classes cl,subjects subj,subject_classes sc,test_marks tm,exam_marks em
      WHERE ts.class_id=cl.class_id AND cl.class_id=sc.class_id AND sc.subject_id=subj.subject_id AND ts.reg_no=tm.reg_no AND ts.reg_no=em.reg_no AND tm.subject_id=subj.subject_id AND subj.subject_id=em.subject_id AND ts.reg_no=:reg_no AND cl.class_name=:class
      GROUP BY subj.subject_id";
 $stmt=$con->prepare($sql);
 $stmt->bindparam(":reg_no",$_SESSION['reg_number']);
 $stmt->bindparam(":class",$_SESSION['class_name']);
 $stmt->execute();
 $result=$stmt->fetchAll();
 	if($_POST['done'] =='1')
 {
    $output= "
    <table class='txt mt-3'style='width:100%;'>
    <tr>
    <td>
    <b class='alig'>REPUBLIC OF RWANDA</b>
    <p class='alig'>G.S.Kimisange</p>
    <!--<p>P.O.Box:3511 Kigali</p>-->
    <p class='alig'>Tel:(+250)788543901</p>
    </td>
    <td class='school_logo'align='center'>
    <img src='admin/configuration/logo.png'class='img-thumbnail'id='img'>
    </td>
    <td class='school_academic'>
    <p class='text-right alig'><b>MINISTRY OF EDUCATION</b></p>
    <p class='text-right alig'>".date('Y')."</p>
    <p class='text-right alig'>2<sup>nd </sup>Terms</p>
    </td>
    </tr>
    </table>
    <div id='report'class='text-center txt mt-1'>
    <p>REPORT CARD</p>
    </div>
    <div class='mb-1'id='student_info'>
    <table class='txt'>
    <tr>
    <td colspan='3'>Student Name:<span id='name'>".$result[0]['student_firstname']." ".$result[0]['student_lastname']."</span></td>
    </tr>
    <tr>
    <td colspan='2'>Born at <span id='born_at'>".$result[0]['born_at']."</span></td>
    <td class='text-center'>Class:<span id='level'>".$result[0]['class_name']."</span></td>
    </tr>
    <tr>
    <td>Id No.<span id='id'>".$result[0]['reg_no']."</span></td>
    <td class='text-center'>No.Student:<span id='last_id'></span></td>
    <td class='text-center'>Conduct:35<span id='conduct'></span></td>
    </tr>
    </table>
    </div>
    <div class='text-center'>
    <table class='table-bordered body'>
    <thead>
    <tr>
    <th class='text-left'>SUBJECTS</th>
    <th>TEST</th>
    <th>EX</th>
    <th>TOT</th>
    <th>TEST</th>
    <th>EX</th>
    <th>TOT</th>
    <th>Rank</th>
    <th>Comments</th>
    </tr>
    </thead>
    <tbody>";
  foreach($result as $row)
  {
      $output .= "
      <tr>
      <td class='text-left'>".$row['subject_name']."</td>
      <td>".$row['marks']."</td>
      <td>".$row['marks']."</td>
      <td>".(2*$row['marks'])."</td>
      <td>".$row['test_mark']."</td>
      <td>".$row['exam_mark']."</td>
      <td>".($row['test_mark']+$row['exam_mark'])."</td>
      <td>".get_rank_subject($con,$row['reg_no'],$row['class_name'],$row['subject_name'])."</td>
      <td></td>
      </tr>";
  }
      $output.= "
      </tbody>
      <tfoot>
      <tr>
      <th class='text-left'>Total</th>
      <th>".getTotal($con,$_SESSION['reg_number'],$_SESSION['class_name'])."</th>
      <th>".getTotal($con,$_SESSION['reg_number'],$_SESSION['class_name'])."</th>
      <th>".(getTotal($con,$_SESSION['reg_number'],$_SESSION['class_name'])+getTotal($con,$_SESSION['reg_number'],$_SESSION['class_name']))."</th>
      <th id='total_test'>".getTotalTest($con,$_SESSION['reg_number'],$_SESSION['class_name'])."</th>
      <th id='total_exam'>".getTotalExam($con,$_SESSION['reg_number'],$_SESSION['class_name'])."</th>
      <th colspan='2'id='all_total'>".(getTotalTest($con,$_SESSION['reg_number'],$_SESSION['class_name'])+getTotalExam($con,$_SESSION['reg_number'],$_SESSION['class_name']))."</th>
      <th></th>
      </tr>
      <tr>
      <th class='text-left'>Average</th>
      <th colspan='3'id='average'>".round(getAverage($con,$_SESSION['reg_number'],$_SESSION['class_name']),1)."&#37;</th>
      <th colspan='3'class='right'>Rank  <span class='ml-2'>".get_rank($con,$_SESSION['reg_number'],$_SESSION['class_name'])."</span></th>
      <th colspan='2'>Absence <span class='ml-2'>0</span></th>
      </tr>
      </table>
      </div>
      <table class='table-bordered mt-1'style='width:100%;'>
      <tr>
      <th rowspan='2'class='text-center'>Observations<div style='height:90px'></div></th>
      <th class='text-center'>Teacher Signature<div style='height:30px'></div></th>
      </tr>
      <tr>
      <th class='text-center'>Parent Signature<div style='height:30px'></div></th>
      </tr>
      </table>
      <form action='result_action.php'method='POST'>
      <div class='mt-2 ml-3 mb-2'>
      <input type='submit'name='done'id='done'class='btn btn-danger'value='create PDF'>
      </div>
      </form>";
      echo $output;
  }
    if($_POST['done'] == 'create PDF')
    {
      require_once('tcpdf/tcpdf.php');
      $obj_pdf=new TCPDF('p',PDF_UNIT,PDF_PAGE_FORMAT,true,"UTF-8",false);
      $obj_pdf->setCreator(PDF_CREATOR);
      $obj_pdf->setTitle($row['level']." Student Report");
      $obj_pdf->setHeaderData('','',PDF_HEADER_TITLE,PDF_HEADER_STRING);
      $obj_pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));
      $obj_pdf->setFooterFont(array(PDF_FONT_NAME_DATA,'',PDF_FONT_SIZE_DATA));
      $obj_pdf->setDefaultMonospacedFont("helvetica");
      $obj_pdf->setFooterMargin(PDF_MARGIN_FOOTER);
      $obj_pdf->setMargins(PDF_MARGIN_LEFT,'5',PDF_MARGIN_RIGHT);
      $obj_pdf->setPrintHeader(false);
      $obj_pdf->setPrintFooter(false);
      $obj_pdf->setAutoPageBreak(true,10);
      $obj_pdf->setFont('helvetica','',12);
      $obj_pdf->Addpage();
      $content .='
      <div></div>
      <div></div>
     <table cellpadding="5"cellspacing="0"style="width:100%">
      <tr>
        <td>
           <p><b>REPUBLIC OF RWANDA</b></p>
           <p>G.S.Kimisange</p>
           <!--<p>P.O.Box:3511 Kigali</p>-->
           <p>Tel:(+250)788543901</p>
        </td>
        <td class="school_logo"style="padding-top:30px">
           <div></div>
           <img src="admin/configuration/logo.png"class="img-thumbnail"width="150px"height="90px">
        </td>
        <td class="school_academic">
           <p style="text-align:right"><b>MINISTRY OF EDUCATION</b></p>
           <p style="text-align:right">'.date("Y").'</p>
           <p style="text-align:right">2<sup>nd </sup>Terms</p>
        </td>
     </tr>
    </table>';
    $content .='
    <hr style="color:black;margin-bottom:0px" />
    <div style="text-align:center;font-size:20px;margin-bottom:0px">REPORT CARD</div>
    <hr style="color:black" />
    ';
    $content .='
    <div class="mb-1"id="student_info">
      <table style="width:100%"cellpadding="5"cellspacing="0">
        <tr>
          <td colspan="3"style="text-align:left">Student Name:<span>'.$result[0]['student_firstname'].' '.$result[0]['student_lastname'].'</span></td>
        </tr>
        <tr>
          <td colspan="2"style="text-align:left">Born at <span>'.$result[0]['born_at'].'</span></td>
          <td style="text-align:right">Class:<span id="level">'.$result[0]['class_name'].'</span></td>
        </tr>
        <tr>
          <td style="text-align:left">Id No.<span id="id">'.$_SESSION['reg_number'].'</span></td>
          <td style="text-align:center">No.Student:<span id="last_id">'.total_student($con).'</span></td>
          <td style="text-align:right">Conduct:35<span id="conduct"></span></td>
         </tr>
       </table>
       </div>';
       $content .='
        <table border="1"cellpadding="5"cellspacing="0"style="width:100%">
        <tr>
        <th style="width:22%">SUBJECTS</th>
        <th style="width:9%">TEST</th>
        <th style="width:9%">EX</th>
        <th style="width:9%">TOT</th>
        <th style="width:9%">TEST</th>
        <th style="width:9%">EX</th>
        <th style="width:9%">TOT</th>
        <th style="width:9%">Rank</th>
        <th style="width:15%">Comments</th>
        </tr>';
      foreach($result as $row)
      {
      $content .= '
      <tr>
      <td class="text-left">'.$row["subject_name"].'</td>
      <td>'.$row["marks"].'</td>
      <td>'.$row["marks"].'</td>
      <td>'.(2*$row["marks"]).'</td>
      <td>'.$row["test_mark"].'</td>
      <td>'.$row["exam_mark"].'</td>
      <td>'.($row["test_mark"]+$row["exam_mark"]).'</td>
      <td>'.get_rank_subject($con,$row["reg_no"],$row["class_name"],$row["subject_name"]).'</td>
      <td></td>
      </tr>';
      }
     $content.='
     <tr>
      <th class="text-left">Total</th>
      <th>'.getTotal($con,$_SESSION['reg_number'],$_SESSION['class_name']).'</th>
      <th>'.getTotal($con,$_SESSION['reg_number'],$_SESSION['class_name']).'</th>
      <th>'.(getTotal($con,$_SESSION['reg_number'],$_SESSION['class_name'])+getTotal($con,$_SESSION['reg_number'],$_SESSION['class_name'])).'</th>
      <th id="total_test">'.getTotalTest($con,$_SESSION['reg_number'],$_SESSION['class_name']).'</th>
      <th id="total_exam">'.getTotalExam($con,$_SESSION['reg_number'],$_SESSION['class_name']).'</th>
      <th colspan="2" id="all_total">'.(getTotalTest($con,$_SESSION['reg_number'],$_SESSION['class_name'])+getTotalExam($con,$_SESSION['reg_number'],$_SESSION['class_name'])).'</th>
      <th></th>
      </tr>
      <tr>
        <th class="text-left">Average</th>
        <th colspan="3">'.round(getAverage($con,$_SESSION['reg_number'],$_SESSION['class_name']),1).'</th>
         <th colspan="3"class="right">Rank'.'  '.'<span>'.get_rank($con,$_SESSION['reg_number'],$_SESSION['class_name']).'</span></th>
        <th colspan="2">Absence'.'  '.' <span>0</span></th>
      </tr>
    </table>
    ';
    $content.='
    <div>
    </div>
    <table border="1"cellpadding="5"cellspacing="0"style="width:100%;margin-top:5px">
      <tr>
      <th rowspan="2"class="text-center">Observations<div style="height:90px"></div></th>
      <th class="text-center">Teacher Signature<div style="height:30px"></div></th>
      </tr>
      <tr>
      <th class="text-center">Parent Signature<div style="height:30px"></div></th>
      </tr>
    </table>';
    $obj_pdf->writeHTML($content);
    //uniqid();
    $obj_pdf->Output($result[0]['student_lastname']."_report".".pdf","I");
  }
 }
?>