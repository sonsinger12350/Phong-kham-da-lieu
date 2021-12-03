<?php
//Pagination
$number = mysqli_query($connect,"select count(type_id) as total from test_type");
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
		<td>Loại xét nghiệm</td>
		<td>Chức năng</td>						
	</tr>';
$sql = "select * from test_type limit $start,$limit";
$result = mysqli_query($connect,$sql);
$i = mysqli_num_rows($result);
if($i != 0)	
{
	while ($row = mysqli_fetch_array($result)) 
	{		
		echo '
		<tr align="center">		
			<td>'.$row['name'].'</td>	
			<td>
				<button type="button" class="btn btn-primary delete_type" value="'.$row['type_id'].'" data-toggle="modal" data-target="#modalDeleteType" name = "'.$row['name'].'">Xóa</button>
			</td>				
		</tr>
		';
	}
}
if($total_page <= 1 ){
	echo '<script>$("#pagination").hide();</script>';
}
else{
	echo '<script>$("#pagination").show();</script>';
}
?>