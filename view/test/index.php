<?php
require_once"../../model/connect.php";
$db= new db();
$connect = $db->connect();
if(isset($_SESSION['permission']))
{
	if($_SESSION['permission']!=4)
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
				<a class="nav-item nav-link" href="index.php">TRANG CHỦ</a>				
				<a class="nav-item nav-link " href="?action=test">YÊU CẦU XÉT NGHIỆM</a>
				<a class="nav-item nav-link " href="?action=type">LOẠI XÉT NGHIỆM</a>					
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

	<!--Modal update test-->
	<div id="modalUpdateTest" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div>
					<div class="modal-header">
						<h3 class="modal-title col-12 text-center">Nhập kết quả</h3>
					</div>
				</div>
				<div class="modal-body">				
				<button type="button" class="close" data-dismiss="modal" hidden>&times;</button>
					<form method="post" enctype="multipart/form-data">
						<table width="100%" height="auto">							
							<tr><td><input type="text" id="test_id" name="test_id" hidden></td></tr>
							<tr>
								<td height="50">
									<label for="file">Chọn kết quả:</label>
									<span style="color:red;">*Chỉ upload file hình</span>
									<input type="file" name="upload[]" id="file" multiple="multiple" class="form-control"  required oninvalid="this.setCustomValidity('Chưa chọn file')" oninput="this.setCustomValidity('')">		
									<div id="file_selected"></div>
								</td>
							</tr>
							<tr>
								<td>
									<center>
										<input type="submit" name="updateTest" class="btn btn-primary" value="Nhập">
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

	<!--Modal add type-->
	<div id="modalAddType" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div>
					<div class="modal-header">
						<h3 class="modal-title col-12 text-center">Thêm mới loại xét nghiệm</h3>
					</div>
				</div>
				<div class="modal-body">				
				<button type="button" class="close" data-dismiss="modal" hidden>&times;</button>
					<form method="post">
						<table width="100%" height="auto">
							<tr>
								<td>
									<label for="test_type">Loại xét nghiệm: </label>
									<input type="text" id="test_type" class="form-control" placeholder="Nhập loại xét nghiệm">
									<span id="error5" style="color: red;"></span>
								</td>
							</tr>
							<tr height="50">
								<td>
									<center><button type="button"  class="btn btn-primary" id="add_type">Thêm</button></center>
								</td>
							</tr>
						</table>
					</form>				
				</div>				
			</div>
		</div>
	</div>
	<!--End-->

	<!--Modal delete type-->	
	<div class="modal fade" id="modalDeleteType">
		<div class="modal-dialog">
			<div class="modal-content" >	
				<div class="modal-header">
					<h4 class="modal-title col-12 text-center" align="center">
						Bạn muốn xóa <span id="type_name"></span> ?
					</h4>
					<button type="button" class="close" data-dismiss="modal" hidden>&times;</button>
				</div>	
				<div class="modal-body" align="center">
					<div class="row">
					<form method="post">
						<input type="text" id="type_id" hidden>
					</form>	
						<div class="col-6">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Không</button>
						</div>
						<div class="col-6">
							<button type="button" class="btn btn-success" id="deletetype">Có</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>  
	<!--End-->	

	<!--Nhập kết quả-->
	<?php
	if(isset($_POST['updateTest'])){
		if(isset($_FILES['upload'])){			
			$test_id = $_POST['test_id'];			
			$type = ['image/jpeg','image/png'];	
			$data=array();
			$count_file = count($_FILES['upload']['name']);				
			for($i=0;$i<$count_file;$i++)
			{
				if(in_array($_FILES['upload']['type'][$i],$type))
				{
					$name = $_FILES['upload']['name'][$i];
					$tmp_name = $_FILES['upload']['tmp_name'][$i];
					array_push($data,$name);
					$folder = '../../image/test/'.$name;
					move_uploaded_file($tmp_name, $folder);						
				}														
			}				
			if($data != null){
				$result = json_encode($data);
				$query = mysqli_query($connect,"update test set result = '$result' where test_id='$test_id'");
				if($query)
				{
					echo '<script>alert("Nhập kết quả thành công");</script>';
				}
				else
				{					
					echo '<script>alert("Nhập kết quả thất bại");</script>';
				}
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
				elseif($ac=='test'){require_once "test.php";}	
				elseif($ac=='type'){require_once "type.php";}											
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
$(".update_test").click(function(){
	let id = $(this).val();
	$("#test_id").val(id);
});
$("#updateTest").click(function(){
	let id = $("#test_id").val();
	let result = $("#result").val();
	if(result != ''){
		$("#error4").html("");
		$.ajax({
			url:"../../controller/test/updatetest.php",
			method:"GET",
			data:{id,result},
			success:function(data){
				if(data=='success'){
					alert("Nhập kết quả thành công");
					$("#result").val("");
					$(".close").click();
					window.location.reload("#tbl_test");
				}
				else
				{
					alert("Nhập kết quả thất bại");
					$("#result").val("");
					$(".close").click();
				}
			}
		});
	}
	else{
		$("#error4").html("*Chưa nhập kết quả");
	}

});
$("#add_type").click(function(){
	let type = $("#test_type").val();
	if(type != ''){
		$("#error5").html("");
		$.ajax({
			url:"../../controller/test/addtype.php",
			method:"GET",
			data:{type},
			success:function(data){
				if(data=='success'){
					alert("Thêm loại xét nghiệm thành công");
					$("#test_type").val("");
					$(".close").click();
					location.reload();
				}
				else{
					alert("Thêm loại xét nghiệm thất bại");
					$("#test_type").val("");
					$(".close").click();
				}
			}
		});
	}
	else{
		$("#error5").html("*Nhập loại xét nghiệm");
	}
});
$("body").on("click",".delete_type",function(){
	let id = $(this).val();
	let name = $(this).attr("name");
	$("#type_id").val(id);
	$("#type_name").html(name);
});
$("#deletetype").click(function(){
	let id = $("#type_id").val();
	if(id != ''){
		$.ajax({
			url:"../../controller/test/deletetype.php",
			method:"GET",
			data:{id},
			success:function(data) {
				if(data=='success'){
					alert("Xóa thành công");	
					$(".close").click();	
					location.reload();			
				}
				else{
					alert("Xóa thất bại");
					$(".close").click();
				}
			}
		});	
	}
});

$("#file").change(function(){
	let file = $("#file").prop('files');
	let text ='';
	if(file != ''){
		for (let i = 0; i < file.length; i++) {
		    text += file[i].name+'<br>';
		  }
		 $("#file_selected").html(text);
	}	
	
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