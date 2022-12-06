$(document).ready(function(){
   	 $('li .pages').first().click();
    disappear_msg();
    
    $(document).on("click",".view_class",function(){
    	var view_class_id=$(this).attr('id');
    	$.ajax({
    		url:"action.php",
    		method:"POST",
    		dataType:"json",
    		data:{update_class_id:view_class_id},
    		success:function(data) {
    			$('#view_class_id').html(view_class_id);
    			$('#view_class_name').html(data.class_name);
    			$('#view_class_block').html(data.block_name);
    			$("#class_viewer").modal('show');
    		}
    	});
    });
    $('#search_box').focusout(function() {
    	if(this.value=="")
    	{
    		$('.pages').click();
    	}
    });
   });
//document.addEventListener("DOMContentLoaded", ready);
function validate()
  {
   var email=document.getElementById("email");
   var password=document.getElementById("password");
   var error_message=document.getElementsByClassName("error_message")[0];
   var msg=document.getElementById("msg");
     if(email.value != "" && password.value != "")
     {
        if(password.value.length <= 4 || password.value.length >= 15)
        {
           msg.innerHTML="passwod must be between 4 and 15";
           error_message.style.display="block";
           password.style.border="1px solid red";
        }
     }
      else
      {
       error_message.style.display="block";
       email.style.border="1px solid red";
       password.style.border="1px solid red";
       return false;
       }
   }

  document.getElementById("cross").onclick=function()
  {
       document.getElementsByClassName("error_message")[0].style.display="none";
  };
  function form_clear()
  {
  	 document.getElementById("addingForm").reset();
  }
  function hide_show()
  {
    if(document.getElementById("display_table").style.display != "none")
    {
      document.getElementById("display_table").style.display = "none"
      document.getElementById("edit_id").style.display="block";
      document.getElementById("add_more").innerHTML="Back Home";
    }else {
      document.getElementById("display_table").style.display="block";
      document.getElementById("edit_id").style.display="none";
      document.getElementById("add_more").innerHTML=document.getElementById("add_more").getAttribute("value");
    }
  }
  function add_more()
  {
  	  form_clear();
  	  document.getElementById("submit_data").value=document.getElementById("add_more").innerHTML=document.getElementById("add_more").getAttribute("value");
  	  document.getElementById("form_title").innerHTML=document.getElementById("add_more").getAttribute("value");
  	  hide_show();
  }
  function delete_student(e)
  {
    if (confirm("ARE YOU SURE YOU WANT TO DELETE THIS STUDENT"))
    { 
         var delete_stud_id=e.getAttribute('id');
         var ajaxRequest=new XMLHttpRequest();
         var serverForm=new FormData();
         serverForm.append("delete_stud_id",delete_stud_id);
         ajaxRequest.open("POST","action.php");
         ajaxRequest.send(serverForm);
         ajaxRequest.onreadystatechange =function()
         {
            if(ajaxRequest.readyState==4 && ajaxRequest.status == 200)
            {
                 window.location.href="student.php";
            }
         }
    } else {
      return false;
    }
  }
   function delete_teacher(e)
  {
    if (confirm("ARE YOU SURE YOU WANT TO DELETE THIS TEACHER"))
    { 
         var delete_teacher_id=e.getAttribute('id');
         var ajaxRequest=new XMLHttpRequest();
         var serverForm=new FormData();
         serverForm.append("delete_teacher_id",delete_teacher_id);
         ajaxRequest.open("POST","action.php");
         ajaxRequest.send(serverForm);
         ajaxRequest.onreadystatechange =function()
         {
            if(ajaxRequest.readyState==4 && ajaxRequest.status == 200)
            {
                 window.location.href="teacher.php";
            }
         }
    } else {
      return false;
    }
  }
   function delete_subject(e)
  {
    if (confirm("ARE YOU SURE YOU WANT TO DELETE THIS SUBJECT"))
    { 
         var delete_subject_id=e.getAttribute('id');
         var ajaxRequest=new XMLHttpRequest();
         var serverForm=new FormData();
         serverForm.append("delete_subject_id",delete_subject_id);
         ajaxRequest.open("POST","action.php");
         ajaxRequest.send(serverForm);
         ajaxRequest.onreadystatechange =function()
         {
            if(ajaxRequest.readyState==4 && ajaxRequest.status == 200)
            {
                 window.location.href="subjects.php";
            }
         }
    } else {
      return false;
    }
  }
   function delete_class(e)
  {
    if (confirm("ARE YOU SURE YOU WANT TO DELETE THIS CLASS"))
    { 
         var delete_class_id=e.getAttribute('id');
         var ajaxRequest=new XMLHttpRequest();
         var serverForm=new FormData();
         serverForm.append("delete_class_id",delete_class_id);
         ajaxRequest.open("POST","action.php");
         ajaxRequest.send(serverForm);
         ajaxRequest.onreadystatechange =function()
         {
            if(ajaxRequest.readyState==4 && ajaxRequest.status == 200)
            {
                 window.location.href="classes.php";
            }
         }
    } else {
      return false;
    }
  }
      function update_student(e)
      {
      	   hide_show();
         var student_id=e.getAttribute('id');
         var ajaxRequest=new XMLHttpRequest();
         var serverForm=new FormData();
         serverForm.append("update_stud_id",student_id);
         ajaxRequest.open("POST","action.php");
         ajaxRequest.send(serverForm);
         ajaxRequest.onreadystatechange =function()
         {
            if(ajaxRequest.readyState==4 && ajaxRequest.status == 200)
            {
              var data=JSON.parse(ajaxRequest.responseText);
              document.getElementById("student_firstname").value=data.student_firstname;
              document.getElementById("student_lastname").value=data.student_lastname;
              document.getElementById("student_id").value=data.student_id;
              document.getElementById("dateofbirth").value=data.dateofbirth;
              document.getElementById("address").value=data.address;
              document.getElementById("guardianidnumber").value=data.guardianidnumber;
              document.getElementById("fatherorguardian_name").value=data.fatherorguardian_name;
              document.getElementById("admission_date").value=data.admission_date;
              //document.getElementById("image").value=data.image;
              document.getElementById("class_id").value=data.class_id;
              document.getElementById("born_at").value=data.born_at;
              document.getElementById("phone_number").value=data.phone_number;
              document.getElementById("submit_data").value="Update Student";
              document.getElementById("form_title").innerHTML="Update student Information";
              document.getElementById("hidden_stud_id").value=student_id;
            }
         }
      }
      function update_teacher(event)
      {
           hide_show();
         var teacher_id=event.getAttribute('id');
         var ajaxRequest=new XMLHttpRequest();
         var serverForm=new FormData();
         serverForm.append("update_teacher_id",teacher_id);
         ajaxRequest.open("POST","action.php");
         ajaxRequest.send(serverForm);
         ajaxRequest.onreadystatechange =function()
         {
            if(ajaxRequest.readyState==4 && ajaxRequest.status == 200)
            {
              var data=JSON.parse(ajaxRequest.responseText);
              document.getElementById("teacher_firstname").value=data.teacher_firstname;
              document.getElementById("teacher_lastname").value=data.teacher_lastname;
              document.getElementById("email_id").value=data.email_id;
              document.getElementById("dateofbirth").value=data.dateofbirth;
              document.getElementById("address").value=data.address;
              document.getElementById("qualification").value=data.qualification;
              document.getElementById("experience").value=data.experience;
              document.getElementById("joiningdate").value=data.joining_date;
              //document.getElementById("teacher_image").value=data.teacher_image;
              document.getElementById("phone_number").value=data.phone_number;
              document.getElementById("submit_data").value="Update Teacher";
              document.getElementById("form_title").innerHTML="Update Teacher Information";
              document.getElementById("hidden_teacher_id").value=teacher_id;
            }
         }
      }
      function update_subject(event)
      {
         hide_show();
         var subject_id=event.getAttribute('id');
         var ajaxRequest=new XMLHttpRequest();
         var serverForm=new FormData();
         serverForm.append("update_subject_id",subject_id);
         ajaxRequest.open("POST","action.php");
         ajaxRequest.send(serverForm);
         ajaxRequest.onreadystatechange =function()
         {
            if(ajaxRequest.readyState==4 && ajaxRequest.status == 200)
            {
              var data=JSON.parse(ajaxRequest.responseText);
              console.log(ajaxRequest.responseText);
              document.getElementById("marks").value=data.marks;
              document.getElementById("subject_name").value=data.subject_name;
              document.getElementById("submit_data").value="Update Subject";
              document.getElementById("form_title").innerHTML="Update Subject Information";
              document.getElementById("hidden_subject_id").value=subject_id;
            }
         }
      }
      function update_class(event)
      {
         hide_show();
         var class_id=event.getAttribute('id');
         var ajaxRequest=new XMLHttpRequest();
         var serverForm=new FormData();
         serverForm.append("update_class_id",class_id);
         ajaxRequest.open("POST","action.php");
         ajaxRequest.send(serverForm);
         ajaxRequest.onreadystatechange =function()
         {
            if(ajaxRequest.readyState==4 && ajaxRequest.status == 200)
            {
              var data=JSON.parse(ajaxRequest.responseText);
              document.getElementById("class_name").value=data.class_name;
              document.getElementById("block_name").value=data.block_name;
              document.getElementById("submit_data").value="Update Class";
              document.getElementById("form_title").innerHTML="Update Class Information";
              document.getElementById("hidden_class_id").value=class_id;
            }
         }
      }
      /*function view_class(event)
      {
      	document.getElementsByClassName("modal")[0].style.display="block";
      }*/
  /*function open_nav()
  {
    if(document.getElementById("navbarSupportedContent").style.display != "none")
    {
      document.getElementById("navbarSupportedContent").style.display = "none";
    }else {
      document.getElementById("navbarSupportedContent").style.display="block";
    }
  }*/
  function disappear_msg()
  {
  	setTimeout(function(){
  		document.getElementById("disappear_msg").style.display="none";
  	},5000);
  }
  function fetchStudentTable()
  {
     var action="action";
     var request=new XMLHttpRequest();
     var formData=new FormData();
     formData.append("get_all_students",action);
     request.open("POST","action.php");
     request.send(formData);
     request.onreadystatechange=function() {
         if(request.readyState==4 && request.status==200)
         {
             document.getElementById("student_table").innerHTML=request.responseText;
         }
     }
  }
  function live_search_submit_student()
  {
	  	var search_box=document.getElementById("search_box").value;
	  	var request=new XMLHttpRequest();
	  	var form_data=new FormData();
	  	form_data.append("get_all_students","action");
	  	form_data.append("search_value",search_box)
	  	request.open("POST","action.php");
	  	request.send(form_data);
	  	request.onreadystatechange=function() {
	  	  	if(request.readyState==4 && request.status==200)
	  		 {
	  			   document.getElementById("student_table").innerHTML=request.responseText;
	  		 }
	  	}
  }
   // TEACHER TABLE
  function fetchTeacherTable()
  {
      var action="action";
      var request=new XMLHttpRequest();
      var formData=new FormData();
      formData.append("get_all_teachers",action);
      request.open("POST","action.php");
      request.send(formData);
      request.onreadystatechange=function() {
          if(request.readyState==4 && request.status==200)
          {
              document.getElementById("teacher_table").innerHTML=request.responseText;
          }
      }
  }
  function live_search_submit_teacher()
  {
      var search_box=document.getElementById("search_box").value;
      var request=new XMLHttpRequest();
      var form_data=new FormData();
      form_data.append("get_all_teachers","action");
      form_data.append("search_value",search_box)
      request.open("POST","action.php");
      request.send(form_data);
      request.onreadystatechange=function() {
          if(request.readyState==4 && request.status==200)
         {
             document.getElementById("teacher_table").innerHTML=request.responseText;
         }
      }
  }
  // SUBJECT TABLE
  function fetchSubjectTable()
  {
      var action="action";
      var request=new XMLHttpRequest();
      var formData=new FormData();
      formData.append("get_all_subjects",action);
      request.open("POST","action.php");
      request.send(formData);
      request.onreadystatechange=function() {
          if(request.readyState==4 && request.status==200)
          {
              document.getElementById("subject_table").innerHTML=request.responseText;
          }
      }
  }
  function live_search_submit_subject()
  {
      var search_box=document.getElementById("search_box").value;
      var request=new XMLHttpRequest();
      var form_data=new FormData();
      form_data.append("get_all_subjects","action");
      form_data.append("search_value",search_box)
      request.open("POST","action.php");
      request.send(form_data);
      request.onreadystatechange=function() {
          if(request.readyState==4 && request.status==200)
         {
             document.getElementById("subject_table").innerHTML=request.responseText;
         }
      }
  }
   // CLASS TABLE
   function fetchClassTable()
  {
      var action="action";
      var request=new XMLHttpRequest();
      var formData=new FormData();
      formData.append("get_all_classes",action);
      request.open("POST","action.php");
      request.send(formData);
      request.onreadystatechange=function() {
          if(request.readyState==4 && request.status==200)
          {
              document.getElementById("class_table").innerHTML=request.responseText;
          }
      }
  }
  function live_search_submit_class()
  {
      var search_box=document.getElementById("search_box").value;
      var request=new XMLHttpRequest();
      var form_data=new FormData();
      form_data.append("get_all_classes","action");
      form_data.append("search_value",search_box)
      request.open("POST","action.php");
      request.send(form_data);
      request.onreadystatechange=function() {
          if(request.readyState==4 && request.status==200)
         {
             document.getElementById("class_table").innerHTML=request.responseText;
         }
      }
  }
 /*function ready() {
	  //fetchStudentTable();
    fetchTeacherTable();
    fetchSubjectTable();
    fetchClassTable();
    disappear_msg();
}*/
	 function live_student_search(event) {
	 	    if(event.value!="") {
	  	   document.getElementById("search").click();
	  	   }
	  	   else {
	  	   	fetchStudentTable();
	  	   }
	 }
   function live_teacher_search(event) {
        if(event.value!="") {
         document.getElementById("search").click();
         }
         else {
          fetchTeacherTable();
         }
   }
   function live_subject_search(event) {
        if(event.value!="") {
         document.getElementById("search").click();
         }
         else {
          fetchSubjectTable();
         }
   }
   function live_class_search(event) {
        if(event.value!="") {
         document.getElementById("search").click();
         }
         else {
          fetchClassTable();
         }
   }
 function pagination_data_student(event)
 {
    var limit_start=event.getAttribute("data-id1");
    var number_of_data=event.getAttribute("data-id2");
    var action="action";
    var request=new XMLHttpRequest();
    var formData=new FormData();
    formData.append("get_all_students",action);
    formData.append("pagination","pagination");
    formData.append("limit_start",limit_start);
    formData.append("number_of_data",number_of_data);
    request.open("POST","action.php");
    request.send(formData);
    request.onreadystatechange=function() {
          if(request.readyState==4 && request.status==200)
          {
             document.getElementById("student_table").innerHTML=request.responseText;
           }
     }
   }
 function pagination_data_teacher(event)
 {
    var limit_start=event.getAttribute("data-id1");
    var number_of_data=event.getAttribute("data-id2");
    var action="action";
    var request=new XMLHttpRequest();
    var formData=new FormData();
    formData.append("get_all_teachers",action);
    formData.append("pagination","pagination");
    formData.append("limit_start",limit_start);
    formData.append("number_of_data",number_of_data);
    request.open("POST","action.php");
    request.send(formData);
    request.onreadystatechange=function() {
          if(request.readyState==4 && request.status==200)
          {
             document.getElementById("teacher_table").innerHTML=request.responseText;
           }
     }
   }
 function pagination_data_subject(event)
 {
    var limit_start=event.getAttribute("data-id1");
    var number_of_data=event.getAttribute("data-id2");
    var action="action";
    var request=new XMLHttpRequest();
    var formData=new FormData();
    formData.append("get_all_subjects",action);
    formData.append("pagination","pagination");
    formData.append("limit_start",limit_start);
    formData.append("number_of_data",number_of_data);
    request.open("POST","action.php");
    request.send(formData);
    request.onreadystatechange=function() {
          if(request.readyState==4 && request.status==200)
          {
             document.getElementById("subject_table").innerHTML=request.responseText;
           }
     }
   }
 function pagination_data_class(event)
 {
    var limit_start=event.getAttribute("data-id1");
    var number_of_data=event.getAttribute("data-id2");
    var action="action";
    var request=new XMLHttpRequest();
    var formData=new FormData();
    formData.append("get_all_classes",action);
    formData.append("pagination","pagination");
    formData.append("limit_start",limit_start);
    formData.append("number_of_data",number_of_data);
    request.open("POST","action.php");
    request.send(formData);
    request.onreadystatechange=function() {
          if(request.readyState==4 && request.status==200)
          {
             document.getElementById("class_table").innerHTML=request.responseText;
           }
     }
   }
   
   