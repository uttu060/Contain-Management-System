<?php
$Connection=mysqli_connect('127.0.0.1','root','') or die("Could not connect");
$ConnectingDB=mysqli_select_db($Connection,'phpcms') or die("no db");

?> 