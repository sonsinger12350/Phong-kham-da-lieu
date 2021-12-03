<?php
require_once"../../model/connect.php";
$db = new db();
$connect = $db->connect();

if(isset($_GET['id']))
{
	$id = $_GET['id'];
	$sql = "select * from schedule where schedule_id='$id'";
	$result = mysqli_query($connect,$sql);
	$i = mysqli_num_rows($result);
	if($i > 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			echo					
				'
				<div class="card mx-auto bg-light text-dark" style="width:500px" >
				<h3 align="center">Lịch khám</h3>
				<br>
				<table align="center">		
					<tr height="50px">
						<td class="label"> Ngày khám: </td>
						<td>'.$row['date'].'</td>
					</tr>
					<tr>
						<td class="label">Giờ khám: </td>
						<td>'.$row['time'].'</td>
					</tr>
					<tr height="50px">
						<td class="label">Tên bệnh nhân: </td>
						<td>'.$row['patient_name'].'</td>
					</tr>
					<tr>
						<td class="label">Bác sĩ khám: </td>
						<td>'.$row['doctor'].'</td>
					</tr>
					<tr height="50px">
						<td class="label">Trạng thái: </td>
						<td>'.$row['status'].'</td>
					</tr>
				</table>
				</div>
				'
			;
		}
	}
}
?>