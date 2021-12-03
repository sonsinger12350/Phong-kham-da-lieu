<?php
session_start();
date_default_timezone_set("Asia/Ho_Chi_Minh");
class db
{
	function connect()
	{
		$conn = mysqli_connect("localhost","root","","phongkham");
		if(!$conn)
			{
				die("Cannot connect to database!");
				exit();
			}
		else
			{
				mysqli_set_charset($conn,"utf8");			
				return $conn;
			}
	}
}
class user extends db
{
	function login($email,$pass)
	{
		$sql = "select * from users where email = '$email' && password = '$pass'";
		$result = mysqli_query($this->connect(),$sql);
		$num = mysqli_num_rows($result);
		if($num != 0)
		{
			while($row = mysqli_fetch_array($result))
			{
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['name'] = $row['name'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['password'] = $row['password'];
				$_SESSION['permission'] = $row['permission'];
				if($row['permission']==0)
				{
					if($row['verified']=='yes')
					{
						echo 'patient';
					}
					else
					{
						echo 'notVerified';
					}
				}
				else if($row['permission']==1)
				{
					echo 'receptionist';
				}
				else if($row['permission']==2)
				{
					echo 'doctor';
				}
				else if($row['permission']==3)
				{
					echo 'medicine';
				}
				else if($row['permission']==4)
				{
					echo 'test';
				}
				else if($row['permission']==5)
				{
					echo 'admin';
				}
					
			}
			
		}
		else
		{
			echo'wrong';
		}
	}		
}
class patient extends db
{
	function getinfoschedule($sql)
	{
		$result=mysqli_query($this->connect(),$sql);
		$i = mysqli_num_rows($result);
		if($i>0)
		{
			while ($row=mysqli_fetch_array($result)) 
			{
				echo $row["patient_name"];
			}
		}
	}
}

?>
