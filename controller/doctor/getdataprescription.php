<?php
require_once "../../model/connect.php";
$db = new db();
$connect = $db->connect();
if(isset($_GET['id']))
{
	$prescription_id = $_GET['id'];
	$sql="select * from prescription where prescription_id = '$prescription_id'";
	$result = mysqli_query($connect,$sql);
	$i = mysqli_num_rows($result);
	if($i != 0)
	{	
		$row = mysqli_fetch_array($result);	
		$query = mysqli_query($connect,"select * from prescription_detail where prescription_id='$prescription_id'");
		if($query)
		{
			$num = mysqli_num_rows($query);
			if($num != 0)
			{
				$rw = mysqli_fetch_array($query);				
				$data ='{			
					"name":"'.$row['patient_name'].'",
					"sex":"'.$row['patient_sex'].'",
					"year":"'.$row['patient_year'].'",
					"diagnose":"'.$row['diagnose'].'",
					"doctor":"'.$row['doctor_name'].'",				
					"id":"'.$row['patient_id'].'",
					"date":"'.$row['reexamination'].'",
					"medicine":'.$rw['medicine'].'
				}';			
				echo $data;
			}			
		}		
	}		
}
?>