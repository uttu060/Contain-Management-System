<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php require_once("Include/DB.php"); ?>
<?php Confirm_Login(); ?>
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
	<div class="container-fluid">
	<div class="row">
	
			<div class="col-sm-2">
			<br><br>
			<ul id="Side_Menu" class="nav flex-column">
			<li class="active"><a href="Dashboard.php">
			<span class="glyphicon glyphicon-home">Dashboard</span>
			</a></li><br><br>
			<li><a href="AddNewPost.php">
			<span class="glyphicon glyphicon-list-alt">Add New Post</span></a></li>
			<br><br>
			<li><a href="Categories.php">
			<span class="glyphicon glyphicon-tags">Categories</span>
			</a></li><br><br>
			<li><a href="Admins.php">
			<span class="glyphicon glyphicon-user">Manage Admins</span>
			</a></li><br><br>
			<li><a href="#">
			<span class="glyphicon glyphicon-comment">Comments</span>
			</a></li><br><br>
			<li><a href="BLog2.php">
			<span class="glyphicon glyphicon-envelope">Live Blog</span>
			</a></li><br><br>
			<li><a href="Logout.php">
			<span class="glyphicons glyphicons-share">Logout</span>
			</a></li><br>
			</ul>
			
			
			</div> 
			<div class="col-sm-10">
			<div><?php echo Message();
					echo SuccessMessage();
				?></div>		
			<h1>Admin Dashboard</h1>	
			<div class="table-responsive">
				<table class="table table-striped table-hover">
					<tr>
						<th>No.</th>
						<th>Post Title</th>
						<th>Date & Time</th>
						<th>Author</th>
						<th>Category</th>
						<th>Banner</th>
						<th>Comments</th>
						<th>Action</th>
						<th>Details</th>
						
					</tr>
		<?php
		$ConnectingDB;
		$ViewQuery="SELECT * FROM admin_panel ORDER BY datetime desc;";
		$Execute=mysqli_query($Connection,$ViewQuery);
		$SrNo=0;
		while($DataRows=mysqli_fetch_array($Execute)){
				$Id=$DataRows["id"];
				$DateTime=$DataRows["datetime"];
				$Title=$DataRows["title"];
				$Category=$DataRows["category"];
				$Admin=$DataRows["author"];
				$Image=$DataRows["image"];
				$Post=$DataRows["post"];
				$SrNo++;
		?>			
				<tr>
				
				<td><?php echo $SrNo; ?></td>
				<td style="color: #0000A0;"><?php
					if(strlen($Title)>20){$Title=substr($Title,0,20).'..';}
				echo $Title;  
				?></td>
				<td><?php
		            if(strlen($DateTime)>11){$DateTime=substr($DateTime,0,11);}
				echo $DateTime; 
				?></td>
				<td><?php echo $Admin; ?></td>
				<td><?php echo $Category; ?></td>
				<td><img src="Upload/<?php echo $Image; ?>" width="80px"; height="60px"></td>
				<td>Processing</td>
				<td>
				<a href="EditPost.php?Edit=<?php echo $Id; ?>">
				<span class="btn btn-warning">Edit</span>
				</a> 
				<a href="DeletePost.php?Delete=<?php echo $Id; ?>"> 
				<span class="btn btn-danger">Delete</span>
				</a>
				</td>
				<td>
				<a href="FullPost.php?id=<?php echo $Id; ?>" target="_blank">
				<span class="btn btn-primary">Live Preview</span>
				</a>
				</td>
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