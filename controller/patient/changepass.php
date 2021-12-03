<?php
require_once "../../model/connect.php";
$db=new db();
if(isset($_POST['pass']) && isset($_POST['newpass']))
{
	$user_id = $_SESSION['user_id'];
	$pass = $_POST['pass'];
	$newpass = $_POST['newpass'];
	$sql="select * from users where user_id='$user_id'";
	$result=mysqli_query($db->connect(),$sql);
	$i=mysqli_num_rows($result);
	if($i != 0)
	{
		$row=mysqli_fetch_array($result);
		
		if($pass == $row['password'] && $newpass != $row['password'])
		{
			mysqli_query($db->connect(),"update users set password='$newpass' where user_id='$user_id' limit 1");
			echo 'success';
		}
		else if($pass != $row['password'])
		{
			echo 'notexist';
		}
		else if($newpass == $row['password'])
		{
			echo 'exist';
		}
	}	
}
?>