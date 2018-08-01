<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>

	
	




<!DOCTYPE>


<html>


		<head>
		
				<title>Password Reset</title>
				<link rel="stylesheet" href= "css/bootstrap.min.css">
				<script src="js/jquery-3.3.1.min.js"></script>
				<script src="js/bootstrap.min.js"></script>
				<link rel="stylesheet" href= "css/adminstyle.css">
	
		
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
				<h1 style="color:white"><marquee>Password Reset!</marquee></h1>
				
<div>
<form action="forgot.php" method="post">
	<fieldset>
		<div class="form-group">
		
		<label for="Email">Email</label>
		<div class="input-group input-group-lg">
		<span class="input-group-addon">
		<span class="glyphicon glyphicon-envelope text-primary"></span>
		</span>
		<input class="form-control" type="email" name="Email" id="email" placeholder="@gmail.com">
		</div>
		
		</div>
		
		<br>
		<input class="btn btn-Warning"type="Submit" name="Submit" value="Submit">
		<br><br>
		 <a href="Login.php"><input class="btn btn-Success" type="button" name="Back To Home" value=" <- Back To Login"></a>
		</fieldset>
		<br>
</form>	

	</div>
	</div>
	</div>

		
		</body>
</html>		
 







