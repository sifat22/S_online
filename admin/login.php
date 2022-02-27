<?php include '../classes/AdminLogin.php'; ?>
<!--creating object for adminLogin.php class-->
<?php 
$al=new Adminlogin();
if($_SERVER['REQUEST_METHOD']=='POST'){
	$adminUser=$_POST['adminUser'];
	$adminPass=md5($_POST['adminPass']);

	$loginchk=$al->adminLogin($adminUser,$adminPass);
}

?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Admin Login</title>


</span>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<span style="color:red;font-size:18px">

			<!--admin_login-->
			<?php 

			if(isset($loginchk)){
				echo $loginchk;
			}

			?>
					<div>
				<input type="text" placeholder="Username"  name="adminUser"/>
			</div>
			<div>
				<input type="password" placeholder="Password"  name="adminPass"/>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>