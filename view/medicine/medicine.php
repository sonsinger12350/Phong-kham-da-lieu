<center><h2>Quản lí thuốc</h2></center>
<br>
<form method="post" class="form-inline">
<input class="form-control" id="search_name" type="text" placeholder="Nhập tên thuốc" onkeyup="searchmed(this.value)">
<div data-toggle="dropdown" id="dropdown">
	<ul class="dropdown-menu" role="menu" id="result">
	</ul>
</div>
<table class="table table-hover" width="100%" id="tblMedicine">	
	<?php require_once "../../controller/medicine/getmedicine.php";	?>		
</table>
</form>
<center>
	<span id="pagination">
		<?php
			if ($current_page > 1 && $total_page > 1){
		    	echo '<a href="index.php?action=medicine&page='.($current_page-1).'">Prev</a> | ';
			}
			for ($i = 1; $i <= $total_page; $i++){
			    if ($i == $current_page){
			        echo '<span>'.$i.'</span> | ';
			    }
			    else{
			        echo '<a href="index.php?action=medicine&page='.$i.'">'.$i.'</a> | ';
			    }
			}
			if ($current_page < $total_page && $total_page > 1){
			    echo '<a id="next" href="index.php?action=medicine&page='.($current_page+1).'" >Next</a>';
			}		
		?>
	</span>
</center>