<?php
require_once "../../model/connect.php";
require_once "../../library/phpqrcode/qrlib.php";
$db = new db();
$connect = $db->connect();
if(isset($_GET['name']))
{
	$user_id = $_SESSION['user_id'];
	$name = $_GET['name'];
	$sex = $_GET['sex'];
	$year = $_GET['year'];
	$phone = $_GET['phone'];
	$doctor = $_GET['doctor'];
	$date = $_GET['date'];
	$time = $_GET['time'];
	$sql = "insert into schedule(user_id,patient_name,patient_phone,patient_year,patient_sex,doctor,date,time,paid)	 
	values('$user_id','$name','$phone','$year','$sex','$doctor','$date','$time','Chưa thanh toán')";
	$result = mysqli_query($connect,$sql);
	$last_id = mysqli_insert_id($connect);
	$file="../../image/qrcode/".$last_id.".png";
	$url = 'http://localhost:88/phongkham/view/receptionist/index.php?id='.$last_id.'';
	QRcode::png($url,$file,QR_ECLEVEL_L,5);
	echo 'success';
}
else
{
	echo 'wrong';
}
?>