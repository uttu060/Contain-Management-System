<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php Confirm_Login(); ?>
<?php
if(isset($_POST["Submit"])){
$Email=($_POST["Email"]);	
$Username=($_POST["Username"]);
$Password=($_POST["Password"]);
$ConfirmPassword=($_POST["ConfirmPassword"]);
date_default_timezone_set("Asia/Kolkata");
$CurrentTime=time();
$DateTime=strftime("%Y-%m-%d %H:%M:%S", $CurrentTime);
$DateTime;
$Admin=$_SESSION["Username"];
if(empty($Username)||empty($Password)||empty($ConfirmPassword)||empty($Email)){
	$_SESSION["ErrorMessage"]="All Fields must be filled out";
	Redirect_to("Admins.php");
	
}elseif(strlen($Password)<4){
	$_SESSION["ErrorMessage"]="Atleast 4 characters for password";
	Redirect_to("Admins.php");
}elseif($Password!==$ConfirmPassword){
	$_SESSION["ErrorMessage"]="Password does not match";
	Redirect_to("Admins.php");
}
else{
		global $ConnectingDB;
		$Query="INSERT INTO registration(datetime, email, username, password, addedby)
		VALUES('$DateTime','$Email','$Username','$Password','$Admin')";
		$Execute=mysqli_query($Connection,$Query);
		if($Execute){
			$_SESSION["SuccessMessage"]="Admin Added Successfully";
	Redirect_to("Admins.php");	
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
				<link rel="stylesheet" href= "css/adminstyle.css">
		
		</head>
		<body>
	<div class="container-fluid">
	<div class="row">
	
			<div class="col-sm-2">
			<h1>Uttaran</h1>
			<ul id="Side_Menu" class="nav flex-column">
			<li><a href="Dashboard.php">
			<span class="glyphicon glyphicon-th"></span>
			Dashboard</a></li><br>
			<li><a href="AddNewPost.php">
			<span class="glyphicon glyphicon-list-alt"></span>
			Add New Post</a></li><br>
			<li><a href="Categories.php">
			<span class="glyphicon glyphicon-tags"></span>
			Categories</a></li><br>
			<li class="active"><a href="Admins.php">
			<span class="glyphicon glyphicon-user"></span>
			Manage Admins</a></li><br>
			<li><a href="#">
			<span class="glyphicon glyphicon-comment"></span>
			Comments</a></li><br>
			<li><a href="Blog2.php">
			<span class="glyphicon glyphicon-equalizer"></span>
			Live Blog</a></li><br>
			<li><a href="Logout.php">
			<span class="glyphicons glyphicons-share"></span>
			Logout</a></li><br>
			</ul>
			
			
			</div> 
			<div class="col-sm-10">
			
			<h1>Manage Admin Access</h1>	
			<div><?php echo Message();
					echo SuccessMessage();
				?>
<div>
<form action="Admins.php" method="post">
	<fieldset>
		<div class="form-group">
		<label for="Email">Email</label>
		<input class="form-control" type="email" name="Email" id="Username" placeholder="@gmail.com">
		</div>
		<div class="form-group">
		<label for="Username">Username:</label>
		<input class="form-control" type="text" name="Username" id="Username" placeholder="Username">
		</div>
		<div class="form-group">
		<label for="Password">Password:</label>
		<input class="form-control" type="Password" name="Password" id="Password" placeholder="Password">
		</div>
		<div class="form-group">
		<label for="ConfirmPassword">Confirm Password:</label>
		<input class="form-control" type="Password" name="ConfirmPassword" id="ConfirmPassword" placeholder="ConfirmPassword">
		</div>
		<br>
		<input class="btn btn-success"type="Submit" name="Submit" value="Add New Admin">
		</fieldset>
		<br>
</form>	
</div>
<div class="table-responsive">
		<table class="table table-hover">
		<tr>
				<th>Sr No.</th>
				<th>Date & Time</th>
				<th>Email</th>
				<th>Admin Name</th>
				<th>Added By</th>
				<th>Action</th>
		</tr>
<?php
global $ConnectingDB;
$ViewQuery="SELECT * FROM registration ORDER BY datetime desc";
$Execute=mysqli_query($Connection,$ViewQuery);
$SrNo=0;		
while($DataRows=mysqli_fetch_array($Execute)){
		$Id=$DataRows["id"];
		$DateTime=$DataRows["datetime"];
		$Email=$DataRows["email"];
		$Username=$DataRows["username"];
		$Admin=$DataRows["addedby"];
		$SrNo++;
?>	
<tr>
	<td><?php echo $SrNo; ?></td>
	<td><?php echo $DateTime; ?></td>
	<td><?php echo $Email; ?></td>
	<td><?php echo $Username; ?></td>
	<td><?php echo $Admin; ?></td>
	<td><a href="DeleteAdmin.php?id=<?php echo $Id;?>">
	<span class="btn btn-danger">Delete</span></a></td>
</tr>	
		<?php } ?>
		</table>

</div>
	</div>
	</div>
	</div>
<div id="Footer">	
		<hr><p>Theme by | Uttaran Dey |&copy;2016-2020 --- All right reserved.
		</p>
		<a style="color: white; text-decoration:none; cursor:pointer; font-weight:bold;" href="http:// google.com"
		<p>
This site is only used for study purpose Uttaran.com have all the rights.no one is allow
copies other than <br>&trade; Uttaran.com &trade; NS3 ; &trade; Skillshare; &trade;
</a>
</div> <div style="height: 10px; backgorund:#27AAE1;"></div>
	
		
		</body>
</html>		