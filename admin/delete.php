<?php
include("configuration/connection.php");
$sql="SELECT a.id,mathematics,computerscience,economics,enterpreneurship,gscs,english,religious,computerlib,sports,level,name,born_at,a.no,average,mathematics_t,computerscience_t,economics_t,enterpreneurship_t,gscs_t,english_t,religious_t,computerlib_t,sports_t FROM mysuccess_exam a,mysuccess_test b WHERE a.id=b.id;";
$result=$con->query($sql);
?>
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
<link rel="stylesheet"href="../include/css/materialize.css">
 <link rel="stylesheet"href="configuration/admin.css">
  <style>
    .scrol_view {
      overflow-x:auto;
    }
    .scrol_view::-webkit-scrollbar {
      display:none;
    }
    .scrol_view {
      -ms-overflow-style:none;
      -moz-overflow-style:none;
    }

  </style>
<title>Mysuccess</title>
</head>
<body>
  <?php include("configuration/header.php"); ?>
  <div class="title center">
    <span>All Student Data</span>
  </div>
  <?php
  if($result->num_rows>0) {
    while($row=$result->fetch_assoc()) {
  ?>
<div class="card">
  <div class="card-container">
    <div class="btn-floating center"style="position:absolute;right:10px;top:5px">
      <a href="delete_recod.php?no=<?php echo $row['no']; ?>"><i class="material-icons delete_record">delete_forever</i></a>
    </div>
    <p>
      <span>Name:</span><span class="teal-text"style="font-size:18px"><?php echo $row['name']; ?></span>
    </p>
    <p>
      <span>ID:</span><?php echo $row['id']; ?>
    </p>
    <p>
      <span>Level:</span><?php echo $row['level']; ?>
    </p>
    <p>
      <span>Born At:</span><?php echo $row['born_at']; ?>
    </p>
  <div class="scrol_view">
    <table class="striped">
      <tr><th>Subject</th><th>Mathematics</th><th>Computer</th><th>Economics</th><th>Enterpreneurship</th><th>GSCS</th><th>English</th><th>Religious</th><th>Computerlib</th><th>Sports/clubs</th></tr>
      <tr>
        <th>Test</th>
        <td><?php echo $row['mathematics_t']; ?></td>
        <td><?php echo $row['computerscience_t']; ?></td>
        <td><?php echo $row['economics_t']; ?></td>
        <td><?php echo $row['enterpreneurship_t']; ?></td>
        <td><?php echo $row['gscs_t']; ?></td>
        <td><?php echo $row['english_t']; ?></td>
        <td><?php echo $row['religious_t']; ?></td>
        <td><?php echo $row['computerlib_t']; ?></td>
        <td><?php echo $row['sports_t']; ?></td>
      </tr>
      <tr>
        <th>Exam</th>
        <td><?php echo $row['mathematics']; ?></td>
        <td><?php echo $row['computerscience']; ?></td>
        <td><?php echo $row['economics']; ?></td>
        <td><?php echo $row['enterpreneurship']; ?></td>
        <td><?php echo $row['gscs']; ?></td>
        <td><?php echo $row['english']; ?></td>
        <td><?php echo $row['religious']; ?></td>
        <td><?php echo $row['computerlib']; ?></td>
        <td><?php echo $row['sports']; ?></td>
      </tr>
    </table>
    </div>
  </div>
</div>

  <?php } } ?>
  <?php include("configuration/footer.php"); ?>
  <?php include("configuration/script.js"); ?>
</body>
</html>