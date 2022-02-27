<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php'; ?>
<?php 
//edit Brand
    if(!isset($_GET['brandid']) || $_GET['brandid']==NULL){
        echo "<script>window.location='brandlist.php';</script>";
    }else{
        $id=$_GET['brandid'];
    }
    $br=new Brand();
     ///update Brand
     if($_SERVER['REQUEST_METHOD']=='POST'){
        $brandName=$_POST['brandName'];
        $updateBrand=$br->updateBrand($brandName,$id);
    }
   

?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock">
                   <!--update brand-->
                   <?php 
                   
                    if(isset($updateBrand)){
                        echo $updateBrand;
                    }
                   
                   ?>
                   <!--edit Brand-->
                   <?php 
                   
                        $getbrandid=$br->getEditBrandById($id);
                        if($getbrandid){
                            while($result=$getbrandid->fetch_assoc()){

                         
                   
                   ?> 
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brandName" value="<?php echo $result['brandName']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                            <?php } } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>