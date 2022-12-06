<?php include("configuration/connection.php"); ?>
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
<link rel="stylesheet"href="../css/bootstrap.min.css">
<link rel="stylesheet"href="../css/dataTables.bootstrap4.min.css">
 <link rel="stylesheet"href="../include/css/mycss.css">
  <style>
.table_scroll {
  overflow-x:auto;
}
.table_scroll::-webkit-scrollbar {
  display:none;
}
.table_scroll {
  -ms-overflow-style:none;
  -moz-overflow-style:none;
}

  </style>
<title>Mysuccess</title>
</head>
<body>
  <?php include("configuration/header.php"); ?>
  <div align="center">
    <div id="status"align="center">
      <span class="monospace">Total Students:<?php echo last_id($con); ?></span><br />
      <span class="monospace">S4 Students:<?php echo s4($con); ?></span><br />
      <span class="monospace">S5 Students:<?php echo s5($con); ?></span><br />
      <span class="monospace">S6 Students:<?php echo s6($con); ?></span><br />
    </div>
  </div>
  <div class="card m-3">
    <div class="card-header">
      <div class="row">
        <div class="col-sm-9">
         Do wont to add student!
        </div>
        <div class="col-sm-3"align="right">
          <button type="button" class="btn btn-primary btn-xs"id="add_student">add STUDENT</button>
        </div>
      </div>
    </div>
  </div>
  <div class="table-responsive">
    <table id="all_student"class="table table-bordered table-striped ml-1 mr-1">
      <thead>
        <tr>
          <th>Id</th>
          <th>Names</th>
          <th>Level</th>
          <th>View</th>
          <th>Update</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
  <div class="modal"id="add_edit">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <span class="modal-title monospace"style="font-size:20px;color:white"id="modal_title"></span>
        </div>
        <div class="modal-body">
          <div class="mb-1"id="edit_student_info">
            <table class="txt"style="width:100%">
            <tr>
              <td colspan="3">Student Name:<span id="e_name"><img src="../img/edit.png"style="display:inline-block;margin-left:40px;height:30px;"class="img_edit"></span></td>
            </tr>
            <tr>
              <td colspan="2">Born at <span id="e_born_at"><img src="../img/edit.png"style="display:inline-block;margin-left:40px;height:30px;"class="img_edit"></span></td>
              <td class="text-center">Class:<span id="e_level"><img src="../img/edit.png"style="display:inline-block;margin-left:40px;height:30px;"class="img_edit"></span></td>
            </tr>
            <tr>
              <td>Id No.<span id="e_id"><img src="../img/edit.png"style="display:inline-block;margin-left:40px;height:30px;"class="img_edit"></span></td>
              <td class="text-center">No.Student:<span id="e_last_id"></span></td>
              <td class="text-center">Conduct:35<span id="e_conduct"></span></td>
             </tr>
           </table>
         </div>
         <div class="text-center">
           <table class="table-bordered body"id="edit_main_table">
            <thead>
              <tr>
                <th class="text-left">SUBJECTS</th>
                <th>TEST</th>
                <th>EX</th>
                <th>TOT</th>
                <th>TEST</th>
                <th>EX</th>
                <th>TOT</th>
                <th>Rank</th>
                <th>Comment</th>
              </tr>
             </thead>
             <tbody>
             <tr>
               <td class="text-left">Mathematics</td>
                <td>70</td>
                <td>70</td>
                <td>140</td>
                <td><span id="e_maths_t"><img src="../img/edit.png"style="display:inline-block;margin-left:5px;height:30px;"class="img_edit"></span></td>
                <td><span id="e_maths"><img src="../img/edit.png"style="display:inline-block;margin-left:5px;height:30px;"class="img_edit"></span></td>
                <td id="e_maths_total"></td>
                <td></td>
                <td></td>
              </tr>
             <tr>
               <td class="text-left">Computer science</td>
                <td>70</td>
                <td>70</td>
                <td>140</td>
                <td><span id="e_comp_t"><img src="../img/edit.png"style="display:inline-block;margin-left:5px;height:30px;"class="img_edit"></span></td>
                <td><span id="e_comp"><img src="../img/edit.png"style="display:inline-block;margin-left:5px;height:30px;"class="img_edit"></span></td>
                <td id="e_comp_total"></td>
                <td></td>
                <td></td>
              </tr>
             <tr>
               <td class="text-left">Economics</td>
                <td>70</td>
                <td>70</td>
                <td>140</td>
                <td><span id="e_eco_t"><img src="../img/edit.png"style="display:inline-block;margin-left:5px;height:30px;"class="img_edit"></span></td>
                <td><span id="e_eco"><img src="../img/edit.png"style="display:inline-block;margin-left:5px;height:30px;"class="img_edit"></span></td>
                <td id="e_eco_total"></td>
                <td></td>
                <td></td>
              </tr>
                <tr>
               <td class="text-left">Enterpreneur<br>ship</td>
                <td>60</td>
                <td>60</td>
                <td>120</td>
                <td><span id="e_ent_t"><img src="../img/edit.png"style="display:inline-block;margin-left:5px;height:30px;"class="img_edit"></span></td>
                <td><span id="e_ent"><img src="../img/edit.png"style="display:inline-block;margin-left:5px;height:30px;"class="img_edit"></span></td>
                <td id="e_ent_total"></td>
                <td></td>
                <td></td>
              </tr>
             <tr>
               <td class="text-left">G.S.C.S</td>
                <td>30</td>
                <td>30</td>
                <td>60</td>
                <td><span id="e_gs_t"><img src="../img/edit.png"style="display:inline-block;margin-left:5px;height:30px;"class="img_edit"></span></td>
                <td><span id="e_gs"><img src="../img/edit.png"style="display:inline-block;margin-left:5px;height:30px;"class="img_edit"></span></td>
                <td id="e_gs_total"></td>
                <td></td>
                <td></td>
              </tr>

             <tr>
               <td class="text-left">English</td>
                <td>40</td>
                <td>40</td>
                <td>80</td>
                <td><span id="e_eng_t"><img src="../img/edit.png"style="display:inline-block;margin-left:5px;height:30px;"class="img_edit"></span></td>
                <td><span id="e_eng"><img src="../img/edit.png"style="display:inline-block;margin-left:5px;height:30px;"class="img_edit"></span></td>
                <td id="e_eng_total"></td>
                <td></td>
                <td></td>
              </tr>
             <tr>
               <td class="text-left">Religious activities</td>
                <td>20</td>
                <td>20</td>
                <td>40</td>
               <td><span id="e_rel_t"><img src="../img/edit.png"style="display:inline-block;margin-left:5px;height:30px;"class="img_edit"></span></td>
               <td><span id="e_rel"><img src="../img/edit.png"style="display:inline-block;margin-left:5px;height:30px;"class="img_edit"></span></td>
                <td id="e_rel_total"></td>
               <td></td>
                <td></td>
              </tr>
               <tr>
               <td class="text-left">computer and library</td>
                <td>20</td>
                <td>20</td>
                <td>40</td>
                 <td><span id="e_cl_t"><img src="../img/edit.png"style="display:inline-block;margin-left:5px;height:30px;"class="img_edit"></span></td>
                 <td><span id="e_cl"><img src="../img/edit.png"style="display:inline-block;margin-left:5px;height:30px;"class="img_edit"></span></td>
                <td id="e_cl_total"></td>
                <td></td>
                <td></td>
              </tr>
             <tr>
               <td class="text-left">Sports/clubs</td>
                <td>20</td>
                <td>20</td>
                <td>40</td>
                <td><span id="e_sport_t"><img src="../img/edit.png"style="display:inline-block;margin-left:5px;height:30px;"class="img_edit"></span></td>
                <td><span id="e_sport"><img src="../img/edit.png"style="display:inline-block;margin-left:5px;height:30px;"class="img_edit"></span></td>
                <td id="e_sport_total"></td>
                <td></td>
                <td></td>
              </tr>
             </tbody>
           </table>
           <div align="center"class="mt-2">
             <input type="submit"name="insert_data"id="insert_data"value="create REPORT" class="btn btn-primary"style="width:100%" />
           </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button"data-dismiss="modal"class="btn btn-default">close</button>
        </div>
      </div>
    </div>
  </div>
