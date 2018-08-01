<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php
if(isset($_POST["Submit"])){
$Name=($_POST["Name"]);
$Email=($_POST["Email"]);
$Comment=($_POST["Comment"]);
date_default_timezone_set("Asia/Kolkata");
$CurrentTime=time();
$DateTime=strftime("%Y-%m-%d %H:%M:%S", $CurrentTime);
$DateTime;
$PostId=$_GET["id"];

if(empty($Name)||empty($Email)||($Comment)){
	$_SESSION["ErrorMessage"]="All fields are required";
	
}elseif(strlen($Comment)>500){
	$_SESSION["ErrorMessage"]="Only 500 words are allowed";
}else{
		global $ConnectingDB;
		$Query="INSERT into comments (datetime,name,email,comment,status)
		VALUES ('$DateTime','$Name','$Email','$Comment','OFF')";
		$Execute=mysqli_query($Connection,$Query);

		if($Execute){
			$_SESSION["SuccessMessage"]="Comment submitted Successfully";
	Redirect_to("FullPost.php?id={$PostId}");	
		}else{
		if($Execute){
			$_SESSION["ErrorMessage"]="Something Went Wrong";
		Redirect_to("FullPost.php?id={$PostId}");			
		}		
}	
}
}
?>
<!DOCTYPE>

<html>
		<head>
				<title>Full Blog Post</title>
				<link rel="stylesheet" href= "css/bootstrap.min.css">
				<script src="jquery-3.3.1.min.js"></script>
				<script src="js/bootstrap.min.js"></script>
				<link rel="stylesheet" href= "css/adminstyle.css">
				<link rel="stylesheet" href= "css/publicstyles.css">
		
				
		</head>
		<body>
<nav class="navbar navbar-inverse navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="https://www.nsnam.org/">
  <img src="image/ns3tcg.png" class="pic">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>
	 <?php if(Login()==true){?>
	  <li class="nav-item">
        <a class="nav-link" href="dashboard.php">Dashboard</a>
      </li>
	 <?php }
	 else{ ?>
	 <li class="nav-item">
        <a class="nav-link" href="dashboard.php">Expert's Login</a>
      </li>
	 <?php } ?>
      <li class="nav-item">
        <a class="nav-link" href="Blog2.php">Blog</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="codegen.php">Generate Code & Topology</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="https://www.nsnam.org/docs/tutorial/html/">Tutorial</a>
      </li>	  
	  <li class="nav-item">
        <a class="nav-link" href="aboutus.php">About Us</a>
      </li>
    </ul>
    <form action="Blog2.php" class="navbar-form navbar-right">
	<div class="form-group">
	<input type="text" class="form-control" placeholder="Search" name="Search" >
	</div>
	<button class="btn btn-default" name="SearchButton">Go</button>
	</form>
</nav>
		
	<div style="height: 10px; background: #27aae1;"></div>	
	<div class="container">
			<div class="blog-header">
			<h1>The Complete Responsive Blog</h1>
			<p class="lead">The Complete Blog Using PHP by Uttaran Dey</p>
			</div>
			<div class="row">
				<div class="col-sm-8">
				<?php 
				global $ConnectingDB;
				if(isset($_GET["SearchButton"])){
						$Search=$_GET["Search"];
				$ViewQuery="SELECT * FROM admin_panel
				WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search%'
				OR category LIKE '%$Search%' OR post LIKE '%$Search%'";
				}else{
						$PostIDFromURL=$_GET["id"];
					
				$ViewQuery="SELECT * FROM admin_panel WHERE id='$PostIDFromURL'
				ORDER BY datetime desc";}
				$Execute=mysqli_query($Connection,$ViewQuery);
				while($DataRows=mysqli_fetch_array($Execute)){
					$PostId=$DataRows["id"];
					$DateTime=$DataRows["datetime"];
					$Title=$DataRows["title"];
					$Category=$DataRows["category"];
					$Admin=$DataRows["author"];
					$Image=$DataRows["image"];
					$Post=$DataRows["post"];
				
				?>
				<div class="blogpost thumbnail">
					<img class="img-responsive img-rounded" src="Upload/<?php echo $Image; ?>">
				<div class="captions">
						<h1 id="heading"> <?php echo htmlentities($Title); ?></h1>
				<p>Category:<?php echo htmlentities($Category);?> Published on
				<?php echo htmlentities($DateTime);?></p>	
				<p class="post"><?php
				echo $Post; ?></p>
				</div>				
				</div>
				<?php } ?> 
				<br><br>
				<br><br>
				<span class="FieldInfo">Share your thoughts about this post</span>
				<br>
				<span class="FieldInfo">Comments</span>
<div>
<form action="FullPost.php?id=<?php echo $PostId; ?>" method="post" enctype="multipart/form-data">
	<fieldset>
		<div class="form-group">
		<label for="Name">Name:</label>
		<input class="form-control" type="text" name="Name" id="Name" placeholder="Name">
		</div>
		
		<div class="form-group">
		<label for="Email">Email:</label>
		<input class="form-control" type="email" name="Email" id="Email" placeholder="Email">
		</div>

		
		<div class="form-group">
		<label for="Commentarea">Comment:</label>
		<textarea class="form-control" name="Comment" id="Commentarea"></textarea>
		</div>
		<br>
		<input class="btn btn-primary"type="Submit" name="Submit" value="Submit">
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