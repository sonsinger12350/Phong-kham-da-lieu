//Check SESSION user
function checkSession(){
	var session = $("#session").html();	
	if(session ==''){
		$("#account").hide();
		$("#login").show();
		$(".card").click(function(){
			alert("Đăng nhập để sử dụng chức năng này");
			$("#modalSetCalendar").remove();
			$(".checkss").attr("href","#");	
		});
	}
	else if(session !=''){
		$("#account").show();
		$("#login").hide();
	}
};
//End

//Logout
$("#logout").click(function(){
	alert("Đăng xuất thành công");
	window.location.href="view/patient/logout.php";
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
			text += '<li class="list-group-item list-group-item-action w-auto p-3" id="day">'+date+'</li>';
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
			text += '<li class="list-group-item list-group-item-action w-auto p-3" id="day">'+date+'</li>';
			day= day +1;
		}			
		$("#days").html(text);				
	}										
});

$("body").on("click","#day",function(){
	let doctor = $('#doctor').val();
	let d = $(this).html();	
	let year = new Date().getFullYear();
	let date = year+'/'+d;
	$("#d").html(date);	
	$.ajax({
		url:"controller/patient/gettime.php",
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
	$("#closeS").click();		
});
//End

//Set calendar
$("#schedule").click(function(){	
	let name = $("#name").val();
	let sex = $("#sex").val();
	let year = $("#year").val();
	let phone = $("#phone").val();
	let doctor = $("#doctor").val();
	let date = $("#date").val();
	let time = $("#time").val();	
	let today=new Date();	
	today.setDate(today.getDate()-1);
	let nextday = new Date();
	nextday.setDate(nextday.getDate()+30);
	let  d = new Date(date);
	let checkphone= /^[0\+]{1}[0-9\-]{9}$/;	
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
						if(doctor != null){
							$("#error5").html("");
							if(date != ''){
								$("#error6").html("");
								$("#error7").html("");
								if(d > today && d < nextday){
									$.ajax({
									url:"controller/patient/bookschedule.php",
									method:"GET",
									data:{name:name,sex:sex,year:year,phone:phone,doctor:doctor,date:date,time:time},
									success:function(data){
										if(data=='success'){											
											alert("Đặt lịch thành công.Vui lòng thanh toán để xác nhận lịch đặt");											
											location.reload("#tableschedule");										
											$(".close").click();
											window.location.href="index.php?action=viewcalendar";										
										}
										else if(data=='wrong'){
											alert("Đặt lịch thất bại");
											location.reload("#tableschedule");										
											$(".close").click();
										}
										else{
											alert(data);
										}											
									}
								});	
								}else{$("#error6").html("*Chọn ngày mới và không quá ngày hiện tại 30 ngày");}							
							}else{$("#error6").html("*Chưa chọn ngày");$("#error7").html("*Chưa chọn giờ");}	
						}else{$("#error5").html("*Chưa chọn bác sĩ");}				
					}else{$("#error4").html("*Nhập số điện thoại hợp lệ");}
				}else{$("#error4").html("*Chưa nhập số điện thoại");}
			}else{$("#error3").html("*Chưa nhập năm sinh");}
		}else{$("#error2").html("*Chưa chọn giới tính");}
	}else{$("#error1").html("*Chưa nhập họ tên");}
	if(name=='' && sex==null && year=='' && phone=='' && doctor==null && date=='' && time==''){
		$("#error1").html("*Chưa nhập họ tên");
		$("#error2").html("*Chưa chọn giới tính");
		$("#error3").html("*Chưa nhập năm sinh");
		$("#error4").html("*Chưa nhập số điện thoại");
		$("#error5").html("*Chưa chọn bác sĩ");
		$("#error6").html("*Chưa chọn ngày");
		$("#error7").html("*Chưa chọn giờ");
	}
});
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
		url:"controller/patient/gettime.php",
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
	$("#closeC").click();		
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

//Change Schedule
$("body").on("click",".changeC",function(){
	let id = $(this).val();
	$("#schedule_id").val(id);
	$.ajax({
		url:"controller/patient/getdata.php",
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
										url:"controller/patient/changeschedule.php",
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

//Change Password
$("#changePass").click(function(){
let pass = $("#pass").val();
let newpass = $("#newpass").val();
let cfpass = $("#cfpass").val();
if(pass != ''){
	$("#error15").html("");
	if(newpass !=''){
		$("#error16").html("");
		if(cfpass !=''){
			$("#error17").html("");
			if(cfpass == newpass){
				$("#error17").html("");
				$.ajax({
					url:"controller/patient/changepass.php",
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
			}else{$("#error17").html("*Mật khẩu mới không trùng khớp");}
		}else{$("#error17").html("*Xác nhận mật khẩu mới");}
	}else{$("#error16").html("*Chưa nhập mật khẩu mới");}
}else{$("#error15").html("*Chưa nhập mật khẩu hiện tại");}
if(pass =='' && newpass == '' && cfpass==''){
	$("#error6").html("*Chưa nhập mật khẩu hiện tại");
	$("#error7").html("*Chưa nhập mật khẩu mới");
	$("#error8").html("*Xác nhận mật khẩu mới");
}
});
//End

$("body").on("click",".qr_code",function(){
	let id = $(this).val();	
	let image = "<img src='image/qrcode/"+id+".png'>";	
	$(".qr_image").html(image);	
});
$("body").on("click",".view_pre",function(){
	let id = $(this).val();
	let text ="";
	$.ajax({
		url:"controller/doctor/getdataprescription.php",
		method:"GET",
		data:{id:id},
		success:function(data){
			let value = JSON.parse(data);
			$("#pa_name").html(value.name);
			$("#pa_sex").html(value.sex);
			$("#pa_year").html(value.year);
			$("#pa_diagnose").html(value.diagnose);
			$("#pa_doctor").html(value.doctor);
			$("#pa_code").html(value.id);
			text = '<tr class="bold"><td>Tên thuốc: </td><td>Số lượng: </td><td>Lời dặn: </td></tr>'
			for(i=0;i<value.medicine.length;i++)
			{
				text += '<tr><td>'+value.medicine[i].name+'<br>Cách dùng: '+value.medicine[i].use+'</td><td width="30%">'+value.medicine[i].quantity+'</td><td width="35%">'+value.medicine[i].note+'</td></tr>';			
			}
			if(value.date !=''){				
				$("#d_reexam").html('<hr>'+'Tái khám sau: '+value.date+' ngày');
			}
			else{
				$("#d_reexam").html("");
			}
			$("#table_prescription > tbody").html(text);
		}
	});
});
$(".view_result").click(function(){
	let id = $(this).val();
	if(id != ''){		
		$.ajax({
			url:"controller/patient/gettestresult.php",
			method:"GET",
			data:{id},
			success:function(data){
				if(data!=''){
					if(data=="null"){
						alert("Không có kết quả");
					}
					else{
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
			}
		});
	}
});