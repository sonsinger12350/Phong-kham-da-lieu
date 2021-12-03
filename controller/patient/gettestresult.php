<?php
require_once "../../model/connect.php";
$db = new db();
$connect = $db->connect();
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$query = mysqli_query($connect,"select * from test where record_id='$id'");
	if(!empty(mysqli_num_rows($query))){
		while($row = mysqli_fetch_array($query))
		{
			echo $row['result'];
		}		
	}
	else{
		echo 'null';
	}
}
?>