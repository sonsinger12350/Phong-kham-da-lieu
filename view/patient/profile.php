<form method="post">
	<center><h2>Hồ sơ bệnh án</h2></center>
	<br>
	<table class="table table-hover">
		<tr align="center" style="font-weight:bold;">
			<td>Ngày tạo</td>
			<td>Họ tên</td>
			<td>Năm sinh</td>
			<td>Giới tính</td>
			<td>Chẩn đoán bệnh</td>
			<td>Mô tả chi tiết</td>
			<td>Bác sĩ khám</td>
			<td>Trạng thái</td>	
			<td>Chức năng</td>					
		</tr>
		<?php 
			require_once "controller/patient/getrecord.php";
		?>
	</table>
</form>