<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php
if(isset($_GET["id"])){
	$IdFromURL=$_GET["id"];
	$ConnectingDB;
$Query="DELETE FROM category WHERE id='$IdFromURL'";
$Execute=mysqli_query($Connection,$Query);
if($Execute){
			$_SESSION["SuccessMessage"]="Category Deleted Successfully";
	Redirect_to("Categories.php");	
		}else{
			$_SESSION["ErrorMessage"]="Something went wrong";
	Redirect_to("Categories.php");
	
		}
}
?>	