<form method="post">
	<center><h2>Lịch khám bệnh</h2></center>
	<br>
	<table class="table table-hover" id="tableschedule">		
		<?php 
			require_once "controller/patient/getschedule.php";
		?>
	</table>
</form>