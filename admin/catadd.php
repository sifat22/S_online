<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Category.php'; ?>
<!--cerating object for ctegory-->
<?php 
    $cat=new Category();
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $catName=$_POST['catName'];

        $addCat=$cat->addCat($catName);
    }



?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>
               <div class="block copyblock"> 
                   <?php 
                   
                    if(isset($addCat)){
                        echo $addCat;
                    }
                   
                   ?>
                 <form action="catadd.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" placeholder="Enter Category Name..." name="catName" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>