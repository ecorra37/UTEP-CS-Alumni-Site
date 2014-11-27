<?PHP
	require_once("./include/db.php");
	require_once("./include/pager.php");
	
	if($_GET['searchGrad'] !== NULL){
		$info = $configSite->searchGrad($_GET['searchGrad']);
		echo $info;
	}
	
	//PAGER
	//instantiation of class
	$p = new Pager;

	/* Show many results per page? */
	$limit = 20;

	/* Find the start depending on $_GET['page'] (declared if it's null) */
	$start = $p->findStart($limit);
	
	$dbh = mysql_connect ("localhost", "root", "sk@t3low1432") or die ('I cannot connect to the database because: ' . mysql_error());
	
	mysql_select_db("cs5339team9fa14");
	
	/* Find the number of rows returned from a query; Note: Do NOT use a LIMIT clause in this query */
	$count = mysql_num_rows(mysql_query("SELECT * FROM master")); 
	
	/* Find the number of pages based on $count and $limit */
	$pages = $p->findPages($count, $limit);
	
	$dbQuery = "SELECT * FROM master ORDER BY academicyear ASC LIMIT ". $start . ", " . $limit;
	
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
		<script src="js/main.js" ></script>
	</head>
	<body>
		<div id="navigation_container">
			<?PHP include './menu.php' ?>
		</div>
			
		<table>
			<thead>
				<td>Academic Year</td>
				<td>Term</td>
				<td>Last</td>
				<td>First</td>
				<td>Major</td>
				<td>Level</td>
				<td>Degree</td>
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
					  //if so, then do not show the add button
					if($configSite->alreadyAdded($row['last'], $row['first']) == NULL){?>
					<input type="submit" name="addUser" onclick="<?PHP $configSite->addUser();?>" value="Add">
				<?PHP }?>
				</td>
			</tr>
				<?PHP } ?>
		</table>
	</body>
</html>