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
        <h2>Available Items For Sale:</h2>
		<table border='1'>
			<tr>
				<th>Product ID</th>
				<th>Category</th>
				<th>Product</th>
				<th>Description</th>
				<th>Price</th>
				<th>Picture</th>
				<th>Payment Method</th>
				
			</tr>
				<?php
				$db = 'cs5339teamxfa14';
				require('mysqli_con.php');
				$query 	= 'SELECT * FROM items ORDER BY category ASC';
				$result = mysqli_query($con,$query);
						$in_stock = 0;
				while($row =  mysqli_fetch_assoc($result)){
					if ($row['quantity']>0){
						$in_stock = 0;
				?>
			<tr>
				<td><?php echo $row['item_id']?></td>
				<td><?php echo $row['category']?></td>
				<td><?php echo $row['product_name']?></td>
				<td><?php echo $row['description']?></td>
				<td><?php echo '$'.$row['price']?></td>
				<td><?php echo '<img src="tmp\\'.$row['item_pic'].'" heigth=100px  width=100px>';?></td>
				<td><?php echo $row['pymt_method']?></td>
			</tr>
				<?php
					++$in_stock;
					}
				}
				$out_of_stock = (4-$in_stock);
				echo '<span style="color:red;"><b>'.$out_of_stock.'</b> item(s) out of stock. Sorry!</span>';
				?>
		</table>
				<?php 
				echo '<br>';
				echo($in_stock == 0 ? '<span style="color:red;">"ALL ITEMS FOR SALE ARE <u>OUT OF STOCK</u>. SORRY FOR THE INCONVENIENCE!"</span>' : NULL);
				?>
        </div>
        
	</body>
</html>
