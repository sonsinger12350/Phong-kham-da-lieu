<?php
require_once "../../model/connect.php";
$db = new db();
$connect = $db->connect();
if(isset($_GET['id']) && !empty($_GET['id']))
{
	$id = $_GET['id'];
	$query1 = mysqli_query($connect,"delete from prescription where prescription_id='$id' limit 1");
	if($query1)
	{
		$query2 = mysqli_query($connect,"delete from prescription_detail where prescription_id='$id' limit 1");
		if($query2)
		{
			echo 'success';
		}
		else
		{
			echo 'failed';
		}
	}
	else
	{
		echo 'failed';
	}
}
?>