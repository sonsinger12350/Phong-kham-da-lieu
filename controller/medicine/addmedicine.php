<?php
require_once "../../model/connect.php";
$db = new db();
$connect = $db->connect();
if(isset($_GET['name']))
{
	$name = $_GET['name'];
	$unit = $_GET['unit'];
	$use = $_GET['use'];	
	$quantity = $_GET['quantity'];
	$sql = "insert into medicines(name,unit,howtouse,quantity) values('$name','$unit','$use','$quantity')";
	$result = mysqli_query($connect,$sql);
	if($result)
	{
		echo 'success';
	}
	else
	{
		echo 'failed';
	}
}
?>