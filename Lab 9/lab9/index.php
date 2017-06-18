<!DOCTYPE html>
<html>
<?php
session_start();

if(empty($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}

$link = mysqli_connect("us-cdbr-azure-central-a.cloudapp.net", "b0b17d51bbdf26", "d1dd4f94", "cs3380-ajwc5f") or die("Connect Error " . mysqli_error($link));
	?>

	<head>
		<title>CS3380 Lab 9</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	</head>
	<body>
		<h2>Please login.</h2>
		<?php
			if ($error) {
				print "<div class=\"btn btn-danger\">$error</div>\n";
			}
		?>
		<div name="formscontainer">
			<form action="login.php" method="POST">
  				Username:<br>
  				<input type="text" name="username" placeholder="">
				<br>
  				Password:<br>
  				<input type="password" name="password">
  				<br><br>
				<input class="btn btn-info" type="submit" value="Login">
			</form>
			<form action="register.php" method="POST">
				<br><input class="btn btn-primary" type="submit" value="Register"><br>
			</form>
		</div>
	</body>
</html>
			
