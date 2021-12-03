<?php
echo '
	<tr align="center" style="font-weight: bold;">
		<td>Ngày tạo</td>					
		<td>Họ tên</td>
		<td>Năm sinh</td>
		<td>Giới tính</td>
		<td>Chẩn đoán</td>
		<td>Bác sĩ</td>				
		<td>Chức năng</td>			
	</tr>';
if(isset($_SESSION['user_id']))
{
	$id = $_SESSION['user_id'];	
	$query = mysqli_query($connect,"select * from users where user_id='$id'");
	$rw = mysqli_fetch_array($query);
	if(!empty($rw['patient_id'])){
		$patient_id=$rw['patient_id'];
	}
	$result = mysqli_query($connect,"select * from prescription where patient_id='$patient_id'");
	$i = mysqli_num_rows($result);
	if($i != 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			echo '
				<tr align="center">
					<td>'.$row['date_created'].'</td>					
					<td>'.$row['patient_name'].'</td>
					<td>'.$row['patient_year'].'</td>
					<td>'.$row['patient_sex'].'</td>
					<td>'.$row['diagnose'].'</td>
					<td>'.$row['doctor_name'].'</td>				
					<td>
						<button type="button" class="btn btn-primary view_pre" data-toggle="modal" data-target="#modalViewPrescription" value="'.$row['prescription_id'].'">Xem chi tiết</button>						
					</td>			
				</tr>';			
		}
	}
	else
	{
		echo '<tr align="center" style="opacity:0.5"><td colspan="7">Không có đơn thuốc</td></tr>';
	}
}
?>