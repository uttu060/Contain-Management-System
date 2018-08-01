<?php require_once("Include/DB.php"); ?>
<?php require_once("Include/Sessions.php"); ?>
<?php require_once("Include/Functions.php"); ?>
<?php
//print_r($_POST);
extract($_POST);
$start_time=intval($interval);
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
	 <?php
	 if(Login()==true){?>
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
#include "ns3/network-module.h"<br>
#include "ns3/mobility-module.h"<br>
#include "ns3/config-store-module.h"<br>
#include "ns3/wifi-module.h"<br>
#include "ns3/internet-module.h"<br>
#include "ns3/olsr-helper.h"<br>
#include "ns3/ipv4-static-routing-helper.h"<br>
#include "ns3/ipv4-list-routing-helper.h"<br>
<br>
#include "iostream.h"<br>
#include "fstream.h"<br>
#include "vector.h"<br>
#include "string.h"<br>
<br>
NS_LOG_COMPONENT_DEFINE ("WifiSimpleAdhocGrid");<br>
<br>
using namespace ns3;<br>
<br>
void ReceivePacket (Ptr<Socket> socket)
{<br>
  NS_LOG_UNCOND ("Received one packet!");<br>
}<br>
<br>
static void GenerateTraffic (Ptr<Socket> socket, uint32_t pktSize, 
                             uint32_t pktCount, Time pktInterval )
{<br>
  if (pktCount > 0)
    {<br>
      socket->Send (Create<Packet> (pktSize));<br>
      Simulator::Schedule (pktInterval, &GenerateTraffic, 
                           socket, pktSize,pktCount-1, pktInterval);<br>
    }<br>
  else
    {<br>
      socket->Close ();<br>
    }<br>
}<br>

<br>
int main (int argc, char *argv[])
{<br>
  std::string phyMode ("DsssRate1Mbps");<br>
  double distance = 500;<br>  // m
  uint32_t packetSize = <?php echo $data_size;?>;<br> // bytes
  uint32_t numPackets = <?php echo $packet_no;?>;<br>
  uint32_t numNodes = <?php echo $nwifi;?>;<br>  // by default, 5x5
  uint32_t sinkNode = 0;<br>
  uint32_t sourceNode = 24;<br>
  double interval = <?php echo number_format((float)$interval, 1, '.', '');?>;<br> // seconds
  bool verbose = false;<br>
  bool tracing = false;<br>
<br>
  CommandLine cmd;<br>
<br>
  cmd.AddValue ("phyMode", "Wifi Phy mode", phyMode);<br>
  cmd.AddValue ("distance", "distance (m)", distance);<br>
  cmd.AddValue ("packetSize", "size of application packet sent", packetSize);<br>
  cmd.AddValue ("numPackets", "number of packets generated", numPackets);<br>
  cmd.AddValue ("interval", "interval (seconds) between packets", interval);<br>
  cmd.AddValue ("verbose", "turn on all WifiNetDevice log components", verbose);<br>
  cmd.AddValue ("tracing", "turn on ascii and pcap tracing", tracing);<br>
  cmd.AddValue ("numNodes", "number of nodes", numNodes);<br>
  cmd.AddValue ("sinkNode", "Receiver node number", sinkNode);<br>
  cmd.AddValue ("sourceNode", "Sender node number", sourceNode);<br>
<br>
  cmd.Parse (argc, argv);<br>
  // Convert to time object
  Time interPacketInterval = Seconds (interval);<br>
<br>
  // disable fragmentation for frames below 2200 bytes
  Config::SetDefault ("ns3::WifiRemoteStationManager::FragmentationThreshold", StringValue ("2200"));<br>
  // turn off RTS/CTS for frames below 2200 bytes
  Config::SetDefault ("ns3::WifiRemoteStationManager::RtsCtsThreshold", StringValue ("2200"));<br>
  // Fix non-unicast data rate to be the same as that of unicast
  Config::SetDefault ("ns3::WifiRemoteStationManager::NonUnicastMode", 
                      StringValue (phyMode));<br>
<br>
  NodeContainer c;<br>
  c.Create (numNodes);<br>
<br>
  // The below set of helpers will help us to put together the wifi NICs we want
  WifiHelper wifi;<br>
  if (verbose)
    {<br>
      wifi.EnableLogComponents ();<br>  // Turn on all Wifi logging
    }<br>
<br>
  YansWifiPhyHelper wifiPhy =  YansWifiPhyHelper::Default ();<br>
  // set it to zero;<br> otherwise, gain will be added
  wifiPhy.Set ("RxGain", DoubleValue (-10) );<br> 
  // ns-3 supports RadioTap and Prism tracing extensions for 802.11b
  wifiPhy.SetPcapDataLinkType (YansWifiPhyHelper::DLT_IEEE802_11_RADIO);<br> 
<br>
  YansWifiChannelHelper wifiChannel;<br>
  wifiChannel.SetPropagationDelay ("ns3::ConstantSpeedPropagationDelayModel");<br>
  wifiChannel.AddPropagationLoss ("ns3::FriisPropagationLossModel");<br>
  wifiPhy.SetChannel (wifiChannel.Create ());<br>
<br>
  // Add a non-QoS upper mac, and disable rate control
  NqosWifiMacHelper wifiMac = NqosWifiMacHelper::Default ();<br>
  wifi.SetStandard (WIFI_PHY_STANDARD_80211b);<br>
  wifi.SetRemoteStationManager ("ns3::ConstantRateWifiManager",
                                "DataMode",StringValue (phyMode),
                                "ControlMode",StringValue (phyMode));<br>
  // Set it to adhoc mode
  wifiMac.SetType ("ns3::AdhocWifiMac");<br>
  NetDeviceContainer devices = wifi.Install (wifiPhy, wifiMac, c);<br>
<br>
  MobilityHelper mobility;<br>
  mobility.SetPositionAllocator ("ns3::GridPositionAllocator",
                                 "MinX", DoubleValue (0.0),
                                 "MinY", DoubleValue (0.0),
                                 "DeltaX", DoubleValue (distance),
                                 "DeltaY", DoubleValue (distance),
                                 "GridWidth", UintegerValue (5),
                                 "LayoutType", StringValue ("RowFirst"));<br>
  mobility.SetMobilityModel ("ns3::ConstantPositionMobilityModel");<br>
  mobility.Install (c);<br>
<br>
  // Enable OLSR
  OlsrHelper olsr;<br>
  Ipv4StaticRoutingHelper staticRouting;<br>
<br>
  Ipv4ListRoutingHelper list;<br>
  list.Add (staticRouting, 0);<br>
  list.Add (olsr, 10);<br>
<br>
  InternetStackHelper internet;<br>
  internet.SetRoutingHelper (list);<br>
  internet.Install (c);<br>
<br>
  Ipv4AddressHelper ipv4;<br>
  NS_LOG_INFO ("Assign IP Addresses.");<br>
  ipv4.SetBase ("<?php echo $wifi_address;?>", "255.255.255.0");<br>
  Ipv4InterfaceContainer i = ipv4.Assign (devices);<br>
<br>
  TypeId tid = TypeId::LookupByName ("ns3::UdpSocketFactory");<br>
  Ptr<Socket> recvSink = Socket::CreateSocket (c.Get (sinkNode), tid);<br>
  InetSocketAddress local = InetSocketAddress (Ipv4Address::GetAny (), 80);<br>
  recvSink->Bind (local);<br>
  recvSink->SetRecvCallback (MakeCallback (&ReceivePacket));<br>
<br>
  Ptr<Socket> source = Socket::CreateSocket (c.Get (sourceNode), tid);<br>
  InetSocketAddress remote = InetSocketAddress (i.GetAddress (sinkNode, 0), 80);<br>
  source->Connect (remote);<br>
<br>
  if (tracing == true)
    {<br>
      AsciiTraceHelper ascii;<br>
      wifiPhy.EnableAsciiAll (ascii.CreateFileStream ("wifi-simple-adhoc-grid.tr"));<br>
      wifiPhy.EnablePcap ("wifi-simple-adhoc-grid", devices);<br>
      // Trace routing tables
      Ptr<OutputStreamWrapper> routingStream = Create<OutputStreamWrapper> ("wifi-simple-adhoc-grid.routes", std::ios::out);<br>
      olsr.PrintRoutingTableAllEvery (Seconds (2), routingStream);<br>
<br>
      // To do-- enable an IP-level trace that shows forwarding events only
    }<br>
<br>
  // Give OLSR time to converge-- 30 seconds perhaps
  Simulator::Schedule (Seconds (30.0), &GenerateTraffic, 
                       source, packetSize, numPackets, interPacketInterval);<br>
<br>
  // Output what we are doing
  NS_LOG_UNCOND ("Testing from node " << sourceNode << " to " << sinkNode << " with grid distance " << distance);<br>
<br>
  Simulator::Stop (Seconds (32.0));<br>
  Simulator::Run ();<br>
  Simulator::Destroy ();<br>
<br>
  return 0;<br>
}<br>
	</div>
</div>
<form action="apRowIP-FINAL.php" method="post">
<input type='hidden' name='ncomp' value='<?php echo $ncomp;?>'>
<input type='hidden' name='nmob' value='<?php echo $nmob;?>'>
<input type='hidden' name='network_type' value='<?php echo $network_type;?>'>

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