<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php' ?>
<!--showing category-->
<?php 

	$cat=new Category();
	//delete cetgory
	if(isset($_GET['catdelid'])){
		$id=$_GET['catdelid'];
		$delcat=$cat->delCatById($id);
	}

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">   
					<!--delete category-->
					<?php 
					if(isset($delcat)){
						echo $delcat;
					}
					?>     
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<!-- showing category-->
					<?php 
					
						$getCat=$cat->getAllCat();
						if($getCat){
							$i=0;
							while($result=$getCat->fetch_assoc()){
								$i++;
						
					
					?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['catName']; ?></td>
							<td><a href="catedit.php?catid=<?php echo $result['catId']; ?>">Edit</a> ||
							 <a onclick="return confirm('Are you sure to delete!')" href="?catdelid=<?php echo $result['catId']; ?>">Delete</a></td>
						</tr>
							<?php } }else{
								$msg="No Category Found !!";
								return $msg;
							} ?>
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

