<?php include("include/header.php"); ?>
<!--Image slider-->
 <div id="show_photo">
   <div id="text_image">
     <h4 class=""></h4>
   </div>
   <img src="" class="img-fluid"style="min-height:300px;width:100%">
   <div class="container">
     <div align="center"id="photo_link">
       <span id="first"></span>
       <span id="second"></span>
       <span id="third"></span>
       <span id="forth"></span>
       <span id="fith"></span>
    </div>
   </div>
</div>
<ul id="photo">
<!--   <span id="img_text">Better Education Means Thinking A hundred Years </span> -->
  <li id="1"class="color1"><img src="img/background3.jpg"></li>
  <li id="2"class="color2"><img src="img/image9.jpg"></li>
  <li id="4"class="text-primary"><img src="img/image1.jpg"></li>
  <li id="3"class="color4"><img src="img/image3.jpg"></li>
  <li id="5"class="color5"><img src="img/image7.jpg"></li>
</ul>

<!-- search -->
<div class="container-fluid mt-3">
    <div class="row">
    <div class="col-sm-12 col-md-8">
    <div class="card mb-3">
    <div class="card-body">
    <h4 style="font-family: &quot;Comic Sans MS&quot;, &quot;Comic Sans&quot;, cursive;color:teal">WHAT TO DO NOW</h4>
     <p id="reb_approval"></p>
      </div>
      </div>
      </div>
     <div class="col-sm-12 col-md-4">
    <div class="card mb-3">
    <div class="card-body">
    <h4 style="font-family: &quot;Comic Sans MS&quot;, &quot;Comic Sans&quot;, cursive;color:teal">FIND YOUR REPORT</h4>
    <span>Level:</span>
    <div style="font-family: &quot;Comic Sans MS&quot;, &quot;Comic Sans&quot;,cursive;width:260px;">
    <div class="custom-control custom-radio custom-control-inline">
      <input type="radio"name="class"id="s4mce"class="custom-control-input level"value="senior 4 MCE">
      <label class="custom-control-label"for="s4mce">S<sub>4</sub>MCE</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
      <input type="radio"name="class"id="s5mce"class="custom-control-input level"value="senior 5 MCE">
      <label class="custom-control-label"for="s5mce">S<sub>5</sub>MCE</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
      <input type="radio"name="class"id="s6mce"class="custom-control-input level"value="senior 6 MCE">
      <label class="custom-control-label"for="s6mce">S<sub>6</sub>MCE</label>
    </div>
    </div><br><br>
    <div class="">
      <span>Student Id:</span>
      <div class="input-group">
        <input type="number"placeholder="  Enter student Id"id="input"name="input"class="form-control">
      </div>
      <label class="text-muted">eg:0102001,0102002</label><br>
      <div class="input-group">
        <input type="submit"value="SEARCH"name="submit"id="submit"class="btn"style="background:teal;color:white"><br>
      </div>
    </div>
      </div>
      </div>
    </div>
  </div>
</div>
<div id="frame">
</div>
<div class="message">
  <p>

  </p>
  <button type="button"class="btn btn-sm"id="close"style="background:teal;color:white;width:50px">
    OK
  </button>
</div>
<div id="load">
    <h5>
      Loading...
  </h5>
