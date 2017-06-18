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

session_start();
?>

<head>
        <title>CS3380 Lab 9</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"><!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"><!-- Optional theme -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script><!-- Latest compiled and minified JavaScript -->
</head>
<body>
<?php
	if($_POST['username'] == '') {
		$error = "Sorry, you must provide a username to login.";
		require "index.php";
		exit();
	}
	else if($_POST['password'] == '') {
                $error = "Sorry, you must provide a password to login.";
                require "index.php";
                exit();
        }		
	
        $sql = 'SELECT salt, hashed_password, user_type FROM user WHERE username = ?';
        if ($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt, "s", htmlspecialchars($_POST['username']));
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
        }

        if (mysqli_num_rows($result) == 0) {
                $error = "Sorry, that username does not exist. Please try again.";
                require "index.php";
		exit();
        }
        else {
                $row = mysqli_fetch_assoc($result);
                $localhash = sha1( $row['salt'] . htmlspecialchars($_POST['password']) );

                if ($localhash == $row['hashed_password']){
                        //require "page1.php";
			$_SESSION['loggedin'] = true;
			$_SESSION['username'] = $_POST['username'];
			if ($row['user_type'] == 'admin') {
				$_SESSION['admin'] = true;
			}
			header("Location: page1.php");
                }
                else {
                        $error = "Sorry, password is incorrect. Please try again.";
			require "index.php";
			exit();
                }
                mysqli_stmt_close($stmt);
        }
?>
</body>
</html>


