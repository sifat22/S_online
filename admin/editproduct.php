<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Product.php'; ?>
<?php include '../classes/Category.php' ?>
<?php include '../classes/Brand.php' ?>
<!--Edit product-->
<?php
if(!isset($_GET['productid']) || $_GET['productid']==NULL){
    echo "<script>window.location='productlist.php'</script>";
}else{
    $productid=$_GET['productid'];
}

$product=new Product();

//update product
if($_SERVER['REQUEST_METHOD']=='POST'){
    
    $update_product=$product->productUpdate($_POST,$_FILES,$productid);
}

?>



<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block">    
                 <!--update product-->
        <?php 
        if(isset($update_product)){
            echo $update_product;
        }
        ?>

            <!--Edit Product-->
            <?php 
            
            $editProduct=$product->editProductByid($productid);
            if($editProduct){
                while($value=$editProduct->fetch_assoc()){

                 
           ?>
        
     
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
            <tr>
                <td>
                    <label>Name</label>
                </td>
                <td>
                    <input type="text" name="productName" value="<?php echo $value['productName']; ?>" class="medium" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Category</label>
                </td>
                <td>
                <select id="select" name="catId">
                    <option>Select Category</option>
                    <!--show category-->
                    <?php
                    $cat=new Category();
                    $show_cat=$cat->getAllCat();
                    if($show_cat){
                        while($result=$show_cat->fetch_assoc()){
                    
                    ?>
                                <!--Edit Product-->
                   <option

                   <?php
                   if($value['catId']==$result['catId']){?>
                    selected="Selected";
                 <?php   } ?> value="<?php echo $result['catId']; ?>"><?php echo $result['catName'] ?>
                    </option>
                  <?php } } ?>

                </select>
                 </td>
                </tr>
				<tr>
                <td>
                    <label>Brand</label>
                </td>
                <td>
                    <select id="select" name="brandId">
                        <option>Select Brand</option>
                        <!--show brand-->
                        <?php
                        $brand=new Brand();
                        $show_brand=$brand->getAllBrand();
                        if($show_brand){
                            while($result=$show_brand->fetch_assoc()){

            
                        ?>
                        <option
                        <?php
                   if($value['brandId']==$result['brandId']){?>
                    selected="Selected";
                 <?php   } ?> value="<?php echo $result['brandId']; ?>"><?php echo $result['brandName']; ?>
                </option>
                            <?php  }}?>
                    </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body">
                       <?php echo $value['body']; ?>
                        </textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $value['price']; ?>"  class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src="<?php echo $value['image']; ?>" height="80px";width="160px";/>
                        <input type="file" name="image" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <?php
                            if($value['type']==0){?>
                            <option selected="selected" value="0">Featured</option>
                            <option value="1">General</option>
                          <?php }  else{?>
                            <option value="0">Featured</option>
                            <option selected="selected" value="1">General</option>
                          <?php } ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
           <?php } } ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


