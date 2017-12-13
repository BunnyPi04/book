<form method="post">	<!-- Nếu cần => action-->
	<label>Số thứ 1: </label><input type="text" name="st1" required="1" /><br/>
	<label>Phép tính: </label>
	<select name="pt">
		<option value="+"> + </option>
		<option value="-"> - </option>
		<option value='*'> * </option>
		<option value="/"> / </option>
	</select><br/>
	<label>Số thứ 2: </label><input type="text" name="st2"><br/>
	<label>Kết quả: </label><input type="text" name="kq" value=""><br/>
	<input type="submit" name="sbm" value="Tính">
	<?php echo csrf_field();?> <!-- Must have của các file có form-->
</form>