<!--  <div class="add_student">
     -->
  <div class="modal"id="view_data">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <span class="modal-title monospace"style="font-size:20px;color:white">Student Report</span>
        </div>
        <div class="modal-body">
           <div class="mb-1"id="student_info">
              <table class="txt">
              <tr>
                <td colspan="3">Student Name:<span id="name"style="font-size:24px"></span></td>
              </tr>
              <tr>
                <td colspan="2">Born at <span id="born_at"></span></td>
                <td class="text-center">Class:<span id="level"></span></td>
              </tr>
              <tr>
                <td>Id No.<span id="id"></span></td>
                <td class="text-center">No.Student:<span id="last_id"></span></td>
                <td class="text-center">Conduct:35<span id="conduct"></span></td>
              </tr>
              </table>
           </div>
           <div class="text-center">
              <table class="table-bordered body"id="main_table">
              <thead>
                <tr>
                  <th class="text-left">SUBJECTS</th>
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
                <tbody>
               <tr>
                 <td class="text-left">Mathematics</td>
                  <td>70</td>
                  <td>70</td>
                  <td>140</td>
                  <td><span id="maths_t"></span></td>
                  <td><span id="maths"></span></td>
                  <td id="maths_total"></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                 <td class="text-left">Computer science</td>
                  <td>70</td>
                  <td>70</td>
                  <td>140</td>
                  <td><span id="comp_t"></span></td>
                  <td><span id="comp"></span></td>
                  <td id="comp_total"></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                 <td class="text-left">Economics</td>
                  <td>70</td>
                  <td>70</td>
                  <td>140</td>
                  <td><span id="eco_t"></span></td>
                  <td><span id="eco"></span></td>
                  <td id="eco_total"></td>
                  <td></td>
                  <td></td>
                 </tr>
                 <tr>
                 <td class="text-left">Enterpreneur<br>ship</td>
                  <td>60</td>
                  <td>60</td>
                  <td>120</td>
                  <td><span id="ent_t"></span></td>
                  <td><span id="ent"></span></td>
                  <td id="ent_total"></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                 <td class="text-left">G.S.C.S</td>
                  <td>30</td>
                  <td>30</td>
                  <td>60</td>
                  <td><span id="gs_t"></span></td>
                  <td><span id="gs"></span></td>
                  <td id="gs_total"></td>
                  <td></td>
                  <td></td>
                </tr>

               <tr>
                 <td class="text-left">English</td>
                  <td>40</td>
                  <td>40</td>
                  <td>80</td>
                  <td><span id="eng_t"></span></td>
                  <td><span id="eng"></span></td>
                  <td id="eng_total"></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                 <td class="text-left">Religious activities</td>
                  <td>20</td>
                  <td>20</td>
                  <td>40</td>
                  <td><span id="rel_t"></span></td>
                  <td><span id="rel"></span></td>
                  <td id="rel_total"></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                 <td class="text-left">computer and library</td>
                  <td>20</td>
                  <td>20</td>
                  <td>40</td>
                  <td><span id="cl_t"></span></td>
                  <td><span id="cl"></span></td>
                  <td id="cl_total"></td>
                  <td></td>
                  <td></td>
                </tr>
               <tr>
                 <td class="text-left">Sports/clubs</td>
                  <td>20</td>
                  <td>20</td>
                  <td>40</td>
                  <td><span id="sport_t"></span></td>
                  <td><span id="sport"></span></td>
                  <td id="sport_total"></td>
                  <td></td>
                  <td></td>
                </tr>
               </tbody>
             </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button"data-dismiss="modal"class="btn btn-default">close</button>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="../include/jquery-3.5.0.min.js"></script>
  <script type="text/javascript" src="../js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="../js/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript">
    $(function(){
      var dataTable=$("#all_student").DataTable({
     "processing":true,
     "serverSide" :true,
     "order" : [],
     "ajax" : {
      url:"createReport_action.php",
      method:"POST",
      data:{action:'fetch_student'}
     },
     columnDefs:[
       {
         "target" :[0,1,2,3,4,5],
         "orderable" :false,
       },
      ],
    });
  $(".img_edit").click(function() {
     $(this).parent().attr("contenteditable",true).css("display","inline-block").css("min-width","50px").css("border","2px solid blue").css("height","50px").css("padding","10px");
     $(this).hide();
     $(this).parent().focus();
  });
  function get_data(content)
  {
  content.focusout(function() {
     $(this).attr("contenteditable",false).css("display","inline").css("min-width","50px").css("border","0");
     $(".img_edit").show();
  }).keypress(function(event) {
     if(event.which==13)
     {
       event.preventDefault();
       $(this).focusout();
     }
  });
  }
  get_data($("#edit_student_info #e_born_at"));
  get_data($("#edit_student_info #e_level"));
  get_data($("#edit_student_info #e_name"));
  get_data($("#edit_student_info #e_id"));
  get_data($("#edit_main_table #e_maths_t"));
  get_data($("#edit_main_table #e_maths"));
  get_data($("#edit_main_table #e_comp_t"));
  get_data($("#edit_main_table #e_comp"));
  get_data($("#edit_main_table #e_eco_t"));
  get_data($("#edit_main_table #e_eco"));
  get_data($("#edit_main_table #e_ent_t"));
  get_data($("#edit_main_table #e_ent"));
  get_data($("#edit_main_table #e_gs_t"));
  get_data($("#edit_main_table #e_gs"));
  get_data($("#edit_main_table #e_eng_t"));
  get_data($("#edit_main_table #e_eng"));
  get_data($("#edit_main_table #e_rel_t"));
  get_data($("#edit_main_table #e_rel"));
  get_data($("#edit_main_table #e_cl_t"));
  get_data($("#edit_main_table #e_cl"));
  get_data($("#edit_main_table #e_sport_t"));
  get_data($("#edit_main_table #e_sport"));
  $('#collapsible').click(function() {
    $(".collapse").slideToggle();
  });
  $("#insert_data").on("click",function() {
    var name=$("#edit_student_info #e_name").text();
    var born_at=$("#edit_student_info #e_born_at").text();
    var id=$('#edit_student_info #e_id').text();
    var maths=$('#edit_main_table #e_maths').text();
    var comp=$('#edit_main_table #e_comp').text();
    var eco=$('#edit_main_table #e_eco').text();
    var ent=$('#edit_main_table #e_ent').text();
    var gs=$('#edit_main_table #e_gs').text();
    var eng=$('#edit_main_table #e_eng').text();
    var rel=$('#edit_main_table #e_rel').text();
    var sport=$('#edit_main_table #e_sport').text();
    var cl=$('#edit_main_table #e_cl').text();
    var level=$('#edit_student_info #e_level').text();

    var maths_t=$('#edit_main_table #e_maths_t').text();
    var comp_t=$('#edit_main_table #e_comp_t').text();
    var eco_t=$('#edit_main_table #e_eco_t').text();
    var ent_t=$('#edit_main_table #e_ent_t').text();
    var gs_t=$('#edit_main_table #e_gs_t').text();
    var eng_t=$('#edit_main_table #e_eng_t').text();
    var rel_t=$('#edit_main_table #e_rel_t').text();
    var sport_t=$('#edit_main_table #e_sport_t').text();
    var cl_t=$('#edit_main_table #e_cl_t').text();
    $.ajax({
    url:"createReport_action.php",
    method:"POST",
    data:{
        "action":"insert",
        "id":id,
        "maths":maths,
        "comp":comp,
        "eco":eco,
        "gs":gs,
        "ent":ent,
        "eng":eng,
        "rel":rel,
        "sport":sport,
        "cl":cl,
        "level":level,
        "name":name,
        "born_at":born_at,

        "maths_t":maths_t,
        "comp_t":comp_t,
        "eco_t":eco_t,
        "gs_t":gs_t,
        "ent_t":ent_t,
        "eng_t":eng_t,
        "rel_t":rel_t,
        "sport_t":sport_t,
        "cl_t":cl_t
      },
    success:function(data)
    {
      alert(data);
      $("#add_edit").modal('hide');
      dataTable.ajax.reload();
    }
    });
  });
    function clear_form() {
    }
    $(document).on("click",".view",function() {
      var id=$(this).attr("id");
      $.ajax({
        url:"createReport_action.php",
        method:"POST",
        data:{id:id,action:"fetch_view"},
        dataType:"json",
        success:function(data)
        {
          $('#student_info #id').text(data.id);
          $('#main_table #maths').text(data.maths);
          $('#main_table #comp').text(data.comp);
          $('#main_table #eco').text(data.eco);
          $('#main_table #ent').text(data.ent);
          $('#main_table #gs').text(data.gs);
          $('#main_table #eng').text(data.eng);
          $('#main_table #rel').text(data.rel);
          $('#main_table #sport').text(data.sport);
          $('#main_table #cl').text(data.cl);
          $('#student_info #level').text(data.level);
          $('#student_info #name').text(data.name);
          $('#student_info #born_at').text(data.born_at);
          $('#main_table #maths_t').text(data.maths_t);
          $('#main_table #comp_t').text(data.comp_t);
          $('#main_table #eco_t').text(data.eco_t);
          $('#main_table #ent_t').text(data.ent_t);
          $('#main_table #gs_t').text(data.gs_t);
          $('#main_table #eng_t').text(data.eng_t);
          $('#main_table #rel_t').text(data.rel_t);
          $('#main_table #sport_t').text(data.sport_t);
          $('#main_table #cl_t').text(data.cl_t);
          $("#main_table #last_id").text(data.last_id)
          $('#main_table #maths_total').text(data.maths_total);
          $('#main_table #comp_total').text(data.comp_total);
          $('#main_table #eco_total').text(data.eco_total);
          $('#main_table #ent_total').text(data.ent_total);
          $('#gs_total').text(data.gs_total);
          $('#eng_total').text(data.eng_total);
          $('#rel_total').text(data.rel_total);
          $('#sport_total').text(data.sport_total);
          $('#cl_total').text(data.cl_total);
          $("#total_test").text(data.total_test);
          $("#total_exam").text(data.total_exam);
          $("#average").text(data.average);
          $("#all_total").text(data.total_test+data.total_exam);
          $("#view_data").modal('show');
        }
      });
    });
    $("#add_student").click(function() {
      $("#modal_title").text("Add Student Data")
      $("#add_edit").modal('show');
      clear_form();
    });
  });
  </script>
  <?php include("configuration/footer.php"); ?>
</body>
</html>