<?php
require_once"../../model/connect.php";
require_once "../../library/PHPExcel/Classes/PHPExcel.php";
$db= new db();
$connect = $db->connect();
if(isset($_SESSION['permission']))
{
	if($_SESSION['permission']!=3)
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
				<a class="nav-item nav-link" href="index.php">TRANG CHỦ</a>
				<a class="nav-item nav-link " href="" data-toggle="modal" data-target="#modalAddMedicine">THÊM THUỐC</a>
				<a class="nav-item nav-link " href="" data-toggle="modal" data-target="#modalAddMoreMedicine">THÊM THUỐC BẰNG EXCEL</a>
				<a class="nav-item nav-link " href="?action=medicine">QUẢN LÍ THUỐC</a>						
			</div>			
			<div>					
				<div class="dropdown dropleft float-right" id="account">					
					<a class="dropdown-toggle" data-toggle="dropdown">
						<span id="session"><?php if(isset($_SESSION['name']))echo $_SESSION['name'];?></span> <img src="../../image/account.png" width="30px" height="30px">
					</a>
						<div class="dropdown-menu">							
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

	<!--Modal add medicine-->
	<div id="modalAddMedicine" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title col-12 text-center">Thêm thuốc mới</h4>
					<button type="button" class="close" data-dismiss="modal" hidden>&times;</button>
				</div>
				<div class="modal-body">
					<form method="post">
						<table width="100%" height="auto" id="tblM">
							<tr>
								<td height="50">
									<label>Tên thuốc: </label>
									<input type="text" id="medicine_name" class="form-control" placeholder="Tên thuốc">
									<span id="error4" style="color: red;"></span>
								</td>
							</tr>
							<tr>
								<td>
									<label>Đơn vị tính: </label>
									<input type="text" id="medicine_unit" class="form-control" placeholder="Đơn vị tính">
									<span id="error5" style="color: red;"></span>
								</td>
							</tr>
							<tr>
								<td height="50">
									<label>Liều lượng: </label>
									<input type="text" id="medicine_use" class="form-control" placeholder="Liều lượng">
									<span id="error6" style="color: red;"></span>
								</td>
							</tr>							
							<tr>
								<td>
									<label>Số lượng: </label>
									<input type="text" id="medicine_quantity" class="form-control" placeholder="Số lượng">
									<span id="error7" style="color: red;"></span>
								</td>
							</tr>
							<tr>
								<td>
									<center><button type="button" id="addMedicine" class="btn btn-primary">Thêm</button></center>
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!--End-->

	<!--Modal delete medicine-->	
	<div class="modal fade" id="modalDeleteMedicine">
		<div class="modal-dialog">
			<div class="modal-content" >	
				<div class="modal-header">
					<h4 class="modal-title col-12 text-center" align="center">
						Bạn muốn xóa thuốc <span id="medi_name"></span> ?
					</h4>
					<button type="button" class="close" data-dismiss="modal" hidden>&times;</button>
				</div>	
				<div class="modal-body" align="center">
					<div class="row">
					<form method="post">
						<input type="text" id="medicine_id" hidden>
					</form>	
						<div class="col-6">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Không</button>
						</div>
						<div class="col-6">
							<button type="button" class="btn btn-success" id="deleteMedicine">Có</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>  
	<!--End-->	

	<!--Modal update medicine-->	
	<div class="modal fade" id="modalUpdateMedicine">
		<div class="modal-dialog">
			<div class="modal-content" >	
				<div class="modal-header">
					<h4 class="modal-title col-12 text-center">Cập nhật thuốc</h4>
					<button type="button" class="close" data-dismiss="modal" hidden>&times;</button>
				</div>	
				<div class="modal-body" align="center">					
					<form method="post">
						<table width="100%" height="auto">
							<tr><td><input type="text" id="med_id" hidden></td></tr>
							<tr>
								<td height="50">
									<label>Tên thuốc: </label>
									<input type="text" id="med_name" class="form-control" placeholder="Tên thuốc">
									<span id="error9" style="color: red;"></span>
								</td>
							</tr>
							<tr>
								<td>
									<label>Đơn vị tính: </label>
									<input type="text" id="med_unit" class="form-control" placeholder="Đơn vị tính">
									<span id="error10" style="color: red;"></span>
								</td>
							</tr>
							<tr>
								<td height="50">
									<label>Cách dùng: </label>
									<input type="text" id="med_use" class="form-control" placeholder="Cách dùng">
									<span id="error11" style="color: red;"></span>
								</td>
							</tr>							
							<tr>
								<td>
									<label>Số lượng: </label>
									<input type="text" id="med_quantity" class="form-control" placeholder="Số lượng">
									<span id="error12" style="color: red;"></span>
								</td>
							</tr>
							<tr>
								<td>
									<center><button type="button" id="updateMedicine" class="btn btn-primary">Cập nhật</button></center>
								</td>
							</tr>
						</table>
					</form>	
				</div>
			</div>
		</div>
	</div>  
	<!--End-->	

	<!--Modal delete medicine-->	
	<div class="modal fade" id="modalAddMoreMedicine">
		<div class="modal-dialog">
			<div class="modal-content" >	
				<div class="modal-header">
					<h4 class="modal-title col-12 text-center" align="center">
						Thêm thuốc <span id="medi_name"></span> ?
					</h4>
					<button type="button" class="close" data-dismiss="modal" hidden>&times;</button>
				</div>	
				<div class="modal-body">					
					<form method="post" enctype="multipart/form-data">
						<table width="100%" height="auto" align="center">
							<tr height="50px">
								<td><label for="file">Chọn file: </label></td>
								<td>
									<input type="file" name="file" id="file" required oninvalid="this.setCustomValidity('Chưa chọn file')" oninput="this.setCustomValidity('')">
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<center>
										<input type="submit" name="addMoreMed" value="Thêm" class="btn btn-primary">										
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
	
	<!--Enter medicine into the database-->
	<?php
	if(isset($_POST['addMoreMed'])){		
		if(isset($_FILES['file'])){
			$type = ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-excel'];
			if(!in_array($_FILES['file']['type'],$type))
			{
				echo '<script>alert("Chỉ được chọn file excel");</script>';
			}	
			else{
				$file = $_FILES['file']['tmp_name'];
				$objFile = PHPExcel_IOFactory::identify($file);
				$objData = PHPExcel_IOFactory::createReader($objFile);
				$objData->setReadDataOnly(true);
				$objPHPExcel = $objData->load($file);
				$sheet = $objPHPExcel->setActiveSheetIndex(0);
				$Totalrow = $sheet->getHighestRow();
				$LastColumn = $sheet->getHighestColumn();
				$TotalCol = PHPExcel_Cell::columnIndexFromString($LastColumn);
				$data = [];
				for($i = 2; $i <= $Totalrow; $i++){
				    for ($j = 0; $j < $TotalCol; $j++){
				        $data[$i - 2][$j] = $sheet->getCellByColumnAndRow($j, $i)->getValue();
				    }
				}
				for($i=0;$i<count($data);$i++){
					$name = $data[$i][0];
					$unit = $data[$i][1];
					$use = $data[$i][2];
					$quantity = $data[$i][3];					
					$query = mysqli_query($connect,"insert into medicines(name,unit,howtouse,quantity) 
						values('$name','$unit','$use','$quantity')");					
				}
				echo '<script>alert("Thêm thuốc thành công");</script>';
			}
		}		
	}
	?>
	<!--End-->

	<!--Action-->
	<div class="row" style="margin-bottom:20%;margin-top:5%;">
		<div class="col-12">
			<?php
			if(isset($_GET['action']))
			{
				$ac=$_GET['action'];
				if($ac==''){require_once"index.php";}		
				elseif($ac=='medicine'){require_once "medicine.php";}								
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
//Add Medicine
$("#addMedicine").click(function(){
	let medicine_name = $("#medicine_name").val();
	let medicine_unit= $("#medicine_unit").val();
	let medicine_use= $("#medicine_use").val();	
	let medicine_quantity= $("#medicine_quantity").val();	
	if(medicine_name != ''){
		$("#error4").html("");
		if(medicine_unit != ''){
			$("#error5").html("");
			if(medicine_use != ''){
				$("#error6").html("");				
				if(medicine_quantity != ''){
					$("#error7").html("");						
					$.ajax({
						url:"../../controller/medicine/addmedicine.php",
						method:"GET",
						data:{name:medicine_name,unit:medicine_unit,use:medicine_use,quantity:medicine_quantity},
						success:function(data){
							if(data=='success'){
								alert("Thêm thành công");
								$("#tblM tr td input").val("");
								$(".close").click();
								location.reload("#tblMedicine");
							}
							else{
								alert("Thêm thất bại");
								$("#tblM tr td input").val("");
								$(".close").click();
							}
						}
					});
				}else{$("#error7").html("*Chưa nhập số lượng");}							
			}else{$("#error6").html("*Chưa nhập cách dùng");}
		}else{$("#error5").html("*Chưa nhập đơn vị tính");}
	}else{$("#error4").html("*Chưa nhập tên thuốc");}
	if(medicine_name == '' && medicine_unit == '' && medicine_use == '' && medicine_quantity == ''){
		$("#error4").html("*Chưa nhập tên thuốc");
		$("#error5").html("*Chưa nhập đơn vị tính");
		$("#error6").html("*Chưa nhập cách dùng");
		$("#error7").html("*Chưa nhập số lượng");
	}
});
//End
//Delete medicine 
$("body").on("click",".deleteM", function(){
	let id = $(this).val();
	let name = $(this).attr("name");
	$("#medicine_id").val(id);	
	$("#medi_name").html(name);
});
$("#deleteMedicine").click(function(){
	let id = $("#medicine_id").val();
	$.ajax({
		url:"../../controller/medicine/deletemedicine.php",
		method:"POST",
		data:{id:id},
		success:function(data){
			if(data=='success'){
				alert("Xóa thành công");
				location.reload("#tblMedicine");
			}
			else{
				alert("Xóa thất bại");
			}
		}
	});
});
//End

//Update medicine
$("body").on("click",".updateM", function(){
	let id = $(this).val();
	$("#med_id").val(id);
	$.ajax({
		url:"../../controller/medicine/getdatamedicine.php",
		method:"GET",
		data:{id:id},
		success:function(data){
			const value = JSON.parse(data);
			$("#med_name").val(value.name);
			$("#med_unit").val(value.unit);
			$("#med_use").val(value.use);
			$("#med_type").val(value.type);
			$("#med_quantity").val(value.quantity);
		}
	});
});
$("#updateMedicine").click(function(){
	let id = $("#med_id").val();
	let name = $("#med_name").val();
	let unit = $("#med_unit").val();
	let use = $("#med_use").val();
	let quantity = $("#med_quantity").val();
	$.ajax({
		url:"../../controller/medicine/updatemedicine.php",
		method:"POST",
		data:{id,name,unit,use,quantity},
		success:function(data){
			if(data=='success'){
				alert("Cập nhật thành công");				
				$(".close").click();
				location.reload("#tblMedicine");
			}
			else{
				alert("Cập nhật thất bại");				
				$(".close").click();
			}	
		}
	});
});
//End
//Search medicine
function searchmed(str){
	let name = str.trim();
	if(name != ''){
		$("#pagination").hide();
		$.ajax({
			url:"../../controller/medicine/getmedicine.php",
			method:"GET",
			data:{search_name:name},
			success:function(data){			
				$("#tblMedicine tr").html("");
				$("#tblMedicine").html(data);			
			}
		});	
	}
	else{
		$("#pagination").show();
		$.ajax({
			url:"../../controller/medicine/getmedicine.php",
			method:"GET",
			success:function(data){
				$("#tblMedicine tr").html("");
				$("#tblMedicine").html(data);
			}
		});
	}	
}
//End
</script>