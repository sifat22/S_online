<!--header-->

<?php include 'inc/header.php' ;?>
<!--Delete cart -->
<?php
if(isset($_GET['delcart'])){
	$delcartid=$_GET['delcart'];
	$delcart=$cart->deletCartById($delcartid);
}

?>
<!--update cart quantity-->
<?php 

if($_SERVER['REQUEST_METHOD']=='POST'){
	$cartId=$_POST['cartId'];
	$quantity=$_POST['quantity'];
	   
	$updatecart=$cart->updateCartById($cartId,$quantity);
	if($quantity <=0){
		$delcart=$cart->deletCartById($cartId);
	}
}

?>
<!--for rerloading the page-->
<?php
if(!isset($_GET['id'])){
	echo "<meta http-equiv='refresh' content='0;URL=?id=live'/>";
}

?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
					<h2>Your Cart</h2>
					<!--Delet Cart-->
					<?php
					
					if(isset($delcart)){
						echo $delcart;
					}
					
					?>
					<!--update cart quantity-->
					<?php
					
					if(isset($updatecart)){
						echo $updatecart;
					}
					
					?>
						<table class="tblone">
							<tr>
								<th width="5%">SL</th>
								<th width="20%">Product Name</>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="15%">Quantity</th>
								<th width="15%">Total Price</th>
								<th width="10%">Total Product</th>
								<th width="10%">Action</th>
							</tr>
							<!--show product in the cart-->
							<?php
							$showProduct=$cart->showAllProduct();
							if($showProduct){
								$i=0;
								$qty=0;
								$sum=0;
								while($result=$showProduct->fetch_assoc()){
									$i++;
							
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName'];  ?></td>
								<td><img src="admin/<?php echo $result['image'];  ?>" alt=""/></td>
								<td>$<?php echo $result['price'];  ?></td>
								<td>
									<form action="" method="post">

										<input type="hidden" name="cartId" value="<?php echo $result['cartId']; ?>"/>
										<input type="number" name="quantity" value="<?php echo $result['quantity']; ?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<!--totalprice-->
								<td>$
									<?php
									$total=$result['price']*$result['quantity'];
									echo $total;  
									
									?>
								</td>
								<!--totalproduct-->
								<td>$
									<?php
									$totalProduct=$result['quantity'];
									echo $totalProduct;  
									
									?>
								</td>
								<td><a onclick="return confirm('Are you sure to Remove Cart !')"
								 href="?delcart=<?php echo $result['cartId']; ?>">X</a></td>
							</tr>

							<?php
							$sum=$sum+$total;
							$qty=$qty+$totalProduct;


							//show total in the header
							Session::set("sum",$sum);
							Session::set("qty",$qty);
						
							?>
								<?php } } ?>
						
						</table>
					<!--checking that you have data in you cart or empty-->
					<?php 
					
									$getdata=$cart->chkCartTable();
									if($getdata){
									
					
					?>
						
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td>$<?php echo $sum; ?></td>
							</tr>
							<tr>
								<th>Total Product : </th>
								<td>$<?php echo $qty; ?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>$<?php
									$vat=$sum*0.1;
									$grand_total=$vat+$sum;
									echo $grand_total;
								?></td>
							</tr>
					   </table>
						
									<?php }else{
										header("Location:index.php");
										//echo "Cart Empty !Please shop Now";
									} ?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

 <!--footer-->

<?php include 'inc/footer.php' ;?>
