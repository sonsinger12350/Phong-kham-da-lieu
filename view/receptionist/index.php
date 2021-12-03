<?php
require_once"../../model/connect.php";
$db= new db();
$connect = $db->connect();
if(isset($_SESSION['permission']))
{
	if($_SESSION['permission']!=1)
	{
		echo'
		<script>
			alert("Bạn không được phép truy cập");
			window.history.go(-1);
		</script>';	
	}	
}
else
{
	echo'
	<script>
		alert("Chưa đăng nhập");
		window.location.href="../patient/login.php";
	</script>';
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
	<link rel="stylesheet" href="../../library/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../library/fontawesome/css/all.css">
	<link rel="stylesheet" href="../../library/css/table.css">		
<title>Phòng Khám Đa Khoa</title>
	<style>		
		.footer {
			left: 0;
			bottom: 0;
			width: 100%;
			background-color:#4A49E8;
			color: white;
		}
	</style>
</head>
<script src="../../library/js/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="../../library/js/bootstrap.min.js"></script>	
<body>
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
				<img src="../../image/Logo.png" width="250px" height="100px">
			</a>
			<div class="nav">
				<a class="nav-item nav-link " href="index.php">TRANG CHỦ <span class="sr-only">(current)</span></a>
				<a class="nav-item nav-link" href="#" data-toggle="modal" data-target="#modalSetCalendar">THÊM LỊCH KHÁM</a>
				<a class="nav-item nav-link" href="?action=schedule">XEM LỊCH KHÁM</a>					
			</div>			
			<div>					
				<div class="dropdown dropleft float-right" id="account">					
					<a class="dropdown-toggle" data-toggle="dropdown">
						<span id="session"><?php if(isset($_SESSION['name']))echo $_SESSION['name'];?></span> <img src="../../image/account.png" width="30px" height="30px">
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

	<!--Modal change pass-->
	<div id="modalChangePass" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title col-12 text-center">Đổi mật khẩu</h4>
					<button type="button" class="close" data-dismiss="modal" hidden>&times;</button>
				</div>
				<div class="modal-body">
					<form method="post">
						<table width="100%" height="auto">
							<tr>
								<td height="50">
									<input type="password" id="pass" class="form-control" placeholder="Mật khẩu hiện tại">
									<span id="error9" style="color: red;"></span>
								</td>
							</tr>
							<tr>
								<td >
									<input type="password" id="newpass" class="form-control" placeholder="Mật khẩu mới">
									<span id="error10" style="color: red;"></span>
								</td>
							</tr>
							<tr>
								<td height="50">
									<input type="password" id="cfpass" class="form-control" placeholder="Xác nhận mật khẩu mới">
									<span id="error11" style="color: red;"></span>
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
						<td height="50">
							<label>Giới tính: </label>
							<select id="sex" onchange="resetdate();" class="form-control">
								<option value="" selected disabled hidden>Chọn giới tính</option>
								<option value="Nam" >Nam</option>	
								<option value="Nữ" >Nữ</option>		
							</select>	
							<span style="color: red;" id="error2"></span>
						</td>
					</tr>
					<tr>
						<td>
							<label>Năm sinh: </label>
							<input id="year" type="text" class="form-control" placeholder="Năm sinh">
							<span style="color: red;" id="error3"></span>	
						</td>
					</tr>
					<tr>
						<td height="50">
							<label>Số điện thoại: </label>
							<input id="phone" type="text" class="form-control" placeholder="Số điện thoại">
							<span style="color: red;" id="error4"></span>	
						</td>
					</tr>
					<tr>
						<td>
							<label>Email: </label>
							<input id="email" type="text" class="form-control" placeholder="Email">
							<span style="color: red;" id="error5"></span>	
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
							<span style="color: red;" id="error6"></span>
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
							<span style="color: red;" id="error7"></span>											
						</td>						
					</tr>
					<tr>
						<td height="50">
							<input type="text" id="time" class="form-control" placeholder="Giờ" disabled>
							<span style="color: red;" id="error8"></span>
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

	<!--Modal Calendar(set)-->	
	<div class="modal fade" id="modalCalendar">
		<div class="modal-dialog modal-xl">
			<div class="modal-content" >	
				<div class="modal-header">	
				<div class="modal-title col-12 text-center"><h3>Chọn giờ</h3></div>	
				<button type="button" class="close" id="closeC" data-dismiss="modal" hidden>&times;</button>		
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
							<tr hidden><td><input type="text" id="schedule_id"></td></tr>
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

	<!--Modal Calendar(change)-->	
	<div class="modal fade" id="modalCalendarC">
		<div class="modal-dialog modal-xl">
			<div class="modal-content" >	
				<div class="modal-header">	
				<div class="modal-title col-12 text-center"><h3>Chọn giờ</h3></div>	
				<button type="button" class="close" id="closeCS" data-dismiss="modal" hidden>&times;</button>		
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

	<!--Action-->
	<div class="row" style="margin-bottom:20%;margin-top:5%;">		
		<div class="col-12">
			<?php
			if(isset($_GET['id']))
			{					
				require_once "../../controller/receptionist/checkqr.php";
			}
			if(isset($_GET['action']))
			{
				$ac=$_GET['action'];
				if($ac==''){require_once"index.php";}		
				elseif($ac=='schedule'){require_once "schedule.php";}
				elseif($ac=='profile'){require_once "profile.php";}								
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
				<img src="../../image/LogoFooter.png" width="100%" height="100%">
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
<script language="javascript">	
/*$(document).ready(function(){
  setInterval(checkSchedule(),3000);  
});*/
setInterval(checkSchedule,60000);
function checkSchedule(){
	$.ajax({
		url:"../../controller/receptionist/checkschedule.php"		
	});
}
//Log Out
$("#logout").click(function(){
	alert("Đăng xuất thành công");
	window.location.href="../patient/logout.php";
});
//End

//Change Password
$("#changePass").click(function(){
var pass = $("#pass").val();
var newpass = $("#newpass").val();
var cfpass = $("#cfpass").val();
if(pass != ''){
	$("#error9").html("");
	if(newpass !=''){
		$("#error10").html("");
		if(cfpass !=''){
			$("#error11").html("");
			if(cfpass == newpass){
				$("#error11").html("");
				$.ajax({
					url:"../../controller/patient/changepass.php",
					method:"POST",
					data:{pass:pass,newpass:newpass},
					beforeSend:function(){
						$("#changePass").attr('disabled');
					},
					success:function(data){						
						if(data=='success'){
							alert("Đổi mật khẩu thành công");
							$("#changePass").removeAttr('disabled');
							$("#pass").val("");
							$("#newpass").val("");
							$("#cfpass").val("");							
							$(".close").click();												
						}
						else if(data=='exist'){
							alert("Không sử dụng mật khẩu cũ");	
							$("#changePass").removeAttr('disabled');					
							$("#newpass").val("");
							$("#cfpass").val("");
						}
						else if(data=='notexist'){
							alert("Mật khẩu hiện tại không trùng khớp");
							$("#changePass").removeAttr('disabled');
							$("#pass").val("");						
						}
					}
				});
			}else{$("#error11").html("*Mật khẩu mới không trùng khớp");}
		}else{$("#error11").html("*Xác nhận mật khẩu mới");}
	}else{$("#error10").html("*Chưa nhập mật khẩu mới");}
}else{$("#error9").html("*Chưa nhập mật khẩu hiện tại");}
if(pass =='' && newpass == '' && cfpass==''){
	$("#error9").html("*Chưa nhập mật khẩu hiện tại");
	$("#error10").html("*Chưa nhập mật khẩu mới");
	$("#error11").html("*Xác nhận mật khẩu mới");
}
});
//End

//Open Calendar(set Calendar)
$("#calendar").click(function(){
	let d = new Date();
	let year = d.getFullYear();
	let month = d.getMonth()+1;		
	let text = "";	
	let day = d.getDate();
	let totalDayOfMonth;
	if(month == 2 ){
		totalDayOfMonth=29;
	}
	else if(month == 4 || month == 6 || month == 9 || month == 11){
		totalDayOfMonth=30;
	}
	else{
		totalDayOfMonth=31;
	}
	for(i=0;i<15;i++){						
		if(day  <= totalDayOfMonth){
			date = month+'/'+day;
			text += '<li class="list-group-item list-group-item-action w-auto p-3 day">'+date+'</li>';
			day = day + 1;					
		}
		else{			
			day = 1;
			month = month + 1;
			if(month > 12){
				month = 1;
				year = year +1;
			}			
			date = month+'/'+day;				
			text += '<li class="list-group-item list-group-item-action w-auto p-3 day">'+date+'</li>';
			day= day +1;
		}			
		$("#days").html(text);				
	}										
});

$("body").on("click",".day",function(){
	let doctor = $('#doctor').val();
	let d = $(this).html();	
	let year = new Date().getFullYear();
	let date = year+'/'+d;
	$("#d").html(date);	
	$.ajax({
		url:"../../controller/patient/gettime.php",
		method:"GET",
		data:{doctor:doctor,date:date},
		success:function(data){
			if(data=="wrong"){
				alert("Thất bại");
			}
			else{
				$("#tim").html(data);
			}
		}
	});
});

$("body").on("click",".time",function(){
	let date = $("#d").html();	
	let time = $(this).html();
	$("#date").val(date);
	$("#time").val(time);		
	$("#closeC").click();		
});
//End

//Set calendar
$("#schedule").click(function(){	
	let name = $("#name").val();
	let sex = $("#sex").val();
	let year = $("#year").val();
	var phone = $("#phone").val();
	var email = $("#email").val();	
	var date = $("#date").val();
	var time = $("#time").val();
	var doctor = $("#doctor").val();
	var today=new Date();
	today.setDate(today.getDate()-1);
	var nextday = new Date();
	nextday.setDate(nextday.getDate()+30);
	var  d = new Date(date);
	var checkphone= /^[0\+]{1}[0-9\-]{9}$/;
	if(name=="" && sex == null && year =='' && phone =="" && email == "" && doctor == null && date =="" && time == ""){
		$("#error1").html("*Chưa nhập họ tên");
		$("#error2").html("*Chưa chọn giới tính");
		$("#error3").html("*Chưa nhập năm sinh");
		$("#error4").html("*Chưa nhập số điện thoại");
		$("#error5").html("*Chưa nhập email");
		$("#error6").html("*Chưa chọn bác sĩ");
		$("#error7").html("*Chưa chọn ngày");
		$("#error8").html("*Chưa chọn giờ");
	}
	if(name != ''){
		$("#error1").html("");
		if(sex != null){
			$("#error2").html("");
			if(year != ''){
				$("#error3").html("");
					if(phone != ''){
					$("#error4").html("");
					if(phone.match(checkphone)){
						$("#error4").html("");
						if(email != ''){
							$("#error5").html("");
							if(doctor != null){
								$("#error6").html("");
								if(date !=''){
									$("#error7").html("");
									if(d > today && d < nextday){
										$("#error7").html("");
										if(time != null){
											$("#error8").html("");
											$.ajax({
												url:"../../controller/receptionist/bookschedule.php",
												method:"GET",
												data:{name:name,sex:sex,year:year,phone:phone,email:email,doctor:doctor,date:date,time:time},
												success:function(data){
													if(data=='success'){									
														alert("Đặt lịch thành công");						
														location.reload("#tableschedule");					
														$(".close").click();
														window.location.href="index.php?action=schedule";	
													}
													else if(data=='notexist'){
														alert("Không tìm thấy email");						
														$(".close").click();
													}
													else{
														alert("Đặt lịch không thành công");					
														$(".close").click();
													}											
												}
											});								
										}else{$("#error8").html("*Chưa chọn giờ");}	
									}else{$("#error7").html("*Chọn ngày mới và không quá ngày hiện tại 30 ngày");}	
								}else{$("#error7").html("*Chưa chọn ngày");$("#error5").html("*Chưa chọn giờ");}
							}else{$("#error6").html("*Chưa chọn bác sĩ");}
						}else{$("#error5").html("*Chưa nhập email");}				
					}else{$("#error4").html("*Nhập số điện thoại hợp lệ");}
				}else{$("#error4").html("*Chưa nhập số điện thoại");}
			}else{$("#error3").html("");}
		}else{$("#error2").html("");}
	}else{$("#error1").html("*Chưa nhập họ tên");}
});
//End

//Reset date
function resetdate(){
	$("#date").val("");	
	$("#time").val("");
	$("#datec").val("");	
	$("#timec").val("");
}
//End

//Open Calendar(change calendar)
$("#calendarc").click(function(){
	let d = new Date();
	let day = d.getDate();	
	let month = d.getMonth()+1;	
	let year = d.getFullYear();
	let text = "";	
	let totalDayOfMonth;
	if(month == 2 ){
		totalDayOfMonth=29;
	}
	else if(month == 4 || month == 6 || month == 9 || month == 11){
		totalDayOfMonth=30;
	}
	else{
		totalDayOfMonth=31;
	}
	for(i=0;i<15;i++){						
		if(day  <= totalDayOfMonth){
			date = month+'/'+day;
			text += '<li class="list-group-item list-group-item-action w-auto p-3" id="dayc">'+date+'</li>';
			day = day + 1;					
		}
		else{			
			day = 1;
			month = month + 1;
			if(month > 12){
				month = 1;
				year = year +1;
			}			
			date = month+'/'+day;				
			text += '<li class="list-group-item list-group-item-action w-auto p-3" id="dayc">'+date+'</li>';
			day= day +1;
		}			
		$("#daysc").html(text);				
	}										
});

$("body").on("click","#dayc",function(){
	let doctor = $('#doctorc').val();
	let d = $(this).html();	
	let year = new Date().getFullYear();
	let date = year+'/'+d;
	$("#da").html(date);	
	$.ajax({
		url:"../../controller/patient/gettime.php",
		method:"GET",
		data:{doctor:doctor,date:date},
		success:function(data){
			if(data=="wrong"){
				alert("Thất bại");
			}
			else{
				$("#timc").html(data);
			}
		}
	});
});

$("body").on("click",".time",function(){
	let date = $("#da").html();	
	let time = $(this).html();
	$("#datec").val(date);
	$("#timec").val(time);		
	$("#closeCS").click();		
});

//End

//Change Schedule
$("body").on("click",".changeC",function(){
	let id = $(this).val();
	$("#schedule_id").val(id);
	$.ajax({
		url:"../../controller/patient/getdata.php",
		method:"POST",
		data:{schedule_id:id},
		success:function(data){
			const value = JSON.parse(data);
			$("#namec").val(value.name);
			$("#sexc").val(value.sex);	
			$("#yearc").val(value.year);
			$("#phonec").val(value.phone);		
		}
	});	
});

$("#changeschedule").click(function(){	
	let id = $("#schedule_id").val();
	let name = $("#namec").val();
	let sex = $("#sexc").val();
	let year = $("#yearc").val();
	let phone = $("#phonec").val();
	let date = $("#datec").val();
	let time = $("#timec").val();
	let doctor = $("#doctorc").val();
	let today=new Date();
	today.setDate(today.getDate()-1);
	let nextday = new Date();
	nextday.setDate(nextday.getDate()+30);
	let  d = new Date(date);
	let checkphone= /^[0\+]{1}[0-9\-]{9}$/;
	//
	if(name != ''){
		$("#error8").html("");
		if(phone != ''){
			$("#error9").html("");
			if(year != ''){
				$("#error10").html("");
				if(phone != ''){
					$("#error11").html("");
					if(phone.match(checkphone)){
						$("#error11").html("");
						if(doctor != null){
							$("#error12").html("");
							if(date != '' && time != null){
								$("#error13").html("");
								$("#error14").html("");
								if(d > today && d < nextday){
									$.ajax({
										url:"../../controller/patient/changeschedule.php",
										method:"GET",
										data:{id:id,name:name,sex:sex,year:year,phone:phone,doctor:doctor,date:date,time:time},
										success:function(data){
											if(data=='success'){
												alert("Đổi lịch thành công");
												location.reload("#tableschedule");							
												$(".close").click();
											}
											else{
												alert("Đổi lịch thất bại");
												location.reload("#tableschedule");
												$(".close").click();
											}											
										}
									});	
								}else{$("#error13").html("Chọn ngày mới và không quá ngày hiện tại 30 ngày");}
							}else{$("#error13").html("*Chưa chọn ngày");$("#error14").html("*Chưa chọn giờ");}
						}else{$("#error12").html("*Chưa chọn bác sĩ");}				
					}else{$("#error11").html("*Nhập số điện thoại hợp lệ");}
				}else{$("#error11").html("*Chưa nhập số điện thoại");}
			}else{$("#error10").html("*Chưa nhập năm sinh");}
		}else{$("#error9").html("*Chưa chọn giới tính");}
	}else{$("#error8").html("*Chưa nhập họ tên");}
	if(name=="" && sex==null && year=='' && phone =="" && doctor == null && date =="" && time ==''){
		$("#error8").html("*Chưa nhập họ tên");
		$("#error9").html("*Chưa chọn giới tính");
		$("#error10").html("*Chưa nhập năm sinh");
		$("#error11").html("*Chưa nhập số điện thoại");
		$("#error12").html("*Chưa chọn bác sĩ");
		$("#error13").html("*Chưa chọn ngày");
		$("#error14").html("*Chưa chọn giờ");
	}
});
//End

//Option display Calendar
$("#display").change(function(){
	let option = $("#display").val();	
	//window.location.href="index.php?action=schedule";
	$.ajax({
		url:"../../controller/receptionist/getschedule.php",
		method:"GET",
		data:{option:option},
		success:function(data){
			if(data != ''){	
				$("#tableschedule tr").html("");
				$("#tableschedule").html(data);
			}			
		}
	});
});
//End

$("body").on("click",".paid",function(){	
	let id = $(this).val();
	$.ajax({
		url:"../../controller/receptionist/paid.php",
		method:"GET",
		data:{id:id},
		success:function(data){
			alert(data);
			window.location.reload("#tableschedule");
		}
	});
});

//Search schedule
function ShowResult(str){	
	let phone = str.trim();	
	if(phone !='')
	{
		$.ajax({
			url:"../../controller/receptionist/getschedule.php",
			method:"GET",
			data:{phone:phone},
			success:function(data){						
				$("#tableschedule tr").html("");
				$("#tableschedule").html(data);
			}
		});
		$("#pagi").hide();
	}
	else{
		$.ajax({
			url:"../../controller/receptionist/getschedule.php",
			method:"GET",			
			success:function(data){			
				$("#tableschedule tr").html("");
				$("#tableschedule").html(data);
			}
		});	
		$("#pagi").show();
	}	
}
//End
</script>