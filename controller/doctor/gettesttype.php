<?php
require_once "../../model/connect.php";
$db = new db();
$connect = $db->connect();
$sql = "select * from test_type";
$result = mysqli_query($connect,$sql);
$i = mysqli_num_rows($result);
if($i != 0)
{
	echo '<option disabled selected hidden>Chọn loại xét nghiệm</option>';
	while ($row = mysqli_fetch_array($result)) 
	{
		echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
	}
}
?>