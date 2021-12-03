<?php
$doctor_id=$_SESSION['user_id'];
echo '
	<tr align="center" style="font-weight: bold;">
		<td>STT</td>
		<td>Ngày tạo</td>			
		<td>Họ tên</td>
		<td>Năm sinh</td>
		<td>Giới tính</td>
		<td>Loại xét nghiệm</td>
		<td>Kết quả xét nghiệm</td>				
	</tr>';
if(isset($_GET['id']) && !empty($_GET['id']))
{
	$id = $_GET['id'];
	$sql = "select * from test where record_id ='$id'";
	$result = mysqli_query($connect,$sql);
	$i = mysqli_num_rows($result);
	$count = 1;
	if($i != 0)
	{
		while ($row = mysqli_fetch_array($result)) 
		{
			if(!empty($row['result'])){
				$date = date('Y-m-d',strtotime($row['date']));
				echo '
				<tr align="center">
					<td>'.$count.'</td>
					<td>'.$date.'</td>			
					<td>'.$row['patient_name'].'</td>
					<td>'.$row['patient_year'].'</td>
					<td>'.$row['patient_sex'].'</td>
					<td>'.$row['type'].'</td>
					<td>
						<button type="button" class="btn btn-link view_result" value="'.$row['test_id'].'">Xem kết quả</button>
					</td>				
				</tr>
				';	
			}
			else
			{
				$date = date('Y-m-d',strtotime($row['date']));
				echo '
				<tr align="center">
					<td>'.$count.'</td>
					<td>'.$date.'</td>			
					<td>'.$row['patient_name'].'</td>
					<td>'.$row['patient_year'].'</td>
					<td>'.$row['patient_sex'].'</td>
					<td>'.$row['type'].'</td>
					<td>Chưa có kết quả</td>				
				</tr>
				';
			}			
			$count++;
		}
	}
	else
	{
		echo '<tr align="center"><td colspan="7" style="opacity:0.5">Không có kết quả</td></tr>';
	}
}
?>