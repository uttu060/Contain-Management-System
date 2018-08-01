<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php
if(isset($_POST["Submit"])){
$Username=($_POST["Username"]);
$Password=($_POST["Password"]);
if(empty($Username)||empty($Password)){
	$_SESSION["ErrorMessage"]="All Fields must be filled out";
	Redirect_to("Login.php");
}
else{
		$Found_Account=Login_Attempt($Username,$Password);	
		$_SESSION["User_Id"]=$Found_Account["id"];
		$_SESSION["Username"]=$Found_Account["username"];
		if($Found_Account){
			$_SESSION["SuccessMessage"]="Welcome {$_SESSION["Username"]}";
			Redirect_to("Dashboard.php");
		}else{
			$_SESSION["ErrorMessage"]="Invalid Username or Password";
			Redirect_to("Login.php");
		}
			
		}
}

?>  

<!DOCTYPE>


<html>


		<head>
				<title>Manage Admins</title>
				<link rel="stylesheet" href= "css/bootstrap.min.css">
				<script src="js/jquery-3.3.1.min.js"></script>
				<script src="js/bootstrap.min.js"></script>
				<link rel="stylesheet" href= "css/login.css">
	
		
		</head>
		<style>
		body {
			background-image: url("image/login.jpg");
			background-size: contain;
			background-position: center;
			  background-repeat: repeat;
		}
		</style>
		<body>
		<div class="p">
		<div class="box"></div>
		
		
	<div class="container-fluid">
	<div class="row">
	
			
			<div class="col-sm-offset-4 col-sm-4">
		
			</div>
			<div>
			<br><br><br><br><br><br><br>
			<?php echo Message();
					echo SuccessMessage();
				?>
				<h1 style="color:white"><marquee>Welcome Back!</marquee></h1>
				
<div>
<form action="Login.php" method="post">
	<fieldset>
		<div class="form-group">
		
		<label for="Username">Username</label>
		<div class="input-group input-group-lg">
		<span class="input-group-addon">
		<span class="glyphicon glyphicon-envelope text-primary"></span>
		</span>
		<input class="form-control" type="text" name="Username" id="Username" placeholder="Username">
		</div>
		
		</div>
		<div class="form-group">
		<label for="Password">Password</label>
		<div class="input-group input-group-lg">
		<span class="input-group-addon">
		<span class="glyphicon glyphicon-envelope text-primary"></span>
		</span>
		<input class="form-control" type="Password" name="Password" id="Password" placeholder="Password">
		</div>
		
		<br>
		<input class="btn btn-warning"type="Submit" name="Submit" value="Login">
		
		<a href="forgot.php" style="color: #FFFFFF; font-size:15px; text-decoration: none"> Forget Password</a>
		</fieldset>
		<br>
		<fieldset style="text-align:center;">
		<a href="index.php"><input class="btn btn-Success" type="button" name="Back To Home" value=" <- Back To Home"></a>
		</fieldset>
		<br>
</form>	
		
	
	</div>
	</div>
	</div>

		
		</body>
</html>		