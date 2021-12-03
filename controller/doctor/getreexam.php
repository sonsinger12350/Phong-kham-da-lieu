<?php
$doctor = $_SESSION['name'];
$record_id = $_GET['id'];
$query1 = mysqli_query($connect,"select * from patient_medical_record where record_id = '$record_id'");
$data = mysqli_fetch_array($query1);
$patient_name = $data['patient_name'];
$sql = "select * from schedule where doctor ='$doctor' and status='Tái khám' and patient_name='$patient_name'";
$query2 = mysqli_query($connect,$sql);
$i = mysqli_num_rows($query2);
$count = 1;
echo '
	<tr align="center" style="font-weight: bold;">
		<td>STT</td>				
		<td>Ngày khám</td>
		<td>Giờ</td>
		<td>Họ tên</td>
		<td>Giới tính</td>
		<td>Năm sinh</td>
		<td>Điện thoại</td>			
		<td>Trạng thái</td>			
	</tr>';
if($i != 0)
{
	while($row = mysqli_fetch_array($query2))
	{
		echo '
			<tr align="center">
				<td>'.$count.'</td>
				<td>'.$row['date'].'</td>
				<td>'.$row['time'].'</td>
				<td>'.$row['patient_name'].'</td>
				<td>'.$row['patient_sex'].'</td>
				<td>'.$row['patient_year'].'</td>
				<td>'.$row['patient_phone'].'</td>
				<td>'.$row['status'].'</td>												
			</tr>';
	}
}
else
{
	echo '<tr><td colspan="8" style="opacity:0.6" align="center">Không có lịch khám</td></tr>';
}
?>