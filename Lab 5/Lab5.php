<html>
	<?php
	//establish connection
        $link = mysqli_connect("us-cdbr-azure-central-a.cloudapp.net", "b0b17d51bbdf26", "d1dd4f94", "cs3380-ajwc5f") or die("Connect Error " . mysqli_error($link));
	?>

	<head>
		<!--  I USE BOOTSTRAP BECAUSE IT MAKES FORMATTING/LIFE EASIER -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"><!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"><!-- Optional theme -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script><!-- Latest compiled and minified JavaScript -->
	</head>
	<body>
		<div class="container">
			<h2 style="text-align:center">LAB 5</h2>
			<br>
			<div class="row">
				<!-- 
					This form will submit a 'method' request
					the request is sent to 'action'
					In this case 'method' = POST and 'action' = this_php_script
				 -->
				<form style="text-align:center" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
					<select name="dropDown">
					<?php
						for($i = 1; $i< 12; $i++) {
							echo "<option value='".$i."'>Query ".$i."</option>";
						}
					?>
					</select>
					<input type="submit" name="submit" value="Go"/>
				</form>
			</div>
			<?php
				if(isset($_POST['submit'])) { // Was the form submitted?
					//The value submitted from the drop down was...
					echo "You have selected Query ".$_POST['dropDown']."...";

					switch ($_POST['dropDown']) {
						case 1:
							echo "<br> - Find the district and population of all cities named Springfield. Results ordered from most populous to least populous.";
						
							$query = "SELECT District, Population FROM city WHERE city.name = 'Springfield'";
							$query .= " ORDER BY Population DESC";
	
							$result = mysqli_query($link, $query) or die("Query Error: " . mysqli_error($link));
							echo "</br></br>Number of results: ".mysqli_num_rows ($result);	
			?>
						
							<table class="table table-hover">
                               					<thead>
                                        				<tr>
                                                				<th>District</th>
                                                				<th>Population</th>
                                        				</tr>
                                				</thead>
                                				<tbody>
                                				<?php
									while($row = mysqli_fetch_array($result)) {
                                				?>
                                        				<tr>
                                                				<td><?=$row[0]?></td>
                                                				<td><?=$row[1]?></td>
                                        				</tr>
                                				<?php
                                        				}
									break;
                                				?>
                                				</tbody>
                        				</table>
<?php
						case 2:
                                                        echo "</br> - Find the name, district, and population of each city in Brazil. Results order alphabetically.";

                                                	$query = "SELECT Name, District, Population FROM city WHERE city.CountryCode = 'BRA' ORDER BY Name ASC";

                                                	$result = mysqli_query($link, $query) or die("Query Error: " . mysqli_error($link));
							echo "</br></br>Number of results: ".mysqli_num_rows ($result);
?>

							<table class="table table-hover">
                                                                <thead>
                                                                        <tr>
                                                                                <th>Name</th>
										                                        <th>District</th>
                                                                                <th>Population</th>
                                                                        </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                        while($row = mysqli_fetch_array($result)) {
                                                                ?>
                                                                        <tr>
                                                                                <td><?=$row[0]?></td>
                                                                                <td><?=$row[1]?></td>
										<td><?=$row[2]?></td>
                                                                        </tr>
                                                                <?php
                                                                        }
                                                                        break;
                                                                ?>
                                                                </tbody>
                                                        </table>
                                               	
<?php
						case 3:
							echo "</br> - Find the name, continent, and surface area of the smallest countries by surface area. Results ordered by smallest surface area to largest."; 
							
							$query = "SELECT Name, Continent, SurfaceArea FROM country ORDER BY SurfaceArea ASC LIMIT 20";

                                                	$result = mysqli_query($link, $query) or die("Query Error: " . mysqli_error($link));
							echo "</br></br>Number of results: ".mysqli_num_rows ($result);
?>
							
                                                	<table class="table table-hover">
                                                                <thead>
                                                                        <tr>
                                                                                <th>Name</th>
                                                                                <th>Continent</th>
                                                                                <th>Surface Area</th>
                                                                        </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                        while($row = mysqli_fetch_array($result)) {
                                                                ?>
                                                                        <tr>
                                                                                <td><?=$row[0]?></td>
                                                                                <td><?=$row[1]?></td>
                                                                                <td><?=$row[2]?></td>
                                                                        </tr>
                                                                <?php
                                                                        }
                                                                        break;
                                                                ?>
                                                                </tbody>
                                                        </table>

<?php
						case 4:
                                                        echo "</br> - Find the name, continent, form of government, and GNP of all countries having a GNP greater than 200,000. Results ordered alphabetically.";

                                                	$query = "SELECT Name, Continent, GovernmentForm, GNP FROM country WHERE GNP > 200000 ORDER BY country.Name ASC";

                                                	$result = mysqli_query($link, $query) or die("Query Error: " . mysqli_error($link));
							echo "</br></br>Number of results: ".mysqli_num_rows ($result);
?>
							<table class="table table-hover">
                                                                <thead>
                                                                        <tr>
                                                                                <th>Name</th>
                                                                                <th>Continent</th>
                                                                                <th>Form of Government</th>
										<th>GNP</th>
                                                                        </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                        while($row = mysqli_fetch_array($result)) {
                                                                ?>
                                                                        <tr>
                                                                                <td><?=$row[0]?></td>
                                                                                <td><?=$row[1]?></td>
                                                                                <td><?=$row[2]?></td>
										<td><?=$row[3]?></td>
                                                                        </tr>
                                                                <?php
                                                                        }
                                                                        break;
                                                                ?>
                                                                </tbody>
                                                        </table>

<?php
						case 5:
                                                        echo "</br> - Find the 10 countries with the 10th through 19th best life expectancy rates.";

                                                	$query = "SELECT Name FROM country WHERE LifeExpectancy IS NOT NULL ORDER BY LifeExpectancy DESC LIMIT 10 OFFSET 10";

                                                	$result = mysqli_query($link, $query) or die("Query Error: " . mysqli_error($link));
							echo "</br></br>Number of results: ".mysqli_num_rows ($result);
?>
                                           		<table class="table table-hover">
                                                                <thead>
                                                                        <tr>
                                                                                <th>Name</th>
                                                                        </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                        while($row = mysqli_fetch_array($result)) {
                                                                ?>
                                                                        <tr>
                                                                                <td><?=$row[0]?></td>
                                                                        </tr>
                                                                <?php
                                                                        }
                                                                        break;
                                                                ?>
                                                                </tbody>
                                                        </table>

<?php
						case 6:
                                                        echo "</br> - Find all city names that start with the letter B and ends in the letter s. Results ordered from city with largest population to smallest.";

                                                	$query = "SELECT Name FROM city WHERE city.Name LIKE 'B%' '%s' ORDER BY Population DESC";

                                                	$result = mysqli_query($link, $query) or die("Query Error: " . mysqli_error($link));
							echo "</br></br>Number of results: ".mysqli_num_rows ($result);
?>
							<table class="table table-hover">
                                                                <thead>
                                                                        <tr>
                                                                                <th>Name</th>
                                                                        </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                        while($row = mysqli_fetch_array($result)) {
                                                                ?>
                                                                        <tr>
                                                                                <td><?=$row[0]?></td>
                                                                        </tr>
                                                                <?php
                                                                        }
                                                                        break;
                                                                ?>
                                                                </tbody>
                                                        </table>

<?php
						case 7:
                                                        echo "</br> - Return the name, name of the country, and city population of each city in the world having population greater than 6,000,000. Results ordered by most populous city to least.";

                                                	$query = "SELECT city.Name, country.Name, city.Population FROM city, country WHERE (city.CountryCode = country.Code) AND (city.Population > 6000000) ORDER BY city.Population DESC";

                                                	$result = mysqli_query($link, $query) or die("Query Error: " . mysqli_error($link));
							echo "</br></br>Number of results: ".mysqli_num_rows ($result);
?>
                                                	<table class="table table-hover">
                                                                <thead>
                                                                        <tr>
                                                                                <th>City Name</th>
                                                                                <th>Country</th>
                                                                                <th>Population</th>
                                                                        </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                        while($row = mysqli_fetch_array($result)) {
                                                                ?>
                                                                        <tr>
                                                                                <td><?=$row[0]?></td>
                                                                                <td><?=$row[1]?></td>
                                                                                <td><?=$row[2]?></td>
                                                                        </tr>
                                                                <?php
                                                                        }
                                                                        break;
                                                                ?>
                                                                </tbody>
                                                        </table>

<?php
						case 8:
                                                        echo "</br> - Find the name, independence year, and region of all countries where English is an official language. Results alphabatized by region.";

                                                	$query = "SELECT Name, IndepYear, Region FROM country, countrylanguage WHERE (countrylanguage.Language = 'English') AND (country.Code = countryLanguage.CountryCode) ORDER BY Region ASC, country.Name ASC";

                                                	$result = mysqli_query($link, $query) or die("Query Error: " . mysqli_error($link));
							echo "</br></br>Number of results: ".mysqli_num_rows ($result);
?>
	                                           	<table class="table table-hover">
                                                                <thead>
                                                                        <tr>
                                                                                <th>Name</th>
                                                                                <th>Year of Independence</th>
                                                                                <th>Region</th>
                                                                        </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                        while($row = mysqli_fetch_array($result)) {
                                                                ?>
                                                                        <tr>
                                                                                <td><?=$row[0]?></td>
                                                                                <td><?=$row[1]?></td>
                                                                                <td><?=$row[2]?></td>
                                                                        </tr>
                                                                <?php
                                                                        }
                                                                        break;
                                                                ?>
                                                                </tbody>
                                                        </table>

<?php
						case 9:
                                                        echo "</br> - For each country display the capital city name and the percentage of the population that lives in the capital for each country. Results ordered from largest percentage to smallest.";

                                                	$query = "SELECT ci.Name, ((ci.Population / co.Population) * 100) AS percentage FROM city AS ci INNER JOIN country AS co ON (ci.ID = co.capital)";

                                                	$result = mysqli_query($link, $query) or die("Query Error: " . mysqli_error($link));
                                                	echo "</br></br>Number of results: ".mysqli_num_rows ($result);
?>
							<table class="table table-hover">
                                                                <thead>
                                                                        <tr>
                                                                                <th>Capital City</th>
                                                                                <th>% in Capital City</th>
                                                                        </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                        while($row = mysqli_fetch_array($result)) {
                                                                ?>
                                                                        <tr>
                                                                                <td><?=$row[0]?></td>
                                                                                <td><?=$row[1]?></td>
                                                                        </tr>
                                                                <?php
                                                                        }
                                                                        break;
                                                                ?>
                                                                </tbody>
                                                        </table>
<?php
						
						case 10:
                                                        echo "</br> - Find all official languages, the country for which it is spoken, and the percentage of speakers. Results ordered by total numbers of speakers with the most popular language first.";

                                                	$query = "SELECT countrylanguage.language, country.name, country.Population, countrylanguage.Percentage FROM countrylanguage INNER JOIN country ON countrylanguage.countrycode = country.code WHERE countrylanguage.isofficial = 'T' ORDER BY (countrylanguage.Percentage*country.Population/100) DESC";

                                                	$result = mysqli_query($link, $query) or die("Query Error: " . mysqli_error($link));
                                                	echo "</br></br>Number of results: ".mysqli_num_rows ($result);
?>
							<table class="table table-hover">
                                                                <thead>
                                                                        <tr>
                                                                                <th>Language</th>
                                                                                <th>Country</th>
										<th>% of Speakers</th>
                                                                        </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                        while($row = mysqli_fetch_array($result)) {
                                                                ?>
                                                                        <tr>
                                                                                <td><?=$row[0]?></td>
                                                                                <td><?=$row[1]?></td>
										<td><?=$row[3]?></td>
                                                                        </tr>
                                                                <?php
                                                                        }
                                                                        break;
                                                                ?>
                                                                </tbody>
                                                        </table>

<?php
						case 11:
                                                        echo "</br> - Find the name, region, GNP, old GNP, and real change in GNP for the countries who have most improved their relative wealth.";

                                                	$query = "SELECT Name, Region, GNP, GNPOld, ((GNP - GNPOld) / GNPOld) AS realChange FROM country WHERE GNP IS NOT NULL AND GNPOld IS NOT NULL ORDER BY realChange DESC";

                                                	$result = mysqli_query($link, $query) or die("Query Error: " . mysqli_error($link));
                                                	echo "</br></br>Number of results: ".mysqli_num_rows ($result);
?>
							<table class="table table-hover">
                                                                <thead>
                                                                        <tr>
                                                                                <th>Name</th>
                                                                                <th>Region</th>
										<th>GNP</th>
										<th>Old GNP</th>
										<th> Real GNP Change</th>
                                                                        </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                        while($row = mysqli_fetch_array($result)) {
                                                                ?>
                                                                        <tr>
                                                                                <td><?=$row[0]?></td>
                                                                                <td><?=$row[1]?></td>
										<td><?=$row[2]?></td>
										<td><?=$row[3]?></td>
										<td><?=$row[4]?></td>
                                                                        </tr>
                                                                <?php
                                                                        }
                                                                        break;
                                                                ?>
                                                                </tbody>
                                                        </table>

		<?php				
						default: 
							echo "Sorry, there was an error processing Query".$_POST['dropDown'];
					}
				}
				else {
					echo "<br>Select a query from the drop down...";
				}
			?>
		</div>
	</body>
</html>
