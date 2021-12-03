<center><h2>Lịch khám</h2></center>
<br>
<form method="post" class="form-inline">
<div class="col-3" style="float:left">	

<span>Hiển thị: </span>
	<select id="display">
		<option disabled selected hidden>Tùy chọn hiển thị</option>
		<option value="Toàn bộ">Toàn bộ</option>
		<option value="Chưa khám">Chưa khám</option>
		<option value="Đã khám">Đã khám</option>
		<option value="Hôm nay">Hôm nay</option>
	</select>
</div>
<div class="col-9">	
	Tìm kiếm: <input class="form-control" id="text" id="search_phone" type="text" onkeyup="ShowResult(this.value)" placeholder="Nhập số điện thoại">					
</div>
<table class="table table-hover" width="100%" id="tableschedule">			
	<?php 
		require_once "../../controller/receptionist/getschedule.php";
	?>	
</table>
</form>
<center>
<span id="pagi">	
<?php
	if ($current_page > 1 && $total_page > 1){
    	echo '<a href="index.php?action=schedule&page='.($current_page-1).'">Prev</a> | ';
	}
	for ($i = 1; $i <= $total_page; $i++){
	    if ($i == $current_page){
	        echo '<span>'.$i.'</span> | ';
	    }
	    else{
	        echo '<a href="index.php?action=schedule&page='.$i.'">'.$i.'</a> | ';
	    }
	}
	if ($current_page < $total_page && $total_page > 1){
	    echo '<a id="next" href="index.php?action=schedule&page='.($current_page+1).'" >Next</a>';
	}		
?>	
</span>
</center>