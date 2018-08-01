<!DOCTYPE html>
<html>
<head>
	<script>
		function plot()
		{
			var ap = document.plotting.networkType.value;
			var mob = Number(document.plotting.nms.value);
			var pc = Number(document.plotting.ncs.value);
			var N = mob + pc;
			var x,y,i,j,numap,a,b,c,r,minX=0,maxX=0,takeIP;
			
			var canvas = document.getElementById("myCanvas");
			var ctx = canvas.getContext("2d");
			var aps = document.getElementById("aps");
			var mbl = document.getElementById("mbl");
			var pcs = document.getElementById("pcs");
			var msg = "";
			if (ap == 1)
			{
				numAPS=Number(document.plotting.numap.value);
				}
			else	
				numAPS=1;
			ctx.fillStyle = 'wheat';
			ctx.fillRect(0, 0, 1020, 600); //refreshing canvas for new topology
			
					
			if(mob==0 && pc==0)
				document.getElementById("desc").innerHTML = "\t >> Insufficient data to construct data.";
			else if(N>45)
				document.getElementById("desc").innerHTML = "\t >> Insufficient space to construct topology.";
			else
			{
				
				for(i=1;i<=numAPS;i++)
				{
				takeIP = "WIFI_"+i+" IP  "+prompt("WIFI_"+i+" IP Address:");
				if(i%2==0)	//plotting the range for even AP
				{
				a=50+(((i/2)-1)*180);	//x for rectangle
				b=100;	//y for rectangle
				c=200;	//side of reclangle
				minX=a;
				maxX=a+c-20;
				a=a+c/2;	//center of circle
				b=b+c/2;	//center of circle
				r= Math.sqrt(2*(c*c))/2;	//radius of circle
				ctx.beginPath();
				ctx.arc(a, b, r, 0, 2 * Math.PI);
				ctx.stroke();
				
				ctx.strokeText(takeIP,a-50,50);
				}
				else	//plotting the range for odd AP
				{
				a=50+((((i+1)/2)-1)*180);	//x for rectangle
				b=300;	//y for rectangle
				c=200;	//side of reclangle
				minX=a;
				maxX=a+c-20;
				a=a+c/2;	//center of circle
				b=b+c/2;	//center of circle
				r= Math.sqrt(2*(c*c))/2;	//radius of circle
				ctx.beginPath();
				ctx.arc(a, b, r, 0, 2 * Math.PI);
				ctx.stroke();
				
				ctx.strokeText(takeIP,a-50,555);
				}
				//plotting the stations in AP
				mob = Number(document.plotting.nms.value);
				pc = Number(document.plotting.ncs.value);
				if(ap == 1)
				{
					ctx.drawImage(aps, a-15, b-15, 30, 30);
					msg = " >> Network Type : Infrastructure \n  >> No. of Access Points: "+numAPS+"\n  >> No. of Total Station/s per AP: "+N+"\n  >> No. of Mobile Station/s per AP: "+mob+"\n  >> No. of Computer Station/s per AP: "+pc;
				}
				else
					msg = " >> Network Type : Ad - Hoc \n  >> No. of Total Station/s: "+N+"\n  >> No. of Mobile Station/s: "+mob+"\n  >> No. of Computer Station/s: "+pc;
				
				for(j=0; j<N; j++)
				{
					//RE for X-Coordinates
					x=maxX+1;
					while(x>maxX)
						x = (Math.random()*maxX) + minX;
					//RE for Y-Coordinates
					if(i%2==0)
					{
					y=251;
					while(y>250)
					y = Math.floor(Math.random()*250 + 100);
					}
					else
					{
					y=481;
					while(y>480)
					y = Math.floor(Math.random()*480 + 300);
					}
					if(mob!=0)
					{
						ctx.drawImage(mbl, x, y, 30, 30);
						mob= mob-1;
					}
					else
						ctx.drawImage(pcs, x, y, 30, 30);
				
				}
				document.getElementById("desc").innerHTML = msg;
				}
			}
		}
		
		function showNumOfApInputText()
		{
			var ap = document.plotting.networkType.value;
			var canvas = document.getElementById("myCanvas");
			var ctx = canvas.getContext("2d");
			
			if(ap == -1)
			{
				ctx.fillStyle = 'white';
				ctx.fillRect(0, 0, 1020, 600);
				document.getElementById('takeInput').innerHTML="";
				document.getElementById('desc').innerHTML="<i>	Please Generate Topology</i>";
			}
			else if(ap == 1)
			{
				ctx.fillStyle = 'white';
				ctx.fillRect(0, 0, 1020, 600);
				document.getElementById('takeInput').innerHTML="Number of AP/s: <input type='text' name='numap' min='0'> <br> No. of Mobile Station/s per AP: <input name='nms' type='number' min='0'> <br> No. of Computer Station/s per AP: <input name='ncs' type='number' min='0'> <br> <button type=button onclick=plot()>Generate Topology</button>";
				document.getElementById('desc').innerHTML="<i>	Please Generate Topology</i>";
			}
			else
			{
				ctx.fillStyle = 'white';
				ctx.fillRect(0, 0, 1020, 600);
				document.getElementById('takeInput').innerHTML="<br> No. of Mobile Station/s per AP: <input name='nms' type='number' min='0'> <br> No. of Computer Station/s per AP: <input name='ncs' type='number' min='0'> <br> <button type=button onclick=plot()>Generate Topology</button>";
				document.getElementById('desc').innerHTML="<i>	Please Generate Topology</i>";
			}
		}
		
	</script>
</head>
<body bg="Yellow">
<form name="plotting">
	<table border=1>
		<tr>
			<td>Network Type: <select name="networkType" onchange=showNumOfApInputText()>
			<option value="-1">Select Network Type</option>
			<option value="0" <?php if($_POST["network_type"]=='adhoc'){echo "selected='selected'";}?>>Adhoc</option>
			<option value="1" <?php if($_POST["network_type"]=='infra'){echo "selected='selected'";}?>>Infra</option>
			</select></td>
			<td><div id=takeInput></div></td>
			<td rowspan=2 valign="top"><b><i>Note: The space can only accommodate a total of 45stations. <br><br><br>
				</i></b><img id="aps" width="50" height="50" src="image/aps.png"> >> Access Point<br><br><br>
				<img id="mbl" width="50" height="50" src="image/mbl.png"> >> Mobile Station<br><br><br>
				<img id="pcs" width="50" height="50" src="image/pcs.png"> >> Computer Station<br><br><br>
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

