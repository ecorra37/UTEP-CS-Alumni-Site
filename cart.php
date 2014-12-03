<!DOCTYPE html>
<html>
	<head>
	    <title>Purchase Items</title>
		<!--    <link rel="stylesheet" type="text/css" href="social_network.css"/>     -->
    </head>
	<body>
		<h2>Items for sale:</h2>
		<table border='1'>
			<tr>
				<th>Product ID</th>
				<th>Category</th>
				<th>Product</th>
				<th>Description</th>
				<th>Price</th>
				<th>Picture</th>
				
			</tr>
				<?php
				$db = 'f14';
				require('mysqli_con.php');
				$query 	= 'SELECT * FROM items ORDER BY category ASC';
				$result = mysqli_query($con,$query);
				while($row =  mysqli_fetch_assoc($result)){
				?>
			<tr>
				<td><?php echo $row['item_id']?></td>
				<td><?php echo $row['category']?></td>
				<td><?php echo $row['product_name']?></td>
				<td><?php echo $row['description']?></td>
				<td><?php echo '$'.$row['price']?></td>
				<td><?php echo '<img src="tmp\\'.$row['item_pic'].'" heigth=70px  width=70px>';?></td>
				<td><form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="hosted_button_id" value="TZ4CXKB7DJARU">
						<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" width='100' height='30' border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
						<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</form>
				</td>
			</tr>
				<?php
				}
				?>
		</table>
	</body>
</html>
