<?php
require_once "../../model/connect.php";
$db = new db();
$connect = $db->connect();
if(isset($_POST['schedule_id']))
{
	$schedule_id = $_POST['schedule_id'];
	$sql="select * from schedule where schedule_id = '$schedule_id'";
	$result = mysqli_query($connect,$sql);
	$i = mysqli_num_rows($result);
	if($i != 0)
	{	
		$row = mysqli_fetch_array($result);	
		$data ='{
			"id":"'.$row['user_id'].'",
			"name":"'.$row['patient_name'].'",
			"sex":"'.$row['patient_sex'].'",
			"year":"'.$row['patient_year'].'",
			"phone":"'.$row['patient_phone'].'"
		}';			
		echo $data;
	}	
}
?>