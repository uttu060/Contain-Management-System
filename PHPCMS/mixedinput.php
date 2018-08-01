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
		<body style="background:url('image/3.jpg')">
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
<div class='left' style="background: #ffffffad;">
<form action="mixedcode.php" method="post">
<table width="40%" style='margin:auto;text-align:center;color:brown;font-weight:900'>
<tr>
<td colspan=2  style='text-align:center'><h2>Code generation form</h2></td>
</tr>
<!---<tr>
<td style='text-align:left'>Address of Node1 : </td>
<td style='text-align:right'><input type='text' id='address1'></td>
</tr>
<tr>
<td style='text-align:left'>Address of Node2 : </td>
<td style='text-align:right'><input type='text' id='address2'></td>
</tr>-->
<tr>
<td style='text-align:left'>Address for devices connected Via LAN : </td>
<td style='text-align:right'><input type='text' id='lan_address' name='lan_address' required></td>
</tr>
<tr>
<td style='text-align:left'>Address for P2p connection : </td>
<td style='text-align:right'><input type='text' id='p2p_address' name='p2p_address' required></td>
</tr>
<tr>
<td style='text-align:left'>Address for devices connected Via Wifi: </td>
<td style='text-align:right'><input type='text' id='wifi_address' name='wifi_address' required></td>
</tr>
<tr>
<td style='text-align:left'>No. of nodes in LAN: </td>
<td style='text-align:right'><input type='text' id='nlan' name='nlan' required></td>
</tr>
<tr>
<td style='text-align:left'>No. of Computer nodes in Wifi: </td>
<td style='text-align:right'><input type='text' id='ncomp' name='ncomp' required></td>
</tr>
<tr>
<td style='text-align:left'>No. of Mobile nodes in Wifi: </td>
<td style='text-align:right'><input type='text' id='nmob' name='nmob' required></td>
</tr>
<tr>
<td style='text-align:left'>Start Time(in seconds) : </td>
<td style='text-align:right'><input type='text' id='start_time' name='start_time' required></td>
</tr>
<tr>
<td style='text-align:left'>End Time(in seconds) : </td>
<td style='text-align:right'><input type='text' id='end_time' name='end_time' required></td>
</tr>
<tr>
<td style='text-align:left'>Data Size(in bytes) : </td>
<td style='text-align:right'><input type='text' id='data_size' name='data_size' required></td>
</tr>
<tr>
<td style='text-align:left'>Data Rate for P2P(in Mbps) : </td>
<td style='text-align:right'><input type='text' id='datarate_p2p' name='datarate_p2p' required></td>
</tr>
<tr>
<td style='text-align:left'>Data Rate for LAN(in Mbps) : </td>
<td style='text-align:right'><input type='text' id='datarate_lan' name='datarate_lan' required></td>
</tr>
<tr>
<td style='text-align:left'>Delay for P2P(in ms) : </td>
<td style='text-align:right'><input type='text' id='delay_p2p' name='delay_p2p' required></td>
</tr>
<tr>
<td style='text-align:left'>Delay for LAN(in ns) : </td>
<td style='text-align:right'><input type='text' id='delay_lan' name='delay_lan' required></td>
</tr>
<tr>
<td style='text-align:left'>Port Number : </td>
<td style='text-align:right'><input type='text' id='port_number' name='port_number' required></td>
</tr>
<tr>
<td colspan=2  style='text-align:center'><input type="submit" class="btn btn-Success" value="Generate Code"></td>
</tr>
</table>
</form>
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