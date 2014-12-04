<?PHP
	require_once("./include/dbEC.php");
	require_once("./include/pager.php");
	
	//$_GET['seeAll'];
	
	//PAGER
	//instantiation of class
	$p = new Pager;

	/* Show many results per page? */
	$limit = 20;
	$count = 0;
	
	$dbQuery = "";
	
	/* Find the start depending on $_GET['page'] (declared if it's null) */
	$start = $p->findStart($limit);
	
	$dbh = mysql_connect("earth.cs.utep.edu", "cs5339team9fa14", "cs5339!cs5339team9fa14") or die ('I cannot connect to the database because: ' . mysql_error());
	
	mysql_select_db("cs5339team9fa14");
	
	$var = isset($_GET['searchGrad']) && $_GET['searchGrad'] != "" ? "'.*" . $_GET["searchGrad"] .".*'" : null;
	$qry = "SELECT * FROM master ";
	$qry .= $var != null ? 
			" WHERE academicyear REGEXP $var or term REGEXP $var or last REGEXP $var or first REGEXP $var or major REGEXP $var or level REGEXP $var or degree REGEXP $var " 
			: "";
	
	/* Find the number of rows returned from a query; Note: Do NOT use a LIMIT clause in this query */
	$count = mysql_num_rows(mysql_query($qry));
	
	/* Find the number of pages based on $count and $limit */
	$pages = $p->findPages($count, $limit);
	
	$dbQuery .= $qry . "  ORDER BY master_id ASC LIMIT " . $start . ", " . $limit;
	$result = mysql_query($dbQuery) or die("Couldn't get file list");
	
	$num_rows = 0;
		
	/* Now get the page list and echo it */
	$pagelist = $p->pageList($_GET['page'], $pages);
?>

<html>
	<head lang="en">
		<meta charset="UTF-8">
		<title>Alumni Website</title>
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/table.css">
		<script src="js/main.js" ></script>
		
		
	</head>
	<script src="include/sorttable.js"></script>
	<body>
		<div id="navigation_container">
			<?PHP include './menu.php' ?>
		</div>
			
		<table  class="sortable">
				<thead>
					<tr>
						<th scope="col">Academic Year</th>
						<th scope="col">Term</th>
						<th scope="col">Last</th>
						<th scope="col">First</th>
						<th scope="col">Major</th>
						<th scope="col">Level</th>
						<th scope="col">Degree</th>
						<th scope="col">add</th>
					</tr>
				</thead>
			<?PHP 
				/* Or you can use a simple "Previous | Next" listing if you don't want the numeric page listing */
				$next_prev = $p->nextPrev($_GET['page'], $pages); 
				echo "<div id='division'>" . $next_prev .  " </div>";
				/* From here you can do whatever you want with the data from the $result link. */
				
				while($row = mysql_fetch_assoc($result)){
					$num_rows++;?>
				<tr>
					<td>
						<?PHP echo $row['academicyear']?>
					</td>
					<td>
						<?PHP echo $row['term'] ?>
					</td>
					<td>
						<?PHP echo $row['last'] ?>
					</td>
					<td>
						<?PHP echo $row['first'] ?>
					</td>
					<td>
						<?PHP echo $row['major'] ?>
					</td>
					<td>
						<?PHP echo $row['level'] ?>
					</td>
					<td>
						<?PHP echo $row['degree'] ?>
					</td>
					<td>
					<?PHP //search if the user has already been added to the system.
						  //if so, then do not show the add button?>
							<input type="submit" name="addUser" onclick="<?PHP=$configSite->addUser(); ?>" value="Add"/>
					<?PHP ?>
					</td>
				</tr>
				<?PHP } ?>
		</table>
		<div>
			<?PHP include './footer.php'; ?>
		</div>
	</body>
</html>