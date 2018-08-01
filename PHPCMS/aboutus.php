<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<html>
<head>
	<title>NS3TCG</title>
		<link rel="stylesheet" href= "css/bootstrap.min.css">
		<link rel="stylesheet" href= "css/adminstyle.css">
	<script>
		function kmns3()
		{
			window.open('https://www.nsnam.org/wiki/Installation', '_blank');
			window.open('https://www.nsnam.org/docs/tutorial/html/', '_blank');
		}
		
		function ftw() 
		{
			var myWindow = window.open("", "MsgWindow", "width=800,height=550");
			myWindow.document.write("<center><h1>FLOW OF WEBSITE</h1><hr><img src='flow.jpg' height=400 width=800> <br> <button onclick='window.close()'>Close</button></center>");
		}
	</script>
	<style>
		button
		{
			background-color: #4CAF50;
			border: none;
			color: white;
			padding: 5px 10px;
			font-size: 20px;
			font-family: Times New Roman;
			margin: 4px 2px;
			cursor: pointer;
			border-radius: 4px;
			width: 30%
		}
	
		button:hover
		{
			background-color: #45a049;
			color: #E3DDDC;
		}
	</style>
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
	<table align="center" width=90%>
		<tr>
			<td colspan=6 bgcolor="#FFC300"><br>
			    <font face="georgia" size=3>
					<img src="image/purpose.png" height=30 width=30 align=middle>&ensp;The purpose of NS3TCG project is to serve NS3 Code and network topology on minimum required user-inputs.<br><br>
					<img src="image/developedBy.png" height=30 width=30 align=middle>&ensp;The project is developed by Rishav Halder, Sreeja Karmakar, Sreejita Ghosh, Sridhar Mundra and Uttaran Dey under the guidance of <br>&ensp;&ensp;&ensp;&ensp;&ensp;Prof. Raja Karmakar.<br><br>
					<img src="image/writeUs.png" height=30 width=30 align=middle>&ensp;Write us on "it14.webdesigning@gmail.com"<br><br>
				</font>
			</td>
		</tr>
		<tr>
			<td colspan=6 bgcolor="#FFC300" align=center>
				<button onclick="ftw()">Flow of the Website</button>&ensp;<button onclick="kmns3()">NS3 Installation & Tutorial</button>&ensp;<button>Get Started</button>
			</td>
		</tr>
		<tr align="center" style="height:140">
			<td bgcolor="#39BE7A">
			    <br><br>&ensp;<img src="image\rishav.jpg" height="160" width="160" style="border-radius:50%">&ensp;<br><br>
			    <font face="georgia" size=5>RISHAV HALDER</font> <br> <font face="georgia" size=2>TICT - IT <br> Roll 18700214033</font><br><br><br>
			</td>
			<td bgcolor="#F36541">
			    <br><br>&ensp;<img src="image\sreeja.jpg" height="160" width="160" style="border-radius:50%">&ensp;<br><br>
			    <font face="georgia" size=5>SREEJA KARMAKAR</font> <br> <font face="georgia" size=2>TICT - IT <br> Roll 18700214050</font><br><br><br>
			</td>
			<td bgcolor="#E16D99">
			    <br><br>&ensp;<img src="image\sreejita.jpg" height="160" width="160" style="border-radius:50%">&ensp;<br><br>
			    <font face="georgia" size=5>SREEJITA GHOSH</font> <br> <font face="georgia" size=2>TICT - IT <br> Roll 18700214051</font><br><br><br>
			</td>
			<td bgcolor="#8CBC42">
			    <br><br>&ensp;<img src="image\sridhar.jpg" height="160" width="160" style="border-radius:50%">&ensp;<br><br>
			    <font face="georgia" size=5>SRIDHAR MUNDRA</font> <br> <font face="georgia" size=2>TICT - IT <br> Roll 18700214052</font><br><br><br>
			</td>
			<td bgcolor="#6DB1E1">
			    <br><br>&ensp;<img src="image\uttaran.jpg" height="160" width="160" style="border-radius:50%">&ensp;<br><br>
			    <font face="georgia" size=5>UTTARAN <br>DEY</font> <br> <font face="georgia" size=2>TICT - IT <br> Roll 18700214060</font><br><br><br>
			</td>
			<td bgcolor="#FBA747">
			    <br><br>&ensp;<img src="image\rajasir.jpg" height="160" width="160" style="border-radius:50%">&ensp;<br><br>
			    <font face="georgia" size=5>RAJA <br>KARMAKAR</font> <br> <font face="georgia" size=2>TICT - IT <br> Professor </font><br><br><br>
			</td>
		</tr>
	</table>
</body>
</html>