<?php include 'inc/header.php'; ?>
<?php 

	$login=Session::get("customerLogin");
	if($login==false){
		header("Location:login.php");
	}

?>

<!--confirming the product-->
<?php 

	if(isset($_GET['shiftId'])){
		$id=$_GET['shiftId'];
		$price=$_GET['price'];
		$time=$_GET['time'];
		$confirmProduct=$cart->confirmedProduct($id,$price,$time);
	}
	?>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="order">
				<h2>Your Order Details</h2>
				
				<?php 
				
					if(isset($confirmProduct)){
						echo $confirmProduct;
					}
					?>
                <table class="tblone">
							<tr>
								<th>No.</th>
								<th>Product Name</>
								<th>Image</th >
								<th>Quantity</th>
                                <th>Total Price</th>
                                <th>Order Date</th>
                                <th>Status</th>
								<th>Action</th>
							</tr>
							<!--show product in the cart-->
                            <?php
                            $id=Session::get("cmrid");
							$getorder=$cart->getOrdereProduct($id);
							if($getorder){
								$i=0;
								while($result=$getorder->fetch_assoc()){
									$i++;
							
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName'];  ?></td>
								<td><img src="admin/<?php echo $result['image'];  ?>" alt=""/></td>
								<td><?php echo $result['quantity'];  ?></td>
								<td>$
									<?php echo $result['price'];   ?>
                                    
                                    <td><?php echo $fm->formatDate($result['date']);  ?></td>
									<td>
                                    <?php 
                                    
                                        if($result['status']==0){
                                            echo "pending";
                                        }elseif($result['status']=='1'){?>
											<a href="?shiftId=<?php echo $id ?>&
											price=<?php echo $result['price']; ?> & time=<?php echo $result['date']; ?>">Shifted</a>
										<?php }else{
											echo "confirmed";
										}
                                    
                                    ?></td>
                                    <?php 
                                    
                                        if($result['status']==2){?>
                                            <td><a onclick="return confirm('Are you sure to Remove Cart !')"
								             href="?delcart=<?php echo $result['cartId']; ?>">X</a></td>


                                    <?php    }else{?>
                                        <td>N/A</td>
                              <?php      }?>

                                    
                                
                                   
								
							</tr>

							
								<?php } } ?>
						
						</table>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>