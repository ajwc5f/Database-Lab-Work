<?php
        $link = mysqli_connect("us-cdbr-azure-central-a.cloudapp.net", "b0b17d51bbdf26", "d1dd4f94", "cs3380-ajwc5f") or die("Connect Error " . mysqli_error($link));
ob_start();
?>

<html>
	<head>
		<title>CS3380 Lab 7</title>
                 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"><!-- Latest compiled and minified CSS -->
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"><!-- Optional theme -->
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script><!-- Latest compiled and minified JavaScript -->
        </head>
	<body>

	<div class="container">
		<h3>Inserting into City table...</h3>
		<form action="<?=$_SERVER['PHP_SELF']?>" method="POST">

			<label>Name</label><br>
				<input type="text" name="Name"><br>
			<label>District</label><br>
				<input type="text" name="District"><br>
			<label>Population</label><br>
				<input type="text" name="Population"><br>
			<label>CountryCode</label><br>

			<?php

				$query = "SELECT Name FROM country ORDER BY Name";

				if($stmt = mysqli_prepare($link, $query)){

					mysqli_stmt_execute($stmt);

        				$result = mysqli_stmt_get_result($stmt);
					//$field = mysqli_fetch_fields($result);

					echo "<select name='CountryCode'>";
					while($row = mysqli_fetch_assoc($result)){
                				foreach($row as $key => $value){
                					echo "<option value='" . $value . "'>" . $value . "</option>";
						}
        				}
					echo "</select><br>";	

					mysqli_stmt_close($stmt);
				}



			?>
			<br>
			<input class="btn btn-info" type="submit" name="submit" value="Submit"><br>
		</form>
			<br>
			<a href="index.php" class="btn btn-primary">Back to Index</a><br>

	</div>
	</body>
</html>
<?php

        if(isset($_POST['submit'])){
                if( htmlspecialchars($_POST['Name']) == ''){
                        header('Location: failure.php');
                }
                else if(htmlspecialchars($_POST['District']) == ''){
                        header('Location: failure.php');
                }
                else if(!is_numeric(htmlspecialchars($_POST['Population']))){
                        header('Location: failure.php');
                }
        	else{
                	$code_query = "SELECT Code FROM country WHERE Name=?";
                	if($stmt = mysqli_prepare($link, $code_query)){
                        	mysqli_stmt_bind_param($stmt,"s",htmlspecialchars($_POST['CountryCode']));
                        	mysqli_stmt_execute($stmt);

                       		$code="";
                        	mysqli_stmt_bind_result($stmt,$code);
                        	mysqli_stmt_fetch($stmt);
                        	mysqli_stmt_close($stmt);
                	}

                	$insert_query = "INSERT INTO city (Name,District,Population,CountryCode) VALUES (?,?,?,?)";
                	if($stmt = mysqli_prepare($link, $insert_query)){
                        	mysqli_stmt_bind_param($stmt,"ssss",htmlspecialchars($_POST['Name']),htmlspecialchars($_POST['District']),htmlspecialchars($_POST['Population']),htmlspecialchars($code));
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
