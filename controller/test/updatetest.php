<?php
require_once "../../model/connect.php";
$db = new db();
$connect = $db->connect();
if(isset($_GET['id']))
{
	$id = $_GET['id'];
	$result = $_GET['result'];
	$query = mysqli_query($connect,"update test set result = '$result' where test_id='$id' limit 1");
	if($query)
	{
		echo 'success';
	}
	else
	{
		echo 'failed';
	}
}
?>