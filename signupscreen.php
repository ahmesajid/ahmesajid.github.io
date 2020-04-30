<!DOCTYPE html>
<html>
	<head>
		<?php
		session_start();
		?>
		<script type="text/javascript" src="jquery.js"></script>
		<title>Student Sign Up Screen</title>
	</head>
	<body>
		<h1>Student Sign Up Screen</h1></br>

		<form method="POST" action="validatesignupdata.php">
			Name<input type="text" name="name" id="name">
			Login<input type="text" name="login" id="login">
			Password <input type="password" name="password" id="password">
			Confirm Password <input type="password" name="confirmpassword" id="confirmpassword">

			<div id="showpasswordmessage">

			</div>
			<div id="showpasswordlengthmessage">

			</div>
			<div style="color: red">
				<?php
				if(isset($_SESSION["error"]))
				{
					echo $_SESSION["error"];
				}
				 $_SESSION["error"]=null;
				?>
			</div>
			<div style="color: green">
				<?php
				if(isset($_SESSION["success"]))
				{
					echo $_SESSION["success"];
				}
				 $_SESSION["success"]=null;
				?>
			</div>
		    </br>
			<input type="submit" name="submit" id="submit" value="Submit Data">

		</form>
		<script type="text/javascript">
			var pass1 , pass2;

			$(document).ready(function()
				{
					$("#password,#confirmpassword").change(function(){
						pass1 = $("#password").val();
						pass2 = $("#confirmpassword").val();

						if((pass1!=pass2) && (pass1!=null && pass2!=null))
						{
							$("#showpasswordmessage").empty();
							$("#showpasswordmessage").append("Passwords does not match");
							$("#showpasswordmessage").css("color","red");
						}
						else
						{
							$("#showpasswordmessage").empty();
						}
						if((pass1.length<9 || pass2.length<9) && (pass1!=null && pass2!=null))
						{
							$("#showpasswordlengthmessage").empty();
							$("#showpasswordlengthmessage").append("Your password must contain at least 9 characters.");
							$("#showpasswordlengthmessage").css("color","red");
						}
						else
						{
							$("#showpasswordlengthmessage").empty();
						}
					});
				});

			
		</script>

    </body>
</html>