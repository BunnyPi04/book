<form method="post">	<!-- Nếu cần => action-->
<table>
	<tr>
        <td colspan="4">Calculator</td>
    </tr>
    <tr>
    	<td><label>Số thứ 1: </label></td>
    	<td><input type="text" name="st1" required="1" /></td>
    </tr>
    <tr>
    	<td><label>Phép tính: </label></td>
    	<td><select name="pt" required="1">
				<option value="+"> + </option>
				<option value="-"> - </option>
				<option value='*'> * </option>
				<option value="/"> / </option>
			</select></td>
    </tr>
	<tr>
		<td><label>Số thứ 2: </label></td>
		<td><input type="text" name="st2" required="1"></td>
	</tr>
	<tr>
		<td><label>Kết quả: </label></td>
		<td><input type="text" name="kq" value="<?php if (isset($kq)) {echo $kq;}?>"></td>
	</tr>	
	<tr>
		<td colspan="2"><input type="submit" name="sbm" value="Tính"></td>
	</tr>
	
	<?php echo csrf_field();?> <!-- Must have của các file có form-->
</table>
</form>
<style>
table, th, tr, td {
    border: 1px solid black;
    color: black;
}
th{
    background: #666;
}
.a {
    background: #999;
}
.b {
    text-align: center;
}
</style>