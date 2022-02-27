<?php 
	include 'lib/Session.php'; 
    Session::init();

	include 'lib/Database.php';
	include 'helpers/Format.php';
	spl_autoload_register(function($class){
		include_once "classes/".$class.".php";
	});
	$db=new Database();
	$fm=new Format();
	$pro=new Product();
	$cart=new Cart();
	$cat=new Category();
	$customer=new Customer();

?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE HTML>
<head>
<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form>
				    	<input type="text" value="Search for Products" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit" value="SEARCH">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Cart</span>
								<span class="no_product">

  									<!--show  cart product-->
									  <?php 
									  
										  $getdata=$cart->chkCartTable();
								         if($getdata){
										  $sum=Session::get("sum");
										  $qty=Session::get("qty");
										  echo "$ ".$sum ." (". $qty.")";
											  }else{
												  echo "(Empty)";
											  }
									 
									 ?>
								</span>
							</a>
						</div>
				  </div>
				  <!--logout-->
				  <?php 
				  if(isset($_GET['cid'])){
					  $detdata=$cart->delCustomercart();
					  Session::destroy();
				  }
				 
				 
				 ?>
		 
				  <div class="login">
				  <?php 

				$login=Session::get("customerLogin");
				if($login==false){?>
					<a href="login.php">Login</a> 
				<?php }else{?>
					<a href="?cid=<?php  Session::get('cmrid'); ?>">Logout</a> 
			<?php	}

				?>
		   </div>
		 
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Home</a></li>
	  <li><a href="products.php">Products</a> </li>
	  <li><a href="topbrands.php">Top Brands</a></li>
	  <?php 
	 
		$chkcart=$cart->chkCartTable();
			if($chkcart){?>
			 <li><a href="cart.php">Cart</a></li>
			 <li><a href="payment.php">Payment</a></li>
		<?php	} ?>
	 ?>
	 <?php 
	 $id=Session::get("cmrId");
	 $getorder=$cart->getOrdereProduct($id);
		 if($getorder){?>
		  <li><a href="orderdetails.php">Order</a></li>
	 <?php	} ?>
  ?>
	 
	  <li>
	<?php 
		$login=Session::get("customerLogin");
		if($login==true){?>	  
	  <a href="profile.php">Profile</a>
	  <?php } ?>
	</li>
	  <li><a href="contact.php">Contact</a> </li>
	  <div class="clear"></div>
	</ul>
</div>