<?php
if(isset($_SESSION['user_id']))
{	
	$user_id = $_SESSION['user_id'];
	$query = mysqli_query($connect,"select * from users where user_id='$user_id'");
	$rw = mysqli_fetch_array($query);
	if(!empty($rw['patient_id'])){
		$patient_id=$rw['patient_id'];
	}
	$sql = "select * from patient_medical_record where patient_id='$patient_id'";
	$result=mysqli_query($connect,$sql); 
	$i=mysqli_num_rows($result);	
	if($i != 0)
	{
		while($row=mysqli_fetch_array($result))
		{						
			echo '
			<tr align="center">		
				<td>'.$row['date_created'].'</td>			
				<td>'.$row['patient_name'].'</td>
				<td>'.$row['patient_year'].'</td>
				<td>'.$row['patient_sex'].'</td>	
				<td>'.$row['diagnose'].'</td>
				<td>'.$row['descript'].'</td>
				<td>'.$row['doctor_name'].'</td>
				<td>'.$row['status'].'</td>	
				<td>
				<button type="button" class="btn btn-link view_result" value="'.$row['record_id'].'">Xem kết quả xét nghiệm</button>				
			</tr>';			
		}
	}
	else
	{
		echo '
		<tr>
			<td colspan="9" style="opacity:0.6" align="center">Không có hồ sơ</td>
		</tr>
		';
	}
}
?>