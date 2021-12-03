<?php
require_once "../../model/connect.php";
$db = new db();
$connect = $db->connect();

if(isset($_POST['record_id']))
{
	$record_id = $_POST['record_id'];
	$name = $_POST['name'];
	$year = $_POST['year'];
	$sex =$_POST['sex'];
	$type =$_POST['type'];
	$sql = "insert into 
	test(record_id,patient_name,patient_year,patient_sex,type) 
	values('$record_id','$name','$year','$sex','$type')";
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