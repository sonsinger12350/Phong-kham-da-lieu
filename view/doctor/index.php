<?php
require_once"../../model/connect.php";
$db= new db();
$connect = $db->connect();
if(isset($_SESSION['permission']))
{
	if($_SESSION['permission']!=2)
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
	<link rel="stylesheet" href="../../library/fontawesome/css/fontawesome.min.css">
<title>Phòng Khám Đa Khoa</title>
	<style>		
		.footer {
			left: 0;
			bottom: 0;
			width: 100%;
			background-color:#4A49E8;
			color: white;		
		}
		.bold {
			font-weight: bold;
		}
	</style>
</head>
<script src="../../library/js/jquery-3.6.0.min.js"></script>
<script src="../../library/js/popper.min.js"></script>	
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
				<a class="nav-item nav-link" href="index.php">TRANG CHỦ <span class="sr-only">(current)</span></a>
				<a class="nav-item nav-link " href="?action=schedule">LỊCH LÀM VIỆC</a>
				<a class="nav-item nav-link " href="?action=record">HỒ SƠ BỆNH ÁN</a>						
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
									<span id="error1" style="color: red;"></span>
								</td>
							</tr>
							<tr>
								<td >
									<input type="password" id="newpass" class="form-control" placeholder="Mật khẩu mới">
									<span id="error2" style="color: red;"></span>
								</td>
							</tr>
							<tr>
								<td height="50">
									<input type="password" id="cfpass" class="form-control" placeholder="Xác nhận mật khẩu mới">
									<span id="error3" style="color: red;"></span>
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

	<!--Modal create medical record-->
	<div id="modalCreateRecord" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div>
					<div class="modal-header">
						<h3 class="modal-title col-12 text-center">Tạo hồ sơ bệnh án</h3>
					</div>
				</div>
				<div class="modal-body">				
				<button type="button" class="close" data-dismiss="modal" hidden>&times;</button>
					<form method="post">
						<table width="100%" height="auto">
							<tr><td><input type="text" id="schedule_id" hidden></td></tr>
							<tr><td><input type="text" id="patient_id" hidden></td></tr>
							<tr>
								<td height="50">
									<label>Tên bệnh nhân:</label>
									<input type="text" id="patient_name" class="form-control" placeholder="Tên bệnh nhân">
									<span id="error4" style="color: red;"></span>
								</td>
							</tr>
							<tr>
								<td>
									<label>Số điện thoại:</label>
									<input type="text" id="patient_phone" class="form-control" placeholder="Số điện thoại">
									<span id="error5" style="color: red;"></span>
								</td>
							</tr>
							<tr>
								<td>
									<label>Năm sinh:</label>
									<input type="text" id="patient_year" class="form-control" placeholder="Năm sinh">
									<span id="error6" style="color: red;"></span>
								</td>
							</tr>
							<tr>
								<td height="50">
									<label>Giới tính:</label>
									<select id="patient_sex" class="form-control">
										<option selected disabled hidden>Chọn giới tính</option>
										<option value="Nam">Nam</option>
										<option value="Nữ">Nữ</option>
									</select>
									<span id="error7" style="color: red;"></span>
								</td>							
							</tr>
							<tr>
								<td>
									<label>Chẩn đoán:</label>
									<input type="text" id="diagnose" class="form-control" placeholder="Chẩn đoán">								
								</td>
							</tr>
							<tr>
								<td height="50">
									<label>Mô tả chi tiết:</label>
									<textarea class="form-control" rows="5" id="descript"></textarea>
								</td>
							</tr>
							<tr>
								<td>
									<center><button type="button"  class="btn btn-primary" id="crerecord">Tạo</button></center>
								</td>
							</tr>
						</table>
					</form>				
				</div>				
			</div>
		</div>
	</div>
	<!--End-->

	<!--Modal update medical record-->
	<div id="modalUpdateRecord" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div>
					<div class="modal-header">
						<h3 class="modal-title col-12 text-center">Cập nhật sơ bệnh án</h3>
					</div>
				</div>
				<div class="modal-body">				
				<button type="button" class="close" data-dismiss="modal" hidden>&times;</button>
					<form method="post">
						<table width="100%" height="auto">							
							<tr><td><input type="text" id="record_id_update" hidden></td></tr>
							<tr>
								<td height="50">
									<label>Tên bệnh nhân:</label>
									<input type="text" id="patient_name_update" class="form-control" placeholder="Tên bệnh nhân">
									<span id="error8" style="color: red;"></span>
								</td>
							</tr>						
							<tr>
								<td>
									<label>Năm sinh:</label>
									<input type="text" id="patient_year_update" class="form-control" placeholder="Năm sinh">
									<span id="error9" style="color: red;"></span>
								</td>
							</tr>
							<tr>
								<td height="50">
									<label>Giới tính:</label>
									<select id="patient_sex_update" class="form-control">
										<option selected disabled hidden>Chọn giới tính</option>
										<option value="Nam">Nam</option>
										<option value="Nữ">Nữ</option>
									</select>
									<span id="error10" style="color: red;"></span>
								</td>							
							</tr>
							<tr>
								<td>
									<label>Chẩn đoán:</label>
									<input type="text" id="diagnose_update" class="form-control" placeholder="Chẩn đoán">								
								</td>
							</tr>
							<tr>
								<td height="50">
									<label>Mô tả chi tiết:</label>
									<textarea class="form-control" rows="5" id="descript_update"></textarea>
								</td>
							</tr>
							<tr>
								<td>
									<label>Trạng thái:</label>
									<select id="status_update" class="form-control">
										<option selected disabled hidden>Chọn trạng thái</option>
										<option value="Đang theo dõi">Đang theo dõi</option>
										<option value="Khỏi bệnh">Khỏi bệnh</option>
									</select>
									<span id="error11" style="color: red;"></span>
								</td>
							</tr>
							<tr>
								<td>
									<center><button type="button"  class="btn btn-primary" id="updateRecord">Cập nhật</button></center>
								</td>
							</tr>
						</table>
					</form>				
				</div>				
			</div>
		</div>
	</div>
	<!--End-->

	<!--Modal add medicine-->
	<div id="modalAddMedicine" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">				
				<div class="modal-body">				
				<button type="button" class="close" data-dismiss="modal" hidden>&times;</button>
					<form method="post">
						<table width="100%" height="auto" id="tbl_addpre">							
							<tr><td><input type="text" id="med_name" hidden></td></tr>
							<tr><td><input type="text" id="med_use" hidden></td></tr>
							<tr><td><input type="text" id="med_unit" hidden></td></tr>						
							<tr>
								<td>
									<label>Số lượng:</label>
									<input type="text" id="med_quantity" class="form-control" placeholder="Số lượng">
									<span id="er" style="color: red;"></span>
								</td>
							</tr>
							<tr>
								<td height="50">
									<label>Lưu ý: </label>
									<input type="text" id="med_note" class="form-control" placeholder="Lưu ý">
									
								</td>							
							</tr>							
							<tr>
								<td>
									<center><button type="button"  class="btn btn-primary" id="add_med">Thêm</button></center>
								</td>
							</tr>
						</table>
					</form>				
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
								<td width="41%" align="center" height="80px"><?php echo $_SESSION['name']?></td>
							</tr>
							<tr><td colspan="4" id="d_reexam"></td></tr>		
						</table>						
					</form>				
				</div>				
			</div>
		</div>
	</div>
	<!--End-->

	<!--Modal delete prescription-->	
	<div class="modal fade" id="modalDeletePrescription">
		<div class="modal-dialog">
			<div class="modal-content" >	
				<div class="modal-header">
					<h4 class="modal-title col-12 text-center" align="center">Bạn muốn xóa ?</h4>		
				</div>	
				<div class="modal-body" align="center">
					<form method="post">
						<input type="text" id="pre_id" hidden>
					</form>
					<div class="row">	
						<div class="col-6">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Không</button>
						</div>
						<div class="col-6">
							<button type="button" class="btn btn-success" id="delete_prescription">Có</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>  
	<!--End-->

	<!--Modal create test-->
	<div id="modalCreateTest" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div>
					<div class="modal-header">
						<h3 class="modal-title col-12 text-center">Tạo yêu cầu xét nghiệm</h3>
					</div>
				</div>
				<div class="modal-body">				
				<button type="button" class="close" data-dismiss="modal" hidden>&times;</button>
					<form method="post">
						<table width="100%" height="auto">							
							<tr><td><input type="text" id="record_id_test" hidden></td></tr>
							<tr>
								<td height="50">
									<label for="patient_name_test">Tên bệnh nhân:</label>
									<input type="text" id="patient_name_test" class="form-control" placeholder="Tên bệnh nhân">
									<span id="error12" style="color: red;"></span>
								</td>
							</tr>						
							<tr>
								<td>
									<label for="patient_year_test">Năm sinh:</label>
									<input type="text" id="patient_year_test" class="form-control" placeholder="Năm sinh">
									<span id="error13" style="color: red;"></span>
								</td>
							</tr>
							<tr>
								<td height="50">
									<label for="patient_sex_test">Giới tính:</label>
									<select id="patient_sex_test" class="form-control">
										<option selected disabled hidden>Chọn giới tính</option>
										<option value="Nam">Nam</option>
										<option value="Nữ">Nữ</option>
									</select>
									<span id="error14" style="color: red;"></span>
								</td>							
							</tr>
							<tr>
								<td>
									<label for="test_type">Loại xét nghiệm:</label>
									<select id="test_type" class="form-control">
										<option selected disabled hidden id="disabled">Chọn loại xét nghiệm</option>	
									</select>									
									<span id="error15" style="color: red;"></span>							
								</td>
							</tr>														
							<tr>
								<td>
									<center><button type="button"  class="btn btn-primary" id="create_test">Tạo</button></center>
								</td>
							</tr>
						</table>
					</form>				
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
				elseif($ac=='schedule'){require_once "schedule.php";}
				elseif($ac=='record'){require_once "record.php";}
				elseif($ac=='creprescription'){require_once "createprescription.php";}	
				elseif($ac=='viewprescription'){require_once "prescription.php";}
				elseif($ac=='test'){require_once "test.php";}
				elseif($ac=='reexam'){require_once "reexam.php";}									
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
$(document).ready(function(){	
	let option = sessionStorage.getItem("option");		
	if(option != null){
		$("#display").val(option);
		$.ajax({
				url:"../../controller/doctor/getschedule.php",
				method:"GET",
				data:{option},		
				success:function(data){
					$("#tableschedule tr").html("");
					$("#tableschedule").html(data);
				}
			});
	}	
});	
$("#logout").click(function(){
	alert("Đăng xuất thành công");
	window.location.href="../patient/logout.php";
});

//Change Password
$("#changePass").click(function(){
var pass = $("#pass").val();
var newpass = $("#newpass").val();
var cfpass = $("#cfpass").val();
if(pass != ''){
	$("#error1").html("");
	if(newpass !=''){
		$("#error2").html("");
		if(cfpass !=''){
			$("#error3").html("");
			if(cfpass == newpass){
				$("#error3").html("");
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
			}
			else{
				$("#error3").html("*Mật khẩu mới không trùng khớp");
			}
		}
		else{
			$("#error3").html("*Xác nhận mật khẩu mới");
		}
	}
	else{
		$("#error2").html("*Chưa nhập mật khẩu mới");
	}
}
else{
	$("#error1").html("*Chưa nhập mật khẩu hiện tại");
}
if(pass =='' && newpass == '' && cfpass==''){
	$("#error1").html("*Chưa nhập mật khẩu hiện tại");
	$("#error2").html("*Chưa nhập mật khẩu mới");
	$("#error3").html("*Xác nhận mật khẩu mới");
}
});
//End

//Fill data to form Create medical record
$("body").on("click",".profile",function(){
	let id = $(this).val();
	$("#schedule_id").val(id);
	$.ajax({
		url:"../../controller/patient/getdata.php",
		method:"POST",
		data:{schedule_id:id},
		success:function(data){
			const value = JSON.parse(data);
			$("#patient_id").val(value.id);
			$("#patient_name").val(value.name);
			$("#patient_sex").val(value.sex);	
			$("#patient_year").val(value.year);
			$("#patient_phone").val(value.phone);		
		}
	});		
});
//End

//Create medical record
$("#crerecord").click(function(){
	let schedule_id = $("#schedule_id").val();
	let patient_id = $("#patient_id").val();
	let patient_name = $("#patient_name").val();
	let patient_phone = $("#patient_phone").val();
	let patient_year = $("#patient_year").val();
	let patient_sex = $("#patient_sex").val();
	let diagnose = $("#diagnose").val();
	let descript = $("#descript").val();	
	if(patient_name != ''){
		$("#error4").html("");
		if(patient_phone != ''){
			$("#error5").html("");
			if(patient_year != ''){
				$("#error6").html("");
				if(patient_sex != null){
					$("#error7").html("");
					$.ajax({
						url:"../../controller/doctor/createrecord.php",
						method:"POST",
						data:{schedule_id,patient_id,name:patient_name,phone:patient_phone,sex:patient_sex,year:patient_year,diagnose,descript},
						success:function(data){
							if(data=='success'){
								alert("Tạo hồ sơ thành công");
								$("#diagnose").val("");
								$("#descript").val("");
								$(".close").click();
								window.location.href="index.php?action=record";
							}
							else{
								//alert("Tạo hồ sơ thất bại");
								alert(data);
								$("#diagnose").val("");
								$("#descript").val("");
								$(".close").click();
							}
						}
					});
				}else{$("#error7").html("*Chưa chọn giới tính");}
			}else{$("#error6").html("*Chưa nhập năm sinh");}			
		}else{$("#error5").html("*Chưa nhập số điện thoại");}
	}else{$("#error4").html("*Chưa nhập họ tên");}
});
//End

//Calendar display Option
$("#display").change(function(){
	let option = $("#display").val();		
	if(option != null){
		sessionStorage.setItem("option", option);
		if(option !='Toàn bộ'){
			$("#pagination").hide();
		}
		else{
			$("#schedule1").click();			
			$("#pagination").show();
		}
		$.ajax({
			url:"../../controller/doctor/getschedule.php",
			method:"GET",
			data:{option},
			success:function(data){
				$("#tableschedule tr").html("");
				$("#tableschedule").html(data);
			}
		});
	}
	else{
		$("#pagination").show();
		$.ajax({
			url:"../../controller/doctor/getschedule.php",
			method:"GET",			
			success:function(data){
				$("#tableschedule tr").html("");
				$("#tableschedule").html(data);
			}
		});
	}
	
});
//End

//Fill data to form Update Medical Record
$(".updateR").click(function(){
	let record_id = $(this).val();
	$("#record_id_update").val(record_id);
	$.ajax({
		url:"../../controller/doctor/getdatarecord.php",
		method:"GET",
		data:{record_id:record_id},
		success:function(data){
			const value = JSON.parse(data);
			$("#patient_name_update").val(value.name);
			$("#patient_sex_update").val(value.sex);
			$("#patient_year_update").val(value.year);
			$("#diagnose_update").val(value.diagnose);
			$("#descript_update").val(value.descript);
			$("#status_update").val(value.status);
		}
	});
});
//End

//Update Medical Record
$("#updateRecord").click(function(){
	let record_id = $("#record_id_update").val();
	let patient_name = $("#patient_name_update").val();
	let patient_sex = $("#patient_sex_update").val();
	let patient_year = $("#patient_year_update").val();
	let diagnose = $("#diagnose_update").val();
	let descript = $("#descript_update").val();
	let status = $("#status_update").val();
	if(patient_name != ''){
		$("#error8").html("");
		if(patient_year != ''){
			$("#error9").html("");
			if(patient_sex != null){
				$("#error10").html("");
				if(status != null){
					$("#error11").html("");
					$.ajax({
						url:"../../controller/doctor/updaterecord.php",
						method:"POST",
						data:{record_id:record_id,name:patient_name,sex:patient_sex,year:patient_year,diagnose:diagnose,descript:descript,status:status},
						success:function(data){
							if(data=='success'){
								alert("Cập nhật hồ sơ thành công");
								$("#diagnose").val("");
								$("#descript").val("");
								$(".close").click();
								location.reload("#tblrecord");								
							}
							else{
								alert("Cập nhật hồ sơ thất bại");
								$("#diagnose_update").val("");
								$("#descript_update").val("");
								$(".close").click();
							}
						}
					});
				}else{$("#error11").html("*Chưa chọn trạng thái");}
			}else{$("#error10").html("*Chưa chọn giới tính ");}			
		}else{$("#error9").html("*Chưa nhập năm sinh");}
	}else{$("#error8").html("*Chưa nhập họ tên");}
});
//End

//Search Medicine
function searchmed(str){	
	let prescription = str.trim();
	if(prescription !='' && prescription != null){
		$.ajax({
			url:"../../controller/doctor/getmedicine.php",
			method:"GET",
			data:{name:prescription},
			success:function(data){
				$("#tbl_medicine").html("");
				$("#tbl_medicine").html(data);
			}
		});
	}
	else{
		$.ajax({
			url:"../../controller/doctor/getmedicine.php",
			method:"GET",
			success:function(data){
				$("#tbl_medicine").html("");
				$("#tbl_medicine").html(data);
			}
		});
	}		
}
//End

//Fill data to form add medicine
$("body").on("click",".add_pre",function(){	
	let name = $(this).attr("data-name");
	let use = $(this).attr("data-use");	
	let unit = $(this).attr("data-unit");	
	$("#med_name").val(name);
	$("#med_use").val(use);
	$("#med_unit").val(unit);
});
//End

//Add medicine to prescription
$("#add_med").click(function(){
	let name = $("#med_name").val();
	let use = $("#med_use").val();
	let unit = $("#med_unit").val();
	let quantity = $("#med_quantity").val();
	let note = $("#med_note").val();
	if(quantity != ''){
		$("#er").html("");
		$.ajax({
			url:"../../controller/doctor/checkquantity.php",
			method:"GET",
			data:{name:name,quantity:quantity},
			success:function(data){
				if(data=="ok"){
					$("#er").html("");
					$(".close").click();
					let text = '<tr><td><span id="pre_name">'+name+'</span><br>Cách dùng: <span id="pre_use">'+use+'</span></td><td width="20%"><span id="pre_quantity">'+quantity+' '+unit+'</span></td><td><span id="pre_note">'+note+'</span></td></tr>';
					$("#tbl_addpre tr td input").val("");
					$("#tbl_prescription > tbody").append(text);
				}else{
					$("#er").html("*Số lượng không đủ");					
				}				
			}
		});
	}
	else{
		$("#er").html("*Nhập số lượng");
	}
		
});
//End

//Create prescription
$("body").on("click","#create_prescription",function(){
	let record_id = $("#re_id").html();	
	let patient_id = $("#p_id").html();
	let patient_name = $("#p_name").html();
	let patient_year = $("#p_year").html();
	let patient_sex = $("#p_sex").html();
	let diagnose = $("#p_diagnose").html();
	let date_create = $("#year_cre").html()+'-'+$("#month_cre").html()+'-'+$("#day_cre").html();
	let date = $("#date_reexam").val();	
	let date_reexam = $("#date_rexam").val();
	let count = $("#tbl_prescription tr").length;		
	let text= [];
	//Add medicines into array
	$("#tbl_prescription tr").each(function(){
		let currentrow = $(this);		
		let name = currentrow.find("#pre_name").html();
		let use = currentrow.find("#pre_use").html();		
		let quantity = currentrow.find("#pre_quantity").html();
		let note = currentrow.find("#pre_note").html();
		let obj ={}
		obj.name = name;
		obj.use = use;
		obj.quantity = quantity;
		obj.note = note;
		text.push(obj);		
	});
	//End
	text.splice(text,1);
	let medicine = JSON.stringify(text);
	if(text != ''){
		$.ajax({
			url:"../../controller/doctor/createprescription.php",
			method:"POST",
			data:{record_id,patient_id,patient_name,patient_year,patient_sex,diagnose,medicine,date},
			success:function(data){
				if(data=='success'){
					if(date != null){		
						$.ajax({
							url:"../../controller/doctor/createreexam.php",
							method:"GET",
							data:{record_id,date,date_create}		
						});	
					}
					else if(date_reexam!=''){
						$.ajax({
							url:"../../controller/doctor/createreexam.php",
							method:"GET",
							data:{record_id,date:date_reexam,date_create}		
						});
					}
					else if($("#finish").prop('checked')==true){
						$.ajax({
							url:"../../controller/doctor/updaterecord.php",
							method:"POST",
							data:{record_id,stt:'Khỏi bệnh'}		
						});
					}					
					alert("Tạo đơn thuốc thành công");
					window.history.go(-1);
				}
				else{
					alert(data);
				}
			}
		});
	}	
	else{
		alert("Chưa thêm thuốc");
	}	
});
//End
//View prescription detail
$("body").on("click",".view_pre",function(){
	let id = $(this).val();
	let text ="";
	$.ajax({
		url:"../../controller/doctor/getdataprescription.php",
		method:"GET",
		data:{id:id},
		success:function(data){
			let value = JSON.parse(data);
			$("#pa_name").html(value.name);
			$("#pa_sex").html(value.sex);
			$("#pa_year").html(value.year);
			$("#pa_diagnose").html(value.diagnose);
			$("#pa_code").html(value.id);
			text = '<tr class="bold"><td>Tên thuốc: </td><td>Số lượng: </td><td>Lời dặn: </td></tr>'
			for(i=0;i<value.medicine.length;i++)
			{
				text += '<tr><td>'+value.medicine[i].name+'<br>Cách dùng: '+value.medicine[i].use+'</td><td width="30%">'+value.medicine[i].quantity+'</td><td width="35%">'+value.medicine[i].note+'</td></tr>';			
			}
			if(value.date !=''){				
				$("#d_reexam").html('<hr>'+'Tái khám sau: '+value.date+' ngày');
			}
			$("#table_prescription > tbody").html(text);
		}
	});
});
//End
//Delete prescription
$(".detele_pre").click(function(){
	let id = $(this).val();
	$("#pre_id").val(id);
});
$("#delete_prescription").click(function(){
	let id = $("#pre_id").val();
	$.ajax({
		url:"../../controller/doctor/deleteprescription.php",
		method:"GET",
		data:{id:id},
		success:function(data){
			if(data=='success'){
				alert("Xóa thành công");
				window.location.reload("#table_pre");				
			}
			else{
				alert("Xóa thất bại");
			}
		}
	});
});
//End
//Create test request
$("#cre_test").click(function(){
	let id = $(this).val();
	$("#record_id_test").val(id);
	$.ajax({
		url:"../../controller/doctor/getdatarecord.php",
		method:"GET",
		data:{record_id:id},
		success:function(data){
			let value = JSON.parse(data);
			$("#patient_name_test").val(value.name);
			$("#patient_year_test").val(value.year);
			$("#patient_sex_test").val(value.sex);
		}
	});
	$.ajax({
		url:"../../controller/doctor/gettesttype.php",
		method:"GET",
		success:function(data){
			$("#test_type").html(data);
		}
	});
});
$("#create_test").click(function(){
	let record_id = $("#record_id_test").val();
	let name = $("#patient_name_test").val();
	let year = $("#patient_year_test").val();
	let sex = $("#patient_sex_test").val();
	let type = $("#test_type").val();
	if(name != ''){
		$("#error12").html("");
		if(year != ''){
			$("#error13").html("");
			if(sex != null){
				$("#error14").html("");
				if(type != ''){
					$("#error15").html("");
					$.ajax({
						url:"../../controller/doctor/createtest.php",
						method:"POST",
						data:{record_id,name,year,sex,type},
						success:function(data){
							if(data=='success'){								
								alert("Tạo yêu cầu xét nghiệm thành công");
								$("#test_type").val("");
								$(".close").click();
								location.reload();
							}
							else{
								alert("Tạo yêu cầu xét nghiệm thất bại");
								$("#test_type").val("");
								$(".close").click();
							}
						}
					});
				}else{$("#error15").html("*Chưa nhập loại xét nghiệm");}
			}else{$("#error14").html("*Chưa chọn giới tính");}
		}else{$("#error13").html("*Chưa nhập năm sinh");}
	}else{$("#error12").html("*Chưa nhập họ tên");}
});
//End

$("#search_id").keyup(function(){
	let id = $(this).val();
	if(id != ''){
		$.ajax({
			url:"../../controller/doctor/getrecord.php",
			method:"GET",
			data:{id},
			success:function(data){
				$("#tblrecord").html("");
				$("#tblrecord").html(data);
			}
		});
	}
	else if(id=='' || id==null){
		$.ajax({
			url:"../../controller/doctor/getrecord.php",			
			success:function(data){
				$("#tblrecord").html("");
				$("#tblrecord").html(data);
			}
		});
	}
	
});
$("body").on("click",".re_exam",function(){
	let phone = $(this).attr("phone");	
	$.ajax({
		url:"../../controller/doctor/changestatus.php",
		method:"GET",
		data:{phone}
	});
});
$(".view_result").click(function(){
	let id = $(this).val();
	if(id != ''){
		$.ajax({
			url:"../../controller/test/getresult.php",
			method:"GET",
			data:{id},
			success:function(data){
				if(data!=''){
					let image = JSON.parse(data);
					for(let i=0;i<image.length;i++){
						let url='http://localhost:88/phongkham/image/test/'+image[i];
						let link = document.createElement("a");
						link.setAttribute("href", url);
						link.setAttribute("download",image[i]);
						link.click();
					}
				}
			}
		});
	}
});
</script>