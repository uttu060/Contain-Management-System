<!DOCTYPE html>
<html>
<head>
	<script>
		function plot()
		{
			var comL = Number(document.plotting.comL.value);
			var mobA = Number(document.plotting.mobA.value);
			var comA = Number(document.plotting.comA.value);
			var numA = mobA + comA;
			
			var lanIP = "LAN IP  "+document.plotting.lanIP.value;
			var apIP = "WIFI IP  "+document.plotting.apIP.value;
			var ptpIP = "PTP IP  "+document.plotting.ptpIP.value;
			
			var canvas = document.getElementById("myCanvas");
			var ctx = canvas.getContext("2d");
			var aps = document.getElementById("aps");
			var mbl = document.getElementById("mbl");
			var pcs = document.getElementById("pcs");
			var lan = document.getElementById("lanPC");
			var msg = "  >> LAN IP Address: "+lanIP+"<br>  >> Number of PC connected to LAN: "+comL+"<br><br>  >> Router IP Address: "+apIP+"<br>  >> Devices Connected with Router: "+numA+"<br><br>  >> PTP IP Address: "+ptpIP;
			
			ctx.fillStyle = 'white';
			ctx.fillRect(0, 0, 1020, 600); //refreshing canvas for new topology
			
			//plot lan devices
			while(comL>0)
			{
				ctx.drawImage(lan, 550+(comL*50), 261, 50, 50);
				comL--;
			}
			ctx.strokeText(lanIP,630,320);
			
			//plot ptp wire
			ctx.beginPath();
			ctx.moveTo(610,300);
			ctx.lineTo(250,300);
			ctx.stroke();
			ctx.beginPath();
			ctx.moveTo(610,305);
			ctx.lineTo(250,305);
			ctx.stroke();
			ctx.strokeText(ptpIP,470,290);
			
			//plot AP devices
			a=100;	//x for rectangle
			b=150;	//y for rectangle
			c=280;	//side of reclangle
			minX=a;
			maxX=a+c-20;
			a=a+c/2;	//center of circle
			b=b+c/2;	//center of circle
			r= Math.sqrt(2*(c*c))/2;	//radius of circle
			ctx.beginPath();
			ctx.arc(a, b, r, 0, 2 * Math.PI);
			ctx.stroke();
			//ploting the Access Point(Router)
			ctx.drawImage(aps, a-30, b-30, 60, 60);
			
			for(i=1; i<=numA; i++)
			{
				//RE for X-Coordinates
				x=maxX+1;
				while(x>maxX)
					x = (Math.random()*maxX) + minX;
				//RE for Y-Coordinates
				y=401;
				while(y>400)
					y = Math.floor(Math.random()*400 + 100);
				
				if(mobA!=0)
				{
					ctx.drawImage(mbl, x, y, 40, 40);
					mobA= mobA-1;
				}
				else
					ctx.drawImage(pcs, x, y, 40, 40);
				
			}
			ctx.strokeText(apIP,200,80);
			
			
			document.getElementById("desc").innerHTML = msg;
		}
	</script>
</head>
<body bg="Yellow" onload="plot()">
<form name="plotting">
	<table border=1>
		<tr>
			<td>Network Type: Mixed</td>
			<td>No. of Computer Station/s in LAN: <input type='text' name='comL' value='<?php echo $_POST["nlan"];?>' readonly><br>
				LAN IP Address: <input type='text' name='lanIP' value='<?php echo $_POST["lan_address"];?>' readonly><br>
				No. of Mobile Station/s in AP: <input type='text' name='mobA' value='<?php echo $_POST["nmob"];?>' readonly><br>
				No. of Computer Station/s in AP: <input type='text' name='comA' value='<?php echo $_POST["ncomp"];?>' readonly><br>
				Access Point IP Address: <input type='text' name='apIP' value='<?php echo $_POST["wifi_address"];?>' readonly><br><br>
				Point to point IP Address: <input type='text' name='ptpIP' value='<?php echo $_POST["p2p_address"];?>' readonly><br>
				<!---<button type=button>Generate Topology</button></td>--->
			<td rowspan=2 valign="top"><b><i>Note: The space can only accommodate a total of 45stations. <br><br>
				</i></b><img id="aps" width="50" height="50" src="image/aps.png"> >> Access Point<br><br>
				<img id="mbl" width="50" height="50" src="image/mbl.png"> >> Mobile in AP<br><br>
				<img id="pcs" width="50" height="50" src="image/pcs.png"> >> Computer in AP<br><br>
				<img id="lanPC" width="50" height="50" src="image/lanPC.png"> >> Computer in LAN<br><br>
				<img id="ptp" width="50" height="50" src="image/ptp.png"> >> Point-to-point Connection<br><br>
				<hr>
				<h3 align="center">Description of the Topology Generated</h3><br>
				<pre id="desc"><i>	Please Generate Topology</i><pre></td>
		</tr>
		<tr align="center">
			<td colspan=2>
				<canvas id="myCanvas" width="1020" height="600">
				</canvas>
			</td>
		</tr>
	</table>
</form>
</body>
</html>

