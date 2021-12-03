<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
<?php
require_once "../../model/connect.php";
$db = new db();
$connect = $db->connect();
date_default_timezone_set("Asia/Ho_Chi_Minh");
$today = date("Y-m-d h:ia");
$hour = strtotime('+15 minutes',strtotime($today));
$query1 = mysqli_query($connect,"select * from schedule where paid='Chưa thanh toán'");
$i = mysqli_num_rows($query1);
if($i != 0)
{
	while($row = mysqli_fetch_array($query1))
	{
		$id = $row['schedule_id'];
		$time_create =strtotime($row['time_create']);
		$expired = strtotime('+15 minutes',$time_create);
		$now = strtotime(date("Y-m-d h:ia"));
		if($now >= $expired)
		{
			mysqli_query($connect,"delete from schedule where schedule_id ='$id' limit 1");
		}		
	}
}
?>
</body>
</html>