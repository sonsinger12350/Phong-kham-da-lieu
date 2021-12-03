<?php
require_once "../../model/connect.php";
$db = new db();
$connect = $db->connect();

//Pagination
$number = mysqli_query($connect,"select count(schedule_id) as total from schedule");
$rw = mysqli_fetch_assoc($number);
$total_records = $rw['total'];
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 4;       
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
		<td>STT</td>			
		<td>Ngày khám</td>
		<td>Giờ</td>
		<td>Họ tên bệnh nhân</td>
		<td>Điện thoại</td>
		<td>Bác sĩ khám</td>				
		<td>Trạng thái</td>
		<td>Chức năng</td>				
	</tr>';
$count=1;
if(isset($_GET['option']) && !empty($_GET['option']))
{
	$option = $_GET['option'];
	if($option=='Toàn bộ')
	{
		$sql = "select * from schedule order by date DESC,time ASC limit $start,$limit";
		$result=mysqli_query($connect,$sql); 
		$i=mysqli_num_rows($result);			
		if($i != 0)
		{					
			while($row=mysqli_fetch_array($result))
			{
				if($row['paid']=='Chưa thanh toán')
				{
					echo '
						<tr align="center">
							<td hidden id="schedule_id">'.$row['schedule_id'].'</td>
							<td>'.$count.'</td>
							<td>'.$row['date'].'</td>
							<td>'.$row['time'].'</td>
							<td>'.$row['patient_name'].'</td>
							<td>'.$row['patient_phone'].'</td>
							<td>'.$row['doctor'].'</td>
							<td>'.$row['paid'].'</td>			
							<td><button type="button" class="btn btn-primary changeC" data-toggle="modal" data-target="#modalChangeSchedule" value="'.$row['schedule_id'].'">Đổi lịch</button>
								<button type="button" class="btn btn-primary paid" value="'.$row['schedule_id'].'">Đã thanh toán</button>
							</td>						
						</tr>';
				}
				else if($row['status']=='Chưa khám')
				{
					echo '
					<tr align="center">						
						<td>'.$count.'</td>
						<td>'.$row['date'].'</td>
						<td>'.$row['time'].'</td>
						<td>'.$row['patient_name'].'</td>
						<td>'.$row['patient_phone'].'</td>
						<td>'.$row['doctor'].'</td>
						<td>'.$row['status'].'</td>		
						<td><button type="button" class="btn btn-primary changeC" data-toggle="modal" data-target="#modalChangeSchedule" value="'.$row['schedule_id'].'">Đổi lịch</button>
						</td>											
					</tr>';						
				}
				else if($row['status']=='Đã khám')
				{
					echo '
					<tr align="center">
						<td>'.$count.'</td>
						<td>'.$row['date'].'</td>
						<td>'.$row['time'].'</td>
						<td>'.$row['patient_name'].'</td>
						<td>'.$row['patient_phone'].'</td>
						<td>'.$row['doctor'].'</td>
						<td>'.$row['status'].'</td>	
						<td><button type="button" class="btn btn-primary changeC" data-toggle="modal" data-target="#modalChangeSchedule" value="'.$row['schedule_id'].'" disabled>Đổi lịch</button>
						</td>									
					</tr>';	
				}
				$count++;		
			}
		}
		else
		{
			echo '
			<tr>
				<td colspan="9" style="opacity:0.6" align="center">Không có lịch khám</td>
			</tr>
			';
		}
				
	}
	elseif($option=='Chưa khám')
	{
		$sql = "select * from schedule where status='$option' order by date DESC,time ASC limit 5";
		$result=mysqli_query($connect,$sql); 
		$i=mysqli_num_rows($result);
		if($i != 0)
		{				
			while($row=mysqli_fetch_array($result))
			{	
				echo '
				<tr align="center">					
					<td>'.$count.'</td>
					<td>'.$row['date'].'</td>
					<td>'.$row['time'].'</td>
					<td>'.$row['patient_name'].'</td>
					<td>'.$row['patient_phone'].'</td>
					<td>'.$row['doctor'].'</td>
					<td>'.$row['status'].'</td>		
					<td><button type="button" class="btn btn-primary changeC" data-toggle="modal" data-target="#modalChangeSchedule" value="'.$row['schedule_id'].'">Đổi lịch</button>
					</td>											
				</tr>';
				$count++;		
			}
		}
		else
		{
			echo '
			<tr>
				<td colspan="9" style="opacity:0.6" align="center">Không có lịch khám</td>
			</tr>
			';
		}	
	}
	elseif($option=='Đã khám')
	{
		$sql = "select * from schedule where status='$option' order by date DESC,time ASC limit 5";
		$result=mysqli_query($connect,$sql); 
		$i=mysqli_num_rows($result);
		if($i != 0)
		{	
			while($row=mysqli_fetch_array($result))
			{	
				echo '
				<tr align="center">
					<td>'.$count.'</td>
					<td>'.$row['date'].'</td>
					<td>'.$row['time'].'</td>
					<td>'.$row['patient_name'].'</td>
					<td>'.$row['patient_phone'].'</td>
					<td>'.$row['doctor'].'</td>
					<td>'.$row['status'].'</td>		
					<td><button type="button" class="btn btn-primary changeC" data-toggle="modal" data-target="#modalChangeSchedule" value="'.$row['schedule_id'].'" disabled>Đổi lịch</button>
					</td>											
				</tr>';
				$count++;		
			}
		}
		else
		{
			echo '
			<tr>
				<td colspan="9" style="opacity:0.6" align="center">Không có lịch khám</td>
			</tr>
			';
		}
	}
	elseif($option=='Hôm nay')
	{
		$today = date("Y-m-d");
		$sql = "select * from schedule where date='$today' order by date DESC,time ASC limit 5";
		$result=mysqli_query($connect,$sql); 
		$i=mysqli_num_rows($result);
		if($i != 0)
		{				
			while($row=mysqli_fetch_array($result))
			{	
				if($row['paid']=='Chưa thanh toán')
				{
					echo '
						<tr align="center">
							<td hidden id="schedule_id">'.$row['schedule_id'].'</td>
							<td>'.$count.'</td>
							<td>'.$row['date'].'</td>
							<td>'.$row['time'].'</td>
							<td>'.$row['patient_name'].'</td>
							<td>'.$row['patient_phone'].'</td>
							<td>'.$row['doctor'].'</td>
							<td>'.$row['paid'].'</td>			
							<td><button type="button" class="btn btn-primary changeC" data-toggle="modal" data-target="#modalChangeSchedule" value="'.$row['schedule_id'].'">Đổi lịch</button>
								<button type="button" class="btn btn-primary paid" value="'.$row['schedule_id'].'">Đã thanh toán</button>
							</td>						
						</tr>';
				}
				else if($row['status']=='Chưa khám')
				{
					echo '
					<tr align="center">	
						<td>'.$count.'</td>
						<td>'.$row['date'].'</td>
						<td>'.$row['time'].'</td>
						<td>'.$row['patient_name'].'</td>
						<td>'.$row['patient_phone'].'</td>
						<td>'.$row['doctor'].'</td>
						<td>'.$row['status'].'</td>		
						<td><button type="button" class="btn btn-primary changeC" data-toggle="modal" data-target="#modalChangeSchedule" value="'.$row['schedule_id'].'">Đổi lịch</button>
						</td>											
					</tr>';	
				}
				else if($row['status']=='Đã khám')
				{
					echo '
					<tr align="center">
						<td>'.$count.'</td>
						<td>'.$row['date'].'</td>
						<td>'.$row['time'].'</td>
						<td>'.$row['patient_name'].'</td>
						<td>'.$row['patient_phone'].'</td>
						<td>'.$row['doctor'].'</td>
						<td>'.$row['status'].'</td>	
						<td><button type="button" class="btn btn-primary changeC" data-toggle="modal" data-target="#modalChangeSchedule" value="'.$row['schedule_id'].'" disabled>Đổi lịch</button>
						</td>									
					</tr>';	
				}
				$count++;		
			}
		}
		else
		{
			echo '
			<tr>
				<td colspan="9" style="opacity:0.6" align="center">Không có lịch khám</td>
			</tr>
			';
		}
	}
}
else if(isset($_GET['phone']) && !empty($_GET['phone']))
{
	$phone = $_GET['phone'];
	$sql = "select * from schedule where patient_phone like '%$phone%' limit 5";
	$result = mysqli_query($connect,$sql);
	$i = mysqli_num_rows($result);
	if($i != 0 )
	{		
		while($row = mysqli_fetch_array($result))
		{
			if($row['paid']=='Chưa thanh toán')
			{
				echo '
					<tr align="center">
						<td hidden id="schedule_id">'.$row['schedule_id'].'</td>
						<td>'.$count.'</td>
						<td>'.$row['date'].'</td>
						<td>'.$row['time'].'</td>
						<td>'.$row['patient_name'].'</td>
						<td>'.$row['patient_phone'].'</td>
						<td>'.$row['doctor'].'</td>
						<td>'.$row['paid'].'</td>			
						<td><button type="button" class="btn btn-primary changeC" data-toggle="modal" data-target="#modalChangeSchedule" value="'.$row['schedule_id'].'">Đổi lịch</button>
							<button type="button" class="btn btn-primary paid" value="'.$row['schedule_id'].'">Đã thanh toán</button>
						</td>						
					</tr>';
			}
			else if($row['status']=='Chưa khám')
			{
				echo '
				<tr align="center">>
					<td>'.$count.'</td>
					<td>'.$row['date'].'</td>
					<td>'.$row['time'].'</td>
					<td>'.$row['patient_name'].'</td>
					<td>'.$row['patient_phone'].'</td>
					<td>'.$row['doctor'].'</td>
					<td>'.$row['status'].'</td>		
					<td><button type="button" class="btn btn-primary changeC" data-toggle="modal" data-target="#modalChangeSchedule" value="'.$row['schedule_id'].'">Đổi lịch</button>
					</td>											
				</tr>';	
			}
			else if($row['status']=='Đã khám')
			{
				echo '
				<tr align="center">
					<td>'.$count.'</td>
					<td>'.$row['date'].'</td>
					<td>'.$row['time'].'</td>
					<td>'.$row['patient_name'].'</td>
					<td>'.$row['patient_phone'].'</td>
					<td>'.$row['doctor'].'</td>
					<td>'.$row['status'].'</td>	
					<td><button type="button" class="btn btn-primary changeC" data-toggle="modal" data-target="#modalChangeSchedule" value="'.$row['schedule_id'].'" disabled>Đổi lịch</button>
					</td>									
				</tr>';	
			}
			$count++;
		}		
	}
	else
	{
		echo '
		<tr>
			<td colspan="9" style="opacity:0.6" align="center">Không có lịch khám</td>
		</tr>
		';
	}
}
else if(empty($_GET['option']) || !isset($_GET['option']) || !isset($_GET['phone']) || empty($_GET['phone']))
{	
	$sql = "select * from schedule order by date DESC,time ASC limit $start,$limit";
	$result=mysqli_query($connect,$sql); 
	$i=mysqli_num_rows($result);
	if($i != 0)
	{	
		while($row=mysqli_fetch_array($result))
		{
			if($row['paid']=='Chưa thanh toán')
			{
				echo '
				<tr align="center">
					<td hidden id="schedule_id">'.$row['schedule_id'].'</td>
					<td>'.$count.'</td>
					<td>'.$row['date'].'</td>
					<td>'.$row['time'].'</td>
					<td>'.$row['patient_name'].'</td>
					<td>'.$row['patient_phone'].'</td>
					<td>'.$row['doctor'].'</td>
					<td>'.$row['paid'].'</td>			
					<td><button type="button" class="btn btn-primary changeC" data-toggle="modal" data-target="#modalChangeSchedule" value="'.$row['schedule_id'].'">Đổi lịch</button>
						<button type="button" class="btn btn-primary paid" value="'.$row['schedule_id'].'">Đã thanh toán</button>
					</td>						
				</tr>';
			}
			else if($row['status']=='Chưa khám')
			{
				echo '
				<tr align="center">						
					<td>'.$count.'</td>
					<td>'.$row['date'].'</td>
					<td>'.$row['time'].'</td>
					<td>'.$row['patient_name'].'</td>
					<td>'.$row['patient_phone'].'</td>
					<td>'.$row['doctor'].'</td>
					<td>'.$row['status'].'</td>		
					<td><button type="button" class="btn btn-primary changeC" data-toggle="modal" data-target="#modalChangeSchedule" value="'.$row['schedule_id'].'">Đổi lịch</button>
					</td>											
				</tr>';					
			}
			else if($row['status']=='Đã khám')
			{
				echo '
				<tr align="center">
					<td>'.$count.'</td>
					<td>'.$row['date'].'</td>
					<td>'.$row['time'].'</td>
					<td>'.$row['patient_name'].'</td>
					<td>'.$row['patient_phone'].'</td>
					<td>'.$row['doctor'].'</td>
					<td>'.$row['status'].'</td>	
					<td><button type="button" class="btn btn-primary changeC" data-toggle="modal" data-target="#modalChangeSchedule" value="'.$row['schedule_id'].'" disabled>Đổi lịch</button>
					</td>									
				</tr>';	
			}
			$count++;		
		}
	}
	else
	{
		echo '
		<tr>
			<td colspan="9" style="opacity:0.6" align="center">Không có lịch khám</td>
		</tr>
		';
	}
}
if($total_page < 0 || isset($_GET['option']) || isset($_GET['phone'])){
	echo '<script>$("#pagi").hide();</script>';
}
else{
	echo '<script>$("#pagi").show();</script>';
}
?>