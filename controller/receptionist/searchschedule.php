<?php
require_once "../../model/connect.php";
$db = new db();
$connect = $db->connect();
$count = 1;
if(isset($_GET['phone']))
{
	$phone = $_GET['phone'];
	$sql = "select * from schedule where patient_phone = '$phone'";
	$result = mysqli_query($connect,$sql);
	$i = mysqli_num_rows($result);
	if($i != 0 )
	{
		echo '
			<tr align="center" style="font-weight: bold;">	
				<td>STT</td>			
				<td>Ngày khám</td>
				<td>Giờ</td>
				<td>Họ tên bệnh nhân</td>
				<td>Điện thoại</td>
				<td>Bác sĩ khám</td>				
				<td>Trạng thái</td>
				<td>Chức năng</td>			
			</tr>	';
		while($row = mysqli_fetch_array($result))
		{
			if($row['status']=='Chưa khám')
				{
					echo '
					<tr align="center">					
						<td hidden id="schedule_id">'.$row['schedule_id'].'</td>
						<td>'.$count.'</td>
						<td>'.$row['date'].'</td>
						<td>'.$row['time'].'</td>
						<td>'.$row['patient_name'].'</td>
						<td>'.$row['patient_phone'].'</td>
						<td>'.$row['doctor'].'</td>
						<td>'.$row['status'].'</td>		
						<td><button type="button" class="btn btn-primary changeC" data-toggle="modal" data-target="#modalChangeSchedule" value="'.$row['schedule_id'].'">Đổi lịch</button>
						</td>											
					</tr>';	
				}
			else if($row['status']=='Đã khám')
				{
					echo '
					<tr align="center">
						<td>'.$count.'</td>
						<td>'.$row['date'].'</td>
						<td>'.$row['time'].'</td>
						<td>'.$row['patient_name'].'</td>
						<td>'.$row['patient_phone'].'</td>
						<td>'.$row['doctor'].'</td>
						<td>'.$row['status'].'</td>	
						<td><button type="button" class="btn btn-primary changeC" data-toggle="modal" data-target="#modalChangeSchedule" value="'.$row['schedule_id'].'" disabled>Đổi lịch</button>
						</td>									
					</tr>';	
				}
			$count++;
		}		
	}
	else
	{
		echo 'notfound';
	}
}
?>