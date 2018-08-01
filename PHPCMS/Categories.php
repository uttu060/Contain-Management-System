<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php Confirm_Login(); ?>
<?php
if(isset($_POST["Submit"])){
$Category=($_POST["Category"]);
date_default_timezone_set("Asia/Kolkata");
$CurrentTime=time();
$DateTime=strftime("%Y-%m-%d %H:%M:%S", $CurrentTime);
$DateTime;
$Admin=$_SESSION["Username"];
if(empty($Category)){
	$_SESSION["ErrorMessage"]="All Fields must be filled out";
	Redirect_to("Categories.php");
	
}elseif(strlen($Category)>99){
	$_SESSION["ErrorMessage"]="Too long Name";
	Redirect_to("Categories.php");
}else{
		global $ConnectingDB;
		$Query="INSERT INTO category(datetime, name, creatorname)
		VALUES('$DateTime','$Category','$Admin')";
		$Execute=mysqli_query($Connection,$Query);
		if($Execute){
			$_SESSION["SuccessMessage"]="Category Added Successfully";
	Redirect_to("Categories.php");	
		}
}	
}
?>

<!DOCTYPE>


<html>
		<head>
				<title>Admin Dashboard</title>
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
			<li class="active"><a href="Categories.php">
			<span class="glyphicon glyphicon-tags"></span>
			Categories</a></li><br>
			<li><a href="Admins.php">
			<span class="glyphicon glyphicon-user"></span>
			Manage Admins</a></li><br>
			<li><a href="#">
			<span class="glyphicon glyphicon-comment"></span>
			Comments</a></li><br>
			<li><a href="BLog2.php">
			<span class="glyphicon glyphicon-equalizer"></span>
			Live Blog</a></li><br>
			<li><a href="Logout.php">
			<span class="glyphicons glyphicons-share"></span>
			Logout</a></li><br>
			</ul>
			
			
			</div> 
			<div class="col-sm-10">
			
			<h1>Manage Categories</h1>	
			<div><?php echo Message();
					echo SuccessMessage();
				?>
<div>
<form action="Categories.php" method="post">
	<fieldset>
		<div class="form-group">
		<label for="categoryname">Name:</label>
		<input class="form-control" type="text" name="Category" id="categoryname" placeholder="Name">
		</div>
		<br>
		<input class="btn btn-success"type="Submit" name="Submit" value="Add New Category">
		</fieldset>
		<br>
</form>	
</div>
<div class="table-responsive">
		<table class="table table-hover">
		<tr>
				<th>Sr No.</th>
				<th>Date & Time</th>
				<th>Category Name</th>
				<th>Creator Name</th>
				<th>Action</th>
		</tr>
<?php
global $ConnectingDB;
$ViewQuery="SELECT * FROM category ORDER BY datetime desc";
$Execute=mysqli_query($Connection,$ViewQuery);
$SrNo=0;		
while($DataRows=mysqli_fetch_array($Execute)){
		$Id=$DataRows["id"];
		$DateTime=$DataRows["datetime"];
		$CategoryName=$DataRows["name"];
		$CreatorName=$DataRows["creatorname"];
		$SrNo++;
?>	
<tr>
	<td><?php echo $SrNo; ?></td>
	<td><?php echo $DateTime; ?></td>
	<td><?php echo $CategoryName; ?></td>
	<td><?php echo $CreatorName; ?></td>
	<td><a href="DeleteCategories.php?id=<?php echo $Id;?>">
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