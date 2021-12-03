<?php
require_once "../../model/connect.php";
$db = new db();
$connect = $db->connect();
if(isset($_POST['schedule_id']))
{
	$schedule_id = $_POST['schedule_id'];
	$user_id = $_POST['patient_id'];
	$name = $_POST['name'];
	$phone = $_POST['phone'];
	$year = $_POST['year'];
	$sex = $_POST['sex'];
	$doctor_id = $_SESSION['user_id'];
	$doctor_name = $_SESSION['name'];
	$diagnose = $_POST['diagnose'];
	$descript = $_POST['descript'];
	$res = mysqli_query($connect,"select * from patient_medical_record");
	if(mysqli_num_rows($res) != 0)
	{
		$row = mysqli_fetch_all($res,MYSQLI_ASSOC);
		if(count($row)!=0)
		{	
			$query = mysqli_query($connect,"select * from patient_medical_record where patient_name='$name' and patient_year='$year' and patient_phone='$phone'");
			$rw = mysqli_fetch_array($query);
			if(!empty($rw['patient_id']) )
			{
				$patient_id = $rw['patient_id'];			
				$sql = "
				insert into patient_medical_record(doctor_id,doctor_name,patient_id,patient_name,patient_phone,patient_year,patient_sex,diagnose,descript,status)	
				values('$doctor_id','$doctor_name','$patient_id','$name','$phone','$year','$sex','$diagnose','$descript','Đang theo dõi')";	
				$result = mysqli_query($connect,$sql);
				if($result)
				{
					mysqli_query($connect,"update schedule set status='Đã khám' where schedule_id='$schedule_id'");
					$query1 = mysqli_query($connect,"select * from users where user_id='$user_id'");
					$data = mysqli_fetch_array($query1);
					if($data['patient_id']==null || $data['patient_id']==''|| $data['patient_id']==0){
						mysqli_query($connect,"update users set patient_id='$patient_id' where user_id='$user_id'");
					}				
					echo 'success';
				}
			}
			else
			{				
				$last_id = count($row) -1;
				$code=substr($row[$last_id]['patient_id'],2)+1;					
				$patient_id='BN'.$code;			
				$sql = "
				insert into patient_medical_record(doctor_id,doctor_name,patient_id,patient_name,patient_phone,patient_year,patient_sex,diagnose,descript,status)	
				values('$doctor_id','$doctor_name','$patient_id','$name','$phone','$year','$sex','$diagnose','$descript','Đang theo dõi')";	
				$result = mysqli_query($connect,$sql);
				if($result)
				{
					mysqli_query($connect,"update schedule set status='Đã khám' where schedule_id='$schedule_id'");
					$query1 = mysqli_query($connect,"select * from users where user_id='$user_id'");
					$data = mysqli_fetch_array($query1);
					if($data['patient_id']==null || $data['patient_id']==''|| $data['patient_id']==0){
						mysqli_query($connect,"update users set patient_id='$patient_id' where user_id='$user_id'");
					}				
					echo 'success';
				}		
				else
				{
					echo mysqli_error($connect);
				}
			}			
		}		
		else
		{
			$patient_id='BN1';
			$sql = "
			insert into patient_medical_record(doctor_id,doctor_name,patient_id,patient_name,patient_phone,patient_year,patient_sex,diagnose,descript,status)	
			values('$doctor_id','$doctor_name','$patient_id','$name','$phone','$year','$sex','$diagnose','$descript','Đang theo dõi')";	
			$result = mysqli_query($connect,$sql);
			if($result){
				mysqli_query($connect,"update schedule set status='Đã khám' where schedule_id='$schedule_id'");
				mysqli_query($connect,"update users set patient_id='$patient_id' where user_id='$user_id'");
				echo 'success';
			}
			else{
				echo mysqli_error($connect);
			}
		}
	}
	else{
		$patient_id='BN1';
		$sql = "insert into patient_medical_record(doctor_id,doctor_name,patient_id,patient_name,patient_phone,patient_year,patient_sex,diagnose,descript,status)	
		values('$doctor_id','$doctor_name','$patient_id','$name','$phone','$year','$sex','$diagnose','$descript','Đang theo dõi')";	
		$result = mysqli_query($connect,$sql);
		if($result){
			mysqli_query($connect,"update schedule set status='Đã khám' where schedule_id='$schedule_id'");
			mysqli_query($connect,"update users set patient_id='$patient_id' where user_id='$user_id'");
			echo 'success';
		}
		else{
			echo mysqli_error($connect);
		}
	}
}
?>