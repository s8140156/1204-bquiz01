<h3>新增動畫圖片</h3>
<hr>
<form action="./api/add.php" method="post" enctype="multipart/form-data">
	<table>
		<tr>
			<td>動畫圖片</td>
			<td><input type="file" name="img" id=""></td>
		</tr>

	</table>
	<div>
		<input type="hidden" name="table" value="<?= $_GET['table']; ?>">
		<!-- 由於$do是使用include方式載入(back/titile include至back.php)(直接server端作業沒有client端請求) -->
		<!-- 所以這邊不能使用$do 要用$_GET傳值方式利用hidden input 設name=table -->
		<input type="submit" value="新增">
		<input type="reset" value="重置">
	
	</div>
</form>