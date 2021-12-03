<?php
require_once "../../model/connect.php";
$db = new db();
$connect = $db->connect();
if(isset($_GET['id']))
{
	$id = $_GET['id'];
	$result = mysqli_query($connect,"select * from medicines where medicine_id = '$id'");
	$i = mysqli_num_rows($result);
	if($i != 0 )
	{
		while ($row = mysqli_fetch_array($result)) 
		{
			$data = '{
				"name":"'.$row['name'].'",
				"unit":"'.$row['unit'].'",
				"use":"'.$row['howtouse'].'",
				"quantity":"'.$row['quantity'].'"
			}';
			echo $data;
		}
	}
	else
	{
		echo 'failed';
	}
}
?>