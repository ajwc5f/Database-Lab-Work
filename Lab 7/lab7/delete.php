<?php
        $link = mysqli_connect("us-cdbr-azure-central-a.cloudapp.net", "b0b17d51bbdf26", "d1dd4f94", "cs3380-ajwc5f") or die("Connect Error " . mysqli_error($link));

        if(isset($_POST['delete'])) {
		switch($_POST['table']) {
			case 'city':
                		$delete_query = "DELETE FROM city WHERE ID = ?";
				break;
			case 'country':
				$delete_query = "DELETE FROM country WHERE Code =?";
				break;
			case 'countrylanguage':
				$delete_query = "DELETE FROM countrylanguage WHERE CountryCode = ?";
				break;
		}
                if($stmt = mysqli_prepare($link, $delete_query)) {
			mysqli_stmt_bind_param($stmt, "s", htmlspecialchars($_POST['pk']));
                        if(mysqli_stmt_execute($stmt)) {
                                mysqli_stmt_close($stmt);
                                header('Location: success.php');
                        }
                }
        }

        else {
                header('Location: failure.php');
        }
?>
