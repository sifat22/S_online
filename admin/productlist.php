<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Product.php' ?>
<?php include_once '../helpers/Format.php' ?>
<!--showing product-->
<?php

	$pro=new Product();
	$fm=new Format();
	

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th width="4%">SL</th>
					<th width="11%">Product Name</th>
					<th width="10%">Category</th>
					<th width="10%">Brand</th>
					<th width="20%">Description</th>
					<th width="5%">Price</th>
					<th width="10%">Image</th>
					<th width="7%">Type</th>
					<th width="8%">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				
				$getProduct=$pro->getAllProduct();
				if($getProduct){
					$i=0;
					while($result=$getProduct->fetch_assoc()){
						$i++;
				
				?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['productName']; ?></td>
					<td><?php echo $result['catName']; ?></td>
					<td> <?php echo $result['brandName']; ?></td>
					<td> <?php echo $fm->textShorten($result['body'],50); ?></td>
					<td>$<?php echo $result['price']; ?></td>
					<td><img src="<?php echo $result['image'] ?>" width="60px" height="40px" /></td>
					<td>
						 <?php 
						 if($result['type']==0){
							 echo "featured";
						 }else{
							 echo "genaral";
						 }
						 ?>
					</td>
					<td><a href="editproduct.php?productid=<?php echo $result['productId']; ?>">Edit</a> ||
					 <a onclick="return confirm('Are you sure to delete !')" href="?delproduct=<?php echo $result['productId']; ?>">Delete</a></td>
				</tr>
					<?php }}?>
				
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
