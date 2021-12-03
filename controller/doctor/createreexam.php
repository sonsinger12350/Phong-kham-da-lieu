<?php
require_once "../../model/connect.php";
require_once "../../library/phpqrcode/qrlib.php";
$db = new db();
$connect = $db->connect();
if(isset($_GET['record_id']) && !empty($_GET['record_id']))
{
	$record_id = $_GET['record_id'];
	$date_reexam = $_GET['date'];
	$date_create = $_GET['date_create'];
	$add_date = strtotime('+'.$date_reexam.' day',strtotime($date_create));
	$date = date('Y-m-d',$add_date);
	$query1 = mysqli_query($connect,"select * from patient_medical_record where record_id = '$record_id'");	
	$row = mysqli_fetch_array($query1);
	$patient_id = $row['patient_id'];
	$name = $row['patient_name'];
	$sex = $row['patient_sex'];
	$year = $row['patient_year'];
	$phone = $row['patient_phone'];
	$doctor = $row['doctor_name'];		 		
	$sql = "insert into schedule(patient_id,patient_name,patient_phone,patient_year,patient_sex,doctor,date,status)	 
	values('$patient_id','$name','$phone','$year','$sex','$doctor','$date','Tái khám')";
	$result = mysqli_query($connect,$sql);
	$last_id = mysqli_insert_id($connect);
	$file="../../image/qrcode/".$last_id.".png";
	$url = 'http://localhost:88/phongkham/view/receptionist/index.php?id='.$last_id.'';
	QRcode::png($url,$file,QR_ECLEVEL_L,5);	
}
?>