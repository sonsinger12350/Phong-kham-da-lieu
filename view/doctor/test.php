<h2 align="center">Xét nghiệm</h2>
<form method="post" class="form-inline">	
<button type="button" class="btn btn-link" id="cre_test" value = "<?php if(isset($_GET['id'])){echo $_GET['id'];}?>" data-toggle="modal" data-target="#modalCreateTest">Tạo yêu cầu xét nghiệm</button>
<table class="table table-hover" width="100%">			
	<?php 
		require_once "../../controller/doctor/gettest.php";
	?>	
</table>
</form>