</div>
<?php include("include/footer.php"); ?>
<!--compiled script-->
<script type="text/javascript">
$(document).ready(function() {
  $("#close").click(function() {
   $(".message").fadeOut();
   $("#frame").fadeOut();
  });
  $("#frame").click(function() {
   $(this).fadeOut();
   $(".message").fadeOut();
  });
 var level='';
 $(".level").click(function() {
  level=$(this).val();
 });
  $("#input").keypress(function(event) {
    if(event.which==13)
    {
      $("#submit").click();
    }
  });
 $("#submit").on("click",function() {
   var input=$("#input").val();
   var student_level=level;
   $.ajax({
   url:"check_result.php",
   method:"POST",
   data:{input:input,student_level:student_level,action:'fetch'},
   dataType:"json",
   beforeSend:function() {
     $("#load").fadeIn();
   },
   success:function(data) {
    $("#load").fadeOut();
    if(data.success) {
      location.href="<?php echo $base_url; ?>result.php";
      $(".level").prop("checked",false);
      $("#input").val('');
    }
    if(data.error)
    {
     $("#search_error").fadeIn();
     if(data.error_student_level != '')
     {
      $(".message p").text(data.error_student_level);
       $("#frame").fadeIn();
      $(".message").delay(500).fadeIn();
     }
     else
     {
       $("#search_error").text('');
     }
     if(data.error_input != '')
     {
       $(".message p").text(data.error_input);
       $("#frame").fadeIn()
       $(".message").delay(500).fadeIn();
     }
     else
     {
       $("#search_error").text('');
     }
    }
   }
   });
 });
  $("#photo_link span:first-child").css("background","#ccc");
  $("#photo_link span").click(function() {
    $("#photo_link span").css("background","transparent");
    $(this).css("background","#ccc");
  });
  var first_li=$("#photo li").first();
  var first_span=$("#photo_link span").first();
  var first_image=first_li.children("img").attr("src");
  $("#show_photo > img").attr('src',first_image);

  var first_id=$("#photo li").first().attr("id");
  var path="text/"+first_id+".txt";
  $.get(path,function(data) {
    $("#text_image h4").html(data);
  });
  var first_color=first_li.attr("class");
  $("#text_image h4").attr("class",first_color);
  function load_next()
  {
    $("#photo_link span").css("background","transparent");
    var next_li='';
    var next_span='';
    var next_id='';
    var next_color="";
    if(first_li.is(":last-child"))
    {
      next_li=$("#photo li").first();
      next_span=$("#photo_link span").first();
      next_id=next_li.attr("id");
      next_color=next_li.attr("class");
    }
    else
    {
      next_li=first_li.next();
      next_span=first_span.next();
      next_id=next_li.attr("id");
      next_color=next_li.attr("class");
    }
    var next_image=next_li.children("img").attr("src");
    path="text/"+next_id+".txt";
    $.get(path,function(data) {
      $("#text_image h4").html(data);
    });
    $("#text_image h4").attr("class",next_color);
    $("#show_photo > img").attr('src',next_image);
    next_span.css("background","#ccc");
    first_color=next_color;
    first_id=next_id;
    first_span=next_span;
    first_li=next_li;
  }
  setInterval(function() {
    load_next();
  },5000);
  var first_li;
  var second_li;
  var third_li;
  var forth_li;
  $("#first").click(function() {
     first_li=$("#photo li").first();
     var first_image=first_li.children("img").attr("src");
     $("#show_photo > img").attr("src",first_image);

      var first_id=$("#photo li").first().attr("id");
      var path="text/"+first_id+".txt";
      $.get(path,function(data) {
        $("#text_image h4").html(data);
      });
      var first_color=first_li.attr("class");
      $("#text_image h4").attr("class",first_color);
  });
  $("#second").click(function() {
    second_li=$("#photo li:nth-child(2)");
    var second_image=second_li.children("img").attr("src");
    $("#show_photo > img").attr("src",second_image);
    var second_id=$("#photo li:nth-child(2)").attr("id");
    var path="text/"+second_id+".txt";
    $.get(path,function(data) {
      $("#text_image h4").html(data);
    });
    var second_color=$("#photo li:nth-child(2)").attr("class");
    $("#text_image h4").attr("class",second_color);
  });
  $("#third").click(function() {
     third_li=$("#photo li:nth-child(3)");
     var third_image=third_li.children("img").attr("src");
     $("#show_photo > img").attr("src",third_image);
    var third_id=$("#photo li:nth-child(3)").attr("id");
    var path="text/"+third_id+".txt";
    $.get(path,function(data) {
      $("#text_image h4").html(data);
    });
    var third_color=$("#photo li:nth-child(3)").attr("class");
    $("#text_image h4").attr("class",third_color);
  });
  $("#forth").click(function() {
     forth_li=$("#photo li:nth-child(4)");
     var forth_image=forth_li.children("img").attr("src");
     $("#show_photo > img").attr("src",forth_image);
     var forth_id=$("#photo li:nth-child(4)").attr("id");
     var path="text/"+forth_id+".txt";
     $.get(path,function(data) {
      $("#text_image h4").html(data);
     });
     var forth_color=$("#photo li:nth-child(4)").attr("class");
     $("#text_image h4").attr("class",forth_color);
  });
  $("#fith").click(function() {
     var fith_li=$("#photo li").last();
     var fith_image=fith_li.children("img").attr("src");
     $("#show_photo > img").attr("src",fith_image);
     var fith_id=$("#photo li:nth-child(5)").attr("id");
     var path="text/"+fith_id+".txt";
     $.get(path,function(data) {
      $("#text_image h4").html(data);
     });
     var fith_color=$("#photo li:nth-child(5)").attr("class");
     $("#text_image h4").attr("class",fith_color);
  });
   var path="text/reb_approval.txt";
   $.get(path,function(data) {
     $("#reb_approval").html(data);
   });
});
</script>
</body>
</html>