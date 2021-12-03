<?php
date_default_timezone_set("Asia/Ho_Chi_Minh");
?>
<h2 align="center">Tạo đơn thuốc</h2>
<div class="col-5" style="float:right">
<span class="bold">Tìm thuốc: </span>
<input type="text" class="form-control" id="search_name" onkeyup="searchmed(this.value)" placeholder="Nhập tên thuốc">
<table width="100%" height="auto" class="table text-center" id="tbl_medicine">	
	<?php require_once "../../controller/doctor/getmedicine.php";?>
</table>
</div>
<div class="col-7">	
	<table width="100%" height="auto" border="0px">
		<tr>
			<td class="bold" width="22%">Tên bệnh nhân: </td>
			<td id="p_name" width="29%"></td>	
			<td class="bold" width="19%">Giới tính: </td>
			<td id="p_sex" width="30%"></td>		
		</tr>
		<tr height="50px">						
			<td class="bold" width="22%">Năm sinh: </td>
			<td id="p_year" width="29%"></td>	
			<td class="bold" width="19%">Mã bệnh nhân: </td>
			<td id="p_id" width="30%"></td>				
		</tr>
		<tr>
			<td class="bold" width="22%">Chẩn đoán: </td>
			<td id="p_diagnose" colspan="2"></td>
			<td id="re_id" hidden></td>				
		</tr>
		<tr height="50px">
			<td class="bold" colspan="4">Điều trị: </td>						
		</tr>
		<tr>
			<td colspan="4">
				<table class="table table-bordered table-striped" id="tbl_prescription">
					<tbody>
						<tr class="bold">
							<td>Tên thuốc: </td>
							<td>Số lượng: </td>
							<td>Lời dặn: </td>
						</tr>
					</tbody>					
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="3"></td>
			<td width="31%" align="center">
				Ngày <span id="day_cre"><?php echo date("d")?></span> 
				Tháng <span id="month_cre"><?php echo date("m")?></span>  
				Năm <span id="year_cre"><?php echo date("Y")?></span> 
			</td>
		</tr>
		<tr>
			<td colspan="3"></td>
			<td width="31%" align="center">Bác sĩ khám</td>
		</tr>
		<tr>
			<td colspan="3"></td>
			<td width="41%" align="center" height="80px"><?php echo $_SESSION['name']?></td>
		</tr>
		<tr><td colspan="4"><hr style="height: 20px;"></td></tr>
		<tr>			
			<td colspan="3">Tái khám sau:
				<select id="date_reexam">
					<option selected hidden disabled>Chọn ngày tái khám</option>
					<option value="5">5 ngày</option>
					<option value="7">7 ngày</option>
					<option value="14">14 ngày</option>
					<option value="30">30 ngày</option>
				</select>
				<span>Hoặc</span>
				<input type="number" placeholder="Nhập ngày tái khám" id="date_rexam">				
			</td>
			<td>
				<input type="checkbox" id="finish" value="Khỏi bệnh">				
			  	<label for="finish"> Khỏi bệnh</label>
			</td>
		</tr>		
	</table>
	<center>
		<button type="button" class="btn btn-primary" id="create_prescription">Tạo đơn thuốc</button>
	</center>	
</div>

<?php
if(isset($_GET['id']))
{
	$id = $_GET['id'];	
	$sql = "select * from patient_medical_record where record_id='$id'";
	$result = mysqli_query($connect,$sql);
	$i = mysqli_num_rows($result);
	if($i != 0)
	{		
		while($row = mysqli_fetch_array($result)){
			$patient_id = $row['patient_id'];			
			$name = $row['patient_name'];
			$sex = $row['patient_sex'];
			$year = $row['patient_year'];
			$diagnose = $row['diagnose'];
			echo '
			<script>			
				$("#re_id").html("'.$id.'");				
				$("#p_id").html("'.$patient_id.'");			
				$("#p_name").html("'.$name.'");
				$("#p_sex").html("'.$sex.'");
				$("#p_year").html("'.$year.'");
				$("#p_diagnose").html("'.$diagnose.'");
			</script>
			';
		}
	}
}
?>