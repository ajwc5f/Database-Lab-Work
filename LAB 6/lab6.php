<!DOCTYPE html>
<html>

	<?php
        $link = mysqli_connect("us-cdbr-azure-central-a.cloudapp.net", "b0b17d51bbdf26", "d1dd4f94", "cs3380-ajwc5f") or die("Connect Error " . mysqli_error($link));
	?>

	<head>
		<title>CS3380 Lab 6</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<h2 style="text-align:center">LAB 6</h2>
			<br>
			<div class="row">
				<form style="text-align:center" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
					<select name="dropDown">
                        
						<?php
						for($i = 1; $i< 9; $i++) {
							echo "<option value='".$i."'>Query ".$i."</option>";
						}
						?>
                        
					</select>
					<input type="submit" name="submit" value="Go"/>
				</form>
			</div>
            
			<?php
			if(isset($_POST['submit'])) {
				$query = $_POST['dropDown'];
				echo "You have selected Query ".$query."...";

     				$result = dbQuery($query);
     				$num_rows = mysqli_num_rows($result);
     				echo "<br><br>Number of Results: ".$num_rows."\n";
     
            ?>
				<table class="table table-hover">
					<thead>
						<tr>
                            
							<?php
							while ($fieldname = mysqli_fetch_field($result)) {
								echo "<th>".$fieldname->name."</th>";
							}
							?>
                            
     						</tr>
					</thead>
					<tbody>
                        
						<?php
     						while($row = mysqli_fetch_array($result)){
 							$index = count($row);

							echo "<tr>";
     							for($i = 0; $i < $index; $i++){
     								echo"<td>".$row[$i]."</td>";
     							}
     							echo "</tr>";
     						}
						?>
                        
					</tbody>
    	 			</table>
			
            <?php
    				mysqli_free_result($result);
			}
			else {
				echo "Please select a query from the dropdown menu.";
			}
			?>
            
		</div>
	</body>
</html>

<?php
function dbQuery($queryNum) {
	$link = mysqli_connect("us-cdbr-azure-central-a.cloudapp.net", "b0b17d51bbdf26", "d1dd4f94", "cs3380-ajwc5f") or die("Connect Error " . mysqli_error($link));

	switch($queryNum) {
		case 1:
			echo "<br> - Show the person's id, first name and last name for all people who have a body weight above 140.";
        		$query = "SELECT * FROM weight";
     			break;

		case 2:
			echo "<br> - Returns the first name, last name and BMI for people with a weight above 150.";
			$query = "SELECT * FROM BMI";
			break;

		case 3:
        	        echo "<br> - Return the name and city of the university that has no people in database that are associated with it.";
                	$query = "SELECT university_name, city FROM university WHERE NOT EXISTS
				(SELECT uid FROM person WHERE university.uid = person.uid)";
        	        break;			

		case 4:
			echo "<br> - Retrieve the first and last names for all people that go to school in Columbia.";
			$query = "SELECT fname, lname FROM person WHERE uid IN 
				(SELECT university.uid FROM university WHERE city = 'Columbia')"; 
			break;	

		case 5:
			echo "<br> - Retrieve the activities that are not played by any player in the database.";
			$query = "SELECT activity_name FROM activity WHERE activity_name NOT IN 
				(SELECT participated_in.activity_name FROM participated_in)";
			break;

		case 6:
			echo "<br> - Return person's id for all people who run or play racquetball.";
			$query = "SELECT pid FROM participated_in WHERE activity_name = 'running' 
				UNION 
				SELECT pid FROM participated_in WHERE activity_name = 'racquetball'";
			break;

		case 7:
			echo "<br> - Return first and last name of all people who are older than 30 and are taller than 65 inches.";
			$query = "SELECT * FROM (
					SELECT fname, lname FROM person INNER JOIN body_composition USING (pid) 
					WHERE (age > 30)
				) as age_group JOIN (
					SELECT fname, lname FROM person INNER JOIN body_composition USING (pid)
					WHERE (height > 65)	
				) as height_group USING (fname, lname)";
			break;

		case 8:
			echo "<br> - Return peoples first and last names, weight, height, and age. Records should be ordered first by height in descending order, then by weight in ascending order, and finally by the person's last name in ascending order.";
			$query = "SELECT fname, lname, weight, height, age FROM person INNER JOIN body_composition USING (pid) ORDER BY height DESC, weight ASC, lname ASC";
			break;
	}
	$result = mysqli_query($link, $query) or die("<br><br>Query Error:".mysqli_error($link));
	return $result;
}
?>