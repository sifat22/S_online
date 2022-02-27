<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/Brand.php'; ?>
<?php 

    $br=new Brand();
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $brandName=$_POST['brandName'];

        $addBrand=$br->addBrand($brandName);
    }


?>

<div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Brand</h2>
               <div class="block copyblock"> 
                   <!--add brand-->
                   <?php 
                    if(isset($addBrand)){
                        echo $addBrand;
                    }
                   ?>
                 <form action="brandadd.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" placeholder="Enter Brand Name..." name="brandName" class="medium" />
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