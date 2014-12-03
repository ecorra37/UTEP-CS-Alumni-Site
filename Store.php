<!DOCTYPE html>
  <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Alumni Website</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/main.css">
        <script src="js/main.js" ></script>



    </head>
    <body>
    <div id="navigation_container">
         <div class="rectangle">
        <ul id="navigation">

            <li><a href="index.php"><span id="highlight">Home</span></a></li>
            <li><a href="Store.php">Store</a></li>
            <li><a href="Find.php">Find Graduate</a></li>
            <li><a href="About.php">About Us</a></li>
                       <?php if ((isset($_SESSION['login_status']))) {
?>

            <li> <a href="loginprofile.php">Profile</a></li>
              <li> <a href="signout.php">Sign Out</a></li>
        </ul>
    </div>
<?php }
else {
	//do nothing
}
?>
</div>
    
    
    
		
		
        <div>
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
				$db = 'cs5339teamxfa14';
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
				<td><?php echo '<img src="img\\'.$row['item_pic'].'" heigth=80px  width=80px>';?></td>
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
        </div>
        
	</body>
</html>
