<!doctype html>
<html>
<head>	
	<link rel="stylesheet" href="../../library/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../library/fontawesome/css/fontawesome.min.css">  	
	<style>
		body{
			background-image: url("../../image/backgroundLogin.jpg");
		}
	</style>
</head>
<script src="../../library/js/jquery-3.6.0.min.js"></script>
<script src="../../library/js/bootstrap.min.js"></script>
<body>
<div>
	<!--Form login-->
	<form method="post" style="margin-top: 13%">	
			<h2 align="center">Đăng nhập</h2>
			<table width = "30%" height="auto" align="center" id="tbllogin">
				<div id="lg">
				<tr> 				
					<td width="232"  height="50"><input name="emaillg" id="emaillg" type="text" class="form-control" placeholder="Email" ><span style="color: red;" id="error1"></span></td>
				</tr>
				<tr>				
					<td><input type="password" name="passlg" id="passlg" class="form-control" placeholder="Mật khẩu"><span style="color: red;" id="error2"></span></td>			
				</tr>
				</div>

				<tr>
					<td height="58" align="center">
						<button type="button" id="login" name="login" class="btn btn-primary">Đăng nhập</button>
						hoặc
						<button type="button" class="btn btn-primary" data-toggle='modal' data-target='#registerModal'>Tạo tài khoản</button>				
					</td>
				</tr>
				<tr>
					<td align="center" height="50" style="font-size: 18px;">
						<a href="#" data-toggle="modal" data-target="#forgetPassword">Quên mật khẩu ?</a>
					</td>
				</tr>
			</table>

	</form>
	<!--End-->

	<!--Modal register-->
	<div id="registerModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" hidden>&times;</button>
				<h4 class="modal-title col-12 text-center" align="center">Đăng ký tài khoản</h4>
			</div>
			<div class="modal-body">
				<form method="post">
					<table width = "100%" height="auto">
					<tr>
						<td width="232"  height="50">
							<input id="name" type="text" class="form-control" placeholder="Họ tên">
							<span style="color: red;" id="error3"></span>
						</td>					
					</tr>
					<tr>
						<td width="232"  height="50">
							<input id="emailrg" type="text" class="form-control" placeholder="Email">
							<span style="color: red;" id="error4"></span>
						</td>					
					</tr>
					<tr>
						<td width="232"  height="50">
							<input id="passrg" type="password" class="form-control" placeholder="Mật khẩu">
							<span style="color: red;" id="error5"></span>
						</td>					
					</tr>
					<tr>
						<td width="232"  height="50">
							<input id="cfpass" type="password" class="form-control" placeholder="Xác nhận mật khẩu">
							<span style="color: red;" id="error6"></span>
						</td>					
					</tr>
					<tr>
						<td>
							<button type="button" id="register" class="btn btn-primary">Đăng ký</button>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#verifyModal" data-dismiss="modal">Bạn chưa nhận được email xác thực</button>	
						</td>					
					</tr>
				</table>
				</form>
			</div>
			</div>
		</div>
	</div>
	<!--End-->
	
	<!--Modal Verify Email-->
	<div id="verifyModal" class="modal fade" role="dialog">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" hidden>&times;</button>
				<h4 class="modal-title col-12 text-center" align="center">Xác thực email</h4>
			</div>
			<div class="modal-body">
				<form method="post">					
					<input id="emailv" type="text" class="form-control" placeholder="Email">
					<span style="color: red;" id="error7"></span>
					<br>
					<center><button type="button" id="verify" name="verify" class="btn btn-primary">Gửi</button></center>
				</form>
			</div>
			</div>
		</div>
	</div>
	<!--End-->

	<!-- Modal Forget Password -->
	<div id="forgetPassword" class="modal fade">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" hidden>&times;</button>
				<h4 class="modal-title col-12 text-center" align="center">Quên mật khẩu</h4>
			</div>
			<div class="modal-body">
				<form method="post">					
					<input id="emailforget" type="text" class="form-control" placeholder="Email">
					<span style="color: red;" id="error8"></span>
					<br>
					<center><button type="button" id="forgetpass" class="btn btn-primary">Gửi</button></center>
				</form>
			</div>
			</div>
		</div>
	</div>
	<!-- End -->
