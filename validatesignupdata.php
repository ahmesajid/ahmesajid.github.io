<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript" src="jquery.js"></script>
		<title>Validate Sign Up Data</title>
	</head>
	<body>
		<?php 
		require ("connection.php");
		session_start();
		if(isset($_REQUEST["submit"]))
		{
			if($_REQUEST["name"]==null || $_REQUEST["login"]==null || $_REQUEST["password"]==null || $_REQUEST["confirmpassword"]==null)
			{
                $_SESSION["success"] = null;
				$_SESSION["error"] = "Credentials must not be left blank!";
				header("location:signupscreen.php");
			}
			else
			{
				$_SESSION["error"] = null;
	            $_SESSION["success"] = "Record added successfully!";
	            
	            $name_ = $_REQUEST["name"];
	            $login_ = $_REQUEST["login"];
	            $password_ = $_REQUEST["password"];
		        $sql = "INSERT INTO student (name,login,password) VALUES ('$name_','$login_','$password_')";
		        mysqli_query($con, $sql);
		        header("location:signupscreen.php");
			}
		}
		else
		{
			header("location:signupscreen.php");
		}
		?>
		<script>	
		</script>

    </body>
</html>