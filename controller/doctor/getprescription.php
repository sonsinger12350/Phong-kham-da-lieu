<?php
echo '
	<tr align="center" style="font-weight: bold;">
		<td>STT</td>
		<td>Ngày tạo</td>					
		<td>Họ tên</td>
		<td>Năm sinh</td>
		<td>Giới tính</td>
		<td>Chẩn đoán</td>
		<td>Bác sĩ</td>				
		<td>Chức năng</td>			
	</tr>';
if(isset($_GET['id']))
{
	$id = $_GET['id'];
	$count = 1;
	$result = mysqli_query($connect,"select * from prescription where record_id='$id'");
	$i = mysqli_num_rows($result);
	if($i != 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			echo '
				<tr align="center">
					<td>'.$count.'</td>
					<td>'.$row['date_created'].'</td>					
					<td>'.$row['patient_name'].'</td>
					<td>'.$row['patient_year'].'</td>
					<td>'.$row['patient_sex'].'</td>
					<td>'.$row['diagnose'].'</td>
					<td>'.$row['doctor_name'].'</td>				
					<td>
						<button type="button" class="btn btn-primary view_pre" data-toggle="modal" data-target="#modalViewPrescription" value="'.$row['prescription_id'].'">Xem chi tiết</button>
						<button type="button" class="btn btn-primary detele_pre" value="'.$row['prescription_id'].'" data-toggle="modal" data-target="#modalDeletePrescription">Xóa</button>
					</td>			
				</tr>';
			$count++;
		}
	}
	else
	{
		echo '<tr align="center" style="opacity:0.5"><td colspan="8">Không có đơn thuốc</td></tr>';
	}
}
?>