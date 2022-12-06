<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="description" content="student examination result" />
<meta name="viewport"content="width=device-width,initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible"content="IE=edge" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>

<!--import google icons-->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet"href="include/css/materialize.css">
<title>Mysuccess</title>
</head>
<body>
<?php
$con=new PDO("mysql:host=localhost;dbname=mysuccess","root","");
  $sql="SELECT student_firstname,student_lastname,born_at,ts.reg_no,subject_name,subj.marks,avg(tm.marks) as test_mark,avg(em.marks) as exam_mark,class_name
      FROM tbl_student ts,classes cl,subjects subj,subject_classes sc,test_marks tm,exam_marks em
      WHERE ts.class_id=cl.class_id AND cl.class_id=sc.class_id AND sc.subject_id=subj.subject_id AND ts.reg_no=tm.reg_no AND ts.reg_no=em.reg_no AND tm.subject_id=subj.subject_id AND subj.subject_id=em.subject_id
      GROUP BY subj.subject_id";
 $stmt=$con->prepare($sql);
 $stmt->execute();
 $result=$stmt->fetchAll();
 echo "<h4>".$result[0]['student_firstname']."</h4>";
?>
<!--compiled script-->
<script type="text/javascript" src="include/jquery-3.5.0.min.js"></script>
<script type="text/javascript" src="include/js/materialize.js"></script>
</body>
</html>