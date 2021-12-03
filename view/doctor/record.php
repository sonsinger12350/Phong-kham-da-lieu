<center><h2>Hồ sơ bệnh án</h2></center>
<form method="post" class="form-inline">
<span>Tìm bệnh nhân: </span>
<input type="text" id="search_id" class="form-control" placeholder="Nhập mã bệnh nhân">

<table class="table table-hover" width="100%" id="tblrecord">			
	<?php 
		require_once "../../controller/doctor/getrecord.php";		
	?>	
</table>
</form>
<center>
	<span id="pagination">
		<?php		
		if($total_page <=1){
			echo '<script>$("#pagination").hide();</script>';
		}
		if ($current_page > 1 && $total_page > 1){
	    	echo '<a href="index.php?action=record&page='.($current_page-1).'">Prev</a> | ';
		}
		for ($i = 1; $i <= $total_page; $i++){
		    if ($i == $current_page){
		        echo '<span>'.$i.'</span> | ';
		    }
		    else{
		        echo '<a href="index.php?action=record&page='.$i.'">'.$i.'</a> | ';
		    }
		}
		if ($current_page < $total_page && $total_page > 1){
		    echo '<a id="next" href="index.php?action=record&page='.($current_page+1).'" >Next</a>';
		}		
		?>
	</span>
</center>