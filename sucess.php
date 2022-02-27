<?php include 'inc/header.php' ?>
<?php 

	$login=Session::get("customerLogin");
	if($login==false){
		header("Location:login.php");
	}

?>
<style>
    .success{ width:500px;min-height: 200px;text-align: center;border: 1px solid #ddd; margin: 0 auto;
    padding: 50px;}
    .success h2{border-bottom:1px solid #ddd;margin-bottom: 50px;
    padding-bottom:50px;}
    .success p{line-height: 25px; font-size: 18px;}
</style>

 <div class="main">
    <div class="content">
    	<div class="section group">
           <div class="success">
               <h2>Sucess</h2>
               <?php
                $id=Session::get("cmrid");
                    $getAmount=$cart->payaableAmount($id);
                    if($getAmount){
                        $sum=0;
                        while($result=$getAmount->fetch_assoc()){
                            $price=$result['price'];
                            $sum=$sum+$price;
                        }
                    }
                    ?>
               <p>Total Payable amount(Includeing Vat) :$
                 
                   <?php 
                   $vat=$sum*0.1;
                   $total=$sum+$vat;
                   
                   echo $total;   ?>
                                
               </p>
               <p>Thanks For Puchase . Receive You Order Succesfully.We will contact
               you Asap with delivery details.Here is Your Order details.... <a href="orderdetails.php">
               Visit Here</a>  </p>
           </div>
           <div class="back">
               <a href="cart.php">Previous</a>
           </div>
    	</div>
 	</div>
</div>
<?php include 'inc/footer.php' ?>