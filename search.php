<?PHP
	require_once("./include/db.php");
	if(isset($_POST['submitted'])){
		$info = $configSite->searchGrad();
	}
?>

<form name="searchGrad" action="<?php echo $configSite->GetSelfScript(); ?>" method="POST">
	<input type='hidden' name='submitted' id='submitted' value='1'/>
	<div>
		<span class='error'><?php echo $configSite->GetErrorMessage(); ?></span>
	</div>
	<input type="text" name="searchGrad" placeholder="Search Grads"><br>
	<input type="submit" name="submit" value="Search">
</form>

<?PHP if(isset($_POST['submitted'])){ ?>
<table>
	<thead>
		<td>
			test
		</td>
		<td>
			test2
		</td>
		<td>
			test3
		</td>
		<td>
			test4
		</td>
		<td>
			test5
		</td>
	</thead>
	<?PHP while($row = mysql_fetch_assoc($info)){?>
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
	</tr>
	<?PHP } ?>
		
		
	<?PHP	}?>
</table>