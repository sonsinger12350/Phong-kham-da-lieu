<?php
require_once "../../model/connect.php";
$db = new db();
$connect = $db->connect();
if(isset($_GET["id"]))
{
	$id = $_GET["id"];
	$query = mysqli_query($connect,"delete from test_type where type_id ='$id' limit 1");
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