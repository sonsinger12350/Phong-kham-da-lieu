<?php
require_once"model/connect.php";
$db= new db();
$connect = $db->connect();
if(isset($_SESSION['permission'])){
	if($_SESSION['permission']=='1'){
		echo '<script>window.location.href="view/receptionist";</script>';
	}
	if($_SESSION['permission']=='2'){
		echo '<script>window.location.href="view/doctor";</script>';
	}
	if($_SESSION['permission']=='3'){
		echo '<script>window.location.href="view/medicine";</script>';
	}
	if($_SESSION['permission']=='4'){
		echo '<script>window.location.href="view/test";</script>';
	}
	if($_SESSION['permission']=='5'){
		echo '<script>window.location.href="view/admin";</script>';
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<link rel="stylesheet" href="library/css/bootstrap.min.css">
	<link rel="stylesheet" href="library/fontawesome/css/all.css">		
<title>Phòng Khám Đa Khoa</title>
	<style>
		/* Make the image fully responsive */
		.carousel-inner img {
		width: 800px;
		height: 300px;
		max-width: 100%;
		max-height: 100%;
		}
		.card{
			width:300px;
			height: 148px; 
			border: 0px; 
			background-color: aquamarine; 
			text-align: center;
		}
		.footer {
			left: 0;
			bottom: 0;
			width: 100%;
			background-color:#4A49E8;
			color: white;
		}
		.disabled {
			pointer-events:none;
			opacity:0.4;
		}
		.text{
			font-size: 19px;
			font-weight: bold;
		}
		.bold{
			font-weight: bold;
		}

	</style>
</head>
<script src="library/js/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="library/js/bootstrap.min.js"></script>	
<body onLoad="checkSession();">
	<div class="container-fluid">
	<!--Header-->
	<nav class="navbar navbar-light" style="border-color: aqua;">		
			<a class="navbar navbar-light " href="tel:0123456789">Hotline: <h3>0123456789</h3></a>
			<ul class="nav navbar">				
					<form class="form-inline">
						<input class="form-control mr-sm-2" type="search" placeholder="Nhập từ khóa" aria-label="Search">
						<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm kiếm</button>
			 		</form>
			</ul>		
	</nav>
	<!--End-->

	<!--Menu-->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container-fluid">
			<a class="navbar-brand" href="index.php">
				<img src="image/Logo.png" width="250px" height="100px">
			</a>
			<div class="nav">
				<a class="nav-item nav-link " href="index.php">TRANG CHỦ <span class="sr-only">(current)</span></a>
				<a class="nav-item nav-link" href="#">GIỚI THIỆU</a>
				<a class="nav-item nav-link" href="#">CHUYÊN KHOA</a>
				<a class="nav-item nav-link" href="#">HỖ TRỢ</a>			
			</div>			
			<div>	
				<a href="view/patient/login.php" id="login">ĐĂNG NHẬP</a>
				<div class="dropdown dropleft float-right" id="account">					
					<a class="dropdown-toggle" data-toggle="dropdown">
						<span id="session"><?php if(isset($_SESSION['name']))echo $_SESSION['name'];?></span> <img src="image/account.png" width="30px" height="30px">
					</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="#" id="viewInfo">Thông tin cá nhân</a>
							<a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalChangePass">Đổi mật khẩu</a>
							<a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalLogout">Đăng xuất</a>	
						</div>
				  </div>								
			</div>
		</div>
	</nav>
	<!--End-->	

	<!--Modal logout-->	
	<div class="modal fade" id="modalLogout">
		<div class="modal-dialog">
			<div class="modal-content" >	
				<div class="modal-header">
					<h4 class="modal-title col-12 text-center" align="center">Bạn muốn đăng xuất ?</h4>		
				</div>	
				<div class="modal-body" align="center">
					<div class="row">	
						<div class="col-6">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Không</button>
						</div>
						<div class="col-6">
							<button type="button" class="btn btn-success" id="logout">Có</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>  
	<!--End-->	

	<!--Slide image-->
	<div class="row">
		<div class="col-lg-6" style="padding: 0px 0px">
			<div id="demo" class="carousel slide" data-ride="carousel">
				<ul class="carousel-indicators">
					<li data-target="#demo" data-slide-to="0" class="active"></li>
					<li data-target="#demo" data-slide-to="1"></li>
				</ul>
				<div class="carousel-inner">
					<div class="carousel-item active">
						<img src="image/banner.jpg" alt="Los Angeles" >
						<div class="carousel-caption" style="color: black; font-size: 25px">
							<h3>Phòng khám da liễu</h3>
							<p>Kết quả chuẩn vàng-An toàn điều trị</p>
						</div>   
					</div>
				<div class="carousel-item">
					<img src="image/banner2.jpg" alt="Chicago" >
					<div class="carousel-caption" style="color: black; font-size: 25px">
						<h3>Phòng bệnh</h3>
						<p>hơn chữa bệnh</p>
					</div>   
				</div>
				</div>
				<a class="carousel-control-prev" href="#demo" data-slide="prev">
				<span class="carousel-control-prev-icon"></span>
				</a>
				<a class="carousel-control-next" href="#demo" data-slide="next">
				<span class="carousel-control-next-icon"></span>
				</a>
			</div>
		</div>
		<div class="col-lg-6">			
			<div class="row" style="margin-bottom: 5px;">
				<div class="col-sm-6">
					<div class="card">
						<a href="#" style="text-decoration-color: white;" id="setCalendar" data-toggle="modal" data-target="#modalSetCalendar">						
							<div class="card-body">
								<span class="far fa-calendar-alt" style="font-size: 60px">					
								<p style="font-size: 20px"><strong>ĐẶT LỊCH KHÁM</strong></p>
							</div>
						</a>
					</div>					
				</div>
				<div class="col-sm-6">					
					<div class="card">
						<a href="?action=viewcalendar" class="checkss">
							<div class="card-body">
								<span class="far fa-calendar-check" style="font-size: 60px">
								<p style="font-size: 20px"><strong>XEM LỊCH KHÁM</strong></p>
							</div>
						</a>
					</div>					
				</div>
			</div>
			<div class="row" style="margin-top: 0px;">
				<div class="col-sm-6">
					<div class="card">
						<a href="?action=prescription" class="checkss">						
							<div class="card-body">
								<span class="fas fa-briefcase-medical" style="font-size: 60px">
								<p style="font-size: 20px">XEM LỊCH UỐNG THUỐC</p>
							</div>						
						</a>
					</div>
				</div>
				<div class="col-sm-6">					
					<div class="card">
						<a href="?action=viewprofile" class="checkss">
							<div class="card-body">
								<span class="fas fa-address-book" style="font-size: 60px">
								<p style="font-size: 20px">HỒ SƠ BỆNH ÁN</p>
							</div>
						</a>
					</div>					
				</div>
			</div>			
		</div>
	</div> 
	<!--End-->

	<!--Modal change pass-->
	<div id="modalChangePass" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title col-12 text-center">Đổi mật khẩu</h4>
					<button type="button" class="close" id="close" data-dismiss="modal" hidden>&times;</button>
				</div>
				<div class="modal-body">
					<form method="post">
						<table width="100%" height="auto">
							<tr>
								<td height="50">
									<input type="password" id="pass" class="form-control" placeholder="Mật khẩu hiện tại">
									<span id="error15" style="color: red;"></span>
								</td>
							</tr>
							<tr>
								<td >
									<input type="password" id="newpass" class="form-control" placeholder="Mật khẩu mới">
									<span id="error16" style="color: red;"></span>
								</td>
							</tr>
							<tr>
								<td height="50">
									<input type="password" id="cfpass" class="form-control" placeholder="Xác nhận mật khẩu mới">
									<span id="error17" style="color: red;"></span>
								</td>
							</tr>
							<tr>
								<td>
									<center><button type="button" id="changePass" class="btn btn-primary">Đổi mật khẩu</button></center>
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!--End-->

	<!--Modal set calendar-->
	<div id="modalSetCalendar" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title col-11 text-center">Đặt lịch khám</h4>				
				<button type="button" class="close" id="close" data-dismiss="modal">&times;</button>		
			</div>
			<div class="modal-body">				
				<form method="post">	
					<table width="100%" height="auto" id="tab">
					<tr>
						<td height="50">
							<label>Họ tên: </label>
							<input id="name" type="text" class="form-control" placeholder="Họ tên">
							<span style="color: red;" id="error1"></span>
						</td>
					</tr>
					<tr>
						<td>
							<label>Giới tính: </label>
							<select id="sex" class="form-control">
								<option selected disabled hidden>Chọn giới tính</option>
								<option value="Nam">Nam</option>
								<option value="Nữ">Nữ</option>
							</select>
							<span style="color: red;" id="error2"></span>	
						</td>
					</tr>
					<tr>
						<td height="50">
							<label>Năm sinh: </label>
							<input id="year" type="text" class="form-control" placeholder="Năm sinh">
							<span style="color: red;" id="error3"></span>	
						</td>
					</tr>
					<tr>
						<td>
							<label>Số điện thoại: </label>
							<input id="phone" type="text" class="form-control" placeholder="Số điện thoại">
							<span style="color: red;" id="error4"></span>	
						</td>
					</tr>										
					<tr>
						<td height="50">
							<label>Bác sĩ khám: </label>
							<select id="doctor" onchange="resetdate();" class="form-control">
								<option value="" selected disabled hidden>Chọn bác sĩ</option>
								<option value="Dr.Son" >Dr.Son</option>	
								<option value="Dr.Lucas" >Dr.Lucas</option>						
								<option value="Dr.Strange" >Dr.Strange</option>		
							</select>	
							<span style="color: red;" id="error5"></span>
						</td>
					</tr>
					<tr>
						<td>
							<a href="#" data-toggle='modal' data-target='#modalCalendar' id="calendar">Chọn thời gian</a>
						</td>
					</tr>
					<tr>
						<td>							
							<input type="text" id="date" class="form-control" placeholder="Ngày" disabled>
							<span style="color: red;" id="error6"></span>											
						</td>						
					</tr>
					<tr>
						<td height="50">
							<input type="text" id="time" class="form-control" placeholder="Giờ" disabled>
							<span style="color: red;" id="error7"></span>
						</td>
					</tr>				
					<tr>
						<td height="50">
							<center><button type="button" id="schedule" class="btn btn-primary">Đặt lịch</button></center>
						</td>
					</tr>
					</table>
				</form>
			</div>
			</div>
		</div>
	</div>	
	<!--End-->	

	<!--Modal Open Calendar(set)-->	
	<div class="modal fade" id="modalCalendar">
		<div class="modal-dialog modal-xl">
			<div class="modal-content" >	
				<div class="modal-header">	
				<div class="modal-title col-12 text-center"><h3>Chọn giờ</h3></div>	
				<button type="button" class="close" id="closeS" data-dismiss="modal" hidden>&times;</button>		
				</div>	
				<div class="modal-body">
					<span class="text">Ngày: </span><span id="d"></span>									
					<ul class="list-group list-group-horizontal" id="days">									
					</ul>
					<br>
					<hr style="width:50%;">	
					<h4 align="left">Giờ: </h3>				
					<ul class="list-group list-group-horizontal" id="tim">						
					</ul>				
				</div>
			</div>
		</div>
	</div>  
	<!--End-->	

	<!--Modal Change Schedule-->
	<div class="modal fade" id="modalChangeSchedule" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title col-12 text-center">Đổi lịch khám</h4>					
				</div>
				<div class="modal-body">
					<form method="post">
						<table width="100%" height="auto">
							<tr hidden>
								<td>
									<input type="text" id="schedule_id" class="form-control">				
								</td>
							</tr>
							<tr>
								<td height="50">
									<label>Họ tên: </label>
									<input type="text" id="namec" class="form-control" placeholder="Họ tên">
									<span id="error8" style="color:red;"></span>
								</td>
							</tr>
							<tr>
								<td>
									<label>Giới tính: </label>
									<select id="sexc" class="form-control">
										<option selected disabled hidden>Chọn giới tính</option>
										<option value="Nam">Nam</option>
										<option value="Nữ">Nữ</option>
									</select>
									<span style="color: red;" id="error9"></span>	
								</td>
							</tr>
							<tr>
								<td height="50">
									<label>Năm sinh: </label>
									<input id="yearc" type="text" class="form-control" placeholder="Năm sinh">
									<span style="color: red;" id="error10"></span>	
								</td>
							</tr>
							<tr>
								<td>
									<label>Số điện thoại: </label>
									<input type="text" id="phonec" class="form-control" placeholder="Số điện thoại">
									<span id="error11" style="color:red;"></span>
								</td>
							</tr>
							<tr>
								<td height="50">
									<label>Bác sĩ khám: </label>
									<select id="doctorc" class="form-control" onchange="resetdate();">
										<option value="" selected disabled hidden>Chọn bác sĩ</option>
										<option value="Dr.Son">Dr.Son</option>
										<option value="Dr.Lucas">Dr.Lucas</option>
										<option value="Dr.Strange">Dr.Strange</option>
									</select>
									<span id="error12" style="color:red;"></span>
								</td>
							</tr>
							<tr>
								<td>
									<a href="#" data-toggle='modal' data-target='#modalCalendarC' id="calendarc">Chọn thời gian</a>
								</td>
							</tr>
							<tr>
								<td>							
									<input type="text" id="datec" class="form-control" placeholder="Ngày" disabled>
									<span style="color: red;" id="error13"></span>	
								</td>						
							</tr>
							<tr>
								<td height="50">
									<input type="text" id="timec" class="form-control" placeholder="Giờ" disabled>
									<span style="color: red;" id="error14"></span>
								</td>
							</tr>	
							<tr>
								<td height="50">
									<center>
										<button type="button" id="changeschedule" class="btn btn-primary">Đổi</button>
									</center>
								</td>
							</tr>
						</table>
					</form> 
				</div>
			</div>
		</div>
	</div>
	<!--End-->

	<!--Modal Open Calendar(change)-->	
	<div class="modal fade" id="modalCalendarC">
		<div class="modal-dialog modal-xl">
			<div class="modal-content" >	
				<div class="modal-header">	
				<div class="modal-title col-12 text-center"><h3>Chọn giờ</h3></div>	
				<button type="button" class="close" id="closeC" data-dismiss="modal" hidden>&times;</button>
				</div>	
				<div class="modal-body">
					<span class="text">Ngày: </span><span id="da"></span>									
					<ul class="list-group list-group-horizontal" id="daysc">								
					</ul>
					<br>
					<hr style="width:50%;">	
					<h4 align="left">Giờ: </h3>				
					<ul class="list-group list-group-horizontal" id="timc">						
					</ul>				
				</div>
			</div>
		</div>
	</div>  
	<!--End-->

	<!--Modal view QR Code-->	
	<div class="modal fade" id="modalViewQRCode">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<div class="modal-title col-12 text-center"><h3>Lịch khám</h3></div>	
					<button type="button" class="close" data-dismiss="modal" hidden>&times;</button>	
				</div>
				<div class="modal-body">
					<center>
						<span class="qr_image"></span>
					</center>					
				</div>
			</div>
		</div>
	</div>
	<!--End-->

	<!--Modal view prescription-->
	<div id="modalViewPrescription" class="modal fade">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div>
					<div class="modal-header">
						<h3 class="modal-title col-12 text-center">Đơn thuốc</h3>
					</div>
				</div>
				<div class="modal-body">				
				<button type="button" class="close" data-dismiss="modal" hidden>&times;</button>
					<form method="post">
						<table width="100%" height="auto" border="0px">
							<tr>
								<td class="bold" width="22%">Họ tên: </td>
								<td id="pa_name" width="29%"></td>	
								<td class="bold" width="19%">Giới tính: </td>
								<td id="pa_sex" width="41%"></td>		
							</tr>
							<tr height="50px">
								<td class="bold" width="22%">Năm sinh: </td>
								<td id="pa_year" width="29%"></td>									
								<td class="bold" width="19%">Mã bệnh nhân: </td>
								<td id="pa_code" width="41%"></td>					
							</tr>
							<tr>
								<td class="bold" width="22%">Chẩn đoán: </td>
								<td id="pa_diagnose" colspan="3"></td>			
							</tr>
							<tr height="50px">
								<td class="bold" colspan="4">Điều trị: </td>						
							</tr>
							<tr>
								<td colspan="4">
									<table class="table table-bordered table-striped" id="table_prescription">
										<tbody>											
										</tbody>					
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="3"></td>
								<td width="31%" align="center">Ngày <?php echo date("d")?> Tháng <?php echo date("m")?> Năm <?php echo date("Y")?></td>
							</tr>
							<tr>
								<td colspan="3"></td>
								<td width="31%" align="center">Bác sĩ khám</td>
							</tr>
							<tr>
								<td colspan="3"></td>
								<td width="41%" align="center" height="80px"><span id="pa_doctor"></span></td>
							</tr>	
							<tr><td colspan="4" id="d_reexam"></td></tr>	
						</table>						
					</form>				
				</div>				
			</div>
		</div>
	</div>
	<!--End-->

	<!--Modal Payment Guide-->	
	<div class="modal fade" id="modalPaymentGuide">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<div class="modal-title col-12 text-center"><h3>Hướng dẫn thanh toán</h3></div>	
					<button type="button" class="close" data-dismiss="modal" hidden>&times;</button>	
				</div>
				<div class="modal-body">
					<table width="100%" height="auto" style="font-size:20px">
						<tr height="50px">
							<td class="bold">Số tài khoản:</td>
							<td>112233445566</td>
						</tr>
						<tr>
							<td class="bold">Ngân hàng:</td>
							<td>Vietinbank</td>
						</tr>
						<tr height="50px">
							<td class="bold">Nội dung chuyển khoản:</td>
							<td>Họ tên - Số điện thoại</td>
						</tr>
						<tr>
							<td colspan="2">Vui lòng thanh toán theo hướng dẫn trên để xác nhận lịch đã đặt</td>
						</tr>
						<tr>
							<td colspan="2" style="color:red">Lịch sẽ tự động hủy sau 15 phút nếu không thanh toán</td>
						</tr>
					</table>				
				</div>
			</div>
		</div>
	</div>
	<!--End-->	
			
	<!--Action-->
	<div class="row" style="margin-bottom:20%;margin-top:5%;">
		<div class="col-12">
			<?php
			if(isset($_GET['action']))
			{
				$ac=$_GET['action'];
				if($ac==''){require_once"index.php";}		
				elseif($ac=='viewcalendar'){require_once "view/patient/viewcalendar.php";}
				elseif($ac=='prescription'){require_once "view/patient/viewprescription.php";}
				elseif($ac=='viewprofile'){require_once "view/patient/profile.php";}					
			}
			else
			{
				$ac ='';
			}
			
			?>			
		</div>
	</div>	
	<!--End-->
	
	<!--Footer-->
	<div class="footer">
		<div class="row">
			<div class="col-4">
				<img src="image/LogoFooter.png" width="100%" height="100%">
			</div>
			<div class="col-4" style="padding-top: 2%;">
				<h4>THÔNG TIN LIÊN HỆ</h4>
				<p><strong>PHÒNG KHÁM ĐA KHOA</strong></p>
				<p>Địa chỉ: Phường 3, Quận.Gò Vấp, Tp.Hồ Chí Minh</p>
				<p>Email: <a href="mailto:abc@gmai.com" style="color: white">abc@gmail.com</a></p>
				<p>Hotline: <a href="tel:0123456789" style="color: white">0123456789</a></p>
			</div>
			<div class="col-4" style="padding-top: 2%;">
				<h4>LỊCH LÀM VIỆC</h4>
				<p>Thứ 2 - Thứ 7: 6:00 a.m đến 18:00 p.m</p>
				<p>Chủ Nhật: 6:00 a.m đến 12:00 p.m</p>
			</div>
		</div>				
	</div>
	<!--End-->
</div>
</body>
</html>
<script src="js/patient.js"></script>