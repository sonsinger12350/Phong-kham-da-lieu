<?php
require_once "../../model/connect.php";
require_once "../../library/PHPMailer/Exception.php";
require_once "../../library/PHPMailer/PHPMailer.php";
require_once "../../library/PHPMailer/SMTP.php";

$db= new db();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_GET['email']))
{
	$email = $_GET['email'];
	$sql = "select * from users where email = '$email'";
	$result = mysqli_query($db->connect(),$sql);
	$i = mysqli_num_rows($result);
	if($i > 0)
	{
		$row=mysqli_fetch_array($result);
		$pass = $row['password'];		
		$mail = new PHPMailer();    
		$mail->SMTPDebug = 0;   
		$mail->CharSet = 'UTF-8';
		$mail->isSMTP();                //Sets Mailer to send message using SMTP
		$mail->Host = 'smtp.gmail.com';    //Sets the SMTP hosts of your Email hosting, this for Godaddy   
		$mail->SMTPAuth = true;             //Sets SMTP authentication. Utilizes the Username and Password variables
		$mail->Username = 'sonle12350@gmail.com';         //Sets SMTP username
		$mail->Password = 'Aptx4869';          //Sets SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;     //Sets connection prefix. Options are "", "ssl" or "tls"
		$mail->Port = 587;                //Sets the default SMTP server port
		$mail->setFrom('sonle12350@gmail.com', 'Phòng khám da liễu');
		$mail->addAddress($email);  //Adds a "To" address
		$mail->WordWrap = 50;           //Sets word wrapping on the body of the message to a given number of characters
		$mail->isHTML(true);              //Sets message type to HTML
		$mail->Subject = 'Quên mật khẩu'; //Sets the Subject of the message    
		//An HTML or plain text message body
		$mail->Body = '
		  <div style="font-size: 20px;width: 100%">
			  <table width="90%" border="0">				
				  <tr>
					  <td colspan="4">Mật khẩu hiện tại của bạn là: '.$pass.'</td>
				  </tr>			
			  </table>
		  </div>
			  ';     
		if(!$mail->Send())
		{ 
			echo $mail->ErrorInfo;			
		}
		else
		{        
			echo 'success';			
		}  
	}
	else
	{		
		echo 'notexist';		
	}
				
	}	
?>