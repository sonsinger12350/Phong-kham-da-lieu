<?php
require_once "../../model/connect.php";
$db=new db();
date_default_timezone_set("Asia/Ho_Chi_Minh");
$today = date("Y-m-d h:ia");
$hour = strtotime('+1 hours',strtotime($today));
//echo date('Y-m-d h:ia',$hour);
if(isset($_GET['date']) && isset($_GET['doctor']))
{
	$doctor = $_GET['doctor'];
	$date = $_GET['date'];	
	$sql="select * from calendar 
	where time not in (select time from schedule where date='$date' and doctor='$doctor')";
	$result=mysqli_query($db->connect(),$sql);
	$i=mysqli_num_rows($result);
	if($i != 0)
	{		
		while($row=mysqli_fetch_array($result))
		{
			$d = $date.' '.$row['time'];				
			$t = strtotime($d);			
			if($t>=$hour)
			{				
				$time = date('h:ia',$t);	
				echo '<li class="list-group-item list-group-item-action w-auto p-3 time" >'.$time.'</li>';		
			}
			else if($t<$hour)
			{	
				$time = date('h:ia',$t);				
				echo '<li class="list-group-item list-group-item-action w-auto p-3 disabled">'.$time.'</li>';

			}
		}
	}
	else
	{
		echo 'wrong';
	}
}
?>