<!DOCTYPE html>
<html>
	<head>

		<script type="text/javascript" src="jquery.js"></script>
		<title>Login Up Screen</title>
	</head>
	<body>
		<?php
		session_start();
		$_SESSION["user-std"]=null

		?>
		<h1>Student Log In Screen</h1>
		<form action="homescreen.php" method="POST">
			Name<input type="text" name="name" id="name">
			Password<input type="password" name="password" id="password">
			<input type="submit" name="submit" id="submit" value="Log In">
		</form>

		<div id="errordiv" style="color:red;">
			<?php 
			if(isset($_SESSION["invalid"]))
			{
				echo $_SESSION["invalid"];
			}
			$_SESSION["invalid"]=null;
			$_SESSION["user-std"]=null

			?>
		</div>

		<script>
		</script>

    </body>
</html>