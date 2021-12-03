<?php
require_once"../../model/connect.php";
$db= new db();
$connect = $db->connect();
$doctor_id=$_SESSION['user_id'];
//Pagination
$number = mysqli_query($connect,"select count(record_id) as total from patient_medical_record where doctor_id='$doctor_id'");
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
		<td>Ngày tạo</td>	
		<td>Mã bệnh nhân</td>			
		<td>Họ tên</td>
		<td>Năm sinh</td>
		<td>Giới tính</td>
		<td>Chẩn đoán</td>
		<td>Mô tả chi tiết</td>
		<td>Trạng thái</td>		
		<td colspan="2">Chức năng</td>			
	</tr>';
if(isset($_GET['id']) && !empty($_GET['id']))
{
	$id = $_GET['id'];
	$sql1 = "select * from patient_medical_record where patient_id like '%$id%' limit $limit";
	$query = mysqli_query($connect,$sql1);
	$i=mysqli_num_rows($query);
	if($i != 0)
	{
		while($row = mysqli_fetch_array($query))
		{
			echo '
				<tr align="center" id="data">						
					<td>'.$row['date_created'].'</td>
					<td>'.$row['patient_id'].'</td>			
					<td>'.$row['patient_name'].'</td>
					<td>'.$row['patient_year'].'</td>
					<td>'.$row['patient_sex'].'</td>					
					<td>'.$row['diagnose'].'</td>
					<td>'.$row['descript'].'</td>
					<td>'.$row['status'].'</td>	
					<td>	
					<div class="dropdown">
					<button class="btn btn-primary" type="button" data-toggle="dropdown">Chọn chức năng</button>
						<ul class="dropdown-menu" >
							<li>
								<button type="button" class="btn btn-link updateR" value="'.$row['record_id'].'" data-toggle="modal" data-target="#modalUpdateRecord">Cập nhật hồ sơ</button>
							</li>							
							<li>
								<a href="index.php?action=creprescription&id='.$row['record_id'].'"style="margin-left:12px">Tạo đơn thuốc</a>
							</li>
							<li>
								<a href="index.php?action=viewprescription&id='.$row['record_id'].'"style="margin-left:12px">Xem đơn thuốc</a>
							</li>
							<li>								
								<a href="index.php?action=test&id='.$row['record_id'].'" class="test" style="margin-left:12px;">Xét nghiệm</a>								
							</li>   
							<li>								
								<a href="index.php?action=reexam&id='.$row['record_id'].'" class="test" style="margin-left:12px;">Lịch tái khám</a>								
							</li>    
						</ul>
					</div>
					</td>								
				</tr>';
		}
	}
	else
	{
		echo '<tr><td colspan="10" style="opacity:0.6" align="center">Không có hồ sơ</td></tr>';
	}
}
else if(isset($_GET['phone']))
{
	$phone = $_GET['phone'];
	$sql = "select * from patient_medical_record where patient_phone='$phone' order by date_created DESC limit $limit";
	$result=mysqli_query($connect,$sql); 
	$i=mysqli_num_rows($result);	
	if($i != 0)
	{					
		while($row=mysqli_fetch_array($result))
		{			
				echo '
				<tr align="center" id="data">	
					<td>'.$row['date_created'].'</td>
					<td>'.$row['patient_id'].'</td>			
					<td>'.$row['patient_name'].'</td>
					<td>'.$row['patient_year'].'</td>
					<td>'.$row['patient_sex'].'</td>					
					<td>'.$row['diagnose'].'</td>
					<td>'.$row['descript'].'</td>
					<td>'.$row['status'].'</td>	
					<td>	
					<div class="dropdown">
					<button class="btn btn-primary" type="button" data-toggle="dropdown">Chọn chức năng</button>
						<ul class="dropdown-menu" >
							<li>
								<button type="button" class="btn btn-link updateR" value="'.$row['record_id'].'" data-toggle="modal" data-target="#modalUpdateRecord">Cập nhật hồ sơ</button>
							</li>							
							<li>
								<a href="index.php?action=creprescription&id='.$row['record_id'].'"style="margin-left:12px">Tạo đơn thuốc</a>
							</li>
							<li>
								<a href="index.php?action=viewprescription&id='.$row['record_id'].'"style="margin-left:12px">Xem đơn thuốc</a>
							</li>
							<li>								
								<a href="index.php?action=test&id='.$row['record_id'].'" class="test" style="margin-left:12px;">Xét nghiệm</a>								
							</li> 
							<li>								
								<a href="index.php?action=reexam&id='.$row['record_id'].'" class="test" style="margin-left:12px;">Lịch tái khám</a>								
							</li>     
						</ul>
					</div>
					</td>								
				</tr>';		
		}
	}	
}
else
{
	$sql = "select * from patient_medical_record where doctor_id='$doctor_id' order by record_id DESC limit $start,$limit";
	$result=mysqli_query($connect,$sql); 
	if($result != null){
		$i=mysqli_num_rows($result);
	}
	else{
		$i = 0;
	}		
	if($i != 0)
	{					
		while($row=mysqli_fetch_array($result))
		{			
				echo '
				<tr align="center" id="data">	
					<td>'.$row['date_created'].'</td>
					<td>'.$row['patient_id'].'</td>			
					<td>'.$row['patient_name'].'</td>
					<td>'.$row['patient_year'].'</td>
					<td>'.$row['patient_sex'].'</td>					
					<td>'.$row['diagnose'].'</td>
					<td>'.$row['descript'].'</td>
					<td>'.$row['status'].'</td>	
					<td>	
					<div class="dropdown">
					<button class="btn btn-primary" type="button" data-toggle="dropdown">Chọn chức năng</button>
						<ul class="dropdown-menu" >
							<li>
								<button type="button" class="btn btn-link updateR" value="'.$row['record_id'].'" data-toggle="modal" data-target="#modalUpdateRecord">Cập nhật hồ sơ</button>
							</li>							
							<li>
								<a href="index.php?action=creprescription&id='.$row['record_id'].'"style="margin-left:12px">Tạo đơn thuốc</a>
							</li>
							<li>
								<a href="index.php?action=viewprescription&id='.$row['record_id'].'"style="margin-left:12px">Xem đơn thuốc</a>
							</li>
							<li>								
								<a href="index.php?action=test&id='.$row['record_id'].'" class="test" style="margin-left:12px;">Xét nghiệm</a>								
							</li> 
							<li>								
								<a href="index.php?action=reexam&id='.$row['record_id'].'" class="test" style="margin-left:12px;">Lịch tái khám</a>								
							</li>     
						</ul>
					</div>
					</td>								
				</tr>';			
		}
	}	
	else
	{
		echo '
		<tr>
			<td colspan="10" style="opacity:0.6" align="center">Không có hồ sơ</td>
		</tr>
		';
	}
}

if($total_page <=1){
	echo '<script>$("#pagination").hide();</script>';
}
?>