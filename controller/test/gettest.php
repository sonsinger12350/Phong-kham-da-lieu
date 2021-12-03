<?php
//Pagination
$number = mysqli_query($connect,"select count(test_id) as total from test");
$rw = mysqli_fetch_assoc($number);
$total_records = $rw['total'];
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 5;       
$total_page = ceil($total_records / $limit);  
if ($current_page > $total_page){
    $current_page = $total_page;
}
else if ($current_page < 1){
    $current_page = 1;
}
$start = ($current_page - 1) * $limit;
//End
echo '
	<tr align="center" style="font-weight: bold;">
		<td>Ngày tạo</td>			
		<td>Họ tên</td>
		<td>Năm sinh</td>
		<td>Giới tính</td>
		<td>Loại xét nghiệm</td>
		<td>Kết quả xét nghiệm</td>	
		<td>Chức năng</td>				
	</tr>';
$sql = "select * from test order by date desc limit $start,$limit ";
$result = mysqli_query($connect,$sql);
$i = mysqli_num_rows($result);
if($i != 0)	
{
	while ($row = mysqli_fetch_array($result)) 
	{
		if(!empty($row['result']))
		{
			$date = date('Y-m-d',strtotime($row['date']));
			echo '
			<tr align="center">
				<td>'.$date.'</td>			
				<td>'.$row['patient_name'].'</td>
				<td>'.$row['patient_year'].'</td>
				<td>'.$row['patient_sex'].'</td>
				<td>'.$row['type'].'</td>
				<td>
					<button type="button" class="btn btn-link view_result" value="'.$row['test_id'].'">Xem kết quả</button>
				</td>
				<td>
					<button type="button" class="btn btn-link update_test" value="'.$row['test_id'].'" data-toggle="modal" data-target="#modalUpdateTest">Nhập kết quả</button>
				</td>				
			</tr>
			';
		}
		else
		{
			$date = date('Y-m-d',strtotime($row['date']));
			echo '
			<tr align="center">
				<td>'.$date.'</td>			
				<td>'.$row['patient_name'].'</td>
				<td>'.$row['patient_year'].'</td>
				<td>'.$row['patient_sex'].'</td>
				<td>'.$row['type'].'</td>
				<td>Chưa nhập kết quả</td>
				<td>
					<button type="button" class="btn btn-link update_test" value="'.$row['test_id'].'" data-toggle="modal" data-target="#modalUpdateTest">Nhập kết quả</button>
				</td>				
			</tr>
			';
		}	
	}
}
else
{
	echo '<tr align="center"><td colspan="6" style="opacity:0.5">Không có kết quả</td></tr>';
}
if($total_page <= 1 ){
	echo '<script>$("#pagination").hide();</script>';
}
else{
	echo '<script>$("#pagination").show();</script>';
}
?>