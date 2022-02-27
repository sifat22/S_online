<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php'; ?>
<?php 
//edit category
    if(!isset($_GET['catid']) || $_GET['catid']==NULL){
        echo "<script>window.location='catlist.php';</script>";
    }else{
        $id=$_GET['catid'];
    }
    $cat=new Category();
    ///update category
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $catName=$_POST['catName'];
        $updatecat=$cat->updateCat($catName,$id);
    }

?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock">
                   <!--update Category-->
                   <?php 
                        if(isset($updatecat)){
                            echo $updatecat;
                        }
                   ?>
                   <!--edit category-->
                   <?php 
                   
                        $geteditcat=$cat->getEditCatById($id);
                        if($geteditcat){
                            while($result=$geteditcat->fetch_assoc()){

                         
                   
                   ?> 
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catName" value="<?php echo $result['catName']; ?>" class="medium" />
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