<?php
require_once "../../model/connect.php";
$db = new db();
$connect = $db->connect();
$count = 1;
if(isset($_GET['phone']))
{
	$phone = $_GET['phone'];
	$sql = "select distinct patient_phone from schedule where patient_phone like '$phone%'";
	$result = mysqli_query($connect,$sql);
	$i = mysqli_num_rows($result);
	if($i != 0 )
	{
		while($row = mysqli_fetch_array($result))
		{
			echo '<li><button type="button" class="btn btn-link num" value="'.$row['patient_phone'].'">'.$row['patient_phone'].'</button></li>';
		}				
	}
	else
	{
		echo '<li role="presentation"><a href="#" disabled>Không tìm thấy</a></li>';
	}	
}
?>