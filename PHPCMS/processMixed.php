<?php
//print_r($_POST);
extract($_POST);
$start_time=intval($start_time);
$end_time=intval($end_time);
?>

#include "ns3/core-module.h"<br>
#include "ns3/point-to-point-module.h"<br>
#include "ns3/network-module.h"<br>
#include "ns3/applications-module.h"<br>
#include "ns3/wifi-module.h"<br>
#include "ns3/mobility-module.h"<br>
#include "ns3/csma-module.h"<br>
#include "ns3/internet-module.h"<br>
<br>
using namespace ns3;<br>
<br>
NS_LOG_COMPONENT_DEFINE ("GeneratedExample");<br>
<br>
int main (int argc, char *argv[])<br>
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
  if (nWifi > 18)<br>
    {<br>
      std::cout << "Number of wifi nodes " << nWifi << <br>
                   " specified exceeds the mobility bounding box" << std::endl;<br>
      exit (1);<br>
    }<br>
<br>
  if (verbose)<br>
    {<br>
      LogComponentEnable ("UdpEchoClientApplication", LOG_LEVEL_INFO);<br>
      LogComponentEnable ("UdpEchoServerApplication", LOG_LEVEL_INFO);<br>
    }<br>
<br>
  NodeContainer p2pNodes;<br>
  p2pNodes.Create (2);<br>
<br>
  PointToPointHelper pointToPoint;<br>
  pointToPoint.SetDeviceAttribute ("DataRate", StringValue ("<?php echo $datarate_p2p; ?>Mbps")); <br>
  pointToPoint.SetChannelAttribute ("Delay", StringValue ("<?php echo $delay_p2p;?>ms"));  <br>
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
  mac.SetType ("ns3::StaWifiMac",<br>
               "Ssid", SsidValue (ssid),<br>
               "ActiveProbing", BooleanValue (false));<br>
<br>
  NetDeviceContainer staDevices;<br>
  staDevices = wifi.Install (phy, mac, wifiStaNodes);<br>
<br>
  mac.SetType ("ns3::ApWifiMac",<br>
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
  address.SetBase ("<?php echo $p2p_address;?>", "255.255.255.0"); <br>
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
  serverApps.Start (Seconds (<?php echo number_format((float)$start_time, 1, '.', '');?>)); <br> 
  serverApps.Stop (Seconds (<?php echo number_format((float)$end_time, 1, '.', '');?>)); <br> 
<br>
  UdpEchoClientHelper echoClient (csmaInterfaces.GetAddress (nCsma), <?php echo $port_number;?>);<br>
  echoClient.SetAttribute ("MaxPackets", UintegerValue (1));<br>
  echoClient.SetAttribute ("Interval", TimeValue (Seconds (1.0)));<br>
  echoClient.SetAttribute ("PacketSize", UintegerValue (<?php echo $data_size;?>));<br> 
<br>
  ApplicationContainer clientApps = <br>
    echoClient.Install (wifiStaNodes.Get (nWifi - 1));<br>
  clientApps.Start (Seconds (<?php echo number_format((float)($start_time + 1), 1, '.', '');?>));<br> 
  clientApps.Stop (Seconds (<?php echo number_format((float)$end_time, 1, '.', '');?>)); <br>
<br>
  Ipv4GlobalRoutingHelper::PopulateRoutingTables ();<br>
<br>
  Simulator::Stop (Seconds (<?php echo number_format((float)$end_time, 1, '.', '');?>));<br> 
<br>
  pointToPoint.EnablePcapAll ("generated");<br>
  phy.EnablePcap ("generated", apDevices.Get (0));<br>
  csma.EnablePcap ("generated", csmaDevices.Get (0), true);<br>
<br>
  Simulator::Run ();<br>
  Simulator::Destroy ();<br>
  return 0;<br>
}