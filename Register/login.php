<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Login page</title>
<link rel="stylesheet" href="css/student.css" >
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body id="login_page">
<div id="login">
  <h2 class="titles">LOGIN</h2>
  <div class="error_message"><span id="msg">All fields are required</span><span id="cross">&times;</span></div>
  <form method="POST" action="all_action.php" onsubmit="return validate()">
  <label for="fname">Email:</label>
  <input type="email" id="email" name="email"class="input_box"><br>
  <label for="lname">Password:</label>
  <input type="password" id="password" name="password"class="input_box"><br>
  <input type="submit"name="login" value="login">
  </form>
  <span id="dont">Don't have account <a href="signup.php">sign up</a></span>
  </div>
  <script type="text/javascript" src="js/student.js"></script>
</body>
</html>