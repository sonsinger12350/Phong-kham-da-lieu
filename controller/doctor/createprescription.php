<?php
require_once "../../model/connect.php";
$db = new db();
$connect = $db->connect();
if(isset($_POST['record_id']))
{
	$doctor_name = $_SESSION['name'];
	$record_id = $_POST['record_id'];
	$patient_id = $_POST['patient_id'];	
	$patient_name = $_POST['patient_name'];
	$patient_year = $_POST['patient_year'];
	$patient_sex = $_POST['patient_sex'];
	$diagnose = $_POST['diagnose'];
	$date = $_POST['date'];	
	$medicine = $_POST['medicine'];
	$obj = json_decode($medicine,true);
	$length=count($obj);
	$sql = "insert into 
	prescription(record_id,doctor_name,patient_id,patient_name,patient_year,patient_sex,diagnose,reexamination)
	values('$record_id','$doctor_name','$patient_id','$patient_name','$patient_year','$patient_sex','$diagnose','$date')";
	$query = mysqli_query($connect,$sql);
	if($query)
	{
		$id = mysqli_insert_id($connect);
		mysqli_query($connect,"insert into prescription_detail(prescription_id,medicine) values('$id','$medicine')");
		for($i=0;$i<$length;$i++)
		{
			$name = $obj[$i]['name'];
			$result = mysqli_query($connect,"select * from medicines where name = '$name'");
			$row = mysqli_fetch_array($result);
			$quantity = (int)$obj[$i]['quantity'];
			$newquantity = $row['quantity'] - $quantity;					
			mysqli_query($connect,"update medicines set quantity = '$newquantity' where name = '$name'");	
		}
		echo 'success';

	}
	else
	{
		echo mysqli_error($connect);
	}

}
?>