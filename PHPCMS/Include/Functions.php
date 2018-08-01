
<?php
function Redirect_to($New_Location){
	header("Location:".$New_Location);
	exit;
}

function Login_Attempt($Username,$Password)
{
	$Username=$_POST['Username'];
    $Password=$_POST['Password'];
	
	$Connection=mysqli_connect('localhost','root','') or die("Could not connect");
$ConnectingDB=mysqli_select_db($Connection,'phpcms') or die("no db");
	
	 $Query=mysqli_query($Connection,"select * from registration where Username = '$Username' and Password = '$Password'") 
           or die();
		   $Execute=mysqli_fetch_array($Query);
    if($Execute['username'] == $Username && $Execute['password'] == $Password){
		return $Execute;
	}else{
		return null;
	}
}
function Login(){
	if(isset($_SESSION["User_Id"])){
		return true;
	}
	else{
		return false;
	}
}
function Confirm_Login(){
	if(!Login()){
		
		Redirect_to("Login.php");
	}
}	

           
?> 