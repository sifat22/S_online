<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 

$filepath =realpath(dirname(__FILE__));
include_once ($filepath.'/../classes/Customer.php');
include_once ($filepath.'/../helpers/Format.php');


?>
<?php 
//edit category
    if(!isset($_GET['custId']) || $_GET['custId']==NULL){
        echo "<script>window.location='inbox.php';</script>";
    }else{
        $id=$_GET['custId'];
    }
   
    ///update category
    if($_SERVER['REQUEST_METHOD']=='POST'){
        echo "<script>window.location='inbox.php';</script>";
    }

?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Customer Details</h2>
               <div class="block copyblock">
                   
                   <!--get Customer-->
                   <?php 
                     $cust=new Customer();
                        $getCustomer=$cust->getCustomerdata($id);
                        if($getCustomer){
                            while($result=$getCustomer->fetch_assoc()){

                         
                   
                   ?> 
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>Name:</td>
                            <td>
                                <input type="text" readonly="readonly" name="catName" value="<?php echo $result['name']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                        <tr>
                            <td>City:</td>
                            <td>
                                <input type="text" readonly="readonly" name="catName" value="<?php echo $result['city']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                        <tr>
                            <td>Zip Code:</td>
                            <td>
                                <input type="text" readonly="readonly" name="catName" value="<?php echo $result['zip_code']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                        <tr>
                            <td>Email:</td>
                            <td>
                                <input type="text" readonly="readonly" name="catName" value="<?php echo $result['email']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                        <tr>
                            <td>Address:</td>
                            <td>
                                <input type="text" readonly="readonly" name="catName" value="<?php echo $result['address']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                        <tr>
                            <td>Country:</td>
                            <td>
                                <input type="text" readonly="readonly" name="catName" value="<?php echo $result['country']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Phone:</td>
                            <td>
                                <input type="text" readonly="readonly" name="catName" value="<?php echo $result['phone']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Ok" />
                            </td>
                        </tr>
                    </table>
                    </form>
                            <?php } } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>