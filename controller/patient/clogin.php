<?php
require_once "../../model/connect.php";
$p = new user();
?>
<?php
if(isset($_POST['email']) && isset($_POST['pass']))
{
	$email = $_POST['email'];
	$pass = $_POST['pass'];	
	$p->login($email,$pass);
}
?>