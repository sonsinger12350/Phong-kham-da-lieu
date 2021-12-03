<?php
require_once "../../model/connect.php";
$db = new db();
$connect = $db->connect();
if(isset($_GET['name']))
{
	$name = $_GET['name'];
	$quantity = $_GET['quantity'];
	$sql = "select * from medicines where name='$name'";
	$result = mysqli_query($connect,$sql);
	$i = mysqli_num_rows($result);
	if($i != 0)
	{
		$row = mysqli_fetch_array($result);
		if($quantity <= $row['quantity'])
		{
			echo 'ok';
		}
		else
		{
			echo 'notenough';
		}		
	}
}
?>