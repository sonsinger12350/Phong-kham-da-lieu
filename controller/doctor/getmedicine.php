<?php
require_once "../../model/connect.php";
$db= new db();
$connect = $db->connect();
if(!isset($_GET['name']) && empty($_GET['name']))
{
	$sql = "select * from medicines";
	$result = mysqli_query($connect,$sql);
	$i = mysqli_num_rows($result);
	if($i != 0)
	{
		echo '
			<tr class="bold">
				<td>Tên thuốc</td>
				<td>Liều lượng</td>
				<td>Đơn vị tính</td>
				<td>Kho</td>
				<td>Chức năng</td>
			</tr>
		';
		while($row = mysqli_fetch_array($result))
		{			
			echo '				
				<tr>
					<td>'.$row['name'].'</td>
					<td>'.$row['howtouse'].'</td>
					<td>'.$row['unit'].'</td>
					<td>'.$row['quantity'].'</td>
					<td><button type="button" data-name="'.$row['name'].'" data-use="'.$row['howtouse'].'"  data-unit="'.$row['unit'].'" data-toggle="modal" data-target="#modalAddMedicine" class="btn btn-link add_pre">Thêm</button></td>
				</tr>
			';
		}
	}
}
else if(isset($_GET['name']) && !empty($_GET['name']))
{
	$name = $_GET['name'];
	$sql = "select * from medicines where name like '%$name%'";
	$result = mysqli_query($connect,$sql);
	$i = mysqli_num_rows($result);
	if($i != 0)
	{
		echo '
			<tr class="bold">
				<td>Tên thuốc</td>
				<td>Liều lượng</td>
				<td>Đơn vị tính</td>
				<td>Kho</td>
				<td>Chức năng</td>
			</tr>
		';
		while($row = mysqli_fetch_array($result))
		{
			echo '				
				<tr>
					<td>'.$row['name'].'</td>
					<td>'.$row['howtouse'].'</td>
					<td>'.$row['unit'].'</td>
					<td>'.$row['quantity'].'</td>
					<td><button type="button" data-name="'.$row['name'].'" data-use="'.$row['howtouse'].'"  data-unit="'.$row['unit'].'" data-toggle="modal" data-target="#modalAddMedicine" class="btn btn-link add_pre">Thêm</button></td>
				</tr>
			';
		}
	}
	else
	{
		echo '
			<tr class="bold">
				<td>Tên thuốc</td>
				<td>Liều lượng</td>
				<td>Kho</td>
				<td>Chức năng</td>
			</tr>
			<tr><td colspan="4" style="opacity:0.5">Không tìm thấy</td></tr>
		';
	}
}
?>