<?php include 'inc/header.php' ?>
<?php 

	$login=Session::get("customerLogin");
	if($login==false){
		header("Location:login.php");
	}

?>
<style>
    .payment{ width:500px;min-height: 200px;text-align: center;border: 1px solid #ddd; margin: 0 auto;
    padding: 50px;}
    .payment h2{border-bottom:1px solid #ddd;margin-bottom: 50px;
    padding-bottom:50px;}
    .payment a{background-color: #ff0000; color:#fff;font-size:25px;
    padding: 5px 30px;border-radius:3px ;}
    .back a{width:160px;margin: 0 auto;padding:7px 0;
    text-align: center; display: block;background-color: #555;border:1px solid #fff;
    border-radius: 3px; color: #fff;font-size:25px;margin-bottom: 80px;}
</style>

 <div class="main">
    <div class="content">
    	<div class="section group">
           <div class="payment">
               <h2>Chhose Payment Option</h2>
               <a href="paymentoffline.php">Offline Payment</a>
               <a href="paymentonline.php">Online Payment</a>
           </div>
           <div class="back">
               <a href="cart.php">Previous</a>
           </div>
    	</div>
 	</div>
</div>
<?php include 'inc/footer.php' ?>