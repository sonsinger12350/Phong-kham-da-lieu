<?php
require_once "../../model/connect.php";
$db = new db();
$connect = $db->connect();
if(isset($_GET['record_id']))
{
	$record_id = $_GET['record_id'];
	$sql="select * from patient_medical_record where record_id = '$record_id'";
	$result = mysqli_query($connect,$sql);
	$i = mysqli_num_rows($result);
	if($i != 0)
	{	
		$row = mysqli_fetch_array($result);	
		$data ='{
			"patient_id":"'.$row['patient_id'].'",			
			"name":"'.$row['patient_name'].'",
			"sex":"'.$row['patient_sex'].'",
			"year":"'.$row['patient_year'].'",
			"phone":"'.$row['patient_phone'].'",
			"doctor":"'.$row['doctor_name'].'",
			"diagnose":"'.$row['diagnose'].'",
			"descript":"'.$row['descript'].'",
			"status":"'.$row['status'].'"
		}';			
		echo $data;
	}	
}
?>