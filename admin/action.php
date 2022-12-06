if(isset($_POST['action']))
{
 if($_POST['submit']=="Add Teacher")
 {
 $error_firstname='';
 $error_lastname='';
 $error_dateofbirth='';
 $error_qualification='';
 $error_experience='';
 $error_phone_number='';
 $error_email_id='';
 $error_address="";
 $error_joiningdate="";
 $error=0;
 if(trim($_POST['teacher_firstname']) !='')
 {
    if(strlen(trim($_POST['teacher_firstname'])) < 2 || strlen(trim($_POST['teacher_firstname'])) > 20)
    {
       $error_firstname="First name must be between 2 and 20 character";
       $error++;
    } else {
       $teacher_firstname =filter_input($_POST['teacher_firstname']);
    }
 }else {
    $error_firstname="First Name is Required";
    $error++;
 }
 if(trim($_POST['teacher_lastname']) !='')
 {
    if(strlen(trim($_POST['teacher_lastname'])) < 2 || strlen(trim($_POST['teacher_firstname'])) > 20)
    {
       $error_lastname="Last name must be between 2 and 20 character";
       $error++;
    } else {
       $teacher_lastname =filter_input($_POST['teacher_lastname']);
    }
 }else {
    $error_lastname="Last Name is Required";
    $error++;
 }
 $dateofbirth             =filter_input($_POST['dateofbirth']);
	$qualification           =filter_input($_POST['qualification']);
	$experience              =filter_input($_POST['experience']);
	$phone_number            =filter_input($_POST['phone_number']);
	$email_id                =filter_input($_POST['email_id']);
	$address                 =filter_input($_POST['address']);
 $joiningdate             =filter_input($_POST['joiningdate']);
 $teacher_image="";
    if(!empty($_FILES['teacher_image']['name'])) {
      $image_folder="images";
      $file_array=explode(".",$_FILES['teacher_image']['name']);
      $file_extension=strtolower($file_array[1]);
      $allowed_extension=array("jpg","png","jpeg","gif");
      if(in_array($file_extension,$allowed_extension))
      {
      	$teacher_image = $image_folder."/".basename($_FILES['teacher_image']['name']);
      	move_uploaded_file($_FILES['teacher_image']['tmp_name'],$teacher_image);
      }
      else
      {
        echo "<script>
		           if(alert('IMAGE OF JPG, PNG, JPEG, GIF ARE ONLY EXTENSION ALLOWED'))
		           {
			          ".header("Refresh:0.1;url=teacher.php")."
		           }
		          </script>";
      }
    }
	if( $teacher_firstname !="" && $teacher_lastname != "" && $email_id !="" && $address !="")
	{
		$sql = "INSERT INTO
        tbl_teacher(
        teacher_firstname,teacher_lastname,dateofbirth,qualification,experience,phone_number,email_id,address,joining_date,teacher_image
        )
        VALUES(
        '$teacher_firstname','$teacher_lastname','$dateofbirth','$qualification',$experience,'$phone_number','$email_id','$address','$joiningdate','$teacher_image'
        )";
		 $stmt=$con->prepare($sql);
   if($stmt->execute())
   {
		echo "<script>
		if(alert('DATA INSERTED SUCCESSFULLY'))
		{
			".header("Refresh:0.1;url=teacher.php")."
		}
		</script>";
	    }
	    
	 }
    else {
      echo "script>
		if(alert('Fill in data please'))
		{
			".header("Refresh:0.1;url=teacher.php")."
		}
		</script>";
    }
  }
}