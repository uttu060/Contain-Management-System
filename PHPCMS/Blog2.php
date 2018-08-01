<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<!DOCTYPE>

<html>
		<head>
				<title>Blog Page</title>
				<link rel="stylesheet" href= "css/bootstrap.min.css">
				<script src="js/jquery-3.3.1.min.js"></script>
				<script src="js/bootstrap.min.js"></script>
				<link rel="stylesheet" href= "css/publicstyles.css">
				<link rel="stylesheet" href= "css/adminstyle.css">
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
			<h1 class="lead">The Complete Responsive Blog</h1>
			</div>
			<div class="row">
				<div class="col-sm-10">
				<?php 
				//echo "ABCD";
				global $ConnectingDB;
				if(isset($_GET["SearchButton"])){
						$Search=$_GET["Search"];
				$ViewQuery="SELECT * FROM admin_panel
				WHERE datetime LIKE '%$Search%' OR title LIKE '%$Search%'
				OR category LIKE '%$Search%' OR post LIKE '%$Search%'";
				}else{
				$ViewQuery="SELECT * FROM admin_panel ORDER BY datetime desc";}
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
					<img src="Upload/<?php echo $Image; ?>" >
				<div class="captions">
						<h1 id="heading"> <?php echo htmlentities($Title); ?></h1>
				<p>Category:<?php echo htmlentities($Category);?> Published on
				<?php echo htmlentities($DateTime);?></p>	
				<p class="post"><?php
				if(strlen($Post)>200) {$Post=substr($Post,0,200).'...';}
				echo $Post; ?></p>
				</div>	
				<a href="FullPost.php?id=<?php echo $PostId; ?>"<span class="btn btn-info">
						Read More &rsaquo;
					</span></a>					
				
					
				</div>
				<?php } ?> 	
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