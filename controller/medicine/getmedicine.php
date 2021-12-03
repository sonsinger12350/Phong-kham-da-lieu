<?php
require_once "../../model/connect.php";
$db = new db();
$connect = $db->connect();
//Pagination
$number = mysqli_query($connect,"select count(medicine_id) as total from medicines");
$rw = mysqli_fetch_assoc($number);
$total_records = $rw['total'];
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 10;       
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
	<td>Tên thuốc</td>
	<td>Đơn vị tính</td>
	<td>Liều lượng</td>	
	<td>Số lượng</td>
	<td>Chức năng</td>
</tr>	
';
if(isset($_GET['search_name']) && !empty($_GET['search_name']))
{
	$search_name = $_GET['search_name'];
	$sql = "select * from medicines where name like '%$search_name%' order by name limit $limit";	
	$result = mysqli_query($connect,$sql);
	$i = mysqli_num_rows($result);
	if($i != 0)
	{
		while($row = mysqli_fetch_array($result))
		{
			echo '
			<tr align="center">	
				<td>'.$row['name'].'</td>
				<td>'.$row['unit'].'</td>
				<td>'.$row['howtouse'].'</td>
				<td>'.$row['quantity'].'</td>
				<td>
					<button type="button" class="btn btn-primary updateM" value="'.$row['medicine_id'].'" data-toggle="modal" data-target="#modalUpdateMedicine">Cập nhật</button>
					<button type="button" class="btn btn-primary deleteM" value="'.$row['medicine_id'].'" data-toggle="modal" data-target="#modalDeleteMedicine" name="'.$row['name'].'">Xóa</button>
				</td>
			</tr>	
			';
			$count++;
		}
	}
	else
	{
		echo '
			<tr>
				<td colspan="6" style="opacity:0.5" align="center">Không có kết quả</td>
			</tr>
		';
	}
}
else if(empty($_GET['medicine_name']) || !isset($_GET['medicine_name']))
{
	$sql = "select * from medicines order by name limit $start,$limit";
	$result = mysqli_query($connect,$sql);
	$i = mysqli_num_rows($result);
	if($i != 0)
	{
		while($row = mysqli_fetch_array($result))
		{		
			echo '
			<tr align="center">				
				<td>'.$row['name'].'</td>
				<td>'.$row['unit'].'</td>
				<td>'.$row['howtouse'].'</td>	
				<td>'.$row['quantity'].'</td>
				<td>
					<button type="button" class="btn btn-primary updateM" value="'.$row['medicine_id'].'" data-toggle="modal" data-target="#modalUpdateMedicine">Cập nhật</button>
					<button type="button" class="btn btn-primary deleteM" value="'.$row['medicine_id'].'" data-toggle="modal" data-target="#modalDeleteMedicine" name="'.$row['name'].'">Xóa</button>
				</td>
			</tr>	
			';			
		}
	}
	else
	{
		echo '
		<tr>
			<td colspan="6" style="opacity:0.6" align="center">Không có thuốc</td>
		</tr>
		';
	}
}
?>