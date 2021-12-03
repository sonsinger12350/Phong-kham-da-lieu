<?php
echo '
<tr align="center" style="font-weight: bold;">		
	<td>Ngày khám</td>
	<td>Giờ</td>
	<td>Họ tên</td>
	<td>Giới tính</td>
	<td>Năm sinh</td>
	<td>Điện thoại</td>
	<td>Bác sĩ khám</td>
	<td>Trạng thái</td>	
	<td colspan="2">Chức năng</td>			
</tr>
';
if(isset($_SESSION['user_id']))
{	
	$user_id = $_SESSION['user_id'];
	$query = mysqli_query($connect,"select * from users where user_id='$user_id'");
	$rw = mysqli_fetch_array($query);
	if(!empty($rw['patient_id'])){
		$patient_id=$rw['patient_id'];
	}
	$sql = "select * from schedule where user_id='$user_id' or patient_id='$patient_id' order by date DESC,time ASC";
	$result=mysqli_query($connect,$sql); 
	$i=mysqli_num_rows($result);	
	if($i != 0)
	{
		while($row=mysqli_fetch_array($result))
		{
			if($row['paid']=='Chưa thanh toán')
			{
				echo '
					<tr align="center">
						<td hidden id="schedule_id">'.$row['schedule_id'].'</td>
						<td>'.$row['date'].'</td>
						<td>'.$row['time'].'</td>
						<td>'.$row['patient_name'].'</td>
						<td>'.$row['patient_sex'].'</td>
						<td>'.$row['patient_year'].'</td>
						<td>'.$row['patient_phone'].'</td>
						<td>'.$row['doctor'].'</td>
						<td>'.$row['paid'].'</td>		
						<td>
							<button type="button" class="btn btn-primary changeC" data-toggle="modal" data-target="#modalChangeSchedule" value="'.$row['schedule_id'].'">Đổi lịch</button>
							<button type="button" class="btn btn-primary qr_code" data-toggle="modal" data-target="#modalPaymentGuide">Hướng dẫn thanh toán</button>
						</td>						
					</tr>';
			}
			else if($row['status']=='Chưa khám')
			{				
				echo '
					<tr align="center">
						<td hidden id="schedule_id">'.$row['schedule_id'].'</td>
						<td>'.$row['date'].'</td>
						<td>'.$row['time'].'</td>
						<td>'.$row['patient_name'].'</td>
						<td>'.$row['patient_sex'].'</td>
						<td>'.$row['patient_year'].'</td>
						<td>'.$row['patient_phone'].'</td>
						<td>'.$row['doctor'].'</td>
						<td>'.$row['status'].'</td>		
						<td>
							<button type="button" class="btn btn-primary changeC" data-toggle="modal" data-target="#modalChangeSchedule" value="'.$row['schedule_id'].'">Đổi lịch</button>
							<button type="button" class="btn btn-primary qr_code" data-toggle="modal" data-target="#modalViewQRCode" value="'.$row['schedule_id'].'">Xem mã QR</button>
						</td>						
					</tr>';
			}
			else if($row['status']=='Đã khám')
			{
				echo '
				<tr align="center">
					<td>'.$row['date'].'</td>
					<td>'.$row['time'].'</td>
					<td>'.$row['patient_name'].'</td>
					<td>'.$row['patient_sex'].'</td>
					<td>'.$row['patient_year'].'</td>
					<td>'.$row['patient_phone'].'</td>
					<td>'.$row['doctor'].'</td>
					<td>'.$row['status'].'</td>	
					<td>
						<button type="button" class="btn btn-primary" disabled>Đổi lịch</button>
						<button type="button" class="btn btn-primary" disabled>Xem mã QR</button>
					</td>				
				</tr>';	
			}
			else
			{
				echo '
				<tr align="center">
					<td>'.$row['date'].'</td>
					<td>'.$row['time'].'</td>
					<td>'.$row['patient_name'].'</td>
					<td>'.$row['patient_sex'].'</td>
					<td>'.$row['patient_year'].'</td>
					<td>'.$row['patient_phone'].'</td>
					<td>'.$row['doctor'].'</td>
					<td>'.$row['status'].'</td>	
					<td>
						<button type="button" class="btn btn-primary" disabled>Đổi lịch</button>
						<button type="button" class="btn btn-primary qr_code" data-toggle="modal" data-target="#modalViewQRCode" value="'.$row['schedule_id'].'">Xem mã QR</button>
					</td>				
				</tr>';	
			}			
		}
	}
	else
	{
		echo '
		<tr>
			<td colspan="9" style="opacity:0.6" align="center">Không có lịch khám</td>
		</tr>
		';
	}
}
?>