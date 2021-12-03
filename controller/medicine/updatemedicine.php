<?php
require_once "../../model/connect.php";
$db = new db();
$connect = $db->connect();
if(isset($_POST['id']))
{
	$id = $_POST['id'];
	$name = $_POST['name'];
	$unit = $_POST['unit'];
	$use = $_POST['use'];
	$quantity = $_POST['quantity'];
	$sql = "update medicines set
		name = '$name',
		unit = '$unit',
		howtouse = '$use',		
		quantity = '$quantity'
		where medicine_id = '$id' limit 1;
	";
	$query = mysqli_query($connect,$sql);
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