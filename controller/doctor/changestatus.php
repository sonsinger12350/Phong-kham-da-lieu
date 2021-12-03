<?php
require_once "../../model/connect.php";
$db = new db();
$connect = $db->connect();
if(isset($_GET['phone']))
{
	$phone=$_GET['phone'];
	$sql="update schedule set status='Đã khám' where patient_phone='$phone' and status='Tái khám' limit 1";
	$result = mysqli_query($connect,$sql);	
}
?>