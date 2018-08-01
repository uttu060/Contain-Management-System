<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php Confirm_Login(); ?>
<?php
if(isset($_POST["Submit"])){
$Title=($_POST["Title"]);
$Category=($_POST["Category"]);
$Post=($_POST["Post"]);
date_default_timezone_set("Asia/Kolkata");
$CurrentTime=time();
$DateTime=strftime("%Y-%m-%d %H:%M:%S", $CurrentTime);
$DateTime;
$Admin="Uttaran Dey";
$Image=$_FILES["Image"]['name'];
$Target="Upload/".basename($_FILES["Image"]['name']);
if(empty($Title)){
	$_SESSION["ErrorMessage"]="Title can't be empty";
	Redirect_to("AddNewPost.php");
	
}elseif(strlen($Title)<2){
	$_SESSION["ErrorMessage"]="Title should be at-least 2 charecters";
	Redirect_to("AddNewPost.php");
}else{
		global $ConnectingDB;
		$DeleteFromURL=$_GET['Delete'];
		$Query="DELETE FROM admin_panel WHERE id='$DeleteFromURL'";

		
		$Execute=mysqli_query($Connection,$Query);
		move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);
		if($Execute){
			$_SESSION["SuccessMessage"]="Post Deleted Successfully";
	Redirect_to("Dashboard.php");	
		}else{
		if($Execute){
			$_SESSION["ErrorMessage"]="Something Went Wrong";
	Redirect_to("Dashboard.php");		
		}		
}	
}
}
?>

<!DOCTYPE>


<html>
		<head>
				<title>Delete Post</title>
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
			<li class="active"><a href="AddNewPost.php">
			<span class="glyphicon glyphicon-list-alt"></span>
			Add New Post</a></li><br>
			<li><a href="Categories.php">
			<span class="glyphicon glyphicon-tags"></span>
			Categories</a></li><br>
			<li><a href="#">
			<span class="glyphicon glyphicon-user"></span>
			Manage Admins</a></li><br>
			<li><a href="#">
			<span class="glyphicon glyphicon-comment"></span>
			Comments</a></li><br>
			<li><a href="#">
			<span class="glyphicon glyphicon-equalizer"></span>
			Live Blog</a></li><br>
			<li><a href="#">
			<span class="glyphicons glyphicons-share"></span>
			Logout</a></li><br>
			</ul>
			
			
			</div> 
			<div class="col-sm-10">
			
			<h1>Delete Post</h1>	
			<div><?php echo Message();
					echo SuccessMessage();
				?>
<div>
		<?php
		$SearchQueryParameter=$_GET['Delete'];
		$ConnectingDB;
		$Query="SELECT * FROM admin_panel WHERE id='$SearchQueryParameter'";
		$ExecuteQuery=mysqli_query($Connection,$Query);
		while($DataRows=mysqli_fetch_array($ExecuteQuery)){
				$TitleToBeUpdated=$DataRows['title'];
				$CategoryToBeUpdated=$DataRows['category'];
				$ImageToBeUpdated=$DataRows['image'];
				$PostToBeUpdated=$DataRows['post'];
			
		}
		
		
		?>
<form action="DeletePost.php?Delete=<?php echo $SearchQueryParameter; ?>" method="post" enctype="multipart/form-data">
	<fieldset>
		<div class="form-group">
		<label for="title">Title:</label>
		<input value="<?php echo $TitleToBeUpdated; ?>" class="form-control" type="text" name="Title" id="title" placeholder="Title">
		</div>
		<div class="form-group">
		<span class="FieldInfo"> Previous Category: </span>
		<?php echo $CategoryToBeUpdated;?>
		<br>
		<label for="categoryselect"><span class="FieldInfo">Category:</span></label>
		<select class="form-control" id="categoryselect" name="Category">
		<?php
global $ConnectingDB;
$ViewQuery="SELECT * FROM category ORDER BY datetime desc";
$Execute=mysqli_query($Connection,$ViewQuery);
while($DataRows=mysqli_fetch_array($Execute)){
		$Id=$DataRows["id"];
		$CategoryName=$DataRows["name"];	
?>	
		<option><?php echo $CategoryName ?></option>
<?php } ?>

		</select>
		</div>
		<div class="form-group">
		<span class="FieldInfo"> Previous Image: </span>
		<img src="Upload/<?php echo $ImageToBeUpdated;?>" width=120px; height=50px;>
		<br>
		<label for="imageselect"><span class="FieldInfo">Select Image:</span></label>
		<input type="File" class="form-control" name="Image" id="imageselect">
		</div>
		<div class="form-group">
		<label for="postarea">Post:</label>
		<textarea class="form-control" name="Post" id="postarea">
			<?php echo $PostToBeUpdated; ?>
		</textarea>
		</div>
		<br>
		<input class="btn btn-danger"type="Submit" name="Submit" value="Delete Post">
		</fieldset>
		<br>
</form>	
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