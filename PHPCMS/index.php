<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php require_once("Include/DB.php");
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
<nav class="navbar navbar-inverse navbar-expand-lg navbar-dark bg-dark">
   <a class="navbar-brand" href="https://www.nsnam.org/">
  <img src="image/ns3tcg.png" class="pic">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
		<h1 style="color: deepskyblue;font-size: 40px;font-family: Times New Roman;">NS3 Topology & Code Generator</h1>
    </ul>
    <form action="Blog2.php" class="navbar-form navbar-right">
	<div class="form-group">
	<input type="text" class="form-control" placeholder="Search" name="Search" >
	</div>
	<button class="btn btn-default" name="SearchButton">Go</button>
	</form>
</nav>
		<table align="center" style="width:100%">
		<col width="100"> 
  		<col width="200">
		<col width="200">
  		<col width="200">
		<col width="200">
  		<col width="200">
		<tr style="height:380" align="center">
			<td ><img src="image/icon.png" class="icons"></td>
			<?php if(Login()==false){?>
			<td rowspan=2 bgcolor="#E16D99"><font face="georgia" color="#000000" size=4 style="color:white;"><a href="Dashboard.php"><img src="image/user_lock.png" height="200" width="200"></a><br><br>Expert's Login</font></td>
			<?php }
			else{ ?>
			<td rowspan=2 bgcolor="#E16D99"><font face="georgia" color="#000000" size=4 style="color:white;"><a href="Dashboard.php"><img src="image/user.png" height="200" width="200"></a><br><br>Dashboard</font></td>			
			<?php } ?>
			<td rowspan=2 bgcolor="#1EA908"><font face="georgia" color="#000000" size=4 style="color:white;"><a href="Blog2.php"><img src="image/blog_icon.png" height="200" width="200"></a><br><br>Blog</font></td>
			<td rowspan=2 bgcolor="#FFC300"><font face="georgia" color="#000000" size=4 style="color:white;"><a href="codegen.php"><img src="image/codetopo.jpg" height="200" width="200"></a><br><br>Generate Code & Topology</font></td>
			<td rowspan=2 bgcolor="#6DB1E1"><font face="georgia" color="#000000" size=4 style="color:white;"><a href="https://www.nsnam.org/docs/tutorial/html/"><img src="image/tutorial.jpg" height="200" width="200"></a><br><br>Tutorial</font></td>
			<td rowspan=2 bgcolor="#39BE7A"><font face="georgia" color="#000000" size=4 style="color:white;"><a href="aboutus.php"><img src="image/aboutusicon.png" height="200" width="200"></a><br><br>About Us</font></td>
		</tr>
		<tr style="height:5">
			<td bgcolor="#F36541"></td>
		</tr>
		</table>
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