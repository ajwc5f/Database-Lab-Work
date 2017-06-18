<?php
	$link = mysqli_connect("us-cdbr-azure-central-a.cloudapp.net", "b0b17d51bbdf26", "d1dd4f94", "cs3380-ajwc5f") or die("Connect Error " . mysqli_error($link));

	if(isset($_POST['savecity'])) {
		if(!is_numeric(htmlspecialchars($_POST['Population']))){
                	header('Location: failure.php');
        	}
		else {
			$update_query = "UPDATE city SET District = ?, Population = ? WHERE ID = ?";
			if($stmt = mysqli_prepare($link, $update_query)) {
				mysqli_stmt_bind_param($stmt, "sss", htmlspecialchars($_POST['District']), htmlspecialchars($_POST['Population']), htmlspecialchars($_POST['ID']));
				if(mysqli_stmt_execute($stmt)) {
					mysqli_stmt_close($stmt);
					header('Location: success.php');
				}
			}
		}
	}

	else if(isset($_POST['savecountry'])) {
		if(!is_numeric(htmlspecialchars($_POST['IndepYear'])) || !is_numeric(htmlspecialchars($_POST['Population']))){
			header('Location: failure.php');	
		}
		else {
                	$update_query = "UPDATE country SET IndepYear = ?, Population = ?, LocalName = ?, GovernmentForm = ? WHERE Code = ?";
                	if($stmt = mysqli_prepare($link, $update_query)) {
                        	mysqli_stmt_bind_param($stmt, "sssss", htmlspecialchars($_POST['IndepYear']), htmlspecialchars($_POST['Population']), htmlspecialchars($_POST['LocalName']), htmlspecialchars($_POST['GovernmentForm']), htmlspecialchars($_POST['Code']));
                        	if(mysqli_stmt_execute($stmt)) {
                                	mysqli_stmt_close($stmt);
                                	header('Location: success.php');
                        	}
                	}
        	}
	}

	else if(isset($_POST['savecountrylang'])) {
                if(!is_numeric(htmlspecialchars($_POST['Percentage']))){
                	header('Location: failure.php');	
        	}
		else {
			$update_query = "UPDATE countrylanguage SET IsOfficial = ?, Percentage = ? WHERE CountryCode = ? AND Language = ?";
                	if($stmt = mysqli_prepare($link, $update_query)) {
                        	mysqli_stmt_bind_param($stmt, "ssss", htmlspecialchars($_POST['IsOfficial']), htmlspecialchars($_POST['Percentage']), htmlspecialchars($_POST['CountryCode']), htmlspecialchars($_POST['Language']));
                        	if(mysqli_stmt_execute($stmt)) {
                                	mysqli_stmt_close($stmt);
                                	header('Location: success.php');
                        	}
                	}
        	}
	}
	else {
		header('Location: failure.php');
	}	
?>
