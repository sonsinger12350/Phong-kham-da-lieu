<?php
require_once "../../model/connect.php";
$db= new db();
if(isset($_GET['verify_code']))
{
	$verify_code = $_GET['verify_code'];
	$result = mysqli_query($db->connect(),"select * from users where verify_code='$verify_code'");
	$i = mysqli_num_rows($result);
	if($i !=0){
		mysqli_query($db->connect(),"update users set verified='yes' where verify_code='$verify_code'");
		echo '<script>
				alert("Xác thực tài khoản thành công");
				window.location.href="../../view/patient/login.php";
			</script>';
	}
	else{
		echo '<script>
				alert("Xác thực tài khoản không thành công");
				window.location.href="../../view/patient/login.php";
			</script>';
	}
}
?>