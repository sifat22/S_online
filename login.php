<?php include 'inc/header.php' ?>
<!--user access-->
<?php 

	$login=Session::get("customerLogin");
	if($login==true){
		header("Location:order.php");
	}

?>	
<!--Login-->
<?php

$pro=new Product();
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['login'])){
	$logincmr=$customer->customerLogin($_POST);
	
}


?>
 <div class="main">
    <div class="content">
    	 <div class="login_panel">
		 <?php 
			
			if(isset($logincmr)){
				echo $logincmr;
			}
			
			?>
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
        	<form action="" method="post">
                	<input name="email" placeholder="email" type="text">
                    <input name="password"placeholder="Password" type="password">
					<div class="buttons"><div><button class="grey" name=login>Sign In</button></div></div>
					</div>
            </form>
                    
					
					<!--add Customer-->
				<?php 

				$pro=new Product();
				if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['register'])){
					$addcustomer=$customer->addCustomer($_POST);
					
				}


				?>
    	<div class="register_account">
			<!--register-->
			<?php 
			
			if(isset($addcustomer)){
				echo $addcustomer;
			}
			
			?>
    		<h3>Register New Account</h3>
    		<form action="" method="post">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Enter your Name" >
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="Enter your City">
							</div>
							
							<div>
								<input type="text" name="zip_code" placeholder="Enter your Zip-Code">
							</div>
							<div>
								<input type="text" name="email" placeholder="Enter your E-mail">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Enter your Address">
						</div>
						<div>
							<input type="text" name="country" placeholder="Enter your Country">
						</div>    
	
		           <div>
		          <input type="text" name="phone" placeholder="Enter your Phone">
		          </div>


				  <div>
					<input style="	font-size:12px;
									color:#B3B1B1;
									padding:8px;
									outline:none;
									margin:5px 0;
									width:300px;" 
					type="password" name="password" placeholder="Enter your Password">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><button class="grey" name="register">Create Account</button></div></div>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 <?php include 'inc/footer.php' ?>