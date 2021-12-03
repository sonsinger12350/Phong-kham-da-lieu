<?php
require_once "../../model/connect.php";
$db = new db();
$connect = $db->connect();
if(isset($_POST['record_id']) && !isset($_POST['stt']))
{	
	$record_id = $_POST['record_id'];
	$name = $_POST['name'];
	$sex = $_POST['sex'];
	$year = $_POST['year'];
	$diagnose = $_POST['diagnose'];
	$descript = $_POST['descript'];
	$status = $_POST['status'];
	$sql = "
	update patient_medical_record set 
	patient_name='$name',	
	patient_year='$year',
	patient_sex='$sex',
	diagnose='$diagnose',
	descript='$descript',
	status='$status' 
	where record_id='$record_id' limit 1 ";
	$query1 = mysqli_query($connect,$sql);	
	if($query1)
	{
		echo 'success';
	}
	else
	{
		echo 'failed';
	}
}
else if(isset($_POST['record_id']) && isset($_POST['stt']))
{
	$record_id = $_POST['record_id'];
	$status = $_POST['stt'];
	$sql = "update patient_medical_record set status='$status' where record_id='$record_id' limit 1";
	$query2 = mysqli_query($connect,$sql);	
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
?>