<!DOCTYPE html>
<html>
<?php
if(empty($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}

$link = mysqli_connect("us-cdbr-azure-central-a.cloudapp.net", "b0b17d51bbdf26", "d1dd4f94", "cs3380-ajwc5f") or die("Connect Error " . mysqli_error($link));
ob_start();
?>
	<head>
		<title>CS3380 Lab 8</title>
                 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"><!-- Latest compiled and minified CSS -->
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"><!-- Optional theme -->
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script><!-- Latest compiled and minified JavaScript -->
        	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	</head>
	<body>

	<div class="container">
		<h3>Please submit a new user registration form...</h3>
		
		<form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
			<label>Username</label><br>
			<input type="text" name="username"><br>
		
			<label>Password</label><br>
			<input type="password" name="password"><br>
			
			<label>Confirm Password</label><br>
			<input type="password" name="conf_password"><br>
			
			<input class="btn btn-info" type="submit" name="submit" value="Submit"><br>
		</form>
		
		<br>
		<a href="index.php" class="btn btn-primary">Return to Login</a><br>

	</div>
	</body>
</html>
<?php

        if(isset($_POST['submit'])){
		$username = htmlspecialchars($_POST['username']);
		$password = htmlspecialchars($_POST['password']);
		$conf_password = htmlspecialchars($_POST['conf_password']);
   
                $query = "SELECT username FROM user";

		if($stmt = mysqli_prepare($link, $query)){

			mysqli_stmt_execute($stmt);

        		$result = mysqli_stmt_get_result($stmt);
			while($row = mysqli_fetch_assoc($result)){
               			foreach($row as $key => $value) {
					if ($username == $value) {
						echo "Sorry, that username is already taken.";
			
					}
        			}
			}
			mysqli_stmt_close($stmt);
		}

		if($username == ''){
                        echo "Sorry, username cannot be empty.\n";
                }
                else if($password == ''){
                        echo "Sorry, password cannot be empty.\n";
                }
		else if($conf_password == ''){
                        echo "Sorry, confirmation password cannot be left blank.\n";
                }
		else if($password != $conf_password){
                        echo "Sorry, passwords do not match.\n";
                }
        	else{
                	$insert_query = "INSERT INTO user (username,salt,hashed_password) VALUES (?,?,?)";

			mt_srand();
			$salt = mt_rand();
			$pwhash = sha1($salt . $password);

                	if($stmt = mysqli_prepare($link, $insert_query)){
                        	mysqli_stmt_bind_param($stmt,"sss",htmlspecialchars($username),htmlspecialchars($salt),htmlspecialchars($pwhash));
                        	mysqli_stmt_execute($stmt);
                        	mysqli_stmt_close($stmt);

                        	header('Location: success.php');
                	}
        	}
	}
?>
<?php
	mysqli_close($link);
?>
