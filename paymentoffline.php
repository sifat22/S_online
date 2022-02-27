<?php include 'inc/header.php' ?>
<!--user order is auto insert by customer id-->
<?php 

if(isset($_GET['orderid']) && $_GET['orderid']=='order'){
    $id=Session::get("cmrid");
    $insertOrder=$cart->OrderProduct($id);
    $detdata=$cart->delCustomercart();
    header("Location:sucess.php");
}

?>
<style>
    .division{width:50%;float:left}
    .tblone{width:500px;margin:0 auto;border:2px solid #ddd;}
    .tblone tr td{text-align: justify;}
    .tbltwo{float:right;text-align:left; width:"50%";border:2px solid #ddd;
    margin-right:40px;margin-top:10px;}
    .tbltwo tr td{text-align: justify; padding: 5px 10px;}
    .ordernow a{width:200px;margin:20px auto 10px;text-align:center;
    padding:5px;font-size:30px;display: block;background:#ff0000;
    color: #fff;border-radius: 3px;}
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
            <div class="division">
            <table class="tblone">
							<tr>
								<th>SL</th>
								<th>Product Name</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Total</th>
								
								
							</tr>
							<!--show product in the cart-->
							<?php
							$showProduct=$cart->showAllProduct();
							if($showProduct){
								$i=0;
								$qty=0;
								$sum=0;
								while($result=$showProduct->fetch_assoc()){
									$i++;
							
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName'];  ?></td>
                                <td>$<?php echo $result['price'];  ?></td>
                                <td><?php echo $result['quantity'];  ?></td>
								
								<!--totalprice-->
								<td>$
									<?php
									$total=$result['price']*$result['quantity'];
									echo $total;  
									
									?>
								</td>
							</tr>

							<?php
							$sum=$sum+$total;
							


							
						
							?>
								<?php } } ?>
						
						</table>
					
						
						<table class="tbltwo" >
							<tr>
                                <td>Sub Total  </td>
                                <td>:</td>
								<td>$<?php echo $sum; ?></td>
							</tr>
							<tr>
                                <td>VAT  </td>
                                <td>:</td>
								<td>10%</td>
							</tr>
							<tr>
                                <td>Grand Total </td>
                                <td>:</td>
								<td>$<?php
									$vat=$sum*0.1;
									$grand_total=$vat+$sum;
									echo $grand_total;
								?></td>
							</tr>
                       </table>
                                    
            </div>
            <div class="division">
                 <!--show customer data-->
            <?php 
            
            $id=Session::get("cmrid"); 
            $getdata=$customer->getCustomerdata($id); 
            if($getdata){
                while($result=$getdata->fetch_assoc()){

             
         
         ?>
         <table class="tblone">
             <tr>
                 <td width="20%">Name</td>
                 <td width="5%">:</td>
                 <td><?php echo $result['name']; ?></td>
             </tr>
             <tr>
                 <td>Phone</td>
                 <td>:</td>
                 <td><?php echo $result['phone']; ?></td>
             </tr>
             <tr>
                 <td>Email</td>
                 <td>:</td>
                 <td><?php echo $result['email']; ?></td>
             </tr>
             <tr>
                 <td>Address</td>
                 <td>:</td>
                 <td><?php echo $result['address']; ?></td>
             </tr>
             <tr>
                 <td>City</td>
                 <td>:</td>
                 <td><?php echo $result['city']; ?></td>
             </tr>
             <tr>
                 <td>Zip-Code</td>
                 <td>:</td>
                 <td><?php echo $result['zip_code']; ?></td>
             </tr>
             <tr>
                 <td>Country</td>
                 <td>:</td>
                 <td><?php echo $result['country']; ?></td>
             </tr>
         </table>
                <?php } } ?>
            </div>
    	</div>
     </div>
     <div class="ordernow">
         <a href="?orderid=order">Order</a>
     </div>
</div>
<?php include 'inc/footer.php' ?>