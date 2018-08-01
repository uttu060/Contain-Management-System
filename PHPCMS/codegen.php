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
				<script type="text/javascript">
				$(document).ready(function(){
					$(".maintenance").click(function(){
						$("#modal_r").show();
					});
					$("#close").click(function(){
						$("#modal_r").hide();
					});
				});
				</script>
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
    </ul>
    <form action="Blog2.php" class="navbar-form navbar-right">
	<div class="form-group">
	<input type="text" class="form-control" placeholder="Search" name="Search" >
	</div>
	<button class="btn btn-default" name="SearchButton">Go</button>
	</form>
</nav>
	<div style="height:60%">
		<h1 style="color:white;font-family:bitter;text-align:center;">Choose Network Type :</h1>
		<table align="center" width=75%>
		<tr align="center" style="height:140">
			<td bgcolor="#39BE7A">
			    <br><br>&ensp;<img src="image/wired.jpg" class="maintenance" height="200" width="200" style="border-radius:50%">&ensp;<br><br>
			    <font face="georgia" size=6>WIRED</font> <br> <font face="georgia" size=3></font><br><br>
			</td>
			<td bgcolor="#F36541">
			    <br><br>&ensp;<a href="wireless.php"><img src="image/wifi.png" height="200" width="200" style="border-radius:50%"></a>&ensp;<br><br>
			    <font face="georgia" size=6>WIRELESS</font> <br> <font face="georgia" size=3></font><br><br>
			</td>
			<td bgcolor="#8CBC42">
			    <br><br>&ensp;<a href="mixedinput.php"><img src="image/mixed.jpeg" height="200" width="200" style="border-radius:50%"></a>&ensp;<br><br>
			    <font face="georgia" size=6>MIXED</font> <br> <font face="georgia" size=3></font><br><br>
			</td>
		</tr>
	</table>
	</div>
<div  id='modal_r' class='modal_r' style="    width: 500px;
    height: 200px;
    /* border: 1px solid; */
    position: fixed;
    z-index: 100;
    top: 250px;
    left: 450px;
    background: #a52a2aa8;
    color: white;display:none;">
<br><br><h2 style="text-align:center;">Uh Oh!!</h2><h3 style="text-align:center;"> This Section is Under Maintenace!!!</h3>
<div style="text-align:center;"><input class="btn btn-Default" type="button" id="close" value="Close"></div>
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