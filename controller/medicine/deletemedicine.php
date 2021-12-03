<?php
require_once "../../model/connect.php";
$db = new db();
$connect = $db->connect();
if(isset($_POST["id"]))
{
	$id = $_POST["id"];
	$query = mysqli_query($connect,"delete from medicines where medicine_id ='$id' limit 1");
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