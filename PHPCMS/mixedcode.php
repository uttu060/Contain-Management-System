<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php
//print_r($_POST);
extract($_POST);
$start_time=intval($start_time);
$end_time=intval($end_time);
$nwifi=$ncomp + $nmob;
?>
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
<div>
<div id='result' style="text-align:left;height:52%;width:50%;margin:auto;border:1px solid blue;background:black;overflow-y:scroll;color:white;">


#include "ns3/core-module.h"<br>
#include "ns3/point-to-point-module.h"<br>
#include "ns3/network-module.h"<br>
#include "ns3/applications-module.h"<br>
#include "ns3/wifi-module.h"<br>
#include "ns3/mobility-module.h"<br>
#include "ns3/csma-module.h"<br>
#include "ns3/internet-module.h" <br>                              
<br>
using namespace ns3;<br>
<br>
NS_LOG_COMPONENT_DEFINE ("ThirdScriptExample");<br>
<br>
int 
main (int argc, char *argv[])<br>
{<br>
  bool verbose = true;<br>
  uint32_t nCsma = <?php echo $nlan;?>;<br> 
  uint32_t nWifi = <?php echo $nwifi;?>;<br> 
<br>
  CommandLine cmd;<br>
  cmd.AddValue ("nCsma", "Number of \"extra\" CSMA nodes/devices", nCsma);<br>
  cmd.AddValue ("nWifi", "Number of wifi STA devices", nWifi);<br>
  cmd.AddValue ("verbose", "Tell echo applications to log if true", verbose);<br>
<br>
  cmd.Parse (argc,argv);<br>
<br>
  if (nWifi > 18)
    {<br>
      std::cout << "Number of wifi nodes " << nWifi << <br>
                   " specified exceeds the mobility bounding box" << std::endl;<br>
      exit (1);<br>
    }<br><br>
<br>
  if (verbose)
    {<br>
      LogComponentEnable ("UdpEchoClientApplication", LOG_LEVEL_INFO);<br>
      LogComponentEnable ("UdpEchoServerApplication", LOG_LEVEL_INFO);<br>
    }<br><br>
<br>
  NodeContainer p2pNodes;<br>
  p2pNodes.Create (2);<br>
<br>
  PointToPointHelper pointToPoint;<br>
  pointToPoint.SetDeviceAttribute ("DataRate", StringValue ("<?php echo $datarate_p2p;?>Mbps"));<br>
  pointToPoint.SetChannelAttribute ("Delay", StringValue ("<?php echo $delay_p2p;?>ms"));<br>
<br>
  NetDeviceContainer p2pDevices;<br>
  p2pDevices = pointToPoint.Install (p2pNodes);<br>
<br>
  NodeContainer csmaNodes;<br>
  csmaNodes.Add (p2pNodes.Get (1));<br>
  csmaNodes.Create (nCsma);<br>
<br>
  CsmaHelper csma;<br>
  csma.SetChannelAttribute ("DataRate", StringValue ("<?php echo $datarate_lan;?>Mbps"));<br> 
  csma.SetChannelAttribute ("Delay", TimeValue (NanoSeconds (<?php echo $delay_lan;?>)));<br> 
<br>
  NetDeviceContainer csmaDevices;<br>
  csmaDevices = csma.Install (csmaNodes);<br>
<br>
  NodeContainer wifiStaNodes;<br>
  wifiStaNodes.Create (nWifi);<br>
  NodeContainer wifiApNode = p2pNodes.Get (0);<br>
<br>
  YansWifiChannelHelper channel = YansWifiChannelHelper::Default ();<br>
  YansWifiPhyHelper phy = YansWifiPhyHelper::Default ();<br>
  phy.SetChannel (channel.Create ());<br>
<br>
  WifiHelper wifi = WifiHelper::Default ();<br>
  wifi.SetRemoteStationManager ("ns3::AarfWifiManager");<br>
<br>
  NqosWifiMacHelper mac = NqosWifiMacHelper::Default ();<br>
<br>
  Ssid ssid = Ssid ("ns-3-ssid");<br>
  mac.SetType ("ns3::StaWifiMac",
               "Ssid", SsidValue (ssid),
               "ActiveProbing", BooleanValue (false));<br>
<br>
  NetDeviceContainer staDevices;<br>
  staDevices = wifi.Install (phy, mac, wifiStaNodes);<br>
<br>
  mac.SetType ("ns3::ApWifiMac",
               "Ssid", SsidValue (ssid));<br>
<br>
  NetDeviceContainer apDevices;<br>
  apDevices = wifi.Install (phy, mac, wifiApNode);<br>
<br>
  MobilityHelper mobility;<br>
<br>
  mobility.SetPositionAllocator ("ns3::GridPositionAllocator",<br>
                                 "MinX", DoubleValue (0.0),<br>
                                 "MinY", DoubleValue (0.0),<br>
                                 "DeltaX", DoubleValue (5.0),<br>
                                 "DeltaY", DoubleValue (10.0),<br>
                                 "GridWidth", UintegerValue (3),<br>
                                 "LayoutType", StringValue ("RowFirst"));<br>
<br>
  mobility.SetMobilityModel ("ns3::RandomWalk2dMobilityModel",<br>
                             "Bounds", RectangleValue (Rectangle (-50, 50, -50, 50)));<br>
  mobility.Install (wifiStaNodes);<br>
<br>
  mobility.SetMobilityModel ("ns3::ConstantPositionMobilityModel");<br>
  mobility.Install (wifiApNode);<br>
<br>
  InternetStackHelper stack;<br>
  stack.Install (csmaNodes);<br>
  stack.Install (wifiApNode);<br>
  stack.Install (wifiStaNodes);<br>
<br>
  Ipv4AddressHelper address;<br>
<br>
  address.SetBase ("<?php echo $p2p_address;?>", "255.255.255.0");<br>
  Ipv4InterfaceContainer p2pInterfaces;<br>
  p2pInterfaces = address.Assign (p2pDevices);<br>
<br>
  address.SetBase ("<?php echo $lan_address;?>", "255.255.255.0");<br>
  Ipv4InterfaceContainer csmaInterfaces;<br>
  csmaInterfaces = address.Assign (csmaDevices);<br>
<br>
  address.SetBase ("<?php echo $wifi_address;?>", "255.255.255.0");<br>
  address.Assign (staDevices);<br>
  address.Assign (apDevices);<br>
<br>
  UdpEchoServerHelper echoServer (<?php echo $port_number;?>);<br>
<br>
  ApplicationContainer serverApps = echoServer.Install (csmaNodes.Get (nCsma));<br>
  serverApps.Start (Seconds (<?php echo number_format((float)$start_time, 1, '.', '');?>));<br> //start
  serverApps.Stop (Seconds (<?php echo number_format((float)$end_time, 1, '.', '');?>));<br> //end
<br>
  UdpEchoClientHelper echoClient (csmaInterfaces.GetAddress (nCsma), <?php echo $port_number;?>);<br>
  echoClient.SetAttribute ("MaxPackets", UintegerValue (1));<br>
  echoClient.SetAttribute ("Interval", TimeValue (Seconds (1.0)));<br>
  echoClient.SetAttribute ("PacketSize", UintegerValue (<?php echo $data_size;?>));<br> 
<br>
  ApplicationContainer clientApps = 
    echoClient.Install (wifiStaNodes.Get (nWifi - 1));<br>
  clientApps.Start (Seconds (<?php echo number_format((float)($start_time + 1), 1, '.', '');?>));<br> 
  clientApps.Stop (Seconds (<?php echo number_format((float)$end_time, 1, '.', '');?>));<br> 
<br>
  Ipv4GlobalRoutingHelper::PopulateRoutingTables ();<br>
<br>
  Simulator::Stop (Seconds (<?php echo number_format((float)$end_time, 1, '.', '');?>));<br> 
<br>
  pointToPoint.EnablePcapAll ("third");<br>
  phy.EnablePcap ("third", apDevices.Get (0));<br>
  csma.EnablePcap ("third", csmaDevices.Get (0), true);<br>
<br>
  Simulator::Run ();<br>
  Simulator::Destroy ();<br>
  return 0;<br>
}<br><br>

	</div>
</div>
<form action="wiredIP-FINAL.php" method="post">
<input type='hidden' name='ncomp' value='<?php echo $ncomp;?>'>
<input type='hidden' name='nmob' value='<?php echo $nmob;?>'>
<input type='hidden' name='lan_address' value='<?php echo $lan_address;?>'>
<input type='hidden' name='nlan' value='<?php echo $nlan;?>'>
<input type='hidden' name='wifi_address' value='<?php echo $wifi_address;?>'>
<input type='hidden' name='p2p_address' value='<?php echo $p2p_address;?>'>

<div style="text-align:center;"><br><input type="submit" class="btn btn-Success" value="Generate Topology"></div>
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