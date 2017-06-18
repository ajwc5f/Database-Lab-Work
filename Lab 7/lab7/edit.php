<!DOCTYPE html>
<html>

        <?php
        $link = mysqli_connect("us-cdbr-azure-central-a.cloudapp.net", "b0b17d51bbdf26", "d1dd4f94", "cs3380-ajwc5f") or die("Connect Error " . mysqli_error($link));
        
	function getRowData() {
		if(isset($_POST['row_data'])) {
                        $row = unserialize(gzinflate(base64_decode($_POST['row_data'])));
                }
                else {
                        $row = NULL;
                }	

		return $row;
	}

	function fillCity() {
		
		echo "<h4>Update record from the City table...</h4>";

		$rowData = getRowData();
		if($rowData == NULL) {
			echo "Row data not set.";
		}
		else {
			echo "<form action='update.php' method='POST'>";
			foreach ($rowData as $key => $value) {
				echo "<div class='form-group'>";
				echo "<label>" . $key . "</label><br>";
				if($key == 'District' || $key == 'Population') {
					echo "<input type='text' name='" . $key . "' value='" . $value . "'>";
				}
				else {
					echo "<input type='text' name='" . $key . "' value='" . $value . "' style='background:CFCFCF' readonly>";
				}
				echo "</div>";
			}
			echo "<input class='btn btn-info' type='submit' name='savecity' value='SAVE'>";
			echo "</form>";
		}		
	}

	function fillCountry() {

                echo "<h4>Update record from the Country table...</h4>";

                $rowData = getRowData();
                if($rowData == NULL) {
                        echo "Row data not set.";
                }
                else {
                        echo "<form action='update.php' method='POST'>";
                        foreach ($rowData as $key => $value) {
                                echo "<div class='form-group'>";
                                echo "<label>" . $key . "</label><br>";
                                if($key == 'LocalName' || $key == 'GovernmentForm' || $key == 'IndepYear' || $key == 'Population') {
                                        echo "<input type='text' name='" . $key . "' value='" . $value . "'>";
                                }
                                else {
                                        echo "<input type='text' name='" . $key . "' value='" . $value . "' readonly>";
                                }
                                echo "</div>";
                        }
                        echo "<input class='btn btn-info' type='submit' name='savecountry' value='SAVE'>";
                        echo "</form>";
                }
        }

	function fillCountryLanguage() {

                echo "<h4>Update record from the Country Language table...</h4>";

                $rowData = getRowData();
                if($rowData == NULL) {
                        echo "Row data not set.";
                }
                else {
                        echo "<form action='update.php' method='POST'>";
                        foreach ($rowData as $key => $value) {
                                echo "<div class='form-group'>";
                                echo "<label>" . $key . "</label><br>";
                                if($key == 'IsOfficial') {
					if ($value == 'T') {
						echo "True <input type='radio' name='" . $key . "' value='T' checked>";
                				echo " False <input type='radio' name='" . $key . "' value='F'><br>";
					}
					else {
						echo "True <input type='radio' name='" . $key . "' value='T'>";
                                                echo " False <input type='radio' name='" . $key . "' value='F' checked><br>";
					}					
				}
				else if ($key == 'Percentage') {
                                        echo "<input type='text' name='" . $key . "' value='" . $value . "'>";
                                }
                                else {
                                        echo "<input type='text' name='" . $key . "' value='" . $value . "' readonly>";
                                }
                                echo "</div>";
                        }
                        echo "<input class='btn btn-info' type='submit' name='savecountrylang' value='SAVE'>";
                        echo "</form>";
                }
        }
	?>

        <head>
                <title>CS3380 Lab 7</title>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"><!-- Latest compiled and minified CSS -->
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"><!-- Optional theme -->
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script><!-- Latest compiled and minified JavaScript -->
		<style>
			input[readonly] {
 	   			background: #dddddd;
			}
		</style>
        </head>
        <body>
                <div class="container">
		<?php
		if(isset($_POST['table'])) {
			$table = $_POST['table'];
			switch ($table) {
				case "city":
					fillCity();
					break;
			
				case "country":
                                        fillCountry();
                                        break;

				case "countrylanguage":
                                        fillCountryLanguage();
                                        break;	
				
				default:
					echo "No table";
			}
		}
		?>
		</div>
	</body>
</html>
