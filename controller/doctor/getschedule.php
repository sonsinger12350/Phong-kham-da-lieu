<?php
require_once "../../model/connect.php";
$db = new db();
$connect = $db->connect();
$doctor_name=$_SESSION['name'];

//Pagination

$number = mysqli_query($connect,"select count(schedule_id) as total from schedule where doctor='$doctor_name'");
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
		<td>Ngày khám</td>
		<td>Giờ</td>
		<td>Họ tên</td>
		<td>Giới tính</td>
		<td>Năm sinh</td>
		<td>Điện thoại</td>			
		<td>Trạng thái</td>
		<td>Chức năng</td>			
	</tr>';
if(isset($_GET['option']))
{
	$option = $_GET['option'];
	if($option=='Toàn bộ')
	{
		$sql = "select * from schedule where doctor='$doctor_name' and status != '' order by date DESC limit $limit";
		$result=mysqli_query($connect,$sql); 
		$i=mysqli_num_rows($result);
		if($i != 0)
		{					
			while($row=mysqli_fetch_array($result))
			{
				if($row['status']=='Chưa khám')
				{
					echo '
					<tr align="center" id="data">
						<td>'.$row['date'].'</td>
						<td id="time">'.$row['time'].'</td>
						<td>'.$row['patient_name'].'</td>
						<td>'.$row['patient_sex'].'</td>
						<td>'.$row['patient_year'].'</td>
						<td>'.$row['patient_phone'].'</td>
						<td class="st">'.$row['status'].'</td>		
						<td>							
							<button type="button" class="btn btn-primary profile" data-toggle="modal" data-target="#modalCreateRecord" value="'.$row['schedule_id'].'">Tạo hồ sơ
							</button>
						</td>								
					</tr>';	
				}
				else if($row['status']=='Tái khám')
				{
					echo '
					<tr align="center" id="data">
						<td>'.$row['date'].'</td>
						<td id="time">'.$row['time'].'</td>
						<td>'.$row['patient_name'].'</td>
						<td>'.$row['patient_sex'].'</td>
						<td>'.$row['patient_year'].'</td>
						<td>'.$row['patient_phone'].'</td>
						<td class="st">'.$row['status'].'</td>		
						<td>
							<a href="?action=record&phone='.$row['patient_phone'].'" class="re_exam">Hồ sơ</a>
						</td>								
					</tr>';	
				}
				else
				{
					echo '
					<tr align="center" id="data">
						<td>'.$row['date'].'</td>
						<td id="time">'.$row['time'].'</td>
						<td>'.$row['patient_name'].'</td>
						<td>'.$row['patient_sex'].'</td>
						<td>'.$row['patient_year'].'</td>
						<td>'.$row['patient_phone'].'</td>
						<td class="st">'.$row['status'].'</td>		
						<td>
							<button type="button" class="btn btn-primary profile" data-toggle="modal" data-target="#modalCreateRecord" value="'.$row['schedule_id'].'" disabled>Tạo hồ sơ
							</button>
						</td>								
					</tr>';	
				}						
			}
		}
		else
		{
			echo '
			<tr>
				<td colspan="8" style="opacity:0.6" align="center">Không có lịch khám</td>
			</tr>
			';
		}
				
	}
	elseif($option=='Chưa khám')
	{
		$sql = "select * from schedule where doctor='$doctor_name' and status='$option' order by status asc,date DESC limit $limit";
		$result=mysqli_query($connect,$sql); 
		$i=mysqli_num_rows($result);
		if($i != 0)
		{				
			while($row=mysqli_fetch_array($result))
			{	
				echo '
				<tr align="center" id="data">
						<td>'.$row['date'].'</td>
						<td id="time">'.$row['time'].'</td>
						<td>'.$row['patient_name'].'</td>
						<td>'.$row['patient_sex'].'</td>
						<td>'.$row['patient_year'].'</td>
						<td>'.$row['patient_phone'].'</td>
						<td class="st">'.$row['status'].'</td>		
						<td>
							<button type="button" class="btn btn-primary profile" data-toggle="modal" data-target="#modalCreateRecord" value="'.$row['schedule_id'].'">Tạo hồ sơ
							</button>
						</td>								
					</tr>';					
			}
		}
		else
		{
			echo '
			<tr>
				<td colspan="8" style="opacity:0.6" align="center">Không có lịch khám</td>
			</tr>
			';
		}	
	}
	elseif($option=='Đã khám')
	{
		$sql = "select * from schedule where doctor='$doctor_name' and status='$option' order by status asc,date DESC limit $limit";
		$result=mysqli_query($connect,$sql); 
		$i=mysqli_num_rows($result);
		if($i != 0)
		{	
			while($row=mysqli_fetch_array($result))
			{	
				echo '
				<tr align="center" id="data">
						<td>'.$row['date'].'</td>
						<td id="time">'.$row['time'].'</td>
						<td>'.$row['patient_name'].'</td>
						<td>'.$row['patient_sex'].'</td>
						<td>'.$row['patient_year'].'</td>
						<td>'.$row['patient_phone'].'</td>
						<td class="st">'.$row['status'].'</td>		
						<td>
							<button type="button" class="btn btn-primary profile" data-toggle="modal" data-target="#modalCreateRecord" value="'.$row['schedule_id'].'" disabled>Tạo hồ sơ
						</button>
						</td>								
					</tr>';
				$count++;		
			}
		}
		else
		{
			echo '
			<tr>
				<td colspan="8" style="opacity:0.6" align="center">Không có lịch khám</td>
			</tr>
			';
		}
	}
	elseif($option=='Tái khám')
	{
		$sql = "select * from schedule where doctor='$doctor_name' and status='$option' order by date DESC limit $limit";		
		$result=mysqli_query($connect,$sql); 
		$i=mysqli_num_rows($result);
		if($i != 0)
		{				
			while($row=mysqli_fetch_array($result))
			{			
				echo '
				<tr align="center" id="data">
					<td>'.$row['date'].'</td>
					<td id="time">'.$row['time'].'</td>
					<td>'.$row['patient_name'].'</td>
					<td>'.$row['patient_sex'].'</td>
					<td>'.$row['patient_year'].'</td>
					<td>'.$row['patient_phone'].'</td>
					<td class="st">'.$row['status'].'</td>		
					<td>
						<a href="?action=record&phone='.$row['patient_phone'].'" class="re_exam">Hồ sơ</a>
					</td>								
				</tr>';				
			}
		}
		else
		{
			echo '
			<tr>
				<td colspan="8" style="opacity:0.6" align="center">Không có lịch khám</td>
			</tr>
			';
		}
	}
	elseif($option=='Hôm nay')
	{
		$today = date("Y-m-d");
		$sql = "select * from schedule where doctor='$doctor_name' and date='$today' and status != '' order by status asc,date DESC limit $limit";		
		$result=mysqli_query($connect,$sql); 
		$i=mysqli_num_rows($result);			
		if($i != 0)
		{				
			while($row=mysqli_fetch_array($result))
			{
				if($row['status']=='Chưa khám')
				{								
					echo '
					<tr align="center" id="data">
						<td>'.$row['date'].'</td>
						<td id="time">'.$row['time'].'</td>
						<td>'.$row['patient_name'].'</td>
						<td>'.$row['patient_sex'].'</td>
						<td>'.$row['patient_year'].'</td>
						<td>'.$row['patient_phone'].'</td>
						<td class="st">'.$row['status'].'</td>		
						<td>
							<button type="button" class="btn btn-primary profile" data-toggle="modal" data-target="#modalCreateRecord" value="'.$row['schedule_id'].'">Tạo hồ sơ
							</button>
						</td>								
					</tr>';	
				}
				else if($row['status']=='Tái khám')
				{
					echo '
						<tr align="center" id="data">
							<td>'.$row['date'].'</td>
							<td id="time">'.$row['time'].'</td>
							<td>'.$row['patient_name'].'</td>
							<td>'.$row['patient_sex'].'</td>
							<td>'.$row['patient_year'].'</td>
							<td>'.$row['patient_phone'].'</td>
							<td class="st">'.$row['status'].'</td>		
							<td>
								<a href="?action=record&phone='.$row['patient_phone'].'" class="re_exam">Hồ sơ</a>
							</td>								
						</tr>';	
				}
				else
				{
					echo '
					<tr align="center" id="data">
						<td>'.$row['date'].'</td>
						<td id="time">'.$row['time'].'</td>
						<td>'.$row['patient_name'].'</td>
						<td>'.$row['patient_sex'].'</td>
						<td>'.$row['patient_year'].'</td>
						<td>'.$row['patient_phone'].'</td>
						<td class="st">'.$row['status'].'</td>		
						<td>	
							<button type="button" class="btn btn-primary profile" data-toggle="modal" data-target="#modalCreateRecord" value="'.$row['schedule_id'].'" disabled>Tạo hồ sơ
							</button>
						</td>								
					</tr>';	
				}				
			}
		}
		else
		{
			echo '
			<tr>
				<td colspan="8" style="opacity:0.6" align="center">Không có lịch khám</td>
			</tr>
			';
		}
	}	
}
elseif(empty($_GET['option']))
{	
	$sql = "select * from schedule where doctor='$doctor_name' and status != '' order by date DESC limit $start,$limit";
	$result=mysqli_query($connect,$sql); 
	$i=mysqli_num_rows($result);	
	if($i != 0)
	{	
		while($row=mysqli_fetch_array($result))
		{
			if($row['status']=='Chưa khám')
			{								
				echo '
				<tr align="center" id="data">
					<td>'.$row['date'].'</td>
					<td id="time">'.$row['time'].'</td>
					<td>'.$row['patient_name'].'</td>
					<td>'.$row['patient_sex'].'</td>
					<td>'.$row['patient_year'].'</td>
					<td>'.$row['patient_phone'].'</td>
					<td class="st">'.$row['status'].'</td>		
					<td>
						<button type="button" class="btn btn-primary profile" data-toggle="modal" data-target="#modalCreateRecord" value="'.$row['schedule_id'].'">Tạo hồ sơ
						</button>
					</td>								
				</tr>';	
			}
			else if($row['status']=='Tái khám')
			{
				echo '
				<tr align="center" id="data">
					<td>'.$row['date'].'</td>
					<td id="time">'.$row['time'].'</td>
					<td>'.$row['patient_name'].'</td>
					<td>'.$row['patient_sex'].'</td>
					<td>'.$row['patient_year'].'</td>
					<td>'.$row['patient_phone'].'</td>
					<td class="st">'.$row['status'].'</td>		
					<td>
						<a href="?action=record&phone='.$row['patient_phone'].'" class="re_exam" phone = '.$row['patient_phone'].'>Hồ sơ</a>
					</td>								
				</tr>';	
			}
			else
			{
				echo '
				<tr align="center" id="data">
					<td>'.$row['date'].'</td>
					<td id="time">'.$row['time'].'</td>
					<td>'.$row['patient_name'].'</td>
					<td>'.$row['patient_sex'].'</td>
					<td>'.$row['patient_year'].'</td>
					<td>'.$row['patient_phone'].'</td>
					<td class="st">'.$row['status'].'</td>		
					<td>
						<button type="button" class="btn btn-primary profile" data-toggle="modal" data-target="#modalCreateRecord" value="'.$row['schedule_id'].'" disabled>Tạo hồ sơ
						</button>
					</td>								
				</tr>';	
			}						
		}
	}
	else
	{
		echo '
		<tr>
			<td colspan="8" style="opacity:0.6" align="center">Không có lịch khám</td>
		</tr>
		';
	}
}
if($total_page <=1){
	echo '<script>$("#pagination").hide();</script>';
}
?>