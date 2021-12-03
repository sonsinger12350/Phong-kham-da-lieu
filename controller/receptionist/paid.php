<?php
require_once "../../model/connect.php";
$db = new db();
$connect = $db->connect();
if(isset($_GET['id']))
{
	$id = $_GET['id'];
	$query=mysqli_query($connect,"update schedule set paid = 'Đã thanh toán',status='Chưa khám' where schedule_id ='$id'");
	if($query)
	{
		echo 'Cập nhật thành công';
	}
	else
	{
		echo mysqli_error($connect);
	}
}
?>