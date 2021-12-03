<?php
require_once "../../model/connect.php";
$db = new db();
$connect = $db->connect();
if(isset($_GET['type']))
{
	$type = $_GET['type'];
	$query = mysqli_query($connect,"insert into test_type(name) values('$type')");
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