</div>
</body>
</html>
<!--Processing-->
<script type="text/javascript">
$("#tbllogin").keyup(function(event){
	if(event.keyCode == '13'){
		$("#login").click();
	}
});
$("#login").click(function(){
	var emaillg = $("#emaillg").val();
	var passlg = $("#passlg").val();
	if(emaillg =='' && passlg ==''){
			$("#error1").html("*Chưa nhập email");
			$("#error2").html("*Chưa nhập pass");
	}		
	if(emaillg !=''){
		$("#error1").html("");
		if(passlg !=''){
			$("#error2").html("");
			$.ajax({
				url:"../../controller/patient/clogin.php",
				method:"POST",
				data:{email:emaillg,pass:passlg},
				success:function(data){
					if(data=='patient'){
						alert("Đăng nhập thành công");
						$("#emaillg").val("");
						$("#passlg").val("");
						window.location.href="../../index.php";
					}
					else if(data =='receptionist'){
						alert("Đăng nhập thành công");
						$("#emaillg").val("");
						$("#passlg").val("");
						window.location.href="../receptionist/index.php";
					}
					else if(data =='doctor'){
						alert("Đăng nhập thành công");
						$("#emaillg").val("");
						$("#passlg").val("");
						window.location.href="../doctor/index.php";
					}
					else if(data=='medicine'){
						alert("Đăng nhập thành công");
						$("#emaillg").val("");
						$("#passlg").val("");
						window.location.href="../medicine/index.php";	
					}
					else if(data=='test'){
						alert("Đăng nhập thành công");
						$("#emaillg").val("");
						$("#passlg").val("");
						window.location.href="../test/index.php";	
					}
					else if(data=='admin'){
						alert("Đăng nhập thành công");
						$("#emaillg").val("");
						$("#passlg").val("");
						window.location.href="../admin/index.php";	
					}
					else if(data=='notVerified'){
						alert("Tài khoản này chưa được xác thực. Vui lòng xác thực để tiếp tục");
						$("#emaillg").val("");
						$("#passlg").val("");
					}
					else{
						alert("Đăng nhập thất bại");
						$("#emaillg").val("");
						$("#passlg").val("");
					}
				}
			});
		}
		else{
			$("#error2").html("*Chưa nhập pass");
		}
	}
	else{
		$("#error1").html("*Chưa nhập email");
	}
});
$("#register").click(function(){
	var name = $("#name").val();
	var emailrg = $("#emailrg").val();
	var passrg = $("#passrg").val();
	var cfpass = $("#cfpass").val();
	var checkemail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	if(name == ""){
			$("#error3").html("*Chưa nhập họ tên");
	}
	else{
			$("#error3").html("");
	}
	if(emailrg == ""){
		$("#error4").html("*Chưa nhập email");	
	}
	else{
		$("#error4").html("");	
		if(emailrg.match(checkemail)){
			$("#error4").html("");
		}
		else{
			$("#error4").html("*Email không hợp lệ");
		}
	}
	if(passrg == ""){
		$("#error5").html("*Chưa nhập mật khẩu");
	}
	else{
		$("#error5").html("");
	}
	if(cfpass == ""){
		$("#error6").html("*Chưa xác nhận mật khẩu");
	}
	else{				
		$("#error6").html("");
		if(passrg!=cfpass){
			$("#error6").html("*Mật khẩu không trùng khớp");
		}
		else{
			$("#error6").html("");
		}
	}
	if(name!="" && emailrg!="" && passrg!="" && cfpass!="")	{
		if(emailrg.match(checkemail)){
			if(passrg==cfpass){							
				$.ajax({
					url:"../../controller/patient/verifyemail.php",
					method:"POST",
					data:{name:name,email:emailrg,pass:passrg},	
					beforeSend:function(){						
						$("#register").html("Loading...");
						$("#register").attr("disabled",true);
					},
					success:function(data){
						$("#register").html("Đăng ký");
						$("#register").attr("disabled",false);
						if(data=='success'){
							alert("Đăng kí thành công. Vui lòng truy cập vào mail để xác thực tài khoản");
							window.location.href="login.php"
						}
						else if(data=='exist'){
							alert("Email này đã được đăng ký. Vui lòng dùng email khác");
						}
						else{
							alert(data);
						}
					}
				});
			}
		}
	}
});
	

$("#verify").click(function(){
	var emailv = $("#emailv").val();
	if(emailv != ''){
		$("#error7").html("");
		$.ajax({
			url:"../../controller/patient/verifyagain.php",
			method:"POST",
			data:{email:emailv},
			beforeSend:function(){
				$("#verify").attr("disabled",true);
				$("#verify").html("Loading...");
			},
			success:function(data){
				$("#verify").attr("disabled",false);
				$("#verify").html("Gửi");
				if(data=='success'){
					alert("Vui lòng truy cập vào mail để xác thực tài khoản");
					window.location.href="login.php";
				}
				else if(data=='notexist'){
					alert("Email không trùng khớp với tài khoản hiện có");
				}
				else{
					alert(data);
				}
			}
		});
	}
	else{
		$("#error7").html("*Chưa nhập email");
	}
});
$("#forgetpass").click(function(){
	let email = $("#emailforget").val();
	if(email != ''){
		$("#error8").html("");
		$.ajax({
			url:"../../controller/patient/forgetpass.php",
			method:"GET",
			data:{email:email},
			beforeSend:function(){
				$("#forgetpass").attr("disabled",true);
				$("#forgetpass").html("Loading...");
			},
			success:function(data){
				$("#forgetpass").attr("disabled",false);
				$("#forgetpass").html("Gửi");
				if(data=='success'){
					alert("Vui lòng truy cập vào mail để nhận mật khẩu");
					window.location.href="login.php";
				}
				else if(data=='notexist'){
					alert("Email không trùng khớp với tài khoản hiện có");
				}
				else{
					alert(data);
				}
			}
		});
	}
	else{
		$("#error8").html("*Chưa nhập email");
	}
});
</script>
<!--End-->
	