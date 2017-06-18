<!DOCTYPE html>
<html>

        <?php
        $link = mysqli_connect("us-cdbr-azure-central-a.cloudapp.net", "b0b17d51bbdf26", "d1dd4f94", "cs3380-ajwc5f") or die("Connect Error " . mysqli_error($link));
        ?>

        <head>
                <title>CS3380 Lab 7</title>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"><!-- Latest compiled and minified CSS -->
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css"><!-- Optional theme -->
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script><!-- Latest compiled and minified JavaScript -->
        </head>
        <body>
                <div class="container">
			<br>
			<form style="text-align:left" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
				<b>Select a table to search in:</b><br>
				<div style="float:right">
					<h1>LAB 7</h1>
				</div>

				<input type="text" name="search_for" placeholder="Search For...">

                                <input class="btn btn-info" type="submit" name="search" value="Search">
				<a href="insert.php" class="btn btn-primary" >Insert into city</a><br>

				<input type="radio" name="search_in" value="city" checked> City
				<input type="radio" name="search_in" value="country"> Country 
				<input type="radio" name="search_in" value="countrylanguage"> Country Language <br>
			</form>	
			<?php
			if(isset($_POST['search'])) {
				$search_in = $_POST['search_in'];
				$search_for = $_POST['search_for'] . "%";

				if($search_in == "city" || $search_in == "country") {
					$field = $search_in.".name";
				}
				else {
					$field = $search_in.".language";
				}
				
				$query = "SELECT * FROM " . $search_in . " WHERE " . $field . " LIKE ? ORDER BY " . $field . " ASC";

				if($stmt = mysqli_prepare($link, $query)) {
					mysqli_stmt_bind_param($stmt, "s", htmlspecialchars($search_for));
					if(mysqli_stmt_execute($stmt)) {
						$result = mysqli_stmt_get_result($stmt);

						$row_cnt = mysqli_num_rows($result);
						echo "Num rows: " . $row_cnt . "<br>";
			?>
						<table class="table table-hover">
							<thead>
								<tr>
                            
								<?php
								echo "<th></th>";
								echo "<th></th>";
								while ($fieldname = mysqli_fetch_field($result)) {
									echo "<th>".$fieldname->name."</th>";
								}
								?>
        
     								</tr>
							</thead>
							<tbody>
								<?php
     								while($row = mysqli_fetch_assoc($result)) {
									$primary_key = reset($row);
									echo "<tr>";	
								?>
									<td>
									<form action="edit.php" method="POST">
										<input type="hidden" name="row_data" value="<?php echo base64_encode(gzdeflate(serialize($row))) ?>">
										<input type="hidden" name="table" value="<?php echo $search_in ?>">
										<input class="btn btn-info" type="submit" name="update" value="UPDATE">
									</form>
									</td>

									<td>
									<form action="delete.php" method="POST">
										<input type="hidden" name="pk" value="<?php echo $primary_key ?>">
                                                                                <input type="hidden" name="table" value="<?php echo $search_in ?>">
										<input class="btn btn-danger" type="submit" name="delete" value="DELETE">
                                                                        </form>
									</td>

     								<?php	
									foreach ($row as $key => $value) {
										echo "<td>".$value."</td>";
									}
     									echo "</tr>";
     								}
								?>
							</tbody>
    	 					</table>
			<?php			
					}
					else {
						echo mysqli_stmt_error($stmt);
					}
				}
				else {
					echo mysqli_stmt_error($stmt);
				} 
			}
			?>

		</div>
	</body>
</html>
