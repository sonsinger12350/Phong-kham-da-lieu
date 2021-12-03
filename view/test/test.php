<h2 align="center">Yêu cầu xét nghiệm</h2>
<form method="post" class="form-inline">
<table class="table table-hover" width="100%" id="tbl_test">			
	<?php 
		require_once "../../controller/test/gettest.php";
	?>	
</table>
</form>
<center>
<span id="pagination">
	<?php	
		if($total_page >= 2){
			if ($current_page > 1 && $total_page > 1){
		    	echo '<a href="index.php?action=test&page='.($current_page-1).'">Prev</a> | ';
			}
			for ($i = 1; $i <= $total_page; $i++){
			    if ($i == $current_page){
			        echo '<span>'.$i.'</span> | ';
			    }
			    else{
			        echo '<a href="index.php?action=test&page='.$i.'">'.$i.'</a> | ';
			    }
			}
			if ($current_page < $total_page && $total_page > 1){
			    echo '<a id="next" href="index.php?action=test&page='.($current_page+1).'" >Next</a>';
			}
		}	
	?>	
</span>	
</center>