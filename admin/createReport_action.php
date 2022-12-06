<?php
include("configuration/connection.php");
if(isset($_POST['action'])) {
  if($_POST['action'] == 'insert')
  {
        $id       =$_POST['id'];
        $maths    =$_POST['maths'];
        $comp     =$_POST['comp'];
        $eco      =$_POST['eco'];
        $gs       =$_POST['gs'];
        $ent      =$_POST['ent'];
        $eng      =$_POST['eng'];
        $rel      =$_POST['rel'];
        $sport    =$_POST['sport'];
        $cl       =$_POST['cl'];
        $level    =$_POST['level'];
        $name     =$_POST['name'];
        $born_at  =$_POST['born_at'];

        $maths_t  =$_POST['maths_t'];
        $comp_t   =$_POST['comp_t'];
        $eco_t    =$_POST['eco_t'];
        $gs_t     =$_POST['gs_t'];
        $ent_t    =$_POST['ent_t'];
        $eng_t    =$_POST['eng_t'];
        $rel_t    =$_POST['rel_t'];
        $sport_t  =$_POST['sport_t'];
        $cl_t     =$_POST['cl_t'];
        $total_marks_exam=$maths+$comp+$eco+$ent+$gs+$rel+$eng+$sport+$cl;
        $total_marks_test=$maths_t+$comp_t+$eco_t+$ent_t+$gs_t+$rel_t+$eng_t+$sport_t+$cl_t;
        $total=$total_marks_exam+$total_marks_test;
        $average=($total/800)*100;
        $maths_total  =$maths+$maths_t;
        $comp_total   =$comp+$comp_t;
        $eco_total    =$eco+$eco_t;
        $ent_total    =$ent+$ent_t;
        $eng_total    =$eng+$eng_t;
        $rel_total    =$rel+$rel_t;
        $gs_total     =$gs+$gs_t;
        $cl_total     =$cl+$cl_t;
        $sport_total  =$sport+$sport_t;
        $sql="INSERT INTO mysuccess_exam(id,mathematics,computerscience,economics,gscs,enterpreneurship,english,religious,sports,computerlib,level,name,born_at,average)VALUES(:id,:maths,:comp,:eco,:gs,:ent,:eng,:rel,:sport,:cl,:level,:name,:born_at,:average);";
        $sql.="INSERT INTO mysuccess_test(id,mathematics_t,computerscience_t,economics_t,gscs_t,enterpreneurship_t,english_t,religious_t,sports_t,computerlib_t)VALUES(:id,:maths_t,:comp_t,:eco_t,:gs_t,:ent_t,:eng_t,:rel_t,:sport_t,:cl_t);";
        $sql.="INSERT INTO total_marks(id,mathematics_total,computerscience_total,economics_total,enterpreneurship_total,gscs_total,english_total,religious_total,computerlib_total,sports_total)VALUES(:id,:maths_total,:comp_total,:eco_total,:ent_total,:gs_total,:eng_total,:rel_total,:cl_total,:sport_total);";
        $stmt=$con->prepare($sql);
        $stmt->bindparam(":id",$id);
        $stmt->bindparam(":maths",$maths);
        $stmt->bindparam(":maths_t",$maths_t);
        $stmt->bindparam(":comp",$comp);
        $stmt->bindparam(":comp_t",$comp_t);
        $stmt->bindparam(":eco",$eco);
        $stmt->bindparam(":eco_t",$eco_t);
        $stmt->bindparam(":ent",$ent);
        $stmt->bindparam(":ent_t",$ent_t);
        $stmt->bindparam(":gs",$gs);
        $stmt->bindparam(":gs_t",$gs_t);
        $stmt->bindparam(":eng",$eng);
        $stmt->bindparam(":eng_t",$eng_t);
        $stmt->bindparam(":rel",$rel);
        $stmt->bindparam(":rel_t",$rel_t);
        $stmt->bindparam(":sport",$sport);
        $stmt->bindparam(":sport_t",$sport_t);
        $stmt->bindparam(":cl",$cl);
        $stmt->bindparam(":cl_t",$cl_t);
        $stmt->bindparam(":level",$level);
        $stmt->bindparam(":born_at",$born_at);
        $stmt->bindparam(":name",$name);
        $stmt->bindparam(":average",$average);
        $stmt->bindparam(":maths_total",$maths_total);
        $stmt->bindparam(":comp_total",$comp_total);
        $stmt->bindparam(":eco_total",$eco_total);
        $stmt->bindparam(":ent_total",$ent_total);
        $stmt->bindparam(":gs_total",$gs_total);
        $stmt->bindparam(":rel_total",$rel_total);
        $stmt->bindparam(":eng_total",$eng_total);
        $stmt->bindparam(":cl_total",$cl_total);
        $stmt->bindparam(":sport_total",$sport_total);
        if($stmt->execute())
        {
          echo "data inserted successfully";
        }
  }
  $output='';
  if($_POST['action'] =="fetch_student")
  {
     $sql="SELECT a.id,mathematics,computerscience,economics,enterpreneurship,gscs,english,religious,computerlib,sports,level,name,born_at,a.no,average,mathematics_t,computerscience_t,economics_t,enterpreneurship_t,gscs_t,english_t,religious_t,computerlib_t,sports_t FROM mysuccess_exam a INNER JOIN mysuccess_test b ON a.id=b.id ";
     if(isset($_POST["search"]["value"]))
     {
       $sql .= 'WHERE   a.id  LIKE "%'.$_POST["search"]["value"].'%" OR
                      a.name LIKE "%'.$_POST["search"]["value"].'%" OR
                      a.level LIKE "%'.$_POST["search"]["value"].'%" ';
     }
     if(isset($_POST["order"]))
     {
       $sql .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
     }
     else
     {
       $sql .= 'ORDER BY a.id DESC ';
     }
     if($_POST['length'] != -1)
     {
       $sql .= 'LIMIT '.$_POST["start"].', '.$_POST["length"];
     }
     $stmt=$con->prepare($sql);
     $stmt->execute();
     $recordsFiltered=$stmt->rowCount();
     $data=array();
     $result=$stmt->fetchAll();
     foreach($result as $row)
     {
       $sub_array  = array();
       $sub_array[] = $row['id'];
       $sub_array[] = $row['name'];
       $sub_array[] = $row['level'];
       $sub_array[] = '<button type="button"id="'.$row['id'].'"class="btn btn-info btn-xs view">View</button>';
       $sub_array[] = '<button type="button"id="'.$row['id'].'"class="btn btn-success btn-xs update">Update</button>';
       $sub_array[] = '<button type="button"id="'.$row['id'].'"class="btn btn-danger btn-xs delete">delete</button>';
       $data[] = $sub_array;
     }
     $output=array(
       "draw"            => intval($_POST['draw']),
       "recordsTotal"    => $recordsFiltered,
       "recordsFiltered" => last_id($con),
       "data"            => $data,
     );
    echo json_encode($output);
  }
  if($_POST['action'] =='fetch_view')
  {
    $sql="SELECT a.id,mathematics,computerscience,economics,enterpreneurship,gscs,english,religious,computerlib,sports,level,name,born_at,a.no,average,mathematics_t,computerscience_t,economics_t,enterpreneurship_t,gscs_t,english_t,religious_t,computerlib_t,sports_t FROM mysuccess_exam a,mysuccess_test b WHERE a.id=b.id AND a.id=:id;";
    $stmt=$con->prepare($sql);
    $stmt->bindparam(":id",$_POST['id']);
    $stmt->execute();
    $result=$stmt->fetchAll();
    foreach($result as $row)
    {
      $output=array(
      "total_test"          => $row['mathematics_t']+$row['computerscience_t']+$row['economics_t']+$row['enterpreneurship_t']+$row['gscs_t']+$row['religious_t']+$row['english_t']+$row['computerlib_t']+$row['sports_t'],
      "total_exam"          => $row['mathematics']+$row['computerscience']+$row['economics']+$row['enterpreneurship']+$row['gscs']+$row['religious']+$row['english']+$row['computerlib']+$row['sports'],
      "id"                  => $row['id'],
      "maths"               => $row['mathematics'],
      "comp"                => $row['computerscience'],
      "eco"                 => $row['economics'],
      "gs"                  => $row['gscs'],
      "ent"                 => $row['enterpreneurship'],
      "eng"                 => $row['english'],
      "rel"                 => $row['religious'],
      "sport"               => $row['sports'],
      "cl"                  => $row['computerlib'],
      "level"               => $row['level'],
      "name"                => $row['name'],
      "born_at"             => $row['born_at'],
      "last_id"             => last_id($con),
      "maths_t"             => $row['mathematics_t'],
      "comp_t"              => $row['computerscience_t'],
      "eco_t"               => $row['economics_t'],
      "gs_t"                => $row['gscs_t'],
      "ent_t"               => $row['enterpreneurship_t'],
      "eng_t"               => $row['english_t'],
      "rel_t"               => $row['religious_t'],
      "sport_t"             => $row['sports_t'],
      "cl_t"                => $row['computerlib_t'],
      "maths_total"         => $row['mathematics']+$row['mathematics_t'],
      "comp_total"          => $row['computerscience_t']+$row['computerscience'],
      "eco_total"           => $row['economics']+$row['economics_t'],
      "gs_total"            => $row['gscs_t']+$row['gscs'],
      "ent_total"           => $row['enterpreneurship_t']+$row['enterpreneurship'],
      "eng_total"           => $row['english_t']+$row['english'],
      "rel_total"           => $row['religious_t']+$row['religious'],
      "sport_total"         => $row['sports_t']+$row['sports'],
      "cl_total"            => $row['computerlib_t']+$row['computerlib'],
      "average"             => $row['average']
      );
    echo json_encode($output);
    }
  }
}
?>