<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php' ?>
<!--showing Brand-->
<?php 

    $br=new Brand();
    ///delete brand
    if(isset($_GET['delbrand'])){
		$id=$_GET['delbrand'];
		$delbrand=$br->delbrandById($id);
	}
	

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Brand List</h2>
                <div class="block"> 
                    <!--delete brand-->
                    <?php 
                    
                        if(isset($delbrand)){
                            echo $delbrand;
                        }
                    
                    ?>  
					   
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Brand Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
                        <!--show Brand-->
                        <?php
						$showbrand=$br->getAllBrand();
						if($showbrand){
							$i=0;
							while($result=$showbrand->fetch_assoc()){
								$i++;

						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['brandName']; ?></td>
							<td><a href="brandedit.php?brandid=<?php echo $result['brandId']; ?>">Edit</a>
							 || <a onclick="return confirm('Are you sure to delete')"; href="?delbrand=<?php echo $result['brandId']; ?>">Delete</a></td>
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

