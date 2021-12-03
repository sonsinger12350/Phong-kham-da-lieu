<?php
require_once "../../model/connect.php";
$db = new db();
if(isset($_GET['id']))
{	
	$schedule_id = $_GET['id'];
	$name = $_GET['name'];
	$sex = $_GET['sex'];
	$year = $_GET['year'];
	$phone = $_GET['phone'];
	$doctor = $_GET['doctor'];
	$date = $_GET['date'];
	$time = $_GET['time'];
	$sql = "
	update schedule set 
	patient_name='$name',
	patient_phone='$phone',
	patient_year='$year',
	patient_sex='$sex',
	doctor='$doctor',
	date='$date',
	time='$time' 
	where schedule_id='$schedule_id' limit 1 ";
	$result = mysqli_query($db->connect(),$sql);	
	echo 'success';
}
else
{
	echo 'wrong';
}
?>