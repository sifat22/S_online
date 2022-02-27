<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 

	$filepath =realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/Cart.php');
	include_once ($filepath.'/../helpers/Format.php');
	$fm=new Format();
	$cart=new Cart();

?>

<!--shifting the product-->
<?php 

	if(isset($_GET['shiftId'])){
		$id=$_GET['shiftId'];
		$price=$_GET['price'];
		$shift=$cart->productShifted($id,$price);
	}

	///remove after shifted

	if(isset($_GET['delId'])){
		$id=$_GET['delId'];
		$price=$_GET['price'];
		$deleteorder=$cart->delshiftedProduct($id,$price);
	}

?>
        <div class="grid_10">
            <div class="box round first grid">
				<h2>Inbox</h2>
				<?php 
				
					if(isset($shift)){
						echo $shift;
					}

					if(isset($deleteorder)){
						echo $deleteorder;
					}
				
				?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Id</th>
							<th>Date & Time</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Address</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<!--get order message-->
						<?php 
					
						$getOrder=$cart->getAllOrderProduct();
						if($getOrder){
							while($result=$getOrder->fetch_assoc()){

						
						
						?>
						<tr class="odd gradeX">
							<td><?php echo $result['orderId']; ?></td>
							<td><?php echo $fm->formatDate($result['date']); ?></td>
							<td><?php echo $result['productName']; ?></td>
							<td><?php echo $result['quantity'] ?></td>
							<td><?php echo $result['price'] ?></td>
							<td><a href="Viewcustomer.php?custId=<?php echo $result['cmrId']?>">View Details</a></td>
							<?php 
							
								if($result['status']=='0'){?>
									<td><a href="?shiftId=<?php echo $result['cmrId'] ?>&
									price=<?php echo $result['price']; ?>">Shifted</a></td>
								<?php } elseif($result['status']=='1') {?>
									<td>pending</td>

									<?php }else{?>
									
										<td><a href="?delId=<?php echo $result['cmrId'] ?>&
									price=<?php echo $result['price']; ?>">remove</a></td>
									
									}
									
									
								<?php }?>

					
							
						
							
						</tr>
							<?php } } ?>
					</tbody> 
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
