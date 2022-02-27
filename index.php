<!--header-->

<?php include 'inc/header.php' ;?>
<!--slider-->

<?php include 'inc/sidebar.php' ;?>


 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
			  <!--show Featured product-->
		  <?php 
		  
		  $getFeaturedProduct=$pro->getFeaturedProduct();
		  if($getFeaturedProduct){
			  while($result=$getFeaturedProduct->fetch_assoc()){

			
		 
		 ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?productid=<?php echo $result['productId']; ?>"><img src="admin/<?php echo $result['image']; ?>" height="80px" alt="" /></a>
					 <h2><?php echo $result['productName']; ?> </h2>
					 <p><?php echo $fm->textShorten($result['productName'],60); ?></p>
					 <p><span class="price">$<?php echo $result['price']; ?></span></p>
				     <div class="button"><span><a href="details.php?productid=<?php echo $result['productId']; ?>" height="80px"  class="details">Details</a></span></div>
				</div>
			  <?php } } ?>
				
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
				<!--show New product-->
			<?php 
		    
		  $getNewdProduct=$pro->getNewProduct();
		  if($getNewdProduct){
			  while($result=$getNewdProduct ->fetch_assoc()){

			
		 
		 ?>
				<div class="grid_1_of_4 images_1_of_4">
				<a href="details.php?productid=<?php echo $result['productId']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
				<h2><?php echo $result['productName']; ?> </h2>
				<p><span class="price">$<?php echo $result['price']; ?></span></p>
				     <div class="button"><span><a href="details.php?productid=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
				</div>
				<?php } } ?>
				
			</div>
    </div>
 </div>


 <!--footer-->

<?php include 'inc/footer.php' ;?>
	

