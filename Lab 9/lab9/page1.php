<!DOCTYPE html>
<html>
<?php
if(empty($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}

$link = mysqli_connect("us-cdbr-azure-central-a.cloudapp.net", "b0b17d51bbdf26", "d1dd4f94", "cs3380-ajwc5f") or die("Connect Error " . mysqli_error($link));

session_start();
$loggedin = empty($_SESSION['loggedin']) ? false : $_SESSION['loggedin'];
if($loggedin == false) {
	require "index.php";
	exit();
}
else {
	$username = $_SESSION['username'];
        $admin = $_SESSION['admin'];	
}
?>

        <head>
                <title>CS3380 Lab 9</title>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        </head>
        <body>
		<?php
		if($admin == true) {
		?>
			<h2>Welcome Admin! You have super privileges.</h2>
			<h4>Use them wisely.......</h4>
		<?php
		}
		else {
		?>
			 <h2>Welcome <?php echo $username; ?>!</h2>
		<?php
		}
		?>
                <div name="formcontainer">
			<a href="index.php" class="btn btn-primary">Logout</a>
		</div>
        </body>
</html>

