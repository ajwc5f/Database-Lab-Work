<!DOCTYPE html>
<html>
<?php
if(empty($_SERVER["HTTPS"]) || $_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}

$link = mysqli_connect("us-cdbr-azure-central-a.cloudapp.net", "b0b17d51bbdf26", "d1dd4f94", "cs3380-ajwc5f") or die("Connect Error " . mysqli_error($link));

$loggedin = empty($_GET['loggedin']) ? 'false' : $_GET['loggedin'];
if($loggedin == "false") {
	header("Location: index.php");
}
?>

        <head>
                <title>CS3380 Lab 8</title>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        </head>
        <body>
                <h2>Welcome. Thanks for logging in.</h2>
                <div name="formcontainer">
			<a href="index.php" class="btn btn-primary">Logout</a>
		</div>
        </body>
</